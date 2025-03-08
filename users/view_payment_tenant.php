<?php 
include("../include/menu.php"); 
include("fonction.php");

if (isset($_GET["id"])) {
    $id_tenant = $_GET["id"];
    
    // Connexion à la base de données
    include("../database/connexion.php");

    // Récupérer les informations du locataire (nom et prénom)
    try {
        $stmt = $connexion->prepare("SELECT first_name, last_name,price FROM tenants WHERE id = :tenant_id");
        $stmt->execute(['tenant_id' => $id_tenant]);
        $tenant = $stmt->fetch(PDO::FETCH_ASSOC);
        $tenant_name = $tenant ? $tenant['first_name'] . ' ' . $tenant['last_name'] : 'Inconnu'; // Nom du locataire avec prénom et nom
        $tenant_price = $tenant ? $tenant['price'] : 'Non renseigné'; // Prix du loyer
    } catch (Exception $e) {
        $erreur = "Erreur lors de la récupération des informations du locataire : " . $e->getMessage();
    }

    // Récupérer tous les paiements du locataire
    try {
        $stmt = $connexion->prepare("SELECT * FROM payment WHERE tenant_id = :tenant_id ORDER BY date_payment DESC");
        $stmt->execute(['tenant_id' => $id_tenant]);
        $payments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $erreur = "Erreur lors de la récupération des paiements : " . $e->getMessage();
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
                    <?= $erreur; ?>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card-box p-3">
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <th>#</th> <!-- Colonne pour l'incrémentation -->
                            <th>Locataire</th> <!-- Nouvelle colonne pour afficher le nom -->
                            <th>Montant Loyer</th>
                            <th>Montant payé</th>
                            <th>Status</th>
                            <th>Mois</th>
                            <th>Date de paiement</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($payments)) { 
                            $counter = 1; // Initialisation du compteur ?>
                            <?php foreach ($payments as $payment) { ?>
                                <tr>
                                    <td><?= $counter++; ?></td> <!-- Affichage de l'incrémentation -->
                                    <td><?= htmlspecialchars($tenant_name); ?></td> <!-- Affichage du nom du locataire -->
                                    <td><?= htmlspecialchars($tenant_price); ?> FCFA</td> <!-- Affichage du montant du loyer -->
                                    <td><?= htmlspecialchars($payment['montant']); ?> FCFA</td>
                                    <td>
                                        <?php 
                                        // Affichage du statut
                                        if ($payment['status'] == "Payé") {
                                            echo '<span class="badge bg-success tex-center text-white">Payé</span>';
                                        } elseif ($payment['status'] == "Partiellement payé") {
                                            echo '<span class="badge bg-warning tex-center text-white">Partiellement payé</span>';
                                        } else {
                                            echo '<span class="badge bg-danger tex-center text-white">Non payé</span>';
                                        }
                                        ?>
                                    </td>
                                    <td><?= htmlspecialchars($payment['mois']); ?></td>
                                    <td><?= date("d-m-Y H:i:s", strtotime($payment['date_payment'])); ?></td>
                                    <td>
                                    <?php 
                                    if ($payment['status'] == "Partiellement payé"): ?>
                                        <a href="complete_payment.php?id=<?= $payment['id']; ?>" class="btn btn-warning btn-sm btn-xs text-white shadow-none">Compléter le paiement</a>
                                    <?php else: ?>
                                        Aucune action !
                                    <?php endif; ?>
                                </td>


                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="10" class="text-center">Aucun paiement trouvé pour ce locataire.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
