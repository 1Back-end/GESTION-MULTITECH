<?php

include("../database/connexion.php");
require '../vendor/autoload.php';
include("../config/config_smtp.php");

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$erreur = "";
$success = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $required_fields = [
        'sender_name', 'sender_phone', 'sender_address',
        'recipient_name', 'recipient_phone', 'recipient_address',
        'package_name', 'package_type', 'description', 'main_agency_uuid'
    ];

    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $erreur = "Tous les champs sont requis.";
            break;
        }
    }

    if (!$erreur) {
        $uuid = generateUUID();
        $ref = generate_package_code();
        $sender_name = $_POST['sender_name'];
        $sender_phone = $_POST['sender_phone'];
        $sender_address = $_POST['sender_address'];
        $recipient_name = $_POST['recipient_name'];
        $recipient_phone = $_POST['recipient_phone'];
        $recipient_address = $_POST['recipient_address'];
        $home_delivery = isset($_POST['home_delivery']) ? 1 : 0;
        $agency_delivery = isset($_POST['agency_delivery']) ? 1 : 0;
        $package_name = $_POST['package_name'];
        $package_type = $_POST['package_type'];
        $description = $_POST['description'];
        $main_agency_uuid = $_POST['main_agency_uuid'];
        $sender_cni = $_POST['sender_cni'];
        $recipient_cni = $_POST['recipient_cni'];

        // Image (facultative)
        $imageName = null;
        if (!empty($_FILES['image_path']['name'])) {
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

        // Génération du QR Code
        if (!$erreur) {
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
                . "Livraison à domicile: " . ($home_delivery ? 'Oui' : 'Non') . "\n"
                . "Livraison à l'agence: " . ($agency_delivery ? 'Oui' : 'Non');

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

            // Insertion base de données
            $stmt = $connexion->prepare("INSERT INTO packages (
                uuid, sender_name, sender_phone, sender_address, sender_cni,
                recipient_name, recipient_phone, recipient_address, recipient_cni,
                home_delivery, agency_delivery, package_name, package_type, description,
                image_path, main_agency_uuid, ref, qr_code
            ) VALUES (
                :uuid, :sender_name, :sender_phone, :sender_address, :sender_cni,
                :recipient_name, :recipient_phone, :recipient_address, :recipient_cni,
                :home_delivery, :agency_delivery, :package_name, :package_type, :description,
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
                ':agency_delivery' => $agency_delivery,
                ':package_name' => $package_name,
                ':package_type' => $package_type,
                ':description' => $description,
                ':image_path' => $imageName,
                ':main_agency_uuid' => $main_agency_uuid,
                ':ref' => $ref,
                ':qr_code' => $qrFilename
            ]);

            // ✅ WhatsApp au lieu de Mail
            $now = date('d/m/Y à H:i');
            $whatsapp_number = "237690635861";

            $message = "Bonjour, un nouveau colis a été enregistré.\n\n"
                . "*REF:* $ref\n"
                . "*Expéditeur:* $sender_name ($sender_phone)\n"
                . "*Adresse:* $sender_address\n"
                . "*Destinataire:* $recipient_name ($recipient_phone)\n"
                . "*Adresse:* $recipient_address\n"
                . "*Nom du colis:* $package_name\n"
                . "*Type:* $package_type\n"
                . "*Description:* $description\n"
                . "*Livraison à domicile:* " . ($home_delivery ? 'Oui' : 'Non') . "\n"
                . "*Livraison à l'agence:* " . ($agency_delivery ? 'Oui' : 'Non') . "\n"
                . "*Date:* $now";

            $encodedMessage = rawurlencode($message);
            $whatsapp_link = "https://wa.me/{$whatsapp_number}?text={$encodedMessage}";

            // ✅ Message succès + redirection vers WhatsApp
            echo "<script>
                alert('Colis enregistré avec succès ! Redirection vers WhatsApp...');
                setTimeout(function() {
                    window.location.href = '$whatsapp_link';
                }, 2000);
            </script>";
        }
    }
}
