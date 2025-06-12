<?php
include("../database/connexion.php");


$erreur = "";
$success = "";

// Traitement de la soumission du formulaire
if (isset($_POST["submit"])) {
    // Récupérer et nettoyer les données POST
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $phone_2 = trim($_POST['phone_2']);
    $cni_number = trim($_POST['cni_number']);
    $address = trim($_POST['address']);
    $position = trim($_POST['position']);

    // Initialiser photoPath à l'ancienne photo par défaut
    $photoPath = $agent['photo'];

    // Validation simple
    if (!$fullname || !$email || !$phone || !$cni_number || !$address || !$position) {
        $erreur = "Tous les champs obligatoires doivent être remplis.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreur = "Email invalide.";
    } else {
        // Gérer le téléchargement de la photo si elle est présente
        if (!empty($_FILES['photo']['name'])) {
            $file = $_FILES['photo'];
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            $maxSize = 2 * 1024 * 1024; // 2 Mo

            if (!in_array($file['type'], $allowedTypes)) {
                $erreur = "Type de fichier non autorisé. Seuls JPG, JPEG et PNG sont autorisés.";
            } elseif ($file['size'] > $maxSize) {
                $erreur = "La taille de la photo dépasse 2 Mo.";
            } else {
                $uploadDir = "../uploads/agents/";
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0775, true);
                }

                $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                $filename = generateUUID() . '.' . $ext;
                $uploadPath = $uploadDir . $filename;

                if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
                    $photoPath = $filename; // on enregistre seulement le nom du fichier

                    // Optionnel : supprimer l'ancienne photo si différente et existe
                    if ($agent['photo'] && file_exists($uploadDir . $agent['photo'])) {
                        unlink($uploadDir . $agent['photo']);
                    }
                } else {
                    $erreur = "Erreur lors du téléchargement de la photo.";
                }
            }
        }

        if (empty($erreur)) {
            // Mettre à jour la base
            $sql = "UPDATE agents_for_agency SET fullname = :fullname, email = :email, phone = :phone, phone_2 = :phone_2, cni_number = :cni_number, address = :address, position = :position, photo = :photo, updated_at = NOW() WHERE uuid = :uuid";
            $stmt = $connexion->prepare($sql);
            $params = [
                ':fullname' => $fullname,
                ':email' => $email,
                ':phone' => $phone,
                ':phone_2' => $phone_2,
                ':cni_number' => $cni_number,
                ':address' => $address,
                ':position' => $position,
                ':photo' => $photoPath,
                ':uuid' => $uuid
            ];
            if ($stmt->execute($params)) {
                $success = "Agent mis à jour avec succès.";
                echo "<script>setTimeout(function() { window.location.href='gestion_agencies.php'; }, 3000);</script>";
                // Recharger les données modifiées
                $stmt = $connexion->prepare("SELECT * FROM agents_for_agency WHERE uuid = :uuid");
                $stmt->execute(['uuid' => $uuid]);
                $agent = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                $erreur = "Erreur lors de la mise à jour.";
            }
        }
    }
}
?>
