<?php
include("../database/connexion.php"); 
include("../fonction/fonction.php");

if (isset($_GET["uuid"])) {
    $dossier_uuid = $_GET["uuid"];

    try {
        // Démarrer la transaction
        $connexion->beginTransaction();

        // Mettre à jour le dossier client
        $stmt = $connexion->prepare("UPDATE customers_dossiers SET is_deleted = 1 WHERE uuid = :uuid");
        $stmt->bindParam(':uuid', $dossier_uuid);
        $stmt->execute();

        // Mettre à jour les prestations liées
        $stmt2 = $connexion->prepare("UPDATE prestations_client SET is_deleted = 1 WHERE client_uuid = :uuid");
        $stmt2->bindParam(':uuid', $dossier_uuid);
        $stmt2->execute();

        // Valider la transaction
        $connexion->commit();

        // Rediriger avec succès
        header("Location: ouvertures_dossiers.php?msg=Dossier et prestations supprimés avec succès");
        exit();

    } catch (Exception $e) {
        // Annuler la transaction en cas d'erreur
        $connexion->rollBack();
        header("Location: ouvertures_dossiers.php?msg=Erreur lors de la suppression: " . $e->getMessage());
        exit();
    }
} else {
    // UUID manquant
    header("Location: ouvertures_dossiers.php?msg=ID du dossier manquant");
    exit();
}
?>
