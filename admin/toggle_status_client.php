<?php
include("../database/connexion.php");

if (isset($_GET['uuid'], $_GET['action'])) {
    $uuid = $_GET['uuid'];
    $action = $_GET['action'];

    $new_status = ($action === 'disable') ? 0 : 1;

    try {
        $sql = "UPDATE clients_abonnes SET is_active = :status, updated_at = NOW() WHERE uuid = :uuid AND is_deleted = 0";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':status', $new_status, PDO::PARAM_INT);
        $stmt->bindParam(':uuid', $uuid, PDO::PARAM_STR);
        $stmt->execute();

        $message = ($new_status == 1) ? 'Client activé avec succès.' : 'Client désactivé avec succès.';
        $type = 'success';
    } catch (PDOException $e) {
        $message = "Erreur lors de la mise à jour du statut.";
        $type = 'danger';
    }
} else {
    $message = "Paramètres manquants.";
    $type = 'warning';
}

header("Location: abonnement_clients.php?message=" . urlencode($message) . "&type=" . $type);
exit();
