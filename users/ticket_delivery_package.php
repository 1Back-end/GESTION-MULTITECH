<?php 
include("../include/menu.php");
include("../database/connexion.php");

$package = null;

if (isset($_GET["uuid"])) {
    $uuid = $_GET["uuid"];
    $stmt = $connexion->prepare("SELECT * FROM packages WHERE uuid = :uuid AND is_deleted = 0");
    $stmt->execute([':uuid' => $uuid]);
    $package = $stmt->fetch(PDO::FETCH_ASSOC);
}

$code_recu = random_int(1000000000, 9999999999);
?>
<div class="main-container mt-3 pb-5">
    <div class="col-lg-6 col-sm-12 mb-3 mx-auto">
        <div class="card border-0 rounded-3 p-3">
            <div class="mb-3 text-center">
                <h5 class="fw-bold text-uppercase">Bon de livraison N° <?= htmlspecialchars($code_recu) ?></h5>
                <small class="text-muted">Date : <?= date("d/m/Y à H:i") ?></small>
            </div>

            <div class="row">
                <!-- Expéditeur -->
                <div class="col-md-6">
                    <p class="text-uppercase fw-bold">Informations de l'expéditeur</p>
                    <p class="mb-2">Nom complet : <strong><?= htmlspecialchars($package['sender_name']) ?></strong></p>
                    <p class="mb-2">Adresse : <strong><?= htmlspecialchars($package['sender_address']) ?></strong></p>
                    <p class="mb-2">Téléphone : <strong><?= htmlspecialchars($package['sender_phone']) ?></strong></p>
                    <?php if (!empty($package['sender_cni'])): ?>
                        <p class="mb-2">N° CNI : <strong><?= htmlspecialchars($package['sender_cni']) ?></strong></p>
                    <?php endif; ?>
                </div>

                <!-- Destinataire -->
                <div class="col-md-6">
                    <p class="text-uppercase fw-bold">Informations du destinataire</p>
                    <p class="mb-2">Nom complet : <strong><?= htmlspecialchars($package['recipient_name']) ?></strong></p>
                    <p class="mb-2">Adresse : <strong><?= htmlspecialchars($package['recipient_address']) ?></strong></p>
                    <p class="mb-2">Téléphone : <strong><?= htmlspecialchars($package['recipient_phone']) ?></strong></p>
                    <?php if (!empty($package['recipient_cni'])): ?>
                        <p class="mb-2">N° CNI : <strong><?= htmlspecialchars($package['sender_cni']) ?></strong></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
