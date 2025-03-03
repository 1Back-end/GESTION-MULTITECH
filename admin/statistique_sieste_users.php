<?php include("../include/menu.php"); ?>
<?php include("../fonction/fonction.php"); ?>

<?php 

// Si un ID est passé dans l'URL, récupérer cet ID
if(isset($_GET["id"])){
    $user_id = $_GET["id"];
    
    // Définir les paramètres de filtrage par défaut
    $keyword = $_GET['keyword'] ?? null;  // mot-clé
    $date = $_GET['date'] ?? null;        // date
    $mois = $_GET['mois'] ?? null;        // mois
    $perPage = 10;                        // Nombre d'éléments par page
    $page = $_GET['page'] ?? 1;           // Page actuelle
    $offset = ($page - 1) * $perPage;    // Décalage pour la pagination

    // Récupérer les réservations avec les filtres
    $reservations = get_reservation_sieste_by_added_by($connexion, $user_id, $perPage, $offset, $keyword, $date, $mois);

    // Récupérer le nombre total de réservations pour la pagination
    $totalReservations = get_total_reservations_sieste($connexion, $user_id, $keyword, $date, $mois);
    $totalPages = ceil($totalReservations / $perPage);
}

?>

<div class="main-container mt-3 pb-5">
<div class="col-md-12 mb-3">
    <div class="card-box p-3">
        <form method="get" action="">
            <div class="row">
                <input type="hidden" name="id" value="<?php echo $user_id; ?>">

                <div class="col-md-4 mb-3">
                    <input type="text" name="keyword" class="form-control shadow-none" placeholder="Rechercher..." value="<?php echo $_GET['keyword'] ?? ''; ?>">
                </div>

                <div class="col-md-3 mb-3">
                    <input type="date" name="date" class="form-control shadow-none" value="<?php echo $_GET['date'] ?? ''; ?>">
                </div>

                <div class="col-md-3 mb-3">
                    <select name="mois" class="shadow-none form-control select-custom">
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

                <div class="col-md-2 text-end">
                    <button type="submit" class="btn btn-customize text-white w-100 btn-lg">Afficher</button>
                </div>
            </div>
        </form>
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
                            <td>Statut</td>
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
                                        <span class="badge <?= ($reservation['status'] == 'en cours') ? 'badge-success' : 'badge-danger'; ?>">
                                            <?= ucfirst($reservation['status']); ?>
                                        </span>
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
