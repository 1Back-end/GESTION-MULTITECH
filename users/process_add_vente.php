<?php
include("../database/connexion.php");
include("fonction.php"); // Assure-toi que cette fonction est bien définie

$erreur = "";
$success = "";

if (isset($_POST["submit"])) {
    // Récupération des valeurs du formulaire
    $type_vente = $_POST["type_vente"] ?? null;
    $name = $_POST["name"] ?? null;
    $quantity = $_POST["qte"] ?? null;
    $price = $_POST["price"] ?? null; // Garde une seule variable
    $mois = moisActuelle();
    $id = generateUUID();
    $added_by = $_SESSION['id'] ?? null;
    
    // Vérifie si $restaurant_data est défini avant d'accéder à son ID
    $restaurant_id = $restaurant_data['id'] ?? null;

    // Préparation de la requête SQL
    $sql = "INSERT INTO reservation_menu (id, name, type, price, quantity, added_by, restaurant_id, mois)
            VALUES (:id, :name, :type, :price, :quantity, :added_by, :restaurant_id, :mois)";

    $stmt = $connexion->prepare($sql);
    $stmt->execute([
        ':id' => $id,
        ':name' => $name,
        ':type' => $type_vente,
        ':price' => $price,
        ':quantity' => $quantity,
        ':added_by' => $added_by,
        ':restaurant_id' => $restaurant_id,
        ':mois' => $mois
    ]);

    if ($stmt) {
        $success = "Vente ajoutée avec succès.";
    } else {
        $erreur = "Erreur lors de l'ajout.";
    }
}
?>
