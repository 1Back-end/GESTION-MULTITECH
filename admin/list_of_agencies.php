<?php
include("../include/menu.php");
include("../database/connexion.php");
include("../fonction/fonction.php");

$agencies_data = get_all_agencyform_system($connexion);
$agencies = $agencies_data['data'];
$current_page = $agencies_data['current_page'];
$total_pages = $agencies_data['total_pages'];
?>

<div class="main-container mt-3 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card shadow border-0 rounded-0 p-3">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="text-uppercase">Liste des agences</h5>
                <a href="add_agencies.php" class="btn btn-customize text-white text-uppercase border-0 rounded-0">
                    <i class="fa fa-plus"></i> Ajouter
                </a>
            </div>
        </div>
 </div>

  <div class="col-lg-12 col-sm-12 mb-3">
    <?php if (isset($_GET['message']) && isset($_GET['type'])): ?>
    <div class="alert alert-<?= htmlspecialchars($_GET['type']) ?> border-0 rounded-0 text-center" role="alert">
        <?= htmlspecialchars($_GET['message']) ?>
    </div>
<?php endif; ?>

 </div>


<div class="col-lg-12 col-sm-12 mb-3">
    <div class="card shadow border-0 rounded-0 p-3">
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center" id="example">
                <thead class="thead-dark">
                        <th>#</th>
                        <th>Ref</th>
                        <th>Logo</th>
                        <th>Nom</th>
                        <th>Tel</th>
                        <th>Email</th>
                        <th>Chef d'agence</th>
                        <th>Créer le</th>
                        <th>Mise à jour le</th>
                        <th>Statut</th>
                        <th>Statut</th>
                    </tr>
                </thead>
               <tbody>
                    <?php if (count($agencies) > 0): ?>
                        <?php foreach ($agencies as $index => $agency): ?>
                            <tr>
                                <td><?= ($index + 1) + (($current_page - 1) * 25) ?></td>
                                <td><?= htmlspecialchars($agency['ref']) ?></td>
                                <td>
                                    <?php if (!empty($agency['logo'])): ?>
                                        <img src="../uploads/agency/<?= htmlspecialchars($agency['logo']) ?>" alt="Logo" width="50">
                                    <?php else: ?>
                                        <img src="../vendors/images/logo.png" alt="" class="img-thumbnail"  width="50">
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($agency['name']) ?></td>
                                <td><?= htmlspecialchars($agency['phone']) ?></td>
                                <td><?= htmlspecialchars($agency['email']) ?></td>
                                <td><?= htmlspecialchars($agency['manager_first_name'] . ' ' . $agency['manager_last_name']) ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($agency['created_at'])) ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($agency['updated_at'])) ?></td>
                                <td>
                                   <?php if ($agency['is_active']): ?>
                                        <span class="badge bg-success text-white border-0 rounded-0">
                                            <i class="fas fa-check-circle"></i> Actif
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-danger text-white border-0 rounded-0">
                                            <i class="fas fa-times-circle"></i> Inactif
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                <div class="dropdown">
                                <button class="btn btn-outline-secondary rounded-0 btn-xs btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                                <ul class="dropdown-menu border-0 shadow-sm" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <?php if ($agency['is_active']): ?>
                                            <a class="dropdown-item text-danger fs-6" href="toggle_status_agent.php?action=disable&uuid=<?= $agency['uuid'] ?>">
                                                <i class="fa-solid fa-toggle-off me-1"></i> Désactiver cette agence
                                            </a>
                                        <?php else: ?>
                                            <a class="dropdown-item text-success fs-6" href="toggle_status_agent.php?action=enable&uuid=<?= $agency['uuid'] ?>">
                                                <i class="fa-solid fa-toggle-on me-1"></i> Activer cette agence
                                            </a>
                                        <?php endif; ?>
                                    </li>

                                    <?php if ($agency['is_active']): ?>
                                        <li>
                                            <a class="dropdown-item text-warning fs-6" href="edit_agency.php?uuid=<?= $agency['uuid'] ?>">
                                                <i class="fa-solid fa-user-pen me-1"></i> Modifier cette agence
                                            </a>
                                        </li>

                                        <!-- ✅ Bouton pour activer/désactiver création d’agents -->
                                        <li>
                                            <?php if ($agency['can_create_agents']): ?>
                                                <a class="dropdown-item text-danger fs-6" href="toggle_create_agents.php?action=disable&uuid=<?= $agency['uuid'] ?>">
                                                    <i class="fa-solid fa-user-slash me-1"></i> Désactiver création agents
                                                </a>
                                            <?php else: ?>
                                                <a class="dropdown-item text-success fs-6" href="toggle_create_agents.php?action=enable&uuid=<?= $agency['uuid'] ?>">
                                                    <i class="fa-solid fa-user-plus me-1"></i> Activer création agents
                                                </a>
                                            <?php endif; ?>
                                        </li>
                                    <?php else: ?>
                                        <li>
                                            <a class="dropdown-item disabled text-muted fs-6" href="#" tabindex="-1" aria-disabled="true">
                                                <i class="fa-solid fa-user-pen me-1"></i> Impossible de modifier !
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <li>
                                        <a class="dropdown-item text-danger fs-6" href="delete_agency.php?uuid=<?= $agency['uuid'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette agence ?')">
                                            <i class="fa-solid fa-trash me-1"></i> Supprimer cette agence
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr class="text-center">
                            <td colspan="12">Aucun élément trouvé</td>
                        </tr>
                    <?php endif; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>

<script>
  $(document).ready(function() {
    $('#example').DataTable();
  });
</script>