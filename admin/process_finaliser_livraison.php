<?php
include("../database/connexion.php");

$erreur ="";
$success = "";


if(isset($_POST["submit"])){
     $uuid = $_POST['uuid'] ?? null;
    $price_delivery_exactly = $_POST["price_delivery_exactly"] ?? null;


    if (!isset($_POST['uuid'], $_POST['price_delivery_exactly'])) {
        $erreur = "Données manquantes.";
    }

    if ($price_delivery_exactly <= 0) {
        $erreur= "Montant invalide.";
    }

    try {
        $stmt = $connexion->prepare("UPDATE livraisons_products 
            SET status = 'Livré', price_delivery_exactly = :price_delivery_exactly 
            WHERE uuid = :uuid");
        
        $stmt->execute([
            'price_delivery_exactly' => $price_delivery_exactly,
            'uuid' => $uuid
        ]);

        $success = "Livraison finalisée avec succès.";
        echo "<script>setTimeout(function() { window.location.href='liste_livraisons_products.php'; }, 3000);</script>";
    } catch (PDOException $e) {
        // Log error in real use
        $erreur = "Erreur lors de la mise à jour : " . $e->getMessage();
}

}