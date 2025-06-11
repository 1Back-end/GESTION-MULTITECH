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

    // Champs requis
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

        // Données
        $uuid = generateUUID();
        $ref = generate_package_code();
        $sender_name = $_POST['sender_name'];
        $sender_phone = $_POST['sender_phone'];
        $sender_address = $_POST['sender_address'];
        $recipient_name = $_POST['recipient_name'];
        $recipient_phone = $_POST['recipient_phone'];
        $recipient_address = $_POST['recipient_address'];
        $home_delivery = isset($_POST['home_delivery']) ? 1 : 0;
        $package_name = $_POST['package_name'];
        $package_type = $_POST['package_type'];
        $description = $_POST['description'];
        $main_agency_uuid = $_POST['main_agency_uuid'];

        // 📦 Image du colis (facultative)
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

        // Si pas d’erreur à ce stade
        if (!$erreur) {
            // 📎 Génération du QR Code
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

            // 💾 Insertion en base
            $stmt = $connexion->prepare("INSERT INTO packages (
                uuid, sender_name, sender_phone, sender_address,
                recipient_name, recipient_phone, recipient_address,
                home_delivery, package_name, package_type, description,
                image_path, main_agency_uuid, ref, qr_code
            ) VALUES (
                :uuid, :sender_name, :sender_phone, :sender_address,
                :recipient_name, :recipient_phone, :recipient_address,
                :home_delivery, :package_name, :package_type, :description,
                :image_path, :main_agency_uuid, :ref, :qr_code
            )");

            $stmt->execute([
                ':uuid' => $uuid,
                ':sender_name' => $sender_name,
                ':sender_phone' => $sender_phone,
                ':sender_address' => $sender_address,
                ':recipient_name' => $recipient_name,
                ':recipient_phone' => $recipient_phone,
                ':recipient_address' => $recipient_address,
                ':home_delivery' => $home_delivery,
                ':package_name' => $package_name,
                ':package_type' => $package_type,
                ':description' => $description,
                ':image_path' => $imageName,
                ':main_agency_uuid' => $main_agency_uuid,
                ':ref' => $ref,
                ':qr_code' => $qrFilename
            ]);

            // 📧 Envoi de mail à l’agence
            $stmtAgency = $connexion->prepare("SELECT email, name FROM main_agencies WHERE uuid = :uuid LIMIT 1");
            $stmtAgency->execute([':uuid' => $main_agency_uuid]);
            $agency = $stmtAgency->fetch(PDO::FETCH_ASSOC);

            if ($agency && !empty($agency['email'])) {
                try {
                    $mail = new PHPMailer(true);
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'investmentimmo425@gmail.com'; // Remplacez par votre email
                    $mail->Password = 'ujgv lznq vhnv dvdc'; // Remplacez par votre mot de passe
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;
                    $mail->setFrom('investmentimmo425@gmail.com', 'GESTION MULTITECH');
                    $mail->addAddress($agency['email'], $agency['name']);

                    $mail->isHTML(true);
                    $mail->Subject = "Nouveau colis reçu";
                     $mail->CharSet = 'UTF-8';
                    // Charger le template HTML
                    $template = file_get_contents('../template/new_package_email_template.html');

                    // Remplacer les balises par les vraies données
                    $now = date('d/m/Y à H:i'); // Exemple : 11/06/2025 à 14:30
                    $body = str_replace(
                        [
                            '{{AGENCY_NAME}}',
                            '{{SENDER_ADDRESS}}',
                            '{{PACKAGE_REF}}',
                            '{{SENDER_NAME}}',
                            '{{SENDER_PHONE}}',
                            '{{RECIPIENT_NAME}}',
                            '{{RECIPIENT_PHONE}}',
                            '{{RECIPIENT_ADDRESS}}',
                            '{{CURRENT_DATE}}'
                        ],
                        [
                            $agency['name'],
                            $sender_address,        // ✅ Doit correspondre à l'adresse réelle, PAS au code de référence
                            $ref,                   // Le code du colis ici
                            $sender_name,
                            $sender_phone,
                            $recipient_name,
                            $recipient_phone,
                            $recipient_address,
                            $now
                        ],
                        $template
                    );


                     $mail->Body = $body;
                     if ($mail->send()) {
                     $success = "Colis enregistré avec succès et email envoyé à l'agence « {$agency['name']} » !";
                     echo "<script>setTimeout(function() { window.location.href='../index.php'; }, 3000);</script>";
                    } else {
                        $erreur = "Colis enregistré, mais échec de l’envoi d’email à l'agence « {$agency['name']} !";
                    }
                } catch (Exception $e) {
                    $erreur = "Erreur lors de l’envoi du colis à l'agence : " . $e->getMessage();
                }
            }

        }
    }
}
?>
