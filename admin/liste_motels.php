<?php include("../include/menu.php"); ?>
<?php include("../fonction/fonction.php");?>
<style>
    .text-color{
  color: #1F4283;
}
</style>
<div class="main-container mt-3 pb-5">
   <div class="col-md-12 col-sm-12 mb-3">
   <div class="card-box p-3">
        <div class="d-flex align-items-center justfify-content-between">
            <div class="mr-auto">
                <h5 class="text-uppercase">Liste des motels</h5>
            </div>
            <div class="ml-auto">
                <a href="add_motel.php" class="btn btn-customize text-white text-uppercase">
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
                    <?php if (count($motels) > 0): ?>
                        <?php foreach ($motels  as $index => $motel): ?>
                            <tr>
                                <td><?= ($index + 1) ?></td>
                                <td><?= htmlspecialchars($motel['name']) ?></td>
                                <td><?= htmlspecialchars($motel['address']) ?></td>
                                <td><?= htmlspecialchars($motel['contact_email']) ?></td>
                                <td><?= htmlspecialchars($motel['created_at']) ?></td>
                                <td>
                                    <?= $motel['status'] === 'active' ? '<span class="badge badge-success">Actif</span>' : '<span class="badge badge-danger">Inactif</span>' ?>
                                </td>
                                <td>
                                <div class="dropdown">
                                    <button class="btn btn-customize text-white btn-rounded dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-cogs"></i> 
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                            <a class="dropdown-item text-success" href="details_sieste.php?id=<?= $motel['id']; ?>">
                                                <i class="fa fa-clock text-success"></i> Détails Sièstes
                                            </a>
                                        </li>

                                        <li>
                                            <a class="dropdown-item text-color" href="details_nuitee.php?id=<?= $motel['id']; ?>">
                                                <i class="fa fa-moon text-color"></i> Détails nuitées
                                            </a>
                                        </li>
                                     
                                        <li><a class="dropdown-item text-warning" href="edit_motel.php?id=<?= $motel['id']; ?>">
                                            <i class="fa fa-edit text-warning"></i> Modifier
                                        </a></li>
                                        
                                        <li><a class="dropdown-item text-danger" href="delete_motel.php?id=<?= $motel['id']; ?>" onclick="return confirm('Voulez-vous vraiment supprimer ce motel ?');">
                                            <i class="fa fa-trash-alt text-danger"></i> Supprimer
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