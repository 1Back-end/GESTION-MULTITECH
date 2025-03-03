<?php
ob_start();
include_once("../database/connexion.php");
include_once("../fonction/fonction.php");

$erreur = "";
$success = "";

if (isset($_POST["modifier"])) {
    $id_user = $_POST['id_user'] ?? null;
    $nom = $_POST['nom'] ?? null;
    $prenom = $_POST['prenom'] ?? null;
    $email = $_POST['email'] ?? null;
    $adresse = $_POST['adresse'] ?? null;
    $telephone = $_POST['telephone'] ?? null;
    $photo = $_FILES['photo'] ?? null;

    $max_image_size = 5242880; // 5MB
    $allowed_image_types = ['image/jpeg', 'image/png'];

    if (!$id_user) {
        $erreur = "ID utilisateur non fourni.";
    } else {
        // Vérifier si l'utilisateur existe
        $sql_select = "SELECT * FROM users WHERE id = ?";
        $stmt_select = $connexion->prepare($sql_select);
        $stmt_select->execute([$id_user]);
        $user = $stmt_select->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            $erreur = "Utilisateur introuvable.";
        } else {
            // Gestion de l'upload de la photo
            if (!empty($photo['tmp_name']) && is_uploaded_file($photo['tmp_name'])) {
                if (!in_array($photo['type'], $allowed_image_types)) {
                    $erreur = "Seuls les fichiers JPG et PNG sont autorisés.";
                } elseif ($photo['size'] > $max_image_size) {
                    $erreur = "L'image ne doit pas dépasser 5MB.";
                } else {
                    $target_dir = "../uploads/";

                    // Vérifier si le dossier existe sinon le créer
                    if (!file_exists($target_dir)) {
                        mkdir($target_dir, 0775, true);
                    }

                    // Générer un nom de fichier unique
                    $photo_nom = time() . "_" . pathinfo($photo["name"], PATHINFO_FILENAME) . "." . pathinfo($photo["name"], PATHINFO_EXTENSION);
                    $target_file = $target_dir . $photo_nom;

                    if (move_uploaded_file($photo["tmp_name"], $target_file)) {
                        // Mettre à jour la photo dans la base de données
                        $sql_update_photo = "UPDATE users SET photo = ? WHERE id = ?";
                        $stmt_update_photo = $connexion->prepare($sql_update_photo);
                        $stmt_update_photo->execute([$photo_nom, $id_user]);
                    } else {
                        $erreur = "Erreur lors du téléchargement de l'image.";
                    }
                }
            }

            // Mise à jour des autres champs
            $fields_to_update = [
                'first_name' => $nom,
                'last_name' => $prenom,
                'email' => $email,
                'address' => $adresse,
                'phone_number' => $telephone
            ];

            foreach ($fields_to_update as $field => $value) {
                if ($value !== null && $value !== $user[$field]) {
                    $sql_update = "UPDATE users SET $field = ? WHERE id = ?";
                    $stmt_update = $connexion->prepare($sql_update);
                    $stmt_update->execute([$value, $id_user]);
                }
            }

            if (empty($erreur)) {
                $success = "Le profil a été mis à jour avec succès.";
            }
        }
    }
}

$connexion = null;
ob_end_flush();
?>
