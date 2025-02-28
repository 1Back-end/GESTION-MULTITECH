<?php include("../include/menu.php"); ?>
<?php include("../fonction/fonction.php");?>

<div class="main-container mt-3 pb-5">
   <div class="col-md-12 col-sm-12 mb-3">
   <div class="card-box p-3">
        <div class="d-flex align-items-center justfify-content-between">
            <div class="mr-auto">
                <h5 class="text-uppercase">Liste des utilisateurs</h5>
            </div>
            <div class="ml-auto">
                <a href="add_user.php" class="btn btn-customize text-white text-uppercase">
                <i class="fa fa-plus" aria-hidden="true"></i>
                    Ajouter
                </a>
            </div>
        </div>
    </div>
   </div>

   <?php
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$limit = 10;
$users = get_all_users($connexion, $page, $limit);
?>

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
                        <th>Nom complet</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Statut</th>
                        <th>Ajouté le</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($users) > 0): ?>
                        <?php foreach ($users as $index => $user): ?>
                            <tr>
                                <td><?= ($index + 1) + ($page - 1) * $limit; ?></td>
                                <td><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></td>
                                <td><?= htmlspecialchars($user['phone_number']); ?></td>
                                <td><?= htmlspecialchars($user['email']); ?></td>
                                
                                <!-- Badge pour le rôle -->
                                <td>
                                    <?php if ($user['role'] == 'admin'): ?>
                                        <span class="badge bg-success text-white">Admin</span>
                                    <?php else: ?>
                                        <span class="badge bg-white text-dark">Inconnu</span>
                                    <?php endif; ?>
                                </td>

                                <!-- Badge pour le statut -->
                                <td>
                                    <?php if ($user['status'] == 'active'): ?>
                                        <span class="badge bg-success text-white"><i class="fas fa-check-circle"></i> Actif</span>
                                    <?php elseif ($user['status'] == 'inactive'): ?>
                                        <span class="badge bg-danger text-white"><i class="fas fa-exclamation-circle"></i> Inactif</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger"><i class="fas fa-ban"></i> Suspendu</span>
                                    <?php endif; ?>
                                </td>

                                <td><?= date('d/m/Y H:i', strtotime($user['created_at'])); ?></td>

                                <!-- Dropdown pour les actions -->
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-customize text-white btn-rounded dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-cogs"></i> 
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li><a class="dropdown-item text-info" href="details_user.php?id=<?= $user['id']; ?>">
                                                <i class="fa fa-info-circle text-info"></i> Détails
                                            </a></li>
                                            
                                            
                                            <li><a class="dropdown-item text-danger" href="delete_user.php?id=<?= $user['id']; ?>" onclick="return confirm('Voulez-vous vraiment supprimer cet utilisateur?');">
                                                 <i class="fa fa-trash-alt text-danger"></i> Supprimer
                                            </a></li>


                                            <li>
                                                <?php if ($user['status'] == 'active'): ?>
                                                    <a class="dropdown-item text-primary" href="deactivate_user.php?id=<?= $user['id']; ?>" onclick="return confirm('Voulez-vous vraiment désactiver cet utilisateur ?');">
                                                        <i class="fa fa-toggle-on"></i> Désactiver
                                                    </a>
                                                <?php else: ?>
                                                    <a class="dropdown-item text-success" href="activate_user.php?id=<?= $user['id']; ?>" onclick="return confirm('Voulez-vous vraiment activer cet utilisateur ?');">
                                                        <i class="fa fa-toggle-on"></i> Activer
                                                    </a>
                                                <?php endif; ?>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                </td>

                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8">Aucun élément trouvé</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <?php
        $stmt = $connexion->query("SELECT COUNT(*) FROM users WHERE is_deleted = 0");
        $total_users = $stmt->fetchColumn();
        $total_pages = ceil($total_users / $limit);
        ?>
        <nav>
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>
</div>
