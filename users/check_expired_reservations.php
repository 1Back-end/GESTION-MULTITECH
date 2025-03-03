<?php
include("../database/connexion.php");

$response = [];

// Afficher l'heure actuelle pour vérifier
// echo "Heure actuelle : " . date('H:i:s') . "<br>";

$checkExpiredStmt = $connexion->prepare("
    SELECT r.id, r.client_id, c.first_name, c.last_name, r.date_sortie, r.created_at 
    FROM reservation_sieste r
    JOIN clients c ON r.client_id = c.id
    WHERE r.status = 'en cours' 
    AND r.date_sortie <= CURTIME()
");
$checkExpiredStmt->execute();
$reservations = $checkExpiredStmt->fetchAll(PDO::FETCH_ASSOC);

// Vérifier s'il y a des réservations à mettre à jour
if (!empty($reservations)) {
    // Préparer la mise à jour de tous les statuts en une seule requête
    $ids = array_column($reservations, 'id');
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    
    try {
        // Mettre à jour toutes les réservations expirées
        $updateStmt = $connexion->prepare("
            UPDATE reservation_sieste SET status = 'terminée' WHERE id IN ($placeholders)
        ");
        $updateStmt->execute($ids);

        // Construire les messages de réponse et alerter que l'heure de sortie est arrivée
        foreach ($reservations as $reservation) {
            $client_name = $reservation['first_name'] . " " . $reservation['last_name'];
            $response[] = "Le temps de sieste est terminé pour $client_name.";
            
            // Alerte
            $response[] = "Alerte: L'heure de sortie pour $client_name est arrivée ou passée.";
        }
    } catch (Exception $e) {
        // Gérer les erreurs de mise à jour
        $response[] = "Erreur lors de la mise à jour des réservations : " . $e->getMessage();
    }
} else {
    $response[] = "Aucune réservation expirée trouvée.";
}

// Retourner les alertes en format texte (comme une chaîne de texte)
echo implode("\n", $response);
?>
