<?php
include("../database/connexion.php");

$erreur = "";
$success = "";


if (isset($_POST['submit'])) {
    $uuid = trim($_POST['uuid'] ?? '');
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $region = trim($_POST['region'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $manager_uuid = trim($_POST["manager_uuid"] ?? '');
    $added_by = $_SESSION["id"] ?? null;

    if (empty($name) || empty($email) || empty($region) || empty($city) || empty($phone) || empty($manager_uuid) || empty($added_by)) {
        $erreur = "Tous les champs sont requis !";
    } else {

        // Récupérer les données actuelles pour l'agence (notamment logo)
        $stmtOld = $connexion->prepare("SELECT logo FROM main_agencies WHERE uuid = :uuid AND is_deleted = 0 LIMIT 1");
        $stmtOld->execute([':uuid' => $uuid]);
        $agency = $stmtOld->fetch(PDO::FETCH_ASSOC);

        if (!$agency) {
            $erreur = "Agence non trouvée.";

        } else {
            $logo_image_path = $agency['logo']; // logo actuel

            // Gestion upload nouveau logo
            if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
                $upload_dir = '../uploads/agency/';
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }

                $tmp_name = $_FILES['logo']['tmp_name'];
                $ext = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
                $filename = generateUUID() . '.' . $ext;
                $destination = $upload_dir . $filename;

                if (move_uploaded_file($tmp_name, $destination)) {
                    // Optionnel : supprimer l'ancien fichier logo si existe
                    if (!empty($logo_image_path) && file_exists($upload_dir . $logo_image_path)) {
                        unlink($upload_dir . $logo_image_path);
                    }
                    $logo_image_path = $filename;
                } else {
                    $erreur = "Erreur lors de l'upload du logo.";
                }
            }

            if (empty($erreur)) {
                // Vérification doublons sauf pour cette agence (id différent)
                $check = $connexion->prepare("SELECT COUNT(*) FROM main_agencies WHERE (name = :name OR email = :email OR manager_uuid = :manager_uuid) AND uuid != :uuid");
                $check->execute([
                    ':name' => $name,
                    ':email' => $email,
                    ':manager_uuid' => $manager_uuid,
                    ':uuid' => $uuid
                ]);

                if ($check->fetchColumn() > 0) {
                    $erreur = "Cette agence existe déjà (nom, email ou gestionnaire déjà utilisé).";
                } else {
                    // Mise à jour
                    $sql = "UPDATE main_agencies SET
                                name = :name,
                                phone = :phone,
                                email = :email,
                                city = :city,
                                region = :region,
                                logo = :logo,
                                manager_uuid = :manager_uuid,
                                added_by = :added_by
                            WHERE uuid = :uuid";

                    $stmt = $connexion->prepare($sql);
                    $result = $stmt->execute([
                        ':name' => $name,
                        ':phone' => $phone,
                        ':email' => $email,
                        ':city' => $city,
                        ':region' => $region,
                        ':logo' => $logo_image_path,
                        ':manager_uuid' => $manager_uuid,
                        ':added_by' => $added_by,
                        ':uuid' => $uuid
                    ]);

                    if ($result) {
                        $success = "Agence mise à jour avec succès.";
                        echo "<script>setTimeout(function() { window.location.href='list_of_agencies.php'; }, 3000);</script>";
                    } else {
                        $erreur = "Erreur lors de la mise à jour de l'agence.";
                    }
                }
            }
        }
    }
}
