
<?php include("../include/menu.php"); ?>
<?php include("../fonction/fonction.php"); ?>
<?php
if (isset($_GET["id"])) {
    $motel_id = $_GET["id"];
} else {
    die("Aucun motel trouvé.");
}

// Connexion à la base de données
include("../database/connexion.php");

function get_motel_name($connexion, $motel_id) {
    $stmt = $connexion->prepare("SELECT name FROM motel WHERE id = :motel_id");
    $stmt->execute(['motel_id' => $motel_id]);
    $motel = $stmt->fetch(PDO::FETCH_ASSOC);
    return $motel ? $motel['name'] : 'Motel inconnu';
}

$motel_name = get_motel_name($connexion, $motel_id);

// Pagination
$perPage = 10; // Nombre de réservations par page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Numéro de la page
$offset = ($page - 1) * $perPage;

// Récupérer les réservations avec pagination
$reservations = get_reservation_by_motel_id($connexion, $motel_id, $perPage, $offset);

// Total des réservations pour la pagination
$totalReservations = get_total_reservations($connexion, $motel_id);
$totalPages = ceil($totalReservations / $perPage);

?>

<div class="main-container mt-3 pb-5">
   <div class="col-md-12 col-sm-12 mb-3">
       <div class="card-box p-3">
            <div class="text-center">
                <h5 class="text-uppercase">Liste des sièste du motel : <?php echo $motel_name; ?></h5>
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
                                <td>T° chambre</td>
                                <td>T° service</td>
                                <td>N° chambre</td>
                                <td>Prix</td>
                                <td>Heure entrée</td>
                                <td>Heure sortie</td>
                                <td>Client</td>
                                <td>Ajouté le</td>
                                <td>Ajouté par</td>
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
                                        <td><?= htmlspecialchars($reservation['client_first_name']) . ' ' . htmlspecialchars($reservation['client_last_name']); ?></td>
                                        <td><?= htmlspecialchars($reservation['created_at']); ?></td>
                                        <td><?= htmlspecialchars($reservation['user_first_name']) . ' ' . htmlspecialchars($reservation['user_last_name']); ?></td>

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
                                    <td colspan="12">Aucun élément trouvé</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <nav>
                        <ul class="pagination justify-content-center">
                            <?php if ($page > 1): ?>
                                <li class="page-item"><a class="page-link" href="?id=<?= $motel_id ?>&page=<?= $page - 1; ?>">Précédent</a></li>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>"><a class="page-link" href="?id=<?= $motel_id ?>&page=<?= $i; ?>"><?= $i; ?></a></li>
                            <?php endfor; ?>

                            <?php if ($page < $totalPages): ?>
                                <li class="page-item"><a class="page-link" href="?id=<?= $motel_id ?>&page=<?= $page + 1; ?>">Suivant</a></li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

?>
