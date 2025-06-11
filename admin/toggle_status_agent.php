<?php
include("../database/connexion.php");

if (isset($_GET['uuid'], $_GET['action'])) {
    $uuid = $_GET['uuid'];
    $action = $_GET['action'];

    $new_status = ($action === 'disable') ? 0 : 1;
    $new_user_status = ($new_status == 1) ? 'active' : 'inactive';

    try {
        // Démarrer une transaction
        $connexion->beginTransaction();

        // 1. Mettre à jour le statut de l'agence
        $sqlAgency = "UPDATE main_agencies SET is_active = :status, updated_at = NOW() WHERE uuid = :uuid AND is_deleted = 0";
        $stmtAgency = $connexion->prepare($sqlAgency);
        $stmtAgency->bindParam(':status', $new_status, PDO::PARAM_INT);
        $stmtAgency->bindParam(':uuid', $uuid, PDO::PARAM_STR);
        $stmtAgency->execute();

        // 2. Récupérer le manager_uuid de cette agence
        $sqlGetManager = "SELECT manager_uuid FROM main_agencies WHERE uuid = :uuid";
        $stmtGetManager = $connexion->prepare($sqlGetManager);
        $stmtGetManager->bindParam(':uuid', $uuid, PDO::PARAM_STR);
        $stmtGetManager->execute();
        $manager = $stmtGetManager->fetch(PDO::FETCH_ASSOC);

        if ($manager && !empty($manager['manager_uuid'])) {
            // 3. Mettre à jour le statut de l'utilisateur manager
            $sqlUser = "UPDATE users SET status = :user_status, updated_at = NOW() WHERE id = :manager_uuid AND is_deleted = 0";
            $stmtUser = $connexion->prepare($sqlUser);
            $stmtUser->bindParam(':user_status', $new_user_status, PDO::PARAM_STR);
            $stmtUser->bindParam(':manager_uuid', $manager['manager_uuid'], PDO::PARAM_STR);
            $stmtUser->execute();
        }

        // Valider la transaction
        $connexion->commit();

        $message = ($new_status == 1) ? 'Agence activée avec succès et manager réactivé.' : 'Agence désactivée avec succès et manager désactivé.';
        $type = 'success';

    } catch (PDOException $e) {
        $connexion->rollBack();
        // Tu peux logger $e->getMessage() pour debug si nécessaire
        $message = "Erreur lors de la mise à jour du statut.";
        $type = 'danger';
    }
} else {
    $message = "Paramètres manquants.";
    $type = 'warning';
}

header("Location: list_of_agencies.php?message=" . urlencode($message) . "&type=" . $type);
exit();
