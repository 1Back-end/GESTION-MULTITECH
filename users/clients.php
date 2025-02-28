<?php include("../include/menu.php"); ?>
<?php include("fonction.php");?>

<div class="main-container mt-3 pb-5">
   <div class="col-md-12 col-sm-12 mb-3">
   <div class="card-box p-3">
        <div class="d-flex align-items-center justfify-content-between">
            <div class="mr-auto">
                <h5 class="text-uppercase">Liste des clients</h5>
            </div>
            <div class="ml-auto">
                <a href="add_client.php" class="btn btn-customize text-white text-uppercase">
                <i class="fa fa-plus" aria-hidden="true"></i>
                    Ajouter
                </a>
            </div>
        </div>
    </div>
   </div>

<?php

// Récupérer les clients paginés
$clients = get_all_clients_paginated($connexion, $offset, $items_per_page);

// Récupérer le total des clients pour la pagination
$total_clients = get_total_clients($connexion);

// Calculer le nombre de pages
$total_pages = ceil($total_clients / $items_per_page);
?>
   <div class="col-md-12 col-sm-12 mb-3">
    <div class="card-box p-3">
        <div class="table-responsive">
            <table class="table table-striped table-bordered text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom complet</th>
                        <th>Adresse</th>
                        <th>Téléphone</th>
                        <th>CNI</th>
                        <th>Ajouté le</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($clients) > 0): ?>
                        <?php foreach ($clients as $index => $client): ?>
                            <tr>
                            <td><?= ($index + 1) ?></td>
                                <td><?php echo $client['first_name'] . ' ' . $client['last_name']; ?></td>
                                <td><?php echo $client['address']; ?></td>
                                <td><?php echo $client['phone']; ?></td>
                                <td><?php echo $client['num_cni']; ?></td>
                                <td><?php echo $client['created_at']; ?></td>
                                <td>
                                    <!-- Actions (par exemple, modifier, supprimer) -->
                                    <a href="edit_client.php?id=<?php echo $client['id']; ?>" class="btn btn-info btn-sm">Modifier</a>
                                    <a href="delete_client.php?id=<?php echo $client['id']; ?>" class="btn btn-danger btn-sm">Supprimer</a>
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
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <ul class="pagination justify-content-center">
                <?php if ($current_page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $current_page - 1; ?>">Précédent</a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php echo ($i == $current_page) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($current_page < $total_pages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $current_page + 1; ?>">Suivant</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>