<?php
include("../database/connexion.php");

$message = $_GET['message'] ?? '';
$error = $_GET['error'] ?? '';

if (!isset($_GET['uuid']) || empty($_GET['uuid'])) {
    die("UUID de la livraison manquant.");
}

$uuid = $_GET['uuid'];

// Préparer et exécuter la mise à jour du statut
$sql = "UPDATE livraisons_products SET status = 'Annulé' WHERE uuid = :uuid AND status != 'Annulé'";
$stmt = $connexion->prepare($sql);
$stmt->bindValue(':uuid', $uuid, PDO::PARAM_STR);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    // Succès, statut changé
    header("Location: liste_livraisons_products.php?msg=Livraison annulée avec succès");
    exit;
} else {
    // Soit la livraison n'existe pas, soit elle est déjà annulée
    header("Location: liste_livraisons_products.php?msg=Impossible d'annuler cette livraison");
    exit;
}
?>
