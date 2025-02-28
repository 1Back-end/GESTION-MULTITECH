<?php 
include("../include/menu.php"); 
include("../fonction/fonction.php");

include("../database/connexion.php");

// Vérifier si un ID de motel est passé via l'URL
if (isset($_GET["id"])) {
    $motel_id = $_GET["id"];
} else {
    // Rediriger ou afficher une erreur si aucun motel_id n'est trouvé
    die("Aucun motel trouvé.");
}

// Récupérer le nom du motel
function get_motel_name($connexion, $motel_id) {
    $stmt = $connexion->prepare("SELECT name FROM motel WHERE id = :motel_id");
    $stmt->execute(['motel_id' => $motel_id]);
    $motel = $stmt->fetch(PDO::FETCH_ASSOC);
    return $motel ? $motel['name'] : 'Motel inconnu';
}

// Récupérer les clients associés à ce motel
function get_clients_by_motel($connexion, $motel_id) {
    $stmt = $connexion->prepare("SELECT c.id, c.first_name, c.last_name, c.address, c.phone, c.created_at
                                 FROM clients c
                                 JOIN motel m ON c.motel_id = m.id
                                 WHERE m.id = :motel_id");
    $stmt->execute(['motel_id' => $motel_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Récupérer le nom du motel
$motel_name = get_motel_name($connexion, $motel_id);

// Récupérer les clients du motel
$clients = get_clients_by_motel($connexion, $motel_id);
?>

<div class="main-container mt-3 pb-5">
   <div class="col-md-12 col-sm-12 mb-3">
       <div class="card-box p-3">
            <div class="text-center">
                <div class="mr-auto">
                    <h5 class="text-uppercase">Liste des clients du motel : <?php echo $motel_name; ?></h5>
                </div>
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($clients) > 0): ?>
                            <?php foreach ($clients  as $index => $client): ?>
                                <tr>
                                <td><?= ($index + 1) ?></td>
                                    <td><?php echo $client['first_name'] . ' ' . $client['last_name']; ?></td>
                                    <td><?php echo $client['address']; ?></td>
                                    <td><?php echo $client['phone']; ?></td>
                                    <td><?php echo $client['created_at']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5">Aucun élément trouvé</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
   </div>
</div>
