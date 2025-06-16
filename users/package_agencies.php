<?php 
include("../include/menu.php"); 
include("fonction.php");

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;

$total = count_packages_for_my_agency($connexion, $user_id);
$total_pages = ceil($total / $limit);

$packages = get_packages_for_my_agencies($connexion, $user_id, $limit, $page);
$agency = get_my_agency($connexion, $user_id);
$agency_name = $agency['name'] ?? 'Non défini';

?>


<div class="main-container mt-3 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card shadow border-0 rounded-0 p-3">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="text-uppercase">Liste des colis de l'agence <?= htmlspecialchars($agency_name) ?></h5>
                <a href="add_package.php" class="btn btn-customize text-white text-uppercase border-0 rounded-0">
                    <i class="fa fa-plus"></i> Ajouter
                </a>
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
                        <th>Image</th>
                        <th>Code</th>
                        <th>Expéditeur</th>
                        <th>Destinataire</th>
                        <th>Adresse</th>
                        <th>Statut</th>
                        <th>Créer le</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($packages)): ?>
                        <tr><td colspan="8">Aucun colis trouvé.</td></tr>
                    <?php else: ?>
                        <?php foreach ($packages as $index => $package): ?>
                            <tr>
                                <td><?= ($index + 1) + ($page - 1) * $limit ?></td>
                                <td>
                                    <?php if (!empty($package['image_path'])): ?>
                                        <img src="../uploads/packages/<?= htmlspecialchars($package['image_path']) ?>" class="img-thumbnail" alt="Image" width="70">
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($package['ref']) ?></td>
                                <td>
                                   <span> <?= htmlspecialchars($package['sender_name']) ?></span>
                                   <br><small class="fs-5"><?= htmlspecialchars($package['sender_phone']) ?></small>
                                   <br><small class="fs-5"><?= htmlspecialchars($package['sender_address']) ?>
                                    <?php if (!empty($package['sender_cni'])): ?>
                                        <br><small class="fs-5"><?= htmlspecialchars($package['sender_cni']) ?></small>
                                    <?php endif; ?>

                                </td>
                                <td>
                                    <?= htmlspecialchars($package['recipient_name']) ?>
                                    <br><small class="fs-5"><?= htmlspecialchars($package['recipient_phone']) ?></small>
                                    <?php if (!empty($package['recipient_cni'])): ?>
                                        <br><small class="fs-5"><?= htmlspecialchars($package['recipient_cni']) ?></small>
                                    <?php endif; ?>

                                </td>
                                
                                 <td>
                                    <?= htmlspecialchars($package['recipient_address']) ?>
                                    <br>
                                    <?php if ($package['home_delivery']): ?>
                                        <small>Livraison à domicile</small> <span class="badge bg-success border-0 rounded-0 text-white">Oui</span>
                                    <?php else: ?>
                                        <small>Livraison à domicile</small> <span class="badge bg-danger border-0 rounded-0 text-white">Non</span>
                                    <?php endif; ?>
                                </td>
                                
                                <td>
                                    <?php
                                        $status = $package['status'];
                                        switch ($status) {
                                            case 'en attente':
                                                $badgeClass = 'badge bg-warning text-white border-0 rounded-0 ';
                                                break;
                                            case 'en transit':
                                                $badgeClass = 'badge bg-primary border-0 rounded-0 text-white';
                                                break;
                                            case 'livré':
                                                $badgeClass = 'badge bg-success border-0 rounded-0';
                                                break;
                                            case 'annulé':
                                                $badgeClass = 'badge bg-danger border-0 rounded-0';
                                                break;
                                            default:
                                                $badgeClass = 'badge bg-secondary border-0 rounded-0';
                                        }
                                    ?>
                                    <span class="<?= $badgeClass ?>"><?= htmlspecialchars($status) ?></span>
                                </td>

                                <td><?= date('d/m/Y H:i:s', strtotime($package['created_at'])) ?></td>

                                 
                                    <td>
                                    <div class="dropdown">
                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                            <i class="dw dw-more"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-center dropdown-menu-icon-list border-0 rounded-0">
                                            <!-- Toujours visible -->
                                            <li>
                                                <a href="package_info.php?uuid=<?= htmlspecialchars($package['uuid']) ?>" class="dropdown-item text-info fs-6">
                                                    <i class="fa-solid fa-circle-info"></i> Voir les détails du colis
                                                </a>
                                            </li>

                                            <?php if ($package['status'] === 'en attente'): ?>
                                                <li>
                                                    <a href="collect_package.php?uuid=<?= htmlspecialchars($package['uuid']) ?>" 
                                                    class="dropdown-item text-warning fs-6 d-flex align-items-center gap-2">
                                                        <div class="spinner-grow fs-5 spinner-grow-sm text-warning" role="status" aria-hidden="true"></div>
                                                        <span>En attente de ramassage...</span>
                                                    </a>
                                                </li>


                                            <?php elseif ($package['status'] === 'en transit'): ?>
                                                
                                                <li>
                                                    <a href="delivery_package.php?uuid=<?= htmlspecialchars($package['uuid']) ?>" 
                                                    class="dropdown-item text-success fs-6 d-flex align-items-center gap-2">
                                                        <div class="spinner-grow fs-5 spinner-grow-sm text-success fs-5" role="status" aria-hidden="true"></div>
                                                        <span>En attente de Livraison du colis...</span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="cancel_delivery_package.php?uuid=<?= htmlspecialchars($package['uuid']) ?>" class="dropdown-item text-danger fs-6">
                                                        <i class="fa-solid fa-ban"></i> Annuler le livraison
                                                    </a>
                                                </li>

                                            <?php elseif ($package['status'] === 'livré'): ?>
                                                <li>
                                                    <a href="ticket_delivery_package.php?uuid=<?= htmlspecialchars($package['uuid']) ?>" class="dropdown-item text-warning fs-6">
                                                        <i class="fa-solid fa-ticket"></i> Imprimer le ticket de livraison
                                                    </a>
                                                </li>

                                            <?php elseif ($package['status'] === 'annulé'): ?>
                                                <li class="dropdown-item text-danger fs-6">
                                                    <i class="fa-solid fa-times-circle"></i> Colis annulé
                                                </li>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
 </div>









</div>