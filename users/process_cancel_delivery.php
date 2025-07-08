<?php
include("../database/connexion.php");

$erreur = "";
$success = "";

if (isset($_POST["submit"])) {
    $package_uuid = $_POST["package_uuid"] ?? null;
    $reason_cancel_delivery = trim($_POST["reason_cancel_delivery"] ?? '');
    $cancel_at = date('Y-m-d H:i:s');

    if ($package_uuid && $reason_cancel_delivery !== '') {
        // Vérifier si le colis est encore "en attente" OU "en transit"
        $checkStmt = $connexion->prepare("SELECT status FROM packages WHERE uuid = :uuid AND is_deleted = 0");
        $checkStmt->execute(['uuid' => $package_uuid]);
        $package = $checkStmt->fetch(PDO::FETCH_ASSOC);

        if ($package && ($package['status'] === 'en attente' || $package['status'] === 'en transit')) {
            // Mise à jour du colis
            $sql = "UPDATE packages 
                    SET reason_cancel_delivery = :reason_cancel_delivery, 
                        status = 'annulé',
                        cancel_at = :cancel_at,
                        updated_at = NOW()
                    WHERE uuid = :package_uuid AND is_deleted = 0";

            $stmt = $connexion->prepare($sql);
            $result = $stmt->execute([
                'package_uuid' => $package_uuid,
                'cancel_at'=> $cancel_at,
                'reason_cancel_delivery'=> $reason_cancel_delivery
            ]);

            if ($result) {
                $success = "Livraison annulée avec succès.";
                // Redirection après 3 secondes
                echo "<script>setTimeout(function() { window.location.href='package_agencies.php'; }, 3000);</script>";
            } else {
                $erreur = "❌ Erreur lors de la mise à jour du colis.";
            }
        } else {
            $erreur = "⚠️ Ce colis a déjà été traité ou n'existe pas.";
        }
    } else {
        $erreur = "⚠️ Tous les champs sont obligatoires.";
    }
}
?>
