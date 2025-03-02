<?php
function generateUUID() {
    // Générer un UUID v4
    $data = random_bytes(16);
    // Modifier certains bits selon la spécification UUID
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // version 4
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // variant DCE 1.1
    return vsprintf('%s-%s-%s-%s-%s', str_split(bin2hex($data), 4));
}


function generatePassword($length = 12) {
    // Définir les caractères utilisés dans le mot de passe
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+-=';
    // Initialiser une variable pour stocker le mot de passe généré
    $password = '';
    
    // Boucle pour construire le mot de passe
    for ($i = 0; $i < $length; $i++) {
        // Choisir un caractère aléatoire
        $password .= $characters[random_int(0, strlen($characters) - 1)];
    }

    return $password;
}



function generateCode($length = 4) {
    // Définir les caractères utilisables dans le code
    $characters = '0123456789'; // Chiffres et lettres majuscules
    $code = '';
    
    // Boucle pour construire le code
    for ($i = 0; $i < $length; $i++) {
        // Choisir un caractère aléatoire
        $code .= $characters[random_int(0, strlen($characters) - 1)];
    }

    return $code;
}

function getCurrentYear() {
    return date("Y"); // Renvoie l'année actuelle au format 4 chiffres (ex. 2024)
}

function getCurrentDateTime() {
    return date("d-m-Y H:i:s"); // Renvoie la date et l'heure actuelles au format "AAAA-MM-JJ HH:MM:SS"
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
 
 $mois_actuelle = moisActuelle();
 


 //Fonction pour verifier l'adresse email saisit par l'utilisateur
function validateEmail($email) {
    // Utiliser filter_var avec FILTER_VALIDATE_EMAIL pour vérifier si l'email est valide
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}
function generateFourDigitCode() {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomCode = '';
    for ($i = 0; $i < 4; $i++) {
        $randomCode .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomCode;
}

function getCurrentPageName() {
    // Récupérer le nom du fichier PHP actuel sans extension
    $pageName = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
    
    // Remplacer les soulignements par des espaces
    $pageName = str_replace('_', ' ', $pageName);
    
    // Capitaliser chaque mot
    $pageName = ucwords($pageName);
    
    return $pageName;
}


function NumeroChambres() {
    $numChambres = array();
    
    // Remplir le tableau avec les numéros de chambres allant de 101 à 113
    for ($i = 101; $i <= 113; $i++) {
        $numChambres[] = (string)$i; // Ajouter chaque numéro de chambre comme chaîne de caractères
    }
    
    return $numChambres;
}

function ServicesChambres(){
    $servicesChambres = array(
        'Nuitée',
        "Sieste"
    );
    return $servicesChambres;
}

include("../database/connexion.php"); 


function get_all_users($connexion, $page = 1, $limit = 10) {
    // Calcul de l'offset
    $offset = ($page - 1) * $limit;

    // Requête SQL avec pagination
    $sql = "SELECT id, first_name, last_name, email, phone_number, role, status, created_at 
        FROM users 
        WHERE is_deleted = 0 
        AND role = 'admin' 
        ORDER BY created_at DESC 
        LIMIT :limit OFFSET :offset";

    $stmt = $connexion->prepare($sql);
    $stmt->bindValue(":limit", $limit, PDO::PARAM_INT);
    $stmt->bindValue(":offset", $offset, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$limit = 10; // Nombre d'utilisateurs par page

$users = get_all_users($connexion, $page, $limit);


function get_count_admins($connexion){
    $sql = "SELECT COUNT(*) AS total_admins FROM users WHERE is_deleted = 0 AND role = 'admin'";
    $stmt = $connexion->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC)['total_admins'];   
}
$total_admins = get_count_admins($connexion);


function get_all_motels($connexion){
    $sql = "SELECT * FROM motel WHERE is_deleted = False ORDER BY created_at DESC";
    $stmt = $connexion->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
$motels = get_all_motels($connexion);

function get_all_restaurant($connexion){
    $sql = "SELECT * FROM restaurant WHERE is_deleted = False ORDER BY created_at DESC";
    $stmt = $connexion->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
$restaurant = get_all_restaurant($connexion);


function get_count_clients($connexion){
    $sql = "SELECT COUNT(*) AS total_clients FROM clients";
    $stmt = $connexion->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC)['total_clients'];
}
$total_clients = get_count_clients($connexion);

// Fonction pour récupérer les réservations avec pagination
function get_reservation_by_motel_id($connexion, $motel_id, $limit, $offset) {
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
            c.first_name AS client_first_name, 
            c.last_name AS client_last_name, 
            u.first_name AS user_first_name,
            u.last_name AS user_last_name,
            r.id_motel  -- Utilisation de id_motel ici
        FROM 
            reservation_sieste r
        LEFT JOIN 
            clients c ON r.client_id = c.id 
        LEFT JOIN 
            users u ON r.added_by = u.id  -- Joindre la table users pour obtenir first_name et last_name
        WHERE 
            r.id_motel = :motel_id
        ORDER BY 
            r.created_at DESC
        LIMIT :limit OFFSET :offset
    ");
    $stmt->bindParam(':motel_id', $motel_id);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// Fonction pour récupérer le nombre total de réservations
function get_total_reservations($connexion, $motel_id) {
    $stmt = $connexion->prepare("
        SELECT COUNT(*) AS total 
        FROM reservation_sieste r
        WHERE r.id_motel = :motel_id
    ");
    $stmt->bindParam(':motel_id', $motel_id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}



// Fonction pour récupérer les réservations avec pagination
function get_reservation_nuitee_by_motel_id($connexion, $motel_id, $limit, $offset) {
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
            c.first_name AS client_first_name, 
            c.last_name AS client_last_name, 
            u.first_name AS user_first_name,
            u.last_name AS user_last_name,
            r.id_motel  -- Utilisation de id_motel ici
        FROM 
            reservation_nuitee r
        LEFT JOIN 
            clients c ON r.client_id = c.id 
        LEFT JOIN 
            users u ON r.added_by = u.id  -- Joindre la table users pour obtenir first_name et last_name
        WHERE 
            r.id_motel = :motel_id
        ORDER BY 
            r.created_at DESC
        LIMIT :limit OFFSET :offset
    ");
    $stmt->bindParam(':motel_id', $motel_id);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// Fonction pour récupérer le nombre total de réservations
function get_total_reservation_nuitee($connexion, $motel_id) {
    $stmt = $connexion->prepare("
        SELECT COUNT(*) AS total 
        FROM reservation_nuitee r
        WHERE r.id_motel = :motel_id
    ");
    $stmt->bindParam(':motel_id', $motel_id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}


function get_user_motel_assignments($connexion, $limit, $offset) {
    $stmt = $connexion->prepare("
        SELECT 
            um.id, 
            u.first_name AS user_first_name,
            u.last_name AS user_last_name,
            m.name AS motel_name, 
            um.created_at
        FROM 
            user_motel um
        LEFT JOIN 
            users u ON um.user_id = u.id
        LEFT JOIN 
            motel m ON um.motel_id = m.id
        ORDER BY 
            um.created_at DESC
        LIMIT :limit OFFSET :offset
    ");
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_total_user_motel_assignments($connexion) {
    $stmt = $connexion->prepare("SELECT COUNT(*) AS total FROM user_motel");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}
