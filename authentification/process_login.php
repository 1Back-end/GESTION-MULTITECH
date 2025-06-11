<?php
include("../database/connexion.php");

$erreur = "";
$succes = "";

if (isset($_POST["submit"])) {
    $username = $_POST["username"] ?? null;  // Email ou nom
    $password = $_POST["password"] ?? null;

    try {
        // Vérifier si l'utilisateur existe avec l'email ou le nom
        $stmt = $connexion->prepare("SELECT id, first_name, last_name, email, password, status, photo, role, is_deleted 
                                     FROM users WHERE email = :username OR CONCAT(first_name, ' ', last_name) = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Vérifier si le mot de passe est correct
            if (password_verify($password, $user['password'])) {
                // Vérifier le statut de l'utilisateur
                if ($user['status'] == 'inactive') {
                    $erreur = "Votre compte est inactif. Veuillez contacter l'administrateur.";
                } elseif ($user['is_deleted'] == 1) {
                    $erreur = "Votre compte a été supprimé.";
                } else {
                    // Démarrer la session
                    session_start();

                    // Créer des variables de session
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['name'] = $user['first_name'] . ' ' . $user['last_name'];
                    $_SESSION['photo'] = $user['photo'] ?? '../vendors/images/profile.png';  // Si la photo est nulle, on met une image par défaut
                    $_SESSION['role'] = $user['role'];  // Statut de l'utilisateur

                    // Rediriger selon le rôle
                    if ($user['role'] == "super_admin") {
                        header("Location: ../admin/dashboard.php");
                    } elseif ($user['role'] == "Gestionnaire Motel & Restaurant" || $user['role'] =="Gestionnaire IMMO") {
                        header("Location: ../users/dashboard.php");
                    } else {
                        $erreur = "Accès refusé.";
                    }
                    exit();
                }
            } else {
                $erreur = "Nom d'utilisateur ou mot de passe incorrect.";
            }
        } else {
            $erreur = "Aucun utilisateur trouvé avec ce nom ou email.";
        }
    } catch (Exception $e) {
        $erreur = "Erreur lors de la connexion : " . $e->getMessage();
    }
}
?>
