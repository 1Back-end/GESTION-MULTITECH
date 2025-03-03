<?php 
include("../include/menu.php");
include("fonction.php");

// Définition des paramètres de pagination
$limit = 10; // Nombre d'éléments par page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Récupération des ventes de l'utilisateur connecté
$user_id = $_SESSION['id'] ?? null;
$restaurant_id = $restaurant_data['id'] ?? null;

$ventes = get_vente_by_added_by_and_restaurant_id($connexion, $restaurant_id, $user_id, $limit, $offset);
$total_ventes = count_ventes($connexion, $restaurant_id, $user_id);
$total_pages = ceil($total_ventes / $limit);
?>

<div class="main-container mt-3 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card-box p-3">
            <div class="d-flex align-items-center justify-content-between">
                <div class="mr-auto">
                    <?php if ($restaurant_name): ?>
                        <h5 class="text-uppercase">Bienvenue au restaurant <?php echo htmlspecialchars($restaurant_name); ?></h5>
                    <?php else: ?>
                        <h4 class="text-uppercase">Aucun restaurant assigné.</h4>
                    <?php endif; ?>
                </div>
                <div class="ml-auto">
                    <a href="add_vente.php" class="btn btn-customize text-white text-uppercase">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i> Ajouter
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card-box p-3">
            <table class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Type vente</td>
                        <td>Nom</td>
                        <td>Qté</td>
                        <td>Prix U</td>
                        <td>Prix Total</td>
                        <td>Crée le</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($ventes) > 0): ?>
                        <?php foreach ($ventes as $index => $vente): ?>
                            <tr>
                                <td><?php echo $offset + $index + 1; ?></td>
                                <td><?php echo htmlspecialchars($vente['type']); ?></td>
                                <td><?php echo htmlspecialchars($vente['name']); ?></td>
                                <td><?php echo htmlspecialchars($vente['quantity']); ?></td>
                                <td><?php echo number_format($vente['price']); ?> FCFA</td>
                                <td><?php echo number_format($vente['quantity'] * $vente['price']); ?> FCFA</td>
                                <td><?= htmlspecialchars((new DateTime($vente['created_at']))->format('d-m-Y H:i')); ?></td>

                                <td>
                                    <a href="edit_vente.php?id=<?php echo $vente['id']; ?>" class="btn btn-customize text-white btn-xs btn-sm">Modifier</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">Aucun élément trouvé</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <nav>
                <ul class="pagination justify-content-center">
                    <?php if ($page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $page - 1; ?>">Précédent</a>
                        </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($page < $total_pages): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $page + 1; ?>">Suivant</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
</div>
