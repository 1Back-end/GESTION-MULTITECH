<?php
include("../include/menu.php");
include("../fonction/fonction.php");


$result = get_all_clients_abonnes($connexion, 25);
$clients_abonnes = $result['data'];
$total_pages = $result['total_pages'];
$current_page = $result['current_page'];
?>

<div class="main-container mt-3 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card shadow border-0 rounded-0 p-3">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="text-uppercase">Liste des clients abonnés</h5>
                <a href="add_abonnement_clients.php" class="btn btn-customize text-white text-uppercase border-0 rounded-0">
                    <i class="fa fa-plus"></i> Ajouter
                </a>
            </div>
        </div>
 </div>

 <div class="col-lg-12 col-sm-12 mb-3">
    <?php if (isset($_GET['message']) && isset($_GET['type'])): ?>
    <div class="alert alert-<?= htmlspecialchars($_GET['type']) ?> border-0 rounded-0 text-center" role="alert">
        <?= htmlspecialchars($_GET['message']) ?>
    </div>
<?php endif; ?>

 </div>

<div class="col-lg-12 col-sm-12 mb-3">
    <div class="card shadow border-0 rounded-0 p-3">
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Nom complet</th>
                        <th>Adresse</th>
                        <th>Numéro Téléphone</th>
                        <th>Email</th>
                        <th>CNI</th>
                        <th>Forfait</th>
                        <th>Statut</th>
                        <th>Créer le</th>
                        <th>Mise à jour le</th>
                        <th>Produits</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                     <?php if (count($clients_abonnes) > 0): ?>
                            <?php foreach ($clients_abonnes as $index => $clients_abonne): ?>
                                <tr>
                                    <td><?= ($index + 1)?></td>
                                    <td><?php echo $clients_abonne['firstname'] . ' ' . $clients_abonne['lastname']; ?></td>
                                    <td><?php echo $clients_abonne['address']?></td>
                                   <td class="text-center">
                                        <ul class="list-unstyled">
                                        <li><?php echo $clients_abonne['tel1']?></li>
                                        <li><?php echo $clients_abonne['tel2']?></li>
                                        </ul>
                                    </td>
                                    <td><?php echo $clients_abonne['email']?></td>
                                    <td><?php echo $clients_abonne['cni_number']?></td>
                                    <td><?php echo $clients_abonne['price_for_abonnement']?>XAF</td>
                                    <td>
                                   <?php if ($clients_abonne['is_active']): ?>
                                        <span class="badge bg-success text-white border-0 rounded-0">
                                            <i class="fas fa-check-circle"></i> Actif
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-danger text-white border-0 rounded-0">
                                            <i class="fas fa-times-circle"></i> Inactif
                                        </span>
                                    <?php endif; ?>
                                </td>
                                    <td><?= date('d/m/Y H:i:s', strtotime($clients_abonne['created_at'])) ?></td>
                                    <td><?= date('d/m/Y H:i:s', strtotime($clients_abonne['updated_at'] || 'Non spécifié')) ?></td>
                                   <?php
                                    $stock = intval($clients_abonne['stock_total']);
                                    $badgeClass = $stock > 0 ? 'bg-success border-0 rounded-0 text-white' : 'bg-danger border-0 rounded-0 text-white';
                                    ?>
                                    <td>
                                    <span class="badge <?= $badgeClass ?>"><?= $stock ?> en stock</span>
                                    </td>
                                <td>
                                        <div class="dropdown">
                                            <button class="btn btn-outline-secondary rounded-0 btn-xs btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu border-0 shadow-sm" aria-labelledby="dropdownMenuButton">
                                                <li>
                                                    <?php if ($clients_abonne['is_active']): ?>
                                                        <a class="dropdown-item text-danger fs-6" href="toggle_status_client.php?action=disable&uuid=<?= $clients_abonne['uuid'] ?>">
                                                            <i class="fa-solid fa-toggle-off me-1"></i> Désactiver ce client
                                                        </a>
                                                    <?php else: ?>
                                                        <a class="dropdown-item text-success fs-6" href="toggle_status_client.php?action=enable&uuid=<?= $clients_abonne['uuid'] ?>">
                                                            <i class="fa-solid fa-toggle-on me-1"></i> Activer ce client
                                                        </a>
                                                    <?php endif; ?>
                                                </li>
                                                <?php if ($clients_abonne['is_active']): ?>
                                                    <li>
                                                        <a class="dropdown-item text-primary fs-6" href="add_products_clients.php?uuid=<?= $clients_abonne['uuid'] ?>">
                                                            <i class="fas fa-plus-circle me-2"></i> Ajouter les produits
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item text-warning fs-6" href="edit_abonnement_clients.php?uuid=<?= $clients_abonne['uuid'] ?>">
                                                            <i class="fa-solid fa-user-pen me-1"></i> Modifier ce client
                                                        </a>
                                                    </li>
                                                <?php else: ?>
                                                    <li>
                                                        <a class="dropdown-item disabled text-muted fs-6" href="#" tabindex="-1" aria-disabled="true">
                                                            <i class="fas fa-plus-circle me-2"></i> Aucune action (client inactif)
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item disabled text-muted fs-6" href="#" tabindex="-1" aria-disabled="true">
                                                            <i class="fa-solid fa-user-pen me-1"></i> Aucune action (client inactif)
                                                        </a>
                                                    </li>
                                                <?php endif; ?>

                                                <li>
                                                    <a class="dropdown-item text-danger fs-6" href="delete_abonnement_clients.php?uuid=<?= $clients_abonne['uuid'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?')">
                                                        <i class="fa-solid fa-trash me-1"></i> Supprimer ce client
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="12" class="text-center">Aucun élément trouvé</td>
                            </tr>
                        <?php endif; ?>
                </tbody>
            </table>
        </div>
        <nav>
                <ul class="pagination">
                    <?php for ($p = 1; $p <= $total_pages; $p++): ?>
                        <li class="page-item me-2 <?= $p == $current_page ? 'active' : '' ?>">
                            <a class="page-link border-0 rounded-0 me-2" href="?page=<?= $p ?>"><?= $p ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
    </div>
</div>