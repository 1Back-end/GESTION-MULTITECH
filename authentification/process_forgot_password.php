<?php
include("../database/connexion.php");

$erreur = "";
$success = "";

if (isset($_POST["submit"])) {
    // Récupérer l'email
    $email = $_POST["email"] ?? null;

    if ($email) {
        try {
            // Vérifier si l'email existe et que l'utilisateur n'est pas supprimé
            $stmt = $connexion->prepare("SELECT * FROM users WHERE email = :email AND is_deleted = 0");
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Utilisateur trouvé, rediriger vers la page de réinitialisation du mot de passe
                $user_id = $user['id'];
                header("Location: reset_password.php?id=$user_id");
                exit();
            } else {
                $erreur = "Email non trouvé ou compte désactivé.";
            }
        } catch (Exception $e) {
            $erreur = "Erreur lors de la récupération de l'utilisateur : " . $e->getMessage();
        }
    } else {
        $erreur = "Veuillez entrer un email.";
    }
}
?>
