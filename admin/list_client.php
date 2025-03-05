<?php 
include("../include/menu.php"); 
include("../fonction/fonction.php");
$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;
$clients = get_clients($connexion, $limit, $offset);
$total_clients = get_total_clients_motel($connexion);
$total_pages = ceil($total_clients / $limit);
?>

<div class="main-container mt-3 pb-5">
   <div class="col-md-12 col-sm-12 mb-3">
       <div class="card-box p-3">
            <div class="text-center">
                <h5 class="text-uppercase">Liste de tous les clients</h5>
            </div>
        </div>
   </div>

   <div class="col-md-12 col-sm-12 mb-3">
       <div class="card-box p-3">
            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom complet</th>
                            <th>Adresse</th>
                            <th>N° Téléphone</th>
                            <th>Motel</th>
                            <th>Créé le</th>
                            <th>Ajouté par</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($clients) > 0): ?>
                            <?php foreach ($clients as $index => $client): ?>
                                <tr>
                                    <td><?= ($index + 1) + $offset ?></td>
                                    <td><?php echo $client['first_name'] . ' ' . $client['last_name']; ?></td>
                                    <td><?php echo $client['address']; ?></td>
                                    <td><?php echo $client['phone']; ?></td>
                                    <td><?php echo $client['motel_name'] ?: 'Non assigné'; ?></td>
                                    <td><?php echo $client['created_at']; ?></td>
                                    <td><?php echo $client['added_by_first_name'] . ' ' . $client['added_by_last_name']; ?></td>
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
            <div class="pagination">
       <ul class="pagination">
           <?php if ($page > 1): ?>
               <li class="page-item"><a class="page-link" href="?page=<?= $page - 1 ?>">Précédent</a></li>
           <?php endif; ?>

           <?php for ($i = 1; $i <= $total_pages; $i++): ?>
               <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>">
                   <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
               </li>
           <?php endfor; ?>

           <?php if ($page < $total_pages): ?>
               <li class="page-item"><a class="page-link" href="?page=<?= $page + 1 ?>">Suivant</a></li>
           <?php endif; ?>
       </ul>
   </div>
        </div>
        
   </div>

</div>
