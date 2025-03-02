<?php
include("../database/connexion.php");
include("../fonction/fonction.php");
// include("fonction.php");

$erreur = "";
$success = "";

if (isset($_POST["submit"])) {
    // Récupération des valeurs du formulaire
    $type_chambre = $_POST["type_chambre"] ?? null;
    $numero_chambre = $_POST["numero_chambre"] ?? null;
    $client_id = $_POST["client_id"] ?? null;
    $prix = $_POST["prix"] ?? null;
    $date_entree = $_POST["date_entree"] ?? null;
    $date_sortie = $_POST["date_sortie"] ?? null;
    $type_service = "SIESTE"; // Type de service (fixe à Sieste ici)
    $id = generateUUID(); // Générer un nouvel ID unique
    $added_by = $_SESSION['id'] ?? null; // ID de l'utilisateur qui a ajouté la réservation
    $motel_id = $motel_data['id'] ?? null;  // ID du motel (si disponible)

    // Convertir l'heure d'entrée et l'heure de sortie en secondes
    $date_entree_seconds = strtotime($date_entree); // Convertir l'heure d'entrée en timestamp
    $date_sortie_seconds = strtotime($date_sortie); // Convertir l'heure de sortie en timestamp

    // Calcul de la durée de la sieste
    $interval = $date_sortie_seconds - $date_entree_seconds; // Calcul de la différence en secondes
    $max_duration = 2 * 60 * 60; // Durée maximale de 2 heures en secondes

    if ($interval > $max_duration) {
        $erreur = "La sieste ne peut pas dépasser 2 heures.";
    } else {
        // Insertion dans la base de données
        $stmt = $connexion->prepare("INSERT INTO reservation_sieste (id, type_chambre, type_service, numero, id_motel, prix, date_entre, date_sortie, client_id, is_deleted, status, added_by, created_at, updated_at)
                                      VALUES (:id, :type_chambre, :type_service, :numero, :id_motel, :prix, :date_entre, :date_sortie, :client_id, :is_deleted, :status, :added_by, NOW(), NOW())");

        $is_deleted = '0'; // Pas supprimé
        $status = 'en cours'; // Statut initial de la réservation

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':type_chambre', $type_chambre);
        $stmt->bindParam(':type_service', $type_service);
        $stmt->bindParam(':numero', $numero_chambre);
        $stmt->bindParam(':id_motel', $motel_id);
        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':date_entre', $date_entree);
        $stmt->bindParam(':date_sortie', $date_sortie);
        $stmt->bindParam(':client_id', $client_id);
        $stmt->bindParam(':is_deleted', $is_deleted);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':added_by', $added_by);
        $stmt->execute();

        // Vérification si l'insertion a réussi
        if ($stmt->rowCount() > 0) {
            $success = "Réservation effectuée avec succès.";

            // Récupérer le nom du client
            $clientStmt = $connexion->prepare("SELECT first_name, last_name FROM clients WHERE id = :client_id");
            $clientStmt->bindParam(':client_id', $client_id);
            $clientStmt->execute();
            $client = $clientStmt->fetch(PDO::FETCH_ASSOC);
            $client_name = $client['first_name'] . " " . $client['last_name'];

            // Lancer un script d'alerte si la durée de la réservation a dépassé 2 heures
            if ($interval > $max_duration) {
                // Mise à jour de la réservation
                $updateStmt = $connexion->prepare("UPDATE reservation_sieste SET status = 'terminée', date_entre = NOW(), date_sortie = NOW() WHERE id = :id");
                $updateStmt->bindParam(':id', $id);
                $updateStmt->execute();

                // Lancer une alerte JavaScript avec le nom du client
                echo "<script>alert('Le temps de la sieste est terminé pour le client $client_name.');</script>";
            }
        } else {
            $erreur = "Une erreur est survenue lors de l'enregistrement de la réservation.";
        }
    }
}
?>
