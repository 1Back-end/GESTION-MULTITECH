<?php
include("../include/menu.php");

?>

<?php
include("../database/connexion.php");
include("../fonction/fonction.php");

$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$pagination = getLivraisonsPaginated($connexion, $page);
$livraisons = $pagination['data'];
$totalPages = $pagination['total_pages'];
$currentPage = $pagination['current_page'];
?>



<div class="main-container mt-3 pb-5">

<div class="col-md-12 col-sm-12 mb-3">
<?php if(!empty($_GET["msg"])) : ?>
    <?php $msg = $_GET["msg"]; ?>
    <div class="alert alert-success text-center border-0"><?= $msg ?> !</div>
    <?php endif; ?>
</div>


<div class="col-lg-12 col-sm-12 mb-3">
<div class="card shadow p-3 mt-4 rounded-0 border-0">
    <h5 class="mb-3">📦 Liste des livraisons</h5>
    <div class="table-responsive-md">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Référence</th>
                    <th>Produit</th>
                    <th>Client</th>
                    <th>Téléphone</th>
                    <th>Quantité</th>
                    <th>Prix livraison</th>
                    <th>Lieu</th>
                    <th>À domicile</th>
                    <th>Livreur</th>
                    <th>Statut</th>
                    <th>Date Livraison</th>
                     <th>Ajouté par</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($livraisons) > 0): ?>
                    <?php foreach ($livraisons as $index => $liv): ?>
                        <tr>
                            <td><?= ($currentPage - 1) * 25 + $index + 1 ?></td>
                            <td><?= htmlspecialchars($liv['reference']) ?></td>
                            <td><?= htmlspecialchars($liv['product_name']) ?></td>
                            <td><?= htmlspecialchars($liv['recipient_name']) ?></td>
                            <td><?= htmlspecialchars($liv['phone']) ?></td>
                            <td><?= $liv['quantity'] ?></td>
                            <td><?= number_format($liv['delivery_price'], 0, ',', ' ') ?> FCFA</td>
                            <td><?= htmlspecialchars($liv['location']) ?></td>
                           <td>
                                <?php if ($liv['is_home_delivery']): ?>
                                    <span class="badge bg-success border-0 rounded-0 p-2 text-white">Oui</span>
                                <?php else: ?>
                                    <span class="badge bg-danger border-0 rounded-0 p-2 text-white">Non</span>
                                <?php endif; ?>
                                </td>

                            <td><?= htmlspecialchars($liv['livreur_first_name'] . ' ' . $liv['livreur_last_name']) ?></td>
                            <td>
                                <?php
                                $status = $liv['status'];
                                $badge = match ($status) {
                                    'En cours' => 'warning',
                                    'Livré' => 'success',
                                    'Annulé' => 'danger',
                                    default => 'secondary'
                                };
                                ?>
                                <span class="badge border-0 rounded-0 text-white bg-<?= $badge ?>"><?= $status ?></span>
                            </td>
                            <td><?= date('d/m/Y H:i', strtotime($liv['created_at'])) ?></td>
                           <td>
                                    <?= 
                                        !empty($liv['creator_first_name']) && !empty($liv['creator_last_name']) 
                                            ? htmlspecialchars($liv['creator_first_name'] . ' ' . $liv['creator_last_name']) 
                                            : "<em>Utilisateur inconnu</em>" 
                                    ?>
                            </td>

                           <td class="d-flex gap-2">
                                <?php if ($liv['status'] === 'En cours'): ?>
                                    <a href="traiter_livraison.php?uuid=<?= htmlspecialchars($liv['uuid']) ?>" class="btn btn-success btn-sm border-0 rounded-0 shadow-none mx-2" title="Finaliser">
                                        <i class="fas fa-check"></i> Finaliser
                                    </a>
                                    <a href="process_annuler_livraison.php?uuid=<?= htmlspecialchars($liv['uuid']) ?>" class="btn btn-danger btn-sm border-0 rounded-0 shadow-none mx-2" title="Annuler">
                                        <i class="fas fa-times"></i> Annuler
                                    </a>
                                <?php elseif ($liv['status'] === 'Livré'): ?>
                                    <span class="btn btn-info rounded-0 shadow-none btn-sm border-0 disabled">
                                        Livraison déjà éffectuée
                                    </span>
                                <?php else: ?>
                                    <span class="btn btn-danger rounded-0 shadow-none btn-sm border-0 disabled">
                                        Livraison déjà annulée
                                    </span>
                                <?php endif; ?>
                            </td>


                                
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="20" class="text-center">Aucune livraison trouvée.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination Bootstrap -->
    <nav class="mt-3">
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= $i === $currentPage ? 'active' : '' ?>">
                    <a class="page-link border-0 rounded-0" href="?page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>

</div>
</div>