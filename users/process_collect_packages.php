<?php
include("../database/connexion.php");

$erreur = "";
$success = "";

if (isset($_POST["submit"])) {
    $package_uuid = $_POST["package_uuid"] ?? null;
    $agent_uuid = $_POST["agent_uuid"] ?? null;

    if ($package_uuid && $agent_uuid) {
        // Vérifier si le colis est encore "en attente"
        $checkStmt = $connexion->prepare("SELECT status FROM packages WHERE uuid = :uuid AND is_deleted = 0");
        $checkStmt->execute(['uuid' => $package_uuid]);
        $package = $checkStmt->fetch(PDO::FETCH_ASSOC);

        if ($package && $package['status'] === 'en attente') {
            // Mise à jour du colis
            $sql = "UPDATE packages 
                    SET is_collected = 1, 
                        collected_by = :agent_uuid, 
                        status = 'en transit',
                        updated_at = NOW()
                    WHERE uuid = :package_uuid AND is_deleted = 0";

            $stmt = $connexion->prepare($sql);
            $result = $stmt->execute([
                'agent_uuid' => $agent_uuid,
                'package_uuid' => $package_uuid
            ]);

            if ($result) {
                // Redirection avec succès
               $success = "Colis marqué comme ramassé avec succès.";
                echo "<script>setTimeout(function() { window.location.href='package_agencies.php'; }, 3000);</script>";

            } else {
                $erreur = "❌ Erreur lors de la mise à jour du colis.";
            }
        } else {
            $erreur = "⚠️ Ce colis a déjà été traité.";
        }
    } else {
        $erreur = "⚠️ Tous les champs sont obligatoires.";
    }
}
?>
