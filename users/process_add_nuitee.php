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
    
    // Calculer l'heure de sortie : Ajouter 1 jour à la date d'entrée et définir l'heure à 12:00
    $date_entree_obj = new DateTime($date_entree); // Création de l'objet DateTime à partir de la date d'entrée
    $date_sortie_obj = clone $date_entree_obj; // Cloner l'objet DateTime pour éviter de modifier l'objet original
    $date_sortie_obj->modify('+1 day')->setTime(12, 0); // Ajouter 1 jour et définir l'heure à 12h00
    $date_sortie = $date_sortie_obj->format('Y-m-d H:i:s'); // Convertir l'objet DateTime en chaîne de caractères pour l'insertion dans la base de données

    $type_service = "NUITEE"; // Type de service (fixe à Sieste ici)
    $id = generateUUID(); // Générer un nouvel ID unique
    $added_by = $_SESSION['id'] ?? null; // ID de l'utilisateur qui a ajouté la réservation
    $motel_id = $motel_data['id'] ?? null;  // ID du motel (si disponible)

    // Insertion dans la base de données
    $stmt = $connexion->prepare("INSERT INTO reservation_nuitee (id, type_chambre, type_service, numero, id_motel, prix, date_entre, date_sortie, client_id, is_deleted, status, added_by, created_at, updated_at)
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

        // Calculer le temps de sortie de la réservation
        $date_sortie_timestamp = strtotime($date_sortie); // Convertir l'heure de sortie en timestamp
        $current_timestamp = time(); // Heure actuelle en timestamp

        // Vérifier si le temps de sortie est dépassé
        if ($current_timestamp > $date_sortie_timestamp) {
            // Mettre à jour le statut de la réservation en "terminé"
            $updateStmt = $connexion->prepare("UPDATE reservation_nuitee SET status = 'terminée' WHERE id = :id");
            $updateStmt->bindParam(':id', $id);
            $updateStmt->execute();
            echo "<script>alert('La réservation est terminée pour le client $client_name.');</script>";
        }

    } else {
        $erreur = "Une erreur est survenue lors de l'enregistrement de la réservation.";
    }
}
?>
