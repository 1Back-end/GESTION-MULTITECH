<?php 
include("../include/menu.php"); 
include("fonction.php");

?>


<div class="main-container mt-3 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card shadow border-0 rounded-0 p-3">
            <div class="d-flex align-items-center justify-content-center">
                <h5 class="text-uppercase">Rapport de livraison de l'agence <?= htmlspecialchars($agency_name) ?></h5>
            </div>
        </div>
 </div>


<div class="col-lg-12 col-sm-12 mb-3">
    <div class="card shadow border-0 rounded-0 p-3">
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center align-middle" id="example" class="display">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Colis</th>
                        <th>Lieu Livraison</th>
                        <th>Ramassé par</th>
                        <th>Montant Ramassage</th>
                        <th>Livrer par</th>
                        <th>Montant Livraison</th>
                        <th>Etat</th>
                    </tr>
                </thead>
                <tbody>
                                        <?php
                        $packages = get_all_packages_and_statistics($connexion, $user_id, 100, 1);
                        $i = 1;
                        foreach ($packages as $package): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td>
                                <?php if (!empty($package['qr_code'])): ?>
                                    <img src="../uploads/qrcodes/<?= htmlspecialchars($package['qr_code']) ?>" alt="QR Code" class="img-thumbnail" alt="Image" width="50">
                                    <br><br>
                                    <?= htmlspecialchars($package['ref']) ?>
                                <?php endif; ?>
                            </td>

                            <td><?= htmlspecialchars($package['recipient_address']) ?></td>
                            <td>
                                <?php if ($package['is_collected']): ?>
                                    <?= htmlspecialchars($package['collected_by_name']) ?><br>
                                    <small><?= htmlspecialchars($package['collected_cni_number']) ?></small><br>
                                    <small><?= date('d/m/Y H:i:s', strtotime($package['collected_at'])) ?></small>
                                <?php else: ?>
                                    <span class="text-muted">Non ramassé</span>
                                <?php endif; ?>
                            </td>
                            <td><?= number_format($package['amount_collected'] ?? 0, 0, ',', ' ') ?> FCFA</td>
                            <td>
                                <?php if ($package['is_delivery']): ?>
                                    <?= htmlspecialchars($package['delivery_by_name']) ?><br>
                                    <small><?= htmlspecialchars($package['delivery_cni_number']) ?></small><br>
                                    <small><?= date('d/m/Y H:i:s', strtotime($package['delivery_at'])) ?></small>
                                <?php else: ?>
                                    <span class="text-muted">Non livré</span>
                                <?php endif; ?>
                            </td>
                            <td><?= number_format($package['amount_delivery'] ?? 0, 0, ',', ' ') ?> FCFA</td>
                            <td>
                                <span class="badge 
                                    <?= match($package['status']) {
                                        'en attente' => 'bg-warning text-white border-0 rounded-0',
                                        'en transit' => 'bg-primary text-white border-0 rounded-0',
                                        'livré' => 'bg-success text-white border-0 rounded-0',
                                        'annulé' => 'bg-danger text-white border-0 rounded-0',
                                        default => 'bg-secondary text-white border-0 rounded-0'
                                    } ?>
                                ">
                                    <?= htmlspecialchars($package['status']) ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>