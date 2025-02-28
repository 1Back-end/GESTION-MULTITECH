<?php
session_start();
include("../database/connexion.php");

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header("Location: ../authentification/login.php");
    exit();
}

$id_user = $_SESSION['id']; // Récupérer l'ID de l'utilisateur connecté

// Vérifier si le formulaire a été soumis
if (isset($_POST['modifier'])) {
    // Récupérer les données soumises
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $adresse = $_POST['adresse'];
    $telephone = $_POST['telephone'];
    $photo = $_FILES['photo'] ?? null; // Photo optionnelle

    // Validation des données
    $errors = [];
    if (empty($prenom) || empty($nom) || empty($email) || empty($adresse) || empty($telephone)) {
        $errors[] = "Tous les champs doivent être remplis.";
    }

    // Vérifier si la photo a été envoyée
    if ($photo && $photo['error'] === UPLOAD_ERR_OK) {
        // Vérification du type et de la taille de l'image
        $allowed_types = ['image/jpeg', 'image/png'];
        if (!in_array($photo['type'], $allowed_types)) {
            $errors[] = "La photo doit être au format JPG ou PNG.";
        }

        if ($photo['size'] > 5 * 1024 * 1024) { // Taille maximale 5 Mo
            $errors[] = "La photo ne doit pas dépasser 5 Mo.";
        }

        // Déplacer le fichier uploadé dans le dossier des uploads
        if (empty($errors)) {
            $photo_name = uniqid() . "-" . basename($photo['name']);
            $photo_path = "../uploads/" . $photo_name;
            move_uploaded_file($photo['tmp_name'], $photo_path);
        }
    }

    // Si aucune erreur, mettre à jour les données de l'utilisateur
    if (empty($errors)) {
        // Préparer la requête SQL pour mettre à jour l'utilisateur
        $sql = "UPDATE users SET first_name = :prenom, last_name = :nom, email = :email, address = :adresse, phone_number = :telephone";
        
        if (!empty($photo_name)) {
            $sql .= ", photo = :photo";
        }

        $sql .= " WHERE id = :user_id";

        $stmt = $connexion->prepare($sql);
        
        // Lier les paramètres
        $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':adresse', $adresse, PDO::PARAM_STR);
        $stmt->bindParam(':telephone', $telephone, PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $id_user, PDO::PARAM_INT);
        
        // Lier la photo si elle a été uploadée
        if (!empty($photo_name)) {
            $stmt->bindParam(':photo', $photo_name, PDO::PARAM_STR);
        }

        // Exécuter la requête
        if ($stmt->execute()) {
            // Si la mise à jour est réussie, rediriger vers la page du profil avec un message de succès
            $_SESSION['success_message'] = "Votre profil a été mis à jour avec succès.";
            header("Location: profile.php");
            exit();
        } else {
            $errors[] = "Une erreur s'est produite lors de la mise à jour du profil.";
        }
    }
}
?>
