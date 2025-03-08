<?php
include("../database/connexion.php");

$response = [];

// Récupérer les réservations expirées qui sont encore en cours
$checkExpiredStmt = $connexion->prepare("
    SELECT r.id, r.client_id, c.first_name, c.last_name, r.date_sortie, r.created_at, r.status
    FROM reservation_sieste r
    JOIN clients c ON r.client_id = c.id
    WHERE r.status = 'en cours' 
    AND r.date_sortie <= CURTIME()  -- Comparer la date de sortie avec l'heure actuelle
");
$checkExpiredStmt->execute();
$reservations = $checkExpiredStmt->fetchAll(PDO::FETCH_ASSOC);

if (!empty($reservations)) {
    $ids = array_column($reservations, 'id');
    $placeholders = implode(',', array_fill(0, count($ids), '?'));

    try {
        // Mise à jour du statut uniquement si la réservation est toujours "en cours"
        $updateStmt = $connexion->prepare("
            UPDATE reservation_sieste 
            SET status = 'terminée' 
            WHERE id IN ($placeholders) AND status = 'en cours'
        ");
        $updateStmt->execute($ids);

        // Génération des alertes Bootstrap pour chaque réservation mise à jour
        foreach ($reservations as $reservation) {
            $client_name = htmlspecialchars($reservation['first_name'] . " " . $reservation['last_name']);
            $response[] = "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>Alerte :</strong> Le temps de sieste est terminé pour <b>$client_name</b>.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
            ";
        }
    } catch (Exception $e) {
        // Gérer les erreurs
        $response[] = "
            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>Erreur :</strong> " . htmlspecialchars($e->getMessage()) . ".
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        ";
    }
}

// Retourner uniquement si des alertes existent
if (!empty($response)) {
    echo implode("\n", $response);
}
?>
