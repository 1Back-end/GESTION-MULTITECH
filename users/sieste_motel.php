<?php include("../include/menu.php"); ?>
<?php include("fonction.php");?>

<div class="main-container mt-3 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
    <div class="card-box p-3">
        <div class="d-flex align-items-center justify-content-between">
            <div class="mr-auto">
            <?php if ($motels_name): ?>
        <h5 class="text-uppercase">Bienvenue aux sièstes de la <?php echo htmlspecialchars($motels_name); ?></h5>
    <?php else: ?>
        <h4 class="text-uppercase">Aucun motel assigné.</h4>
    <?php endif; ?>
            </div>
            <div class="ml-auto">
                <a href="add_sieste.php" class="btn btn-customize text-white text-uppercase">
                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    Ajouter
                </a>
            </div>
        </div>
    </div>
    </div>

    <?php
// Connexion à la base de données
include("../database/connexion.php");

// Récupérer les réservations avec pagination
$reservations = get_reservation_sieste_by_motel_id_and_added_by($connexion, $motel_id, $user_id, $perPage, $offset);

// Total des réservations pour la pagination
$totalReservations = get_total_reservations_sieste($connexion, $motel_id, $user_id);
$totalPages = ceil($totalReservations / $perPage);
?>

<div class="col-md-12 col-sm-12 mb-3">
    <div class="card-box p-3">
        <div class="table-responsive">
            <table class="table table-striped table-bordered text-center">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>T° chambre</td>
                        <td>T° service</td>
                        <td>N° chambre</td>
                        <td>Prix</td>
                        <td>Heure entrée</td>
                        <td>Heure sortie</td>
                        <td>Client</td>
                        <td>Ajouté le</td>
                        <td>Statut</td> <!-- Colonne Status -->
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($reservations) > 0): ?>
                        <?php foreach ($reservations as $index => $reservation): ?>
                            <tr>
                            <td><?= ($index + 1) ?></td>
                                <td><?= htmlspecialchars($reservation['type_chambre']); ?></td>
                                <td><?= htmlspecialchars($reservation['type_service']); ?></td>
                                <td><?= htmlspecialchars($reservation['numero']); ?></td>
                                <td><?= htmlspecialchars($reservation['prix']); ?> XAF</td>
                                <td><?= htmlspecialchars($reservation['date_entre']); ?></td>
                                <td><?= htmlspecialchars($reservation['date_sortie']); ?></td>
                                <td><?= htmlspecialchars($reservation['first_name']) . ' ' . htmlspecialchars($reservation['last_name']); ?></td>
                                <td><?= htmlspecialchars($reservation['created_at']); ?></td>
                                <td>
                                    <!-- Affichage du badge en fonction du statut -->
                                    <?php if ($reservation['status'] == 'en cours'): ?>
                                        <span class="badge badge-success">En cours</span>
                                    <?php else: ?>
                                        <span class="badge badge-danger">Terminée</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="10">Aucun élément trouvé</td>
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

