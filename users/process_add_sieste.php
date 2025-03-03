<?php
include("../database/connexion.php");

$erreur = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type_chambre = $_POST["type_chambre"] ?? null;
    $numero_chambre = $_POST["numero_chambre"] ?? null;
    $client_id = $_POST["client_id"] ?? null;
    $prix = $_POST["prix"] ?? null;
    $date_entree = $_POST["date_entree"] ?? null;
    $date_sortie = $_POST["date_sortie"] ?? null;
    
    $id = generateUUID(); 
    $added_by = $_SESSION['id'] ?? null; 
    $motel_id = $motel_data['id'] ?? null;
    $mois = moisActuelle();
    
    $date_entree_seconds = strtotime($date_entree);
    $date_sortie_seconds = strtotime($date_sortie);
    $interval = $date_sortie_seconds - $date_entree_seconds;
    $max_duration = 2 * 60 * 60; 

    if ($interval > $max_duration) {
        $erreur = "La sieste ne peut pas dépasser 2 heures.";
    } else {
        // Insérer la réservation
        $stmt = $connexion->prepare("INSERT INTO reservation_sieste (id, type_chambre, type_service, numero, id_motel, prix, date_entre, date_sortie, client_id, is_deleted, status, added_by, mois, created_at, updated_at)
                                      VALUES (:id, :type_chambre, 'SIESTE', :numero, :id_motel, :prix, :date_entree, :date_sortie, :client_id, '0', 'en cours', :added_by, :mois, NOW(), NOW())");

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':type_chambre', $type_chambre);
        $stmt->bindParam(':numero', $numero_chambre);
        $stmt->bindParam(':id_motel', $motel_id);
        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':date_entree', $date_entree);
        $stmt->bindParam(':date_sortie', $date_sortie);
        $stmt->bindParam(':client_id', $client_id);
        $stmt->bindParam(':added_by', $added_by);
        $stmt->bindParam(':mois', $mois);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $success = "Réservation effectuée avec succès.";
        } else {
            $erreur = "Une erreur est survenue lors de l'enregistrement.";
        }
    }
}

?>
