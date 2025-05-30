<?php include("../include/menu.php"); ?>
<?php include("../fonction/fonction.php");?>



<?php
// Connexion à la base de données
// Assurez-vous que $connexion est une instance PDO correctement configurée

// Nombre d'éléments par page
$limit = 10; 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Page actuelle
$offset = ($page - 1) * $limit; // Calcul de l'offset

// Récupérer les affectations de motels
$assignments = get_user_restaurant_assignments($connexion, $limit, $offset);

// Récupérer le nombre total d'affectations
$totalAssignments = get_total_user_restaurant_assignments($connexion);

// Calcul du nombre total de pages
$totalPages = ceil($totalAssignments / $limit);
?>

<div class="main-container mt-3 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card-box p-3">
            <div class="text-center">
                <h5 class="text-uppercase">Liste des affectations restaurants</h5>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card-box p-3">
            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Utilisateur</td>
                            <td>Restaurant</td>
                            <td>Affecté le</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($assignments) > 0): ?>
                            <?php foreach ($assignments as $index => $assignment): ?>
                                <tr>
                                    <td><?= ($index + 1) ?></td>
                                    <td><?= htmlspecialchars($assignment['user_first_name']) . ' ' . htmlspecialchars($assignment['user_last_name']); ?></td>
                                    <td><?= htmlspecialchars($assignment['restaurant_name']); ?></td>
                                    <td><?= htmlspecialchars((new DateTime($assignment['created_at']))->format('Y-m-d H:i:s')); ?></td>
                                    
                                    <td>
                                    <div class="dropdown">
                                        <button class="btn btn-customize text-white btn-rounded dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-cogs"></i> 
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li><a class="dropdown-item text-info" href="statistique_ventes_users.php?id=<?= $assignment['user_id']; ?>">
                                                <i class="fa fa-info-circle text-info"></i> voir les ventes
                                            </a></li>
                                        
                                        </ul>
                                    </div>
                                </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4">Aucune affectation trouvée</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <!-- Pagination -->
                <nav>
                    <ul class="pagination justify-content-center">
                        <?php if ($page > 1): ?>
                            <li class="page-item"><a class="page-link" href="?page=<?= $page - 1; ?>">Précédent</a></li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>"><a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a></li>
                        <?php endfor; ?>

                        <?php if ($page < $totalPages): ?>
                            <li class="page-item"><a class="page-link" href="?page=<?= $page + 1; ?>">Suivant</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
