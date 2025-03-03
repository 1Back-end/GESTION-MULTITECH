<?php include("../include/menu.php"); ?>
<?php include("../fonction/fonction.php"); ?>
<?php 
if (isset($_GET["id"])) {
    $id_user = $_GET["id"];
    $stmt = $connexion->prepare("SELECT first_name, last_name FROM users WHERE id = :id_user");
    $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
    $stmt->execute();
    $full_name_users = $stmt->fetch();
}

$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$date_filter = isset($_GET['date']) ? $_GET['date'] : null;
$month_filter = isset($_GET['month']) ? $_GET['month'] : null;
$keyword_filter = isset($_GET['keyword']) ? $_GET['keyword'] : null;

$ventes = get_vente_by_added_by_and_restaurant_id($connexion, $id_user, $limit, $offset, $date_filter, $month_filter,$keyword_filter);
$total_records = count_total_ventes($connexion, $id_user, $date_filter, $month_filter);
$total_revenue = get_total_revenue($connexion, $id_user, $date_filter, $month_filter, $keyword_filter);

$total_pages = $total_records ? ceil($total_records / $limit) : 1;

?>

<div class="main-container mt-3 pb-5">
    
    <div class="col-md-12 mb-3">
        <div class="card-box p-3">
            <form method="get" action="">
                <div class="row">
                    <input type="hidden" name="id" value="<?php echo $id_user; ?>">
                    <div class="col-md-4 mb-3">
                        <input type="text" name="keyword" class="form-control shadow-none" placeholder="Rechercher...">
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="date" name="date" class="form-control shadow-none">
                    </div>
                    <div class="col-md-3 mb-3">
                        <select name="month"class="shadow-none form-control select-custom">
                            <option disabled selected>Choisir un mois</option>
                            <?php foreach (tousLesMois() as $index => $nomMois): ?>
                                <option value="<?php echo $index + 1; ?>"><?php echo $nomMois; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2 text-end">
                        <button type="submit" class="btn btn-customize text-white w-100 btn-lg">Afficher</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-12 mb-3">
        <div class="card-box p-3">
            <table class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Type vente</th>
                        <th>Nom</th>
                        <th>Qté</th>
                        <th>PU</th>
                        <th>PT</th>
                        <th>Restaurant</th>
                        <th>Crée le</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($ventes)): ?>
                        <?php foreach ($ventes as $index => $vente): ?>
                            <tr>
                            <td><?php echo $index + 1; ?></td>

                                <td><?php echo htmlspecialchars($vente['type'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($vente['name'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($vente['quantity']); ?></td>
                                <td><?php echo number_format($vente['price']) . ' FCFA'; ?></td>
                                <td><?php echo number_format($vente['quantity'] * $vente['price']) . ' FCFA'; ?></td>
                                <td><?php echo htmlspecialchars($vente['restaurant_name']); ?></td>
                                <td><?php echo date('d-m-Y H:i', strtotime($vente['created_at'])); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="8">Aucun élément trouvé</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <div class="text-center">
            <p>Recette <?php echo $date_filter ? "du jour" : "du mois"; ?> : <strong><?php echo number_format($total_revenue) . ' FCFA'; ?></strong></p>

            </div>

            <nav>
                <ul class="pagination justify-content-center">
                    <?php if ($page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?id=<?php echo $id_user; ?>&page=<?php echo $page - 1; ?>">Précédent</a>
                        </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                            <a class="page-link" href="?id=<?php echo $id_user; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($page < $total_pages): ?>
                        <li class="page-item">
                            <a class="page-link" href="?id=<?php echo $id_user; ?>&page=<?php echo $page + 1; ?>">Suivant</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
</div>
