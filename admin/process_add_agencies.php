<?php

include("../database/connexion.php");


$erreur = "";
$success = "";

if (isset($_POST['submit'])) {
    $ref = generate_agency_code();
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $region = trim($_POST['region'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $manager_uuid = trim($_POST["manager_uuid"] ?? '');
    $added_by = $_SESSION["id"] ?? null;

    if (empty($ref) || empty($name) || empty($email) || empty($region) || empty($city) || empty($phone) || empty($manager_uuid) || empty($added_by)) {
        $erreur = "Tous les champs sont requis !";
    } else {
        // Vérification des doublons
        $check = $connexion->prepare("SELECT COUNT(*) FROM main_agencies WHERE name = :name OR email = :email OR manager_uuid = :manager_uuid");
        $check->execute([
            ':name' => $name,
            ':email' => $email,
            ':manager_uuid' => $manager_uuid
        ]);

        if ($check->fetchColumn() > 0) {
            $erreur = "Cette agence existe déjà (nom, email ou gestionnaire déjà utilisé).";
        } else {
            $logo_image_path = null;

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
                    $logo_image_path = $filename;
                }
            }

            $uuid = generateUUID();
            $sql = "INSERT INTO main_agencies (uuid, ref, name, phone, email, city, region, logo, manager_uuid, is_active, is_deleted, added_by)
                    VALUES (:uuid, :ref, :name, :phone, :email, :city, :region, :logo, :manager_uuid, 1, 0, :added_by)";
            
            $stmt = $connexion->prepare($sql);
            $result = $stmt->execute([
                ':uuid' => $uuid,
                ':ref' => $ref,
                ':name' => $name,
                ':phone' => $phone,
                ':email' => $email,
                ':city' => $city,
                ':region' => $region,
                ':logo' => $logo_image_path,
                ':manager_uuid' => $manager_uuid,
                ':added_by' => $added_by
            ]);

            if ($result) {
                $success = "Agence enregistrée avec succès.";
                echo "<script>setTimeout(function() { window.location.href='list_of_agencies.php'; }, 3000);</script>";
            } else {
                $erreur = "Erreur lors de l'enregistrement de l'agence.";
            }
        }
    }
}
