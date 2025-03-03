<?php
include("../database/connexion.php");


function generateUUID() {
    // Générer un UUID v4
    $data = random_bytes(16);
    // Modifier certains bits selon la spécification UUID
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // version 4
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // variant DCE 1.1
    return vsprintf('%s-%s-%s-%s-%s', str_split(bin2hex($data), 4));
}

// Vérifier si l'utilisateur est connecté
$user_id = $_SESSION['id'] ?? null;

// Fonction pour récupérer le nom et l'ID du motel de l'utilisateur
function getUserMotel($user_id, $connexion) {
    $stmt = $connexion->prepare("SELECT m.id, m.name FROM motel m 
                                JOIN user_motel um ON m.id = um.motel_id 
                                WHERE um.user_id = :user_id");
    $stmt->execute(['user_id' => $user_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC); // Retourne un tableau avec l'id et le nom du motel
}



// Appeler la fonction pour récupérer l'ID et le nom du motel de l'utilisateur
$motel_data = getUserMotel($user_id, $connexion);
$motels_name = $motel_data['name'] ?? 'Motel non trouvé';  // Nom du motel
$motel_id = $motel_data['id'] ?? null;  // ID du motel



function getUserRestaurant($user_id, $connexion) {
    $stmt = $connexion->prepare("SELECT r.id, r.name FROM restaurant r 
                                JOIN user_restaurant ur ON r.id = ur.restaurant_id 
                                WHERE ur.user_id = :user_id");
    $stmt->execute(['user_id' => $user_id]);
    
    return $stmt->fetch(PDO::FETCH_ASSOC) ?: null; // Retourne null si aucun restaurant n'est trouvé
}

// Appeler la fonction pour récupérer l'ID et le nom du restaurant de l'utilisateur
$restaurant_data = getUserRestaurant($user_id, $connexion);

if ($restaurant_data) {
    $restaurant_name = $restaurant_data['name']; // Nom du restaurant
    $restaurant_id = $restaurant_data['id'];    // ID du restaurant
} else {
    $restaurant_name = "Restaurant non trouvé";
    $restaurant_id = null;
}

// echo $motel_id;
// Nombre d'éléments par page
$items_per_page = 10;

// Récupérer la page courante à partir de l'URL (par défaut page 1)
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $items_per_page;

// Fonction pour récupérer les clients paginés
function get_all_clients_paginated($connexion, $offset, $items_per_page) {
    $stmt = $connexion->prepare("SELECT id, first_name, last_name, num_cni, phone, address, added_by, motel_id, created_at, updated_at
                                 FROM clients  LIMIT :offset, :items_per_page");
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindParam(':items_per_page', $items_per_page, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fonction pour compter le total des clients non supprimés
function get_total_clients($connexion) {
    $stmt = $connexion->prepare("SELECT COUNT(*) FROM clients");
    $stmt->execute();
    return $stmt->fetchColumn();
}

function TypeLogements() {
    $typeLogements = array(
        'Chambre standard',
        'Chambre Simple',
        'Chambre VIP',
    );
    return $typeLogements;
}
$typeLogements = TypeLogements();


function get_numero_chambre_from_motel_id($connexion, $motel_id){
    $stmt = $connexion->prepare("SELECT DISTINCT numero FROM chambres WHERE motel_id = :motel_id ORDER BY numero ASC");
    $stmt->bindParam(':motel_id', $motel_id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
$numero_motels = get_numero_chambre_from_motel_id($connexion, $motel_id);

function get_client_from_motel_id($connexion, $motel_id){
    $stmt = $connexion->prepare("SELECT id, first_name, last_name FROM clients WHERE is_deleted = 0 AND motel_id = :motel_id ORDER BY first_name ASC");
    $stmt->bindParam(':motel_id', $motel_id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$clients = get_client_from_motel_id($connexion, $motel_id);


$perPage = 10; // Nombre de réservations par page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Numéro de la page
$offset = ($page - 1) * $perPage;

// Fonction pour récupérer les réservations avec pagination
function get_reservation_sieste_by_motel_id_and_added_by($connexion, $motel_id, $user_id, $limit, $offset) {
    $stmt = $connexion->prepare("
        SELECT 
            r.id, 
            r.date_entre, 
            r.date_sortie, 
            r.type_chambre, 
            r.type_service,
            r.numero,
            r.prix,
            r.created_at,
            r.status,
            r.client_id, 
            c.first_name, 
            c.last_name,
            r.id_motel  -- Utilisation de id_motel ici
        FROM 
            reservation_sieste r
        JOIN 
            clients c ON r.client_id = c.id 
        WHERE 
            r.id_motel = :motel_id AND r.added_by = :user_id  -- Modification ici aussi
        ORDER BY 
            r.created_at DESC
        LIMIT :limit OFFSET :offset
    ");
    $stmt->bindParam(':motel_id', $motel_id);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fonction pour récupérer le nombre total de réservations
function get_total_reservations_sieste($connexion, $motel_id, $user_id) {
    $stmt = $connexion->prepare("
        SELECT COUNT(*) AS total 
        FROM reservation_sieste r
        WHERE r.id_motel = :motel_id AND r.added_by = :user_id
    ");
    $stmt->bindParam(':motel_id', $motel_id);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

// Function to retrieve reservations with pagination
function get_reservation_by_motel_nuite_id_and_added_by($connexion, $motel_id, $user_id, $limit, $offset) {
    // Prepare SQL statement to fetch the reservations with the necessary data
    $stmt = $connexion->prepare("
        SELECT 
            r.id, 
            r.date_entre, 
            r.date_sortie, 
            r.type_chambre, 
            r.type_service,
            r.numero,
            r.prix,
            r.created_at,
            r.status,
            r.client_id, 
            c.first_name, 
            c.last_name,
            r.id_motel
        FROM 
            reservation_nuitee r
        JOIN 
            clients c ON r.client_id = c.id 
        WHERE 
            r.id_motel = :motel_id AND r.added_by = :user_id
        ORDER BY 
            r.created_at DESC
        LIMIT :limit OFFSET :offset
    ");
    // Bind the parameters to the prepared statement
    $stmt->bindParam(':motel_id', $motel_id);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

    // Execute the statement
    $stmt->execute();

    // Return the fetched results as an associative array
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to retrieve the total number of reservations
function get_total_reservations_nuitee($connexion, $motel_id, $user_id) {
    // Prepare SQL statement to count total reservations for a specific motel and user
    $stmt = $connexion->prepare("
        SELECT COUNT(*) AS total 
        FROM reservation_nuitee r
        WHERE r.id_motel = :motel_id AND r.added_by = :user_id
    ");
    // Bind the parameters to the prepared statement
    $stmt->bindParam(':motel_id', $motel_id);
    $stmt->bindParam(':user_id', $user_id);

    // Execute the statement
    $stmt->execute();

    // Fetch the result and return the total count
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

//Fonction pour Generer le mois Actuel
function moisActuelle(){
    $moisEnAnglais = date('F');
 
    $correspondanceMois = [
     'January' => 'Janvier',
      'February' => 'Février',
      'March' => 'Mars',
      'April' => 'Avril',
      'May' => 'Mai',
      'June' => 'Juin',
      'July' => 'Juillet',
      'August' => 'Août',
      'September' => 'Septembre',
      'October' => 'Octobre',
      'November' => 'Novembre',
      'December' => 'Décembre'
    ];
    return $correspondanceMois[$moisEnAnglais];
 }
 



?>
