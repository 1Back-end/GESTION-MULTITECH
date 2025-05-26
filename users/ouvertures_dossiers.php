<?php
include("../include/menu.php");
include("fonction.php");

$result = get_all_ouvertures_dossiers($connexion, 10,$user_id);
$dossiers = $result['data'];
$total_pages = $result['total_pages'];
$current_page = $result['current_page'];
?>

<div class="main-container mt-3 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card-box p-3">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="text-uppercase">Liste des ouvertures des dossiers</h5>
                <a href="add_dossiers.php" class="btn btn-customize text-white text-uppercase">
                    <i class="fa fa-plus"></i> Ajouter
                </a>
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
    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <div class="alert alert-success">Le dossier a été finalisé avec succès.</div>
<?php endif; ?>

</div>

<div class="col-lg-12 col-sm-12 mb-3">
    <div class="shadow p-3 border-0 bg-white">
        <div class="table-responsive-md">
             <?php if (empty($dossiers)): ?>
            <div class="alert alert-warning mt-3">Aucun élément trouvé.</div>
        <?php else: ?>
            <div class="table-responsive mt-3">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Nom complet</th>
                            <th>Profession</th>
                            <th>CNI</th>
                            <th>Téléphone</th>
                            <th>Email</th>
                            <th>Prestation</th> <!-- Ajouté -->
                            <th>Condition</th>
                            <th>Option</th>
                            <th>Date Ouverture</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = ($current_page - 1) * 10 + 1;
                        foreach ($dossiers as $dossier):
                        ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= htmlspecialchars($dossier['prefixe'] . ' ' . $dossier['nom_complet']) ?></td>
                                <td><?= htmlspecialchars($dossier['profession']) ?></td>
                                <td><?= htmlspecialchars($dossier['cni']) ?></td>
                                <td><?= htmlspecialchars($dossier['telephone']) ?></td>
                                <td><?= htmlspecialchars($dossier['email']) ?></td>
                                 <td><?= htmlspecialchars($dossier['prestation'] ?? '---') ?></td>
                                  <td><?= htmlspecialchars($dossier['condition_visite']) ?></td>
                                  <td><?= htmlspecialchars($dossier['option_visite']) ?></td>
                                <td><?= date('d/m/Y H:i:s', strtotime($dossier['created_at'])) ?></td>
                                <td>
                                    <?php if ($dossier['status'] === "En cours"): ?>
                                        <span class="disabled btn btn-warning btn-sm btn-xs text-white rounded-0 border-0">
                                            Dossier en cours
                                        </span>
                                    <?php else: ?>
                                        <span class="disabled btn btn-success btn-sm btn-xs text-white rounded-0 border-0">
                                            Dossier finalisé
                                        </span>
                                     <?php endif; ?>


                                </td>
                                <td>
                                    <div class="dropdown">
                                    <button class="btn btn-outline-secondary btn-sm btn-xs dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu border-0">
                                    <li>
                                        <a class="dropdown-item text-success fs-5" href="print_dossiers.php?uuid=<?= $dossier['uuid'] ?>">
                                           <i class="fa-solid fa-print me-1 text-success fs-5"></i> Imprimer la fiche
                                        </a>
                                    </li>
                                      <li>
                                            <?php if ($dossier['status'] === "Finalisé"): ?>
                                                <a class="dropdown-item text-info fs-5" href="print_recu.php?uuid=<?= htmlspecialchars($dossier['uuid']) ?>">
                                                    <i class="fa-solid fa-ticket fs-5 me-1"></i> Imprimer le reçu
                                                </a>
                                            <?php else: ?>
                                                <span class="dropdown-item text-secondary fs-5">
                                                    <i class="fa-solid fa-circle-info fs-5 me-1"></i> Aucune action
                                                </span>
                                            <?php endif; ?>
                                        </li>
                                    <li>
                                        <a class="dropdown-item text-warning fs-5" href="edit_dossiers.php?uuid=<?= $dossier['uuid'] ?>">
                                            <i class="fa-solid fa-pen-to-square text-warning me-1 fs-5"></i> Modifier le dossier
                                        </a>
                                    </li>

                                      <li>
                                        <?php if ($dossier['status'] === "En cours"): ?>
                                            <a class="dropdown-item text-success fs-5" href="close_dossiers.php?uuid=<?= htmlspecialchars($dossier['uuid']) ?>">
                                                <i class="fa-solid fa-closed-captioning fs-5 me-1 text-success"></i> Finaliser le dossier
                                            </a>
                                        <?php else: ?>
                                            <span class="dropdown-item text-secondary fs-5">
                                                <i class="fa-solid fa-circle-info fs-5 me-1"></i> Aucune action
                                            </span>
                                        <?php endif; ?>
                                    </li>

                                    </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <nav>
                <ul class="pagination">
                    <?php for ($p = 1; $p <= $total_pages; $p++): ?>
                        <li class="page-item <?= $p == $current_page ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $p ?>"><?= $p ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</div>

        </div>
    </div>
</div>