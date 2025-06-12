<?php 
include("../include/menu.php"); 
include("fonction.php");

$agency = get_my_agency($connexion, $user_id);
$agency_name = $agency ? $agency['name'] : "Non attribuée";
$can_create_agents = $agency ? (bool)$agency['can_create_agents'] : false;


$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;

$results = get_all_agents_for_my_agency($connexion, $user_id, $limit, $page);
$agents = $results['data'];
$total_pages = $results['total_pages'];
$current_page = $results['current_page'];
?>

<div class="main-container mt-3 pb-5">

    <!-- Conteneur pour l'alerte -->
    <div id="alert-container"></div>

    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card shadow border-0 rounded-0 p-3">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="text-uppercase">Liste des agents de l'agence <?= htmlspecialchars($agency_name) ?></h5>
                <a href="<?= $can_create_agents ? 'add_agents.php' : '#' ?>" 
                    class="btn btn-customize text-white text-uppercase border-0 rounded-0 <?= $can_create_agents ? '' : 'disabled' ?>" 
                    <?= $can_create_agents ? '' : 'id="disabled-button"' ?>>
                    <i class="fa fa-plus"></i> Ajouter
                </a>
            </div>
        </div>
    </div>

<div class="col-lg-12 col-sm-12 mb-3">
    <?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success alert-dismissible rounded-0 border-0 text-center" role="alert">
        <?= htmlspecialchars($_GET['success']) ?>
    </div>
<?php elseif (isset($_GET['error'])): ?>
    <div class="alert alert-danger alert-dismissible rounded-0 border-0 text-center" role="alert">
        <?= htmlspecialchars($_GET['error']) ?>
    </div>
<?php endif; ?>

</div>


<div class="col-lg-12 col-sm-12 mb-3">
    <div class="card shadow border-0 p-3">
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center" id="example" class="display"> 
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Photo</th>
                        <th>Nom complet</th>
                        <th>Email</th>
                        <th>N° Téléphone</th>
                        <th>N° CNI</th>
                        <th>Role</th>
                        <th>Statut</th>
                        <th>Créer le</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($agents) > 0): ?>
                        <?php foreach ($agents as $index => $agent): ?>
                            <tr>
                                <td><?= ($index + 1) + ($current_page - 1) * $limit ?></td>
                                <td>
                                    <?php if (!empty($agent['photo'])): ?>
                                        <img src="../uploads/agents/<?= htmlspecialchars($agent['photo']) ?>" width="60" height="60" class="img-thumbnail" />
                                    <?php else: ?>
                                        <img src="../vendors/images/agents_delivery.png" width="60" height="60" class="img-thumbnail" alt="">
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($agent['fullname']) ?></td>
                                <td><?= htmlspecialchars($agent['email']) ?></td>
                                <td><?= htmlspecialchars($agent['phone']) ?></td>
                                <td><?= htmlspecialchars($agent['cni_number']) ?></td>
                               
                                 <td>
                                    <?php if ($agent['position']=="Livreur"): ?>
                                        <span class="badge bg-secondary border-0 rounded-0 text-white">Livreur</span>
                                    <?php elseif ($agent['position']=="Ramasseur"): ?>
                                        <span class="badge bg-primary border-0 rounded-0 text-white">Ramasseur</span>
                                    <?php else: ?>
                                        <span class="badge bg-white border-0 rounded-0">Inconnu</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($agent['is_active']): ?>
                                        <span class="badge bg-success border-0 rounded-0 text-white">Actif</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger border-0 rounded-0 text-white">Inactif</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= date('d/m/Y H:i', strtotime($agent['created_at'])) ?></td>

                                <td>
                                        <div class="dropdown">
                                            <button class="btn btn-outline-secondary rounded-0 btn-xs btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu border-0 shadow-sm" aria-labelledby="dropdownMenuButton">
                                                <li>
                                                    <?php if ($agent['is_active']): ?>
                                                        <a class="dropdown-item text-danger fs-6" href="toggle_status_agent.php?action=disable&uuid=<?= $agent['uuid'] ?>">
                                                            <i class="fa-solid fa-toggle-off me-1"></i> Désactiver cet agent
                                                        </a>
                                                    <?php else: ?>
                                                        <a class="dropdown-item text-success fs-6" href="toggle_status_agent.php?action=enable&uuid=<?= $agent['uuid'] ?>">
                                                            <i class="fa-solid fa-toggle-on me-1"></i> Activer cet agent
                                                        </a>
                                                    <?php endif; ?>
                                                </li>
                                                <?php if ($agent['is_active']): ?>
                                                    
                                                    <li>
                                                        <a class="dropdown-item text-warning fs-6" href="edit_agents.php?uuid=<?= $agent['uuid'] ?>">
                                                            <i class="fa-solid fa-user-pen me-1"></i> Modifier cette agent
                                                        </a>
                                                    </li>
                                                <?php else: ?>
                                                    <li>
                                                        <a class="dropdown-item disabled text-muted fs-6" href="#" tabindex="-1" aria-disabled="true">
                                                            <i class="fas fa-plus-circle me-2"></i> Aucune action (agent inactif)
                                                        </a>
                                                    </li>
                                                    
                                                <?php endif; ?>

                                               
                                            </ul>
                                        </div>
                                    </td>

                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="12">Aucun agent trouvé.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <!-- <nav class="mt-3">
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?= ($i == $current_page) ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav> -->
    </div>
</div>









</div>



<script>
document.addEventListener("DOMContentLoaded", function () {
    const button = document.getElementById("disabled-button");
    if (button) {
        button.addEventListener("click", function (e) {
            e.preventDefault();
            const alertDiv = document.getElementById("alert-container");
            alertDiv.innerHTML = `
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                    Vous n'avez pas l'autorisation de créer un agent. Veuillez contacter l'administration.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                </div>
            `;
        });
    }
});
</script>
