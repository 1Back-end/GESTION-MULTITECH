<?php
include("../database/connexion.php");

$erreur = "";
$success = "";

if (isset($_POST["submit"])) {
    // Récupérer les informations du formulaire
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $id_user = $_POST["id_user"];

    // Vérifier que les mots de passe correspondent
    if ($password !== $confirm_password) {
        $erreur = "Les mots de passe ne correspondent pas.";
    } else {
        try {
            // Hacher le mot de passe
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // Mettre à jour le mot de passe dans la base de données
            $stmt = $connexion->prepare("UPDATE users SET password = :password WHERE id = :id");
            $stmt->bindParam(':password', $hashed_password);
            $stmt->bindParam(':id', $id_user);
            $stmt->execute();

            // Si la mise à jour est réussie, rediriger vers la page de connexion
            if ($stmt->rowCount() > 0) {
                header("Location: login.php?msg=Mot de passe réinitialisé avec succès");
                exit();
            } else {
                $erreur = "Erreur lors de la réinitialisation du mot de passe.";
            }
        } catch (Exception $e) {
            $erreur = "Erreur lors de la mise à jour : " . $e->getMessage();
        }
    }
}
?>
