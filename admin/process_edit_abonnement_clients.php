<?php 
include("../database/connexion.php"); 
include("../fonction/fonction.php");

$erreur = "";
$success = "";
$uuid = $_GET['uuid'] ?? null;

// Récupérer les données du client pour préremplir le formulaire
if ($uuid) {
    $sql = "SELECT * FROM clients_abonnes WHERE uuid = :uuid AND is_deleted = 0 LIMIT 1";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':uuid', $uuid);
    $stmt->execute();
    $client = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$client) {
        die("Client introuvable.");
    }
} else {
    die("UUID manquant.");
}

if (isset($_POST['submit'])) {
    // Récupération et nettoyage des données postées
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $tel1 = trim($_POST['tel1']);
    $tel2 = trim($_POST['tel2']);
    $address = trim($_POST['address']);
    $cni_number = trim($_POST['cni_number']);
    $price_for_abonnement = trim($_POST['price_for_abonnement']);

    // Simple validation (ajoute selon tes besoins)
    if (empty($firstname) || empty($lastname) || empty($email) || empty($tel1) || empty($address) || empty($cni_number) || empty($price_for_abonnement)) {
        $erreur = "Veuillez remplir tous les champs obligatoires.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreur = "L'adresse email n'est pas valide.";
    } else {
        // Mise à jour en base
        $sql = "UPDATE clients_abonnes SET
            firstname = :firstname,
            lastname = :lastname,
            email = :email,
            tel1 = :tel1,
            tel2 = :tel2,
            address = :address,
            cni_number = :cni_number,
            price_for_abonnement = :price_for_abonnement,
            updated_at = NOW()
            WHERE uuid = :uuid AND is_deleted = 0";

        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':tel1', $tel1);
        $stmt->bindParam(':tel2', $tel2);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':cni_number', $cni_number);
        $stmt->bindParam(':price_for_abonnement', $price_for_abonnement);
        $stmt->bindParam(':uuid', $uuid);

        if ($stmt->execute()) {
           $success = "Client mis à jour avec succès.";
           echo "<script>setTimeout(function {window.location.href='abonnement_clients.php'; } , 3000)</script>";
        } else {
            $erreur = "Erreur lors de la mise à jour du client.";
        }
    }
}

?>
