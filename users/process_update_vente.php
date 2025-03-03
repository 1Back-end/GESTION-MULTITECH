<?php
include("../database/connexion.php");

$success = "";
$erreur = "";

if (isset($_POST['submit'])) {
    $id_vente = $_POST['id_vente'];
    $type_vente = $_POST['type_vente'];
    $name = $_POST['name'];
    $quantity = $_POST['qte'];
    $price = $_POST['price'];

    $sql = "UPDATE reservation_menu 
            SET type = :type_vente, name = :name, quantity = :quantity, price = :price 
            WHERE id = :id_vente";
    
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':id_vente', $id_vente, PDO::PARAM_STR);
    $stmt->bindParam(':type_vente', $type_vente, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
    $stmt->bindParam(':price', $price, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $success = "Vente mise à jour avec succès !";
    } else {
        $erreur = "Erreur lors de la modification. Veuillez réessayer.";
    }
}
$requete = $connexion->prepare("SELECT * FROM reservation_menu WHERE id = ?");
$requete->execute([$id_vente]);
$vente = $requete->fetch();
?>
