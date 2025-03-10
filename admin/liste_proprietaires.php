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
                <h5 class="text-uppercase">Liste des Propriétaires</h5>
            </div>
            <div class="ml-auto">
                <a href="add_proprietaire.php" class="btn btn-customize text-white text-uppercase">
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
        <?php
// Récupération de la page actuelle
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$total_owners = count_owners($connexion); // Assurez-vous que cette fonction renvoie le bon nombre d'éléments
$total_pages = ceil($total_owners / $limit);

// Récupérer les propriétaires de la page actuelle
$owners = get_all_owners($connexion, $page, $limit);
?>

<div class="col-md-12 col-sm-12 mb-3">
    <div class="card-box p-3">
        <div class="table-responsive">
            <table class="table table-striped table-bordered text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom complet</th>
                        <th>Résidence</th>
                        <th>N° Téléphone</th>
                        <th>Nationalité</th>
                        <th>N° CNI</th>
                        <th>Créé le</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($owners)) : ?>
                        <tr><td colspan="10">Aucun élément trouvé</td></tr>
                    <?php else : ?>
                        <?php foreach ($owners as $index => $owner) : ?>
                            <tr>
                                <td><?= (($page - 1) * $limit) + ($index + 1) ?></td>
                                <td><?= htmlspecialchars($owner['first_name'] . ' ' . $owner['last_name']) ?></td>
                                <td><?= htmlspecialchars($owner['residence_location']) ?></td>
                                <td><?= htmlspecialchars($owner['phone_number']) ?></td>
                                <td><?= htmlspecialchars($owner['nationality']) ?></td>
                                <td><?= htmlspecialchars($owner['id_number']) ?></td>
                                <td><?= htmlspecialchars($owner['created_at']) ?></td>

                                <td>
                                <div class="dropdown">
                                    <button class="btn btn-customize text-white btn-rounded dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-cogs"></i> 
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                       
                                    <li>                                        
                                        <a class="dropdown-item text-success" href="../users/add_locataire.php?id=<?= $owner['id']; ?>">
                                            <i class="fa fa-plus text-success" aria-hidden="true"></i>
                                            Ajouter Locataire
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-info" href="../users/view_locataire_owner.php?id=<?= $owner['id']; ?>">
                                            <i class="fa fa-eye text-info"></i> Voir Locataires
                                        </a>
                                    </li>

                                        
                                        <li><a class="dropdown-item text-warning" href="edit_owner.php?id=<?= $owner['id']; ?>">
                                            <i class="fa fa-edit text-warning"></i> Modifier
                                        </a></li>
                                        
                                        <li><a class="dropdown-item text-danger" href="delete_owner.php?id=<?= $owner['id']; ?>" onclick="return confirm('Voulez-vous vraiment supprimer ce propriétaire ?');">
                                            <i class="fa fa-trash-alt text-danger"></i> Supprimer
                                        </a></li>

                                       
                                    </ul>
                                </div>
                            </td>

                                
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <nav>
    <ul class="pagination justify-content-center">
        <?php if ($page > 1) : ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Précédent">
                    <span aria-hidden="true">&laquo;</span> <!-- Flèche gauche -->
                </a>
            </li>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>

        <?php if ($page < $total_pages) : ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Suivant">
                    <span aria-hidden="true">&raquo;</span> <!-- Flèche droite -->
                </a>
            </li>
        <?php endif; ?>
    </ul>
</nav>

    </div>
</div>
