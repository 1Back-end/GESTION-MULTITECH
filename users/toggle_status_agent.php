<?php
session_start();
include("../database/connexion.php");
include("fonction.php");

if(isset($_GET['uuid'], $_GET['action'])){
    $action = $_GET['action'];
    $user_id = $_SESSION['id'] ?? null;
    $uuid = $_GET['uuid'];

    if (!$action || !$uuid || !$user_id) {
        header("Location: gestion_agencies.php?error=Paramètres invalides");
        exit();
    }

    $agency = get_my_agency($connexion, $user_id);
    $agency_uuid = $agency['uuid'] ?? null;

    $stmt = $connexion->prepare("SELECT uuid FROM agents_for_agency WHERE uuid = :uuid AND agency_uuid = :agency_uuid AND added_by = :user_id AND is_deleted = 0");
    $stmt->execute([
        'uuid' => $uuid,
        'agency_uuid' => $agency_uuid,
        'user_id' => $user_id
    ]);

    $agent = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$agent) {
        header("Location: gestion_agencies.php?error=Agent introuvable ou non autorisé");
        exit();
    }

    $new_status = ($action === 'enable') ? 1 : 0;

    $update = $connexion->prepare("UPDATE agents_for_agency SET is_active = :new_status WHERE uuid = :uuid");
    $update->execute([
        'new_status' => $new_status,
        'uuid' => $uuid
    ]);

    header("Location: gestion_agencies.php?success=Statut mis à jour");
    exit();
}
?>
