<?php include("../include/menu.php"); ?>
<?php include("../fonction/fonction.php");?>
<style>
    h5, h6 {
    margin: 0;
    margin-bottom: 0px;
    padding: 0;
    font-weight: 700;
    color: #1F4283;
    font-family: "Rubik", system-ui;
    font-size: 14px;
}
</style>

<div class="main-container mt-3 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="d-flex align-items-center justify-content-between">
            <div class="mr-auto">
                <h4 class="text-uppercase">Tableau de bord</h4>
            </div>
            <div class="ml-auto">
                <?php echo getCurrentDateTime(); ?>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-sm-12 mb-3">
    <div class="row">
        <!-- Total Motel -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="card-box p-3">
                <div class="text-center">
                    <h6 class="mb-3 text-uppercase">Total Motels</h6>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="mr-auto">
                            <div class="logo">
                                <span class="icon-pending text-white font-weight-bold">
                                    <i class="fas fa-bed fs-3"></i>
                                </span>
                            </div>
                        </div>
                        <div class="ml-auto">
                            <h6 class="mr-2 fs-3"><?php echo $total_motels ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Clients -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="card-box p-3">
                <div class="text-center">
                    <h6 class="mb-3 text-uppercase">Total Clients</h6>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="mr-auto">
                            <div class="logo">
                                <span class="icon-pending text-white font-weight-bold">
                                    <i class="fas fa-users fs-3"></i>
                                </span>
                            </div>
                        </div>
                        <div class="ml-auto">
                            <h6 class="mr-2 fs-3"><?php echo $total_clients?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Admins -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="card-box p-3">
                <div class="text-center">
                    <h6 class="mb-3 text-uppercase">Total Admins</h6>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="mr-auto">
                            <div class="logo">
                                <span class="icon-pending text-white font-weight-bold">
                                    <i class="fas fa-user-shield fs-3"></i>
                                </span>
                            </div>
                        </div>
                        <div class="ml-auto">
                            <h6 class="mr-2 fs-3"><?php echo $total_admins?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
        <div class="card-box p-3">
            <div class="text-center">
                <h6 class="mb-3 text-uppercase">Total Restaurants</h6>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="mr-auto">
                        <div class="logo">
                            <span class="icon-pending text-white font-weight-bold">
                                <i class="fas fa-utensils fs-3"></i> <!-- Icône pour le restaurant -->
                            </span>
                        </div>
                    </div>
                    <div class="ml-auto">
                        <h6 class="mr-2 fs-3"><?php echo $total_restaurants?></h6> <!-- Remplacer 0 par le total des ventes -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="card-box p-3">
                <div class="text-center">
                    <h6 class="mb-3 text-uppercase">Total Proprietaires</h6>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="mr-auto">
                            <div class="logo">
                                <span class="icon-pending text-white font-weight-bold">
                                    <i class="fas fa-users fs-3"></i>
                                </span>
                            </div>
                        </div>
                        <div class="ml-auto">
                            <h6 class="mr-2 fs-3"><?php echo $total_owner?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="card-box p-3">
                <div class="text-center">
                    <h6 class="mb-3 text-uppercase">Total locataires</h6>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="mr-auto">
                            <div class="logo">
                                <span class="icon-pending text-white font-weight-bold">
                                    <i class="fas fa-users fs-3"></i>
                                </span>
                            </div>
                        </div>
                        <div class="ml-auto">
                            <h6 class="mr-2 fs-3"><?php echo $total_tenants?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     </div>


 <?php
$usersStats = get_users_dossiers_stats($connexion);

// Tu peux garder tous les utilisateurs même sans dossier si tu veux, ou filtrer :
$usersStats = array_filter($usersStats, fn($u) => $u['total_dossiers'] > 0);
?>

<div class="col-lg-8 col-sm-12 mb-3">  
    <div class="card shadow border-0 p-3">
        <p class="text-muted">Statistiques d'ouvertures des dossiers par gestionnaires</p> 
        <div class="table-responsive-md">
            <table class="table table-striped table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Gestionnaire</th>
                        <th>Total Dossiers</th>
                        <th>Dossiers Finalisés</th>
                        <th>Montant Générés</th>
                        <th>Dernière Création</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($usersStats)): ?>
                        <tr>
                            <td colspan="9" class="text-center">Aucune donnée disponible</td>
                        </tr>
                    <?php else: 
                        $i = 1;
                        foreach ($usersStats as $user):
                            // Calcul dossiers en cours (s'il existe dans les statuts)
                            $enCoursCount = $user['statuts']['En cours'] ?? 0;
                    ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?></td>
                            <td><?= (int)$user['total_dossiers'] ?></td>
                            <td><?= (int)$user['finalised_dossiers'] ?></td>
                            <td><?= number_format($user['finalised_montant'], 0, ',', ' ') ?> XAF</td>
                          
                            <td><?= $user['last_created_at'] ? date('d/m/Y H:i', strtotime($user['last_created_at'])) : '-' ?></td>
                            <td class="d-flex align-items-center justify-content-center">
                                <div class="mx-2">
                                    <?php if (!empty($user['statuts'])): ?>
                                    <?php foreach ($user['statuts'] as $statut => $count): 
                                        $badgeClass = match (strtolower($statut)) {
                                            'en cours' => 'badge bg-warning text-white',
                                            'finalisé' => 'badge bg-success text-white',
                                            default => 'badge bg-secondary',
                                        };
                                    ?>
                                        <span class="<?= $badgeClass ?> me-1"><?= htmlspecialchars($statut) ?> : <?= (int)$count ?></span>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                                </div>

                            </td>
                        </tr>
                    <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>






    </div>
</div>
