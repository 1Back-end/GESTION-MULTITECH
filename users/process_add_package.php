<?php

include("../database/connexion.php");
include("fonction.php");
require '../vendor/autoload.php';


use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

$erreur = "";
$success = "";

if (isset($_POST["submit"])) {

    // Données
    $uuid = generateUUID();
    $ref = generate_package_code();

    $sender_name = trim($_POST['sender_name']);
    $sender_phone = trim($_POST['sender_phone']);
    $sender_address = trim($_POST['sender_address']);
    $sender_cni = trim($_POST['sender_cni'] ?? '');
    
    $recipient_name = trim($_POST['recipient_name']);
    $recipient_phone = trim($_POST['recipient_phone']);
    $recipient_address = trim($_POST['recipient_address']);
    $recipient_cni = trim($_POST['recipient_cni']);

    $package_name = trim($_POST['package_name']);
    $package_type = trim($_POST['package_type']);
    $description = trim($_POST['description']);
    // $main_agency_uuid = $_POST['main_agency_uuid'];
    $home_delivery = isset($_POST['home_delivery']) ? 1 : 0;

    $added_by = $_SESSION['id'] ?? null;
    $agency = get_my_agency($connexion, $added_by);
    $agency_uuid = $agency['uuid'] ?? null;

    // Validation
    if (
        empty($sender_name) || empty($sender_phone) || empty($sender_address) ||
        empty($recipient_name) || empty($recipient_phone) || empty($recipient_address) ||
        empty($recipient_cni) || empty($package_name) || empty($package_type) || 
        empty($description)
    ) {
        $erreur = "Tous les champs requis doivent être remplis.";
    } elseif (!$agency_uuid) {
        $erreur = "Agence non trouvée pour l'utilisateur actuel.";
    } else {
        // Vérification unicité téléphone et CNI
        $stmtCheck = $connexion->prepare("SELECT COUNT(*) FROM packages WHERE sender_phone = :phone OR recipient_phone = :phone OR sender_cni = :cni OR recipient_cni = :cni");
        $stmtCheck->execute([
            ':phone' => $recipient_phone,
            ':cni' => $recipient_cni
        ]);
        $exist = $stmtCheck->fetchColumn();

        if ($exist > 0) {
            $erreur = "Le numéro de téléphone ou la CNI du destinataire existe déjà dans le système.";
        }

        // Vérif côté expéditeur aussi
        if (!$erreur && $sender_cni && $sender_phone) {
            $stmtCheckSender = $connexion->prepare("SELECT COUNT(*) FROM packages WHERE sender_phone = :phone OR sender_cni = :cni");
            $stmtCheckSender->execute([
                ':phone' => $sender_phone,
                ':cni' => $sender_cni
            ]);
            if ($stmtCheckSender->fetchColumn() > 0) {
                $erreur = "Le numéro de téléphone ou la CNI de l'expéditeur existe déjà dans le système.";
            }
        }
    }

    // 📦 Gestion de l'image
    $imageName = null;
    if (!$erreur && !empty($_FILES['image_path']['name'])) {
        $allowed_types = ['image/jpeg', 'image/jpg', 'image/png'];
        $max_size = 2 * 1024 * 1024;

        if (!in_array($_FILES['image_path']['type'], $allowed_types)) {
            $erreur = "Type d’image invalide. Seuls JPG, JPEG et PNG sont autorisés.";
        } elseif ($_FILES['image_path']['size'] > $max_size) {
            $erreur = "L’image ne doit pas dépasser 2 Mo.";
        } else {
            $uploadDir = "../uploads/packages/";
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

            $imageName = uniqid() . '_' . basename($_FILES['image_path']['name']);
            $imageTmpPath = $_FILES['image_path']['tmp_name'];
            $imageDest = $uploadDir . $imageName;

            if (!move_uploaded_file($imageTmpPath, $imageDest)) {
                $erreur = "Erreur lors de l’upload de l’image.";
            }
        }
    }

    // ✅ Si pas d'erreur, insertion
    if (!$erreur) {
        try {
            // QR Code
            $qr_content = "REF: $ref\n"
                . "Nom de l’expéditeur: $sender_name\n"
                . "Téléphone de l’expéditeur: $sender_phone\n"
                . "Adresse de l’expéditeur: $sender_address\n"
                . "Nom du destinataire: $recipient_name\n"
                . "Téléphone du destinataire: $recipient_phone\n"
                . "Adresse du destinataire: $recipient_address\n"
                . "Nom du colis: $package_name\n"
                . "Type de colis: $package_type\n"
                . "Description: $description\n"
                . "Livraison à domicile: " . ($home_delivery ? 'Oui' : 'Non');

            $qr_dir = "../uploads/qrcodes/";
            if (!is_dir($qr_dir)) mkdir($qr_dir, 0755, true);

            $qrFilename = $uuid . ".png";
            $qr_path = $qr_dir . $qrFilename;

            $options = new QROptions([
                'outputType' => QRCode::OUTPUT_IMAGE_PNG,
                'eccLevel' => QRCode::ECC_L,
                'scale' => 5
            ]);

            (new QRCode($options))->render($qr_content, $qr_path);

            // Insertion DB
            $stmt = $connexion->prepare("INSERT INTO packages (
                uuid, sender_name, sender_phone, sender_address, sender_cni,
                recipient_name, recipient_phone, recipient_address, recipient_cni,
                home_delivery, package_name, package_type, description,
                image_path, main_agency_uuid, ref, qr_code
            ) VALUES (
                :uuid, :sender_name, :sender_phone, :sender_address, :sender_cni,
                :recipient_name, :recipient_phone, :recipient_address, :recipient_cni,
                :home_delivery, :package_name, :package_type, :description,
                :image_path, :main_agency_uuid, :ref, :qr_code
            )");

            $stmt->execute([
                ':uuid' => $uuid,
                ':sender_name' => $sender_name,
                ':sender_phone' => $sender_phone,
                ':sender_address' => $sender_address,
                ':sender_cni' => $sender_cni,
                ':recipient_name' => $recipient_name,
                ':recipient_phone' => $recipient_phone,
                ':recipient_address' => $recipient_address,
                ':recipient_cni' => $recipient_cni,
                ':home_delivery' => $home_delivery,
                ':package_name' => $package_name,
                ':package_type' => $package_type,
                ':description' => $description,
                ':image_path' => $imageName,
                ':main_agency_uuid' => $agency_uuid,
                ':ref' => $ref,
                ':qr_code' => $qrFilename
            ]);

            $success = "Colis enregistré avec succès.";
            echo "<script>setTimeout(function() { window.location.href='package_agencies.php'; }, 3000);</script>";

        } catch (Exception $e) {
            $erreur = "Erreur lors de l’enregistrement du colis : " . $e->getMessage();
        }
    }
}
?>
