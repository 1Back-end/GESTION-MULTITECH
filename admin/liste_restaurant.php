<?php include("../include/menu.php"); ?>
<?php include("../fonction/fonction.php");?>

<div class="main-container mt-3 pb-5">
   <div class="col-md-12 col-sm-12 mb-3">
   <div class="card-box p-3">
        <div class="d-flex align-items-center justfify-content-between">
            <div class="mr-auto">
                <h5 class="text-uppercase">Liste des restaurants</h5>
            </div>
            <div class="ml-auto">
                <a href="add_restaurant.php" class="btn btn-customize text-white text-uppercase">
                <i class="fa fa-plus" aria-hidden="true"></i>
                    Ajouter
                </a>
            </div>
        </div>
    </div>
   </div>

   <div class="col-md-12 col-sm-12 mb-3">
<?php if(!empty($_GET["msg"])) : ?>
    <?php $msg = $_GET["msg"]; ?>
    <div class="alert alert-success text-center border-0"><?= $msg ?> !</div>
    <?php endif; ?>
</div>

   <div class="col-md-12 col-sm-12 mb-3">
    <div class="card-box p-3">
        <div class="table-responsive">
            <table class="table table-striped table-bordered text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Adresse</th>
                        <th>Email</th>
                        <th>Crée le</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (count($restaurant) > 0): ?>
                        <?php foreach ($restaurant  as $index => $restaurant): ?>
                            <tr>
                                <td><?= ($index + 1) ?></td>
                                <td><?= htmlspecialchars($restaurant['name']) ?></td>
                                <td><?= htmlspecialchars($restaurant['address']) ?></td>
                                <td><?= htmlspecialchars($restaurant['contact_email']) ?></td>
                                <td><?= htmlspecialchars($restaurant['created_at']) ?></td>
                                <td>
                                    <?= $restaurant['status'] === 'active' ? '<span class="badge badge-success">Actif</span>' : '<span class="badge badge-danger">Inactif</span>' ?>
                                </td>
                                <td>
                                <div class="dropdown">
                                    <button class="btn btn-customize text-white btn-rounded dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-cogs"></i> 
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li><a class="dropdown-item text-info" href="details_restaurant.php?id=<?= $restautrant['id']; ?>">
                                            <i class="fa fa-info-circle text-info"></i> Détails
                                        </a></li>
                                        
                                        <li><a class="dropdown-item text-warning" href="edit_restaurant.php?id=<?= $restautrant['id']; ?>">
                                            <i class="fa fa-edit text-warning"></i> Modifier
                                        </a></li>
                                        
                                        <li><a class="dropdown-item text-danger" href="delete_restaurant.php?id=<?= $restautrant['id']; ?>" onclick="return confirm('Voulez-vous vraiment supprimer ce restaurant ?');">
                                            <i class="fa fa-trash-alt text-danger"></i> Supprimer
                                        </a></li>

                                        <li><a class="dropdown-item text-primary" href="view_clients.php?id=<?= $restautrant['id']; ?>">
                                            <i class="fa fa-user text-primary"></i> Voir clients
                                        </a></li>
                                    </ul>
                                </div>
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
    </div>
</div>