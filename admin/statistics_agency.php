<?php
include("../database/connexion.php");
include("../include/menu.php");
require_once('../fonction/fonction.php');

$uuid = $_GET['uuid'] ?? null;

if (!$uuid) {
    echo "<div class='alert alert-danger'>UUID de l'agence manquant.</div>";
    exit;
}

// Récupérer les infos de l'agence
$stmt = $connexion->prepare("SELECT name FROM main_agencies WHERE uuid = :uuid");
$stmt->execute(['uuid' => $uuid]);
$agency = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$agency) {
    echo "<div class='alert alert-danger'>Agence introuvable.</div>";
    exit;
}
?>

<?php
$day_stats = get_day_stats($connexion, $uuid);
$month_stats = get_month_stats($connexion, $uuid);
$global_stats = get_global_stats($connexion, $uuid);


?>

<div class="main-container mt-4 pb-5">
   <div class="col-lg-12 col-sm-12 mb-3">
         <h5 class="mb-4 text-uppercase">Bienvenue sur les statistiques de l’agence <strong><?= htmlspecialchars($agency['name']) ?></strong></h5>
    
    <div class="row mb-4 mt-3">
    <!-- Montant du jour -->
    <div class="col-lg-3 col-sm-12 mb-3">
        <div class="card shadow border-0 p-3 rounded-3">
            <h5 class="mb-2">Statistiques du jour</h5>
            <?php if ($day_stats && ($day_stats['total_collected'] || $day_stats['total_delivery'])): ?>
                <p class="text-success">💰 Montant Collecté : <strong><?= number_format($day_stats['total_collected'] ?? 0, 0, ',', ' ') ?> FCFA</strong></p>
                <p class="text-info">🚚 Montant Livré : <strong><?= number_format($day_stats['total_delivery'] ?? 0, 0, ',', ' ') ?> FCFA</strong></p>
            <?php else: ?>
                <p class="text-muted">Aucune donnée pour aujourd’hui.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Montant du mois -->
    <div class="col-md-3 col-sm-12 mb-3">
        <div class="card shadow border-0 p-3 rounded-3">
            <h5 class="mb-2">Statistiques du mois</h5>
            <?php if ($month_stats && ($month_stats['total_collected'] || $month_stats['total_delivery'])): ?>
                <p class="text-success">💰 Montant Collecté : <strong><?= number_format($month_stats['total_collected'] ?? 0, 0, ',', ' ') ?> FCFA</strong></p>
                <p class="text-info">🚚 Montant Livré : <strong><?= number_format($month_stats['total_delivery'] ?? 0, 0, ',', ' ') ?> FCFA</strong></p>
            <?php else: ?>
                <p class="text-muted">Aucune donnée ce mois.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Statistiques globales -->
    <div class="col-md-4">
        <div class="card shadow border-0 p-3 rounded-3">
            <h5 class="mb-2">Statistiques globales</h5>
            <?php if ($global_stats && $global_stats['total_colis']): ?>
                <div class="row">
                    <div class="col-lg-6 col-sm-12 mb-2">
                        📦 Total colis : <strong><?= $global_stats['total_colis'] ?></strong>
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-2">
                        ✅ Livrés : <strong><?= $global_stats['total_livres'] ?></strong>
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-2">
                        📥 Ramassés : <strong><?= $global_stats['total_ramasses'] ?></strong>
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-2">
                        🚫 Annulés : <strong><?= $global_stats['total_annules'] ?></strong>
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-2 text-success">
                        💰 Montant Collecté : <strong><?= number_format($global_stats['total_collected'] ?? 0, 0, ',', ' ') ?> FCFA</strong>
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-2 text-info">
                        🚚 Montant Livré : <strong><?= number_format($global_stats['total_delivery'] ?? 0, 0, ',', ' ') ?> FCFA</strong>
                    </div>
                </div>
            <?php else: ?>
                <p class="text-muted">Aucune statistique disponible.</p>
            <?php endif; ?>

        </div>
    </div>
</div>

    
</div>

