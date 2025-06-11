<?php
include("../database/connexion.php");

if (isset($_GET['uuid'])) {
    $uuid = $_GET['uuid'];

    try {
        $sql = "UPDATE main_agencies SET is_deleted = 1, updated_at = NOW() WHERE uuid = :uuid AND is_deleted = 0";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':uuid', $uuid, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $message = 'Agence supprimé avec succès.';
            $type = 'success';
        } else {
            $message = 'Agence introuvable ou déjà supprimé.';
            $type = 'warning';
        }
    } catch (PDOException $e) {
        $message = "Erreur lors de la suppression de l'agence.";
        $type = 'danger';
    }
} else {
    $message = "Identifiant du client manquant.";
    $type = 'warning';
}

header("Location: list_of_agencies.php?message=" . urlencode($message) . "&type=" . $type);
exit();
