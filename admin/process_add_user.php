<?php 
include("../database/connexion.php"); 
include("../fonction/fonction.php");
include("../config/config_smtp.php");

$erreur = "";
$success = "";

if (isset($_POST["submit"])) {
    $first_name = $_POST["first_name"] ?? null;
    $last_name = $_POST["last_name"] ?? null;
    $email = $_POST["email"] ?? null;
    $adresse = $_POST["adresse"] ?? null;
    $phone = $_POST["phone"] ?? null;
    $photo = $_FILES['photo'] ?? null;

    $id = generateUUID();
    $password = generatePassword(); // Génère un mot de passe sécurisé

    try {
        // Vérifier si l'email ou le numéro de téléphone existent déjà
        $stmt = $connexion->prepare("SELECT COUNT(*) FROM users WHERE email = ? OR phone_number = ?");
        $stmt->execute([$email, $phone]);
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            $erreur = "L'email ou le numéro de téléphone existe déjà.";
        } else {
            // Gérer l'upload de l'image si fournie
            $photo_name = null;
            if ($photo && $photo['tmp_name']) {
                $photo_name = uniqid() . "_" . basename($photo['name']);
                move_uploaded_file($photo['tmp_name'], "../uploads/" . $photo_name);
            }

            // Insérer l'utilisateur en base de données
            $stmt = $connexion->prepare("INSERT INTO users (id, first_name, last_name, email, address, phone_number, password, photo, role, is_deleted, status, created_at, updated_at) 
                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'admin', 0, 'active', NOW(), NOW())");

            $stmt->execute([$id, $first_name, $last_name, $email, $adresse, $phone, password_hash($password, PASSWORD_BCRYPT), $photo_name]);

            // Préparer l'email à envoyer à l'utilisateur
            $subject = 'Création de votre compte sur notre application';
            $message = file_get_contents('../template/account_creation.html');
            $message = str_replace('{{user_name}}', $first_name . ' ' . $last_name, $message);
            $message = str_replace('{{username}}', $email, $message);
            $message = str_replace('{{password}}', $password, $message);
            // $message = str_replace('{{login_url}}', 'https://votre-site.com/login', $message);

            // Ajouter l'adresse de l'utilisateur à l'email
            $mail->addAddress($email, $first_name . ' ' . $last_name);

            // Contenu de l'e-mail
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->CharSet = 'UTF-8';
            $mail->Body = $message;

            // Envoi de l'e-mail
            if ($mail->send()) {
                $success = "Utilisateur ajouté avec succès. Un e-mail a été envoyé.";
            } else {
                $erreur = "L'utilisateur a été ajouté, mais l'e-mail n'a pas pu être envoyé.";
            }
        }
    } catch (Exception $e) {
        $erreur = "Erreur lors de l'ajout : " . $e->getMessage();
    }
}
?>
