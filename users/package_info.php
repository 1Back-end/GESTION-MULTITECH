<?php 
include("../include/menu.php"); 
include("fonction.php");

?>


<?php 
include("../database/connexion.php");

$package = null;

if (isset($_GET["uuid"])) {
    $uuid = $_GET["uuid"];

    $stmt = $connexion->prepare("SELECT * FROM packages WHERE uuid = :uuid AND is_deleted = 0");
    $stmt->execute([':uuid' => $uuid]);
    $package = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<div class="main-container mt-5 pb-5">
    <div class="col-lg-6 col-sm-12">
        <div class="card shadow border-0 p-3">

            <div class="mb-3">
                <h5 class="fw-bold text-uppercase">Détails du colis N° <?= htmlspecialchars($package['ref']) ?></h5>
            </div>

            <!-- Informations de l'expéditeur -->
            <div class="mb-3">
                <p class="fw-bold text-success fw-bold text-uppercase">Informations de l'expéditeur</p>
                <div class="row">
                    <div class="col-lg-3 col-sm-12 mb-3">
                        <small><strong>Nom complet :</strong> <?= htmlspecialchars($package['sender_name']) ?></small>
                    </div>
                    <div class="col-lg-3 col-sm-12 mb-3">
                        <small><strong>Adresse :</strong> <?= htmlspecialchars($package['sender_address']) ?></small>
                    </div>
                    <div class="col-lg-3 col-sm-12 mb-3">
                        <small><strong>N° de téléphone :</strong> <?= htmlspecialchars($package['sender_phone']) ?></small>
                    </div>
                    <?php if (!empty($package['sender_cni'])): ?>
                        <div class="col-lg-3 col-sm-12 mb-3">
                            <small><strong>N° CNI :</strong> <?= htmlspecialchars($package['sender_cni']) ?></small>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Informations du destinataire -->
            <div class="mb-3">
                <p class="fw-bold text-success fw-bold text-uppercase">Informations du destinataire</p>
                <div class="row">
                    <div class="col-lg-3 col-sm-12 mb-3">
                        <small><strong>Nom complet :</strong> <?= htmlspecialchars($package['recipient_name']) ?></small>
                    </div>
                    <div class="col-lg-3 col-sm-12 mb-3">
                        <small><strong>Adresse :</strong> <?= htmlspecialchars($package['recipient_address']) ?></small>
                    </div>
                    <div class="col-lg-3 col-sm-12 mb-3">
                        <small><strong>N° de téléphone :</strong> <?= htmlspecialchars($package['recipient_phone']) ?></small>
                    </div>
                    <?php if (!empty($package['recipient_cni'])): ?>
                        <div class="col-lg-3 col-sm-12 mb-3">
                            <small><strong>N° CNI :</strong> <?= htmlspecialchars($package['recipient_cni']) ?></small>
                        </div>
                    <?php endif; ?>
                </div>
            </div>


                            <!-- Informations sur le colis -->
                <div class="mb-3">
                    <p class="fw-bold text-success fw-bold text-uppercase">Informations sur le colis</p>
                    <div class="row">
                        <div class="col-lg-4 col-sm-12 mb-3">
                            <small><strong>Nom du colis :</strong> <?= htmlspecialchars($package['package_name']) ?></small>
                        </div>
                        <div class="col-lg-4 col-sm-12 mb-3">
                            <small><strong>Type de colis :</strong> <?= htmlspecialchars($package['package_type']) ?></small>
                        </div>
                        <div class="col-lg-4 col-sm-12 mb-3">
                            <small><strong>Livraison à domicile :</strong> <?= $package['home_delivery'] ? 'Oui' : 'Non' ?></small>
                        </div>
                        <div class="col-lg-12 col-sm-12 mb-3">
                            <small><strong>Description :</strong> <?= htmlspecialchars($package['description']) ?></small>
                        </div>

                        <?php if (!empty($package['image_path'])): ?>
                        <div class="col-lg-6 col-sm-12 mb-3">
                            <p><strong>Image du colis :</strong></p><br>
                            <img src="../uploads/packages/<?= htmlspecialchars($package['image_path']) ?>" alt="Image colis" class="img-thumbnail img-fluid" style="max-height: 200px;">
                        </div>
                        <?php endif; ?>

                        <?php if (!empty($package['qr_code'])): ?>
                        <div class="col-lg-6 col-sm-12 mb-3">
                            <p><strong>QR Code :</strong></p><br>
                            <img src="../uploads/qrcodes/<?= htmlspecialchars($package['qr_code']) ?>" alt="QR Code" class="img-thumbnail img-fluid" style="max-height: 200px;">
                        </div>
                        <?php endif; ?>
                    </div>
                </div>


        </div>
    </div>
</div>
