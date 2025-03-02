<?php
include("../database/connexion.php");
if (isset($_POST['numero'])) {
    $numero = $_POST['numero'];
    
    $stmt = $connexion->prepare("SELECT prix_sieste FROM chambres WHERE numero = :numero LIMIT 1");
    $stmt->bindParam(':numero', $numero);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode($result);
}
?>
