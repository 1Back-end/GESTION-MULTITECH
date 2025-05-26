<?php
include("../database/connexion.php");
include("../fonction/fonction.php");

$erreur = "";
$success = "";

$uuid = $_GET['uuid'] ?? null;
if (!$uuid) {
    die("UUID manquant");
}

// Récupération des infos du dossier
$stmt = $connexion->prepare("SELECT * FROM customers_dossiers WHERE uuid = ?");
$stmt->execute([$uuid]);
$dossier = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$dossier) {
    die("Dossier introuvable");
}

if (isset($_POST["submit"])) {
    if ($dossier["status"] === "Finalisé") {
        $erreur = "Ce dossier a déjà été finalisé.";
    } else {
        $montant_verse = $_POST["montant_verse"];
        $references = $_POST["references"];
        $finalisation_uuid = generateUUID();
        $added_by = $_SESSION['id'] ?? null;

        // Insertion dans finalisations_dossiers
        $insert = $connexion->prepare("INSERT INTO finalisations_dossiers (uuid, dossier_uuid, montant_verse, references_personnes, added_by) VALUES (?, ?, ?, ?, ?)");
        $inserted = $insert->execute([$finalisation_uuid, $uuid, $montant_verse, $references, $added_by]);

        if ($inserted) {
            // Mise à jour du statut
            $update = $connexion->prepare("UPDATE customers_dossiers SET status = 'Finalisé' WHERE uuid = ?");
            $update->execute([$uuid]);
            $success = "Le dossier a été finalisé avec succès.";
            echo "<script>setTimeout(function {window.location.href='ouvertures_dossiers.php'; } , 3000)</script>";
        } else {
            $erreur = "Une erreur s'est produite lors de la finalisation.";
        }
    }
}

?>
