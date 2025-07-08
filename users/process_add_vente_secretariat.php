<?php

include("../database/connexion.php");


$erreur = "";
$success = "";

if (isset($_POST["submit"])) {
    $uuid = $_POST["uuid"] ?? null;
    $type_service = trim($_POST["type_service"] ?? "");
    $prix_unitaire = (int)($_POST["prix_unitaire"] ?? 0);
    $quantite = (int)($_POST["quantite"] ?? 0);
    $added_by = $_SESSION['id'] ?? null;

    if ($type_service === "" || $prix_unitaire <= 0 || $quantite <= 0) {
        $erreur = "Tous les champs sont requis et doivent être valides.";
    } else {
        try {
            if ($uuid) {
                // Mise à jour
                $stmt = $connexion->prepare("UPDATE ventes_secretariat SET type_service = ?, prix_unitaire = ?, quantite = ?, updated_at = NOW() WHERE uuid = ? AND added_by = ?");
                $stmt->execute([$type_service, $prix_unitaire, $quantite, $uuid, $added_by]);
                $success = "Vente modifiée avec succès.";
                $last_uuid = $uuid; // garder l'UUID pour récupérer les données
            } else {
                // Nouvelle insertion
                $new_uuid = generateUUID();
                $stmt = $connexion->prepare("INSERT INTO ventes_secretariat (uuid, type_service, prix_unitaire, quantite, added_by) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$new_uuid, $type_service, $prix_unitaire, $quantite, $added_by]);
                $success = "Vente enregistrée avec succès.";
                $last_uuid = $new_uuid;
            }

            // Récupérer la vente modifiée ou insérée
            $stmt = $connexion->prepare("SELECT * FROM ventes_secretariat WHERE uuid = ? AND added_by = ?");
            $stmt->execute([$last_uuid, $added_by]);
            $vente_maj = $stmt->fetch(PDO::FETCH_ASSOC);

            // Ici tu peux utiliser $vente_maj pour affichage ou autre
            // Par exemple, tu peux recharger la variable $ventes pour mettre à jour la liste
            $ventes = get_all_my_ventes_secretariats($connexion, $added_by);

        } catch (PDOException $e) {
            $erreur = "Erreur lors de l’enregistrement : " . $e->getMessage();
        }
    }
}
