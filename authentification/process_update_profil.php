<?php

include("../database/connexion.php");

// Récupérer l'identifiant de l'utilisateur depuis la session

$success = "" ;
$erreur = "" ;

// Traitement de la modification du profil
if (isset($_POST['modifier'])) {
    // Récupération des données du formulaire
    $prenom = htmlspecialchars($_POST['prenom']);
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $id_user = $_SESSION['id']; 
    
    // Vérifier si une photo a été envoyée
    if (!empty($_FILES['photo']['name'])) {
        $photo = $_FILES['photo'];
        $photo_name = time() . "_" . basename($photo['name']); // Nom unique
        $upload_dir = "../uploads/";
        $upload_file = $upload_dir . $photo_name;

        // Vérifier la taille et le format
        $allowed_extensions = ['jpg', 'jpeg', 'png'];
        $photo_extension = strtolower(pathinfo($photo_name, PATHINFO_EXTENSION));
        
        if (in_array($photo_extension, $allowed_extensions) && $photo['size'] <= 5 * 1024 * 1024) {
            if (move_uploaded_file($photo['tmp_name'], $upload_file)) {
                // Mettre à jour la photo dans la base de données
                $sql = "UPDATE users SET first_name = :prenom, last_name = :nom, email = :email, address = :adresse, phone_number = :telephone, photo = :photo WHERE id = :id_user";
                $stmt = $connexion->prepare($sql);
                $stmt->bindParam(':photo', $photo_name);
            } else {
                $success = "Erreur lors du téléchargement de la photo.";
            }
        } else {
            $erreur = "Format ou taille de la photo invalide.";
        }
    } else {
        // Mise à jour sans changer la photo
        $sql = "UPDATE users SET first_name = :prenom, last_name = :nom, email = :email, address = :adresse, phone_number = :telephone WHERE id = :id_user";
        $stmt = $connexion->prepare($sql);
    }

    // Liaison des paramètres et exécution de la requête
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':adresse', $adresse);
    $stmt->bindParam(':telephone', $telephone);
    $stmt->bindParam(':id_user', $id_user);
    
    if ($stmt->execute()) {
        $success = "Profil mis à jour avec succès.";
        
    } else {
        $erreur = "Erreur lors de la mise à jour.";
    }
}

?>
