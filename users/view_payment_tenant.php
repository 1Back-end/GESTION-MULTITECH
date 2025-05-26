<?php 
include("../include/menu.php"); 
include("fonction.php");

if (isset($_GET["id"])) {
    $id_tenant = $_GET["id"];
    
    // Connexion à la base de données
    include("../database/connexion.php");

    try {
        // Récupérer les informations du locataire
        $stmt = $connexion->prepare("SELECT first_name, last_name, price FROM tenants WHERE id = :tenant_id");
        $stmt->execute(['tenant_id' => $id_tenant]);
        $tenant = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($tenant) {
            $tenant_name = $tenant['first_name'] . ' ' . $tenant['last_name'];
            $tenant_price = (float) $tenant['price'];
        } else {
            $tenant_name = 'Inconnu';
            $tenant_price = 0;
        }

        // Récupérer les paiements du locataire
        $stmt = $connexion->prepare("SELECT * FROM payment WHERE tenant_id = :tenant_id ORDER BY date_payment DESC");
        $stmt->execute(['tenant_id' => $id_tenant]);
        $payments = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (Exception $e) {
        $erreur = "Erreur : " . $e->getMessage();
    }
}
?>

<div class="main-container mt-3 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card-box p-3">
            <div class="text-center">
                <h5 class="text-uppercase">Détails de paiement</h5>
            </div>

            <?php if (isset($erreur)) { ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($erreur); ?>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card-box p-3">
            <div class="table-responsive-md">
                <table class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Locataire</th>
                            <th>Montant Loyer</th>
                            <th>Montant payé</th>
                            <th>Status</th>
                            <th>Mois</th>
                            <th>Date de paiement</th>
                            <th>Imprimé</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($payments)) { 
                            $counter = 1; 
                            foreach ($payments as $payment) { 
                                $montant_paye = (float) $payment['montant'];

                                // Détermination du statut et action
                                if ($montant_paye >= $tenant_price) {
                                    $status = '<span class="badge bg-success text-white">Payé</span>';
                                    $action = "Aucune action !";
                                } elseif ($montant_paye > 0 && $montant_paye < $tenant_price) {
                                    $status = '<span class="badge bg-warning text-white">Partiellement payé</span>';
                                    $action = '<a href="complete_payment.php?id=' . $payment['id'] . '" class="btn btn-warning btn-sm btn-xs text-white shadow-none">Compléter le paiement</a>';
                                } else {
                                    $status = '<span class="badge bg-danger text-white">Non payé</span>';
                                    $action = "Aucune action !";
                                }
                        ?>
                                <tr>
                                    <td><?= $counter++; ?></td>
                                    <td><?= htmlspecialchars($tenant_name); ?></td>
                                    <td><?= number_format($tenant_price, 0, ',', ' '); ?> FCFA</td>
                                    <td><?= number_format($montant_paye, 0, ',', ' '); ?> FCFA</td>
                                    <td><?= $status; ?></td>
                                    <td><?= htmlspecialchars($payment['mois']); ?></td>
                                    <td><?= date("d-m-Y H:i:s", strtotime($payment['date_payment'])); ?></td>
                                    <td><a href="print_payment.php?id=<?= $payment['id']; ?>" class="btn btn-customize text-white  font-12 btn-sm btn-xs text-white shadow-none"><i class="fa fa-
                                     fa-print"></i> Imprimer</a></td>
                                    <td><?= $action; ?></td>
                                </tr>
                        <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="12" class="text-center">Aucun paiement trouvé pour ce locataire.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
