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
<?php include("process_assign_motel.php"); ?>
    <?php if ($erreur): ?>
    <div class="alert alert-danger text-center border-0"><?= $erreur ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="alert alert-success text-center border-0"><?= $success ?></div>
    <?php endif; ?>
</div>

<div class="col-md-12 col-sm-12 mb-3">
<?php include("process_assign_restaurant.php"); ?>
    <?php if ($error): ?>
    <div class="alert alert-danger text-center border-0"><?= $error ?></div>
    <?php endif; ?>

    <?php if ($succes): ?>
        <div class="alert alert-success text-center border-0"><?= $succes ?></div>
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
                                    <?php if ($user['role'] == 'Gestionnaire Motel & Restaurant'): ?>
                                        <span class="badge bg-success text-white">Gestionnaire Motel & Restaurant</span>
                                    <?php elseif ($user['role'] == 'Gestionnaire IMMO'): ?>
                                        <span class="badge bg-primary text-white">Gestionnaire IMMO</span>
                                    <?php elseif ($user['role'] == 'Gestionnaire de livraison'): ?>
                                        <span class="badge bg-warning text-white">Gestionnaire de livraison</span>
                                    <?php elseif ($user['role'] == 'Gestionnaire de ramassage'): ?>
                                        <span class="badge bg-info text-white">Gestionnaire de ramassage</span>
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
                                            <?php if ($user["role"] == 'Gestionnaire Motel & Restaurant'): ?>
                                            <?php if ($user['status'] == 'active'): ?>
                                            <li>
                                                <a href="#" class="dropdown-item text-color" data-toggle="modal" data-target="#assignMotelModal" data-user="<?= htmlspecialchars($user['id']); ?>">
                                                    <i class="fa fa-bed text-color"></i> Affecter motel
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="dropdown-item text-success assign-restaurant-btn" data-toggle="modal" data-target="#assignRestaurantModal" data-user="<?= htmlspecialchars($user['id']); ?>">
                                                    <i class="fa fa-utensils text-success"></i> Affecter restaurant
                                                </a>
                                            </li>
                                            <?php endif; ?>
                                           
                                        <?php endif; ?>




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



<!-- Boîte modale pour affecter un motel -->
<div class="modal fade" id="assignMotelModal" tabindex="-1" role="dialog" aria-labelledby="assignMotelModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignMotelModalLabel">Affecter à un motel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <!-- Champ caché pour l'ID utilisateur -->
                    <input type="hidden" name="user_id" id="modalUserId">

                    <div class="form-group">    
                        <select class="form-control form-control select-custom shadow-none" name="motel_id" id="motelSelect" required>
                            <option value="" disabled selected>-- Choisissez une option --</option>
                            <?php
                                foreach ($motels as $motel) {
                                    echo "<option value='{$motel['id']}'>" . htmlspecialchars($motel['name']) . "</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm btn-xs" data-dismiss="modal">Annuler</button>
                    <button type="submit" name="assign_motel" class="btn btn-customize text-white btn-sm btn-xs">Affecter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Ouvrir la modale et assigner l'ID utilisateur au champ caché
        $('[data-target="#assignMotelModal"]').on('click', function() {
            var userId = $(this).data('user');  // Récupère l'ID utilisateur
            $('#modalUserId').val(userId);  // Assigne la valeur au champ input caché
        });
    });
</script>


<!-- Boîte modale pour affecter un restaurant -->
<!-- Boîte modale pour affecter un restaurant -->
<div class="modal fade" id="assignRestaurantModal" tabindex="-1" role="dialog" aria-labelledby="assignRestaurantModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignRestaurantModalLabel">Affecter à un restaurant</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <!-- Champ caché pour l'ID utilisateur -->
                    <input type="hidden" name="user_id" id="modalRestaurantUserId">

                    <div class="form-group">    
                        <select class="form-control form-control select-custom shadow-none" name="restaurant_id" id="restaurantSelect" required>
                            <option value="" disabled selected>-- Choisissez un restaurant --</option>
                            <?php
                                foreach ($restaurant as $restaurants) {
                                    echo "<option value='{$restaurants['id']}'>" . htmlspecialchars($restaurants['name']) . "</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm btn-xs" data-dismiss="modal">Annuler</button>
                    <button type="submit" name="assign_restaurant" class="btn btn-customize text-white btn-sm btn-xs">Affecter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Ouvrir la modale et assigner l'ID utilisateur au champ caché
        $('[data-target="#assignRestaurantModal"]').on('click', function() {
            var userId = $(this).data('user');  // Récupère l'ID utilisateur
            $('#modalRestaurantUserId').val(userId);  // Assigne la valeur au champ input caché
        });
    });
</script>

