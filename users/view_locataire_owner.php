<?php 
include("../include/menu.php"); 
include("../fonction/fonction.php");

$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$tenants = get_tenants($connexion, $limit, $offset);
$total_tenants = get_total_tenants($connexion);
$total_pages = ceil($total_tenants / $limit);
?>


<div class="main-container mt-3 pb-5">
   <div class="col-md-12 col-sm-12 mb-3">
    <div class="card-box p-3">
            <div class="d-flex align-items-center justfify-content-between">
                <div class="mr-auto">
                    <h5 class="text-uppercase">Liste des Locataires</h5>
                </div>
                <div class="ml-auto">
                    <a href="add_locataire.php" class="btn btn-customize text-white text-uppercase">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                        Ajouter
                    </a>
                </div>
            </div>
        </div>
    </div>
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
                            <th>Date d'intégration</th>
                            <th>Type de bien</th>
                            <th>action</th>
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
                                    <td>
                                    <a href="regler_loyer.php?id=<?php echo $vente['id']; ?>" class="btn btn-customize text-white btn-xs btn-sm">ETAT LOYER</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8">Aucun locataire trouvé</td>
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

