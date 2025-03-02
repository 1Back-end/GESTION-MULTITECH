<?php
include("../database/connexion.php");

if (isset($_POST['numero'])) {
    $numero = $_POST['numero'];
    
    // Récupérer tous les prix de nuitée associés à ce numéro de chambre
    $stmt = $connexion->prepare("SELECT prix_nuitee FROM chambres WHERE numero = :numero");
    $stmt->bindParam(':numero', $numero);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupérer tous les prix
    
    // Retourne le tableau JSON des prix
    echo json_encode($result);
}
?>
