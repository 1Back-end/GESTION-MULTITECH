<?php 
include("../include/menu.php"); 
include("fonction.php");

$id_owner = $_GET["id"];
$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;
$tenants = get_tenants($connexion, $limit, $offset,$id_owner);
$total_tenants = get_total_tenants($connexion,$id_owner);
$total_pages = ceil($total_tenants / $limit);
?>


<div class="main-container mt-3 pb-5">
   <div class="col-md-12 col-sm-12 mb-3">
    <div class="card-box p-3">
            <div class="text-center">
                    <h5 class="text-uppercase">Liste des Locataires</h5>
               
            </div>
        </div>
        </div>
        <div class="col-md-12 col-sm-12 mb-3">
    <?php include("process_add_payment.php");?>
    <!-- Affichage des messages d'erreur ou de succès -->
<?php if ($erreur): ?>
    <div class="alert alert-danger text-center border-0">
        <?php echo htmlspecialchars($erreur); ?>
    </div>
<?php endif; ?>

<?php if ($success): ?>
    <div class="alert alert-success text-center border-0">
        <?php echo htmlspecialchars($success); ?>
    </div>
<?php endif; ?>


</div>

   <div class="col-md-12 col-sm-12 mb-3">
       <div class="card-box p-3">
            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom complet</th>
                            <th>N° Téléphone</th>
                            <th>N° CNI</th>
                            <th>Résidence</th>
                            <th>D° Intégration</th>
                            <th>T° Bien</th>
                            <th>Mt Loyer</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($tenants) > 0): ?>
                            <?php foreach ($tenants as $index => $tenant): ?>
                                <tr>
                                    <td><?= ($index + 1) + $offset ?></td>
                                    <td><?php echo $tenant['first_name'] . ' ' . $tenant['last_name']; ?></td>
                                    <td><?php echo $tenant['phone']; ?></td>
                                    <td><?php echo $tenant['id_number']; ?></td>
                                    <td><?php echo $tenant['address']; ?></td>
                                    <td><?php echo $tenant['created_at']; ?></td>
                                    <td><?php echo $tenant['property_type']; ?></td>
                                     <td><?php echo $tenant['price']; ?> XAF</td>
                                     <td>
                                <div class="dropdown">
                                    <button class="btn btn-customize text-white btn-rounded dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-cogs"></i> 
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                       

                                    <li>
                                        <a class="dropdown-item text-info" href="view_payment_tenant.php?id=<?= $tenant['id']; ?>">
                                            <i class="fa fa-info-circle text-info"></i> Détails
                                        </a>
                                    </li>

                                    <li>
                                        <a class="dropdown-item text-success" href="javascript:void(0);" onclick="openPaymentModal('<?= $tenant['id']; ?>')">
                                            <i class="fa fa-credit-card-alt text-success"></i> Payé Loyer
                                        </a>
                                    </li>
                                </li>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="10">Aucun locataire trouvé</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="pagination">
                <ul class="pagination">
                    <?php if ($page > 1): ?>
                        <li class="page-item"><a class="page-link" href="?page=<?= $page - 1 ?>">Précédent</a></li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($page < $total_pages): ?>
                        <li class="page-item"><a class="page-link" href="?page=<?= $page + 1 ?>">Suivant</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
   </div>
</div>

<!-- Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Paiement du loyer</h5>
               <button type="button" class="btn-close border-0 shadow-none" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <form id="paymentForm" method="POST">
                    <input type="hidden" id="tenant_id" name="tenant_id">
                    <div class="mb-3">
                        <label for="montant" class="form-label">Montant <span class="text-danger">*</span></label>
                        <input type="number" class="form-control shadow-none" id="montant" name="montant" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Choisir le mois <span class="text-danger">*</span></label>
                    <select name="mois" class="shadow-none form-control select-custom" required>
                        <option disabled selected>Choisir un mois</option>
                        <?php
                            $mois = tousLesMois();
                            foreach ($mois as $nomMois) {
                                $selected = ($_GET['mois'] == $nomMois) ? 'selected' : '';
                                echo "<option value=\"$nomMois\" $selected>$nomMois</option>";
                            }
                        ?>
                    </select>
                    </div>
                    
                    <div class="mb-3 modal-footer">
                        <button type="submit" name="submit" class="btn btn-success border-0 rounded-0">Enregistrer le Paiement</button>
                        <button type="button" class="btn btn-secondary border-0 rounded-0" data-bs-dismiss="modal">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    function openPaymentModal(tenantId) {
    // Remplir le champ caché avec l'ID du locataire
    document.getElementById('tenant_id').value = tenantId;
    // Ouvrir la boîte modale
    var paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'));
    paymentModal.show();
}

</script>