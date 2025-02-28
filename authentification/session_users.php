<?php
session_start();

// Vérifier si l'utilisateur est connecté, si son ID et son email sont présents, et si son rôle est 'admin'
if (!isset($_SESSION["id"]) || !isset($_SESSION["email"])) {
    header("Location: ../authentification/login.php");
    exit();
}
?>
