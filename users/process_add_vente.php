<?php
include("../database/connexion.php");
// include("fonction.php");

$erreur = "";
$success = "";

if (isset($_POST["submit"])) {
    // Récupération des valeurs du formulaire
    $type_vente = $_POST["type_vente"] ?? null;
    $name = $_POST["name"] ?? null;
    $qte = $_POST["qte"] ?? null;
    $prix = $_POST["prix"] ?? null;
    $price = $_POST["price"] ?? null;
    $mois = moisActuelle();
    $id = generateUUID(); // Générer un nouvel ID unique
    $added_by = $_SESSION['id'] ?? null; // ID de l'utilisateur qui a ajouté la réservation
    $restaurant_id =$restaurant_data['id'];    // ID du restaurant
}