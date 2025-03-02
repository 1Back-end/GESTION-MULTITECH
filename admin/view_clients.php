<?php 
include("../include/menu.php"); 
include("../fonction/fonction.php");
include("../database/connexion.php");

if (isset($_GET["id"])) {
    $motel_id = $_GET["id"];
} else {
    die("Aucun motel trouvé.");
}

function get_motel_name($connexion, $motel_id) {
    $stmt = $connexion->prepare("SELECT name FROM motel WHERE id = :motel_id");
    $stmt->execute(['motel_id' => $motel_id]);
    $motel = $stmt->fetch(PDO::FETCH_ASSOC);
    return $motel ? $motel['name'] : 'Motel inconnu';
}

function get_clients_by_motel($connexion, $motel_id, $limit, $offset) {
    $stmt = $connexion->prepare("
        SELECT 
            c.id, 
            c.first_name, 
            c.last_name, 
            c.address, 
            c.phone, 
            c.created_at,
            u.first_name AS added_by_first_name,
            u.last_name AS added_by_last_name
        FROM clients c
        LEFT JOIN users u ON c.added_by = u.id
        WHERE c.motel_id = :motel_id
        LIMIT :limit OFFSET :offset
    ");
    $stmt->bindParam(':motel_id', $motel_id);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_total_clients($connexion, $motel_id) {
    $stmt = $connexion->prepare("
        SELECT COUNT(*) AS total 
        FROM clients c
        WHERE c.motel_id = :motel_id
    ");
    $stmt->bindParam(':motel_id', $motel_id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

$motel_name = get_motel_name($connexion, $motel_id);
$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;
$clients = get_clients_by_motel($connexion, $motel_id, $limit, $offset);
$total_clients = get_total_clients($connexion, $motel_id);
$total_pages = ceil($total_clients / $limit);
?>

<div class="main-container mt-3 pb-5">
   <div class="col-md-12 col-sm-12 mb-3">
       <div class="card-box p-3">
            <div class="text-center">
                <h5 class="text-uppercase">Liste des clients du motel : <?php echo $motel_name; ?></h5>
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
                            <th>Créé le</th>
                            <th>Ajouté par</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($clients) > 0): ?>
                            <?php foreach ($clients as $index => $client): ?>
                                <tr>
                                    <td><?= ($index + 1) ?></td>
                                    <td><?php echo $client['first_name'] . ' ' . $client['last_name']; ?></td>
                                    <td><?php echo $client['address']; ?></td>
                                    <td><?php echo $client['phone']; ?></td>
                                    <td><?php echo $client['created_at']; ?></td>
                                    <td><?php echo $client['added_by_first_name'] . ' ' . $client['added_by_last_name']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">Aucun élément trouvé</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="pagination">
       <ul class="pagination">
           <?php if ($page > 1): ?>
               <li class="page-item"><a class="page-link" href="?id=<?= $motel_id ?>&page=<?= $page - 1 ?>">Précédent</a></li>
           <?php endif; ?>

           <?php for ($i = 1; $i <= $total_pages; $i++): ?>
               <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>">
                   <a class="page-link" href="?id=<?= $motel_id ?>&page=<?= $i ?>"><?= $i ?></a>
               </li>
           <?php endfor; ?>

           <?php if ($page < $total_pages): ?>
               <li class="page-item"><a class="page-link" href="?id=<?= $motel_id ?>&page=<?= $page + 1 ?>">Suivant</a></li>
           <?php endif; ?>
       </ul>
   </div>
        </div>
        
   </div>

   
</div>
