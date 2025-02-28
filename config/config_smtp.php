
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

// Configuration SMTP de PHPMailer
$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com'; // Ou votre fournisseur SMTP
$mail->SMTPAuth = true;
$mail->Username = 'investmentimmo425@gmail.com'; // Remplacez par votre email
$mail->Password = 'ujgv lznq vhnv dvdc'; // Remplacez par votre mot de passe
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
$mail->setFrom('investmentimmo425@gmail.com', 'GESTION MULTITECH');
?>
