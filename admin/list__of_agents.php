<?php include("../include/menu.php"); ?>
<?php
require_once('../fonction/fonction.php');

$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$pagination = get_all_agents_and_agency($connexion, $page);
$agents = $pagination['data'];
$totalPages = $pagination['total_pages'];
$currentPage = $pagination['current_page'];


?>
<div class="main-container mt-3 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card shadow border-0 rounded-0 p-3">
            <div class="text-center">
                <h5 class="text-uppercase">Liste des agents</h5>
            </div>
    </div>
</div>


<div class="col-lg-12 col-sm-12 mb-3">
    <div class="card shadow border-0 shadow p-3">
        <table class="table table-bordered table-striped align-middle" id="example" class="display">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Photo</th>
                    <th>Nom complet</th>
                    <th>Email</th>
                    <th>N° Téléphone</th>
                    <th>Adresse</th>
                    <th>Role</th>
                    <th>Agence</th>
                    <th>Créer par</th>
                    <th>Créer le</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                    <?php
                    $i = ($currentPage - 1) * 25 + 1;
                    foreach ($agents as $agent): ?>
                        <tr>
                            <td><?= $i++ ?></td>
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
                            <td><?= htmlspecialchars($agent['address']) ?></td>
                            <td>
                                <?php if ($agent['position'] == "Livreur"): ?>
                                    <span class="badge bg-secondary border-0 rounded-0 text-white">Livreur</span>
                                <?php elseif ($agent['position'] == "Ramasseur"): ?>
                                    <span class="badge bg-primary border-0 rounded-0 text-white">Ramasseur</span>
                                <?php else: ?>
                                    <span class="badge bg-white border-0 rounded-0">Inconnu</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="badge bg-success border-0 rounded-0 text-white">
                                    <?= htmlspecialchars($agent['agency_name']) ?>
                                </span>
                            </td>
                            <td><?= htmlspecialchars($agent['first_name'] . ' ' . $agent['last_name']) ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($agent['created_at'])) ?></td>
                            <td>
                                <?php if ($agent['is_active']): ?>
                                    <span class="badge bg-success border-0 rounded-0 text-white">Actif</span>
                                <?php else: ?>
                                    <span class="badge bg-danger border-0 rounded-0 text-white">Inactif</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

        </table>
    </div>
</div>
