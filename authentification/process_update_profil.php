<?php
require_once("../database/connexion.php");
require_once("../fonction/fonction.php");

$erreur = "";
$success = "";

if (isset($_POST["modifier"])) {
    $id_user = $_POST['id_user'] ?? null;
    if (!$id_user) {
        $erreur = "ID utilisateur non fourni.";
    } else {
        $stmt = $connexion->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id_user]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            $erreur = "Utilisateur introuvable.";
        } else {
            $data = [
                'first_name' => $_POST['nom'] ?? $user['first_name'],
                'last_name' => $_POST['prenom'] ?? $user['last_name'],
                'email' => $_POST['email'] ?? $user['email'],
                'address' => $_POST['adresse'] ?? $user['address'],
                'phone_number' => $_POST['telephone'] ?? $user['phone_number']
            ];

            // Mise à jour de la photo si fournie
            if (!empty($_FILES['photo']['tmp_name']) && is_uploaded_file($_FILES['photo']['tmp_name'])) {
                $photo = $_FILES['photo'];
                $max_size = 5242880;
                $allowed = ['image/jpeg', 'image/png'];

                if (in_array($photo['type'], $allowed) && $photo['size'] <= $max_size) {
                    $dir = "../uploads/";
                    if (!file_exists($dir)) mkdir($dir, 0775, true);

                    $photo_nom = time() . "_" . pathinfo($photo["name"], PATHINFO_FILENAME) . "." . pathinfo($photo["name"], PATHINFO_EXTENSION);
                    $path = $dir . $photo_nom;

                    if (move_uploaded_file($photo["tmp_name"], $path)) {
                        $data['photo'] = $photo_nom;
                    } else {
                        $erreur = "Échec du téléchargement de l'image.";
                    }
                } else {
                    $erreur = "Image invalide ou trop volumineuse.";
                }
            }

            // Mise à jour des champs modifiés
            if (empty($erreur)) {
                foreach ($data as $field => $value) {
                    if ($value !== $user[$field]) {
                        $stmt = $connexion->prepare("UPDATE users SET $field = ? WHERE id = ?");
                        $stmt->execute([$value, $id_user]);
                    }
                }
                $success = "Le profil a été mis à jour avec succès.";
            }
        }
    }
}
$connexion = null;
?>
