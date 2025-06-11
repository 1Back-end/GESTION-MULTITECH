<?php
include("../database/connexion.php");

if (isset($_GET['uuid'], $_GET['action'])) {
    $uuid = $_GET['uuid'];
    $action = $_GET['action'];

    // Définir le nouveau statut selon l'action demandée
    $new_status = ($action === 'disable') ? 0 : 1;

    try {
        // Mise à jour du champ can_create_agents pour l'agence donnée
        $sql = "UPDATE main_agencies SET can_create_agents = :status, updated_at = NOW() WHERE uuid = :uuid AND is_deleted = 0";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':status', $new_status, PDO::PARAM_INT);
        $stmt->bindParam(':uuid', $uuid, PDO::PARAM_STR);
        $stmt->execute();

        $message = ($new_status == 1) ? 'Création des agents activée avec succès.' : 'Création des agents désactivée avec succès.';
        $type = 'success';
    } catch (PDOException $e) {
        // Tu peux logger $e->getMessage() quelque part pour le debug
        $message = "Erreur lors de la mise à jour du statut.";
        $type = 'danger';
    }
} else {
    $message = "Paramètres manquants.";
    $type = 'warning';
}

// Redirection vers la liste avec message et type dans l'URL
header("Location: list_of_agencies.php?message=" . urlencode($message) . "&type=" . $type);
exit();
