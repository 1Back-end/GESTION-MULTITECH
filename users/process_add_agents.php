<?php
include("../database/connexion.php");
// include("fonction.php");

$erreur = "";
$success = "";

if (isset($_POST["submit"])) {
    $uuid = generateUUID();
    $added_by = $_SESSION['id'] ?? null;
    $agency = get_my_agency($connexion, $added_by);
    $agency_uuid = $agency['uuid'] ?? null;

    $fullname = trim($_POST["fullname"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $phone = trim($_POST["phone"] ?? "");
    $phone_2 = trim($_POST["phone_2"] ?? "");
    $cni_number = trim($_POST["cni_number"] ?? "");
    $address = trim($_POST["address"] ?? "");
    $position = trim($_POST["position"] ?? "");
    $photoPath = null;

    // Vérifier que les champs obligatoires sont remplis
    if (empty($fullname) || empty($email) || empty($cni_number) || empty($address) || empty($phone ) || empty($position)) {
        $erreur = "Veuillez remplir tous les champs obligatoires (*).";
    } else {
        try {
            // Vérifier si l'agent existe déjà
            $check = $connexion->prepare("SELECT uuid FROM agents_for_agency WHERE email = :email OR cni_number = :cni");
            $check->execute(['email' => $email, 'cni' => $cni_number]);

            if ($check->fetch()) {
                $erreur = "Cet agent existe déjà.";
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
                        } else {
                            $erreur = "Erreur lors du téléchargement de la photo.";
                        }
                    }
                }

                if (empty($erreur)) {
                    $sql = "INSERT INTO agents_for_agency 
                        (uuid, agency_uuid, fullname, email, phone, phone_2, cni_number, address, position, photo, is_active, is_deleted, added_by) 
                        VALUES 
                        (:uuid, :agency_uuid, :fullname, :email, :phone, :phone_2, :cni_number, :address, :position, :photo, 1, 0, :added_by)";
                    $stmt = $connexion->prepare($sql);
                    $stmt->execute([
                        'uuid' => $uuid,
                        'agency_uuid' => $agency_uuid,
                        'fullname' => $fullname,
                        'email' => $email,
                        'phone' => $phone,
                        'phone_2' => $phone_2,
                        'cni_number' => $cni_number,
                        'address' => $address,
                        'position' => $position,
                        'photo' => $photoPath,
                        'added_by' => $added_by
                    ]);

                    $success = "Agent enregistré avec succès.";
                    echo "<script>setTimeout(function() { window.location.href='gestion_agencies.php'; }, 3000);</script>";
                }
            }
        } catch (PDOException $e) {
            $erreur = "Erreur PDO : " . $e->getMessage();
        }
    }
}
?>
