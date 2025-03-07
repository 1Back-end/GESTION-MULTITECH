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

function tousLesMois() {
    return [
        "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", 
        "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"
    ];
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
            u.id AS user_id,
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

function get_user_restaurant_assignments($connexion, $limit, $offset) {
    $stmt = $connexion->prepare("
        SELECT 
            um.id, 
            u.first_name AS user_first_name,
            u.last_name AS user_last_name,
            u.id AS user_id,
            m.name AS restaurant_name, 
            um.created_at
        FROM 
            user_restaurant um
        LEFT JOIN 
            users u ON um.user_id = u.id
        LEFT JOIN 
            restaurant m ON um.restaurant_id = m.id
        ORDER BY 
            um.created_at DESC
        LIMIT :limit OFFSET :offset
    ");
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_total_user_restaurant_assignments($connexion) {
    $stmt = $connexion->prepare("SELECT COUNT(*) AS total FROM user_restaurant");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

// Récupérer le total des clients
function get_total_clients($connexion) {
    $stmt = $connexion->prepare("SELECT COUNT(*) AS total FROM clients WHERE is_deleted=0");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

function get_total_motels($connexion){
    $stmt = $connexion->prepare("SELECT COUNT(*) AS total FROM motel WHERE is_deleted=0");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}
$total_motels = get_total_motels($connexion);


function get_total_restaurants($connexion){
    $stmt = $connexion->prepare("SELECT COUNT(*) AS total FROM restaurant WHERE is_deleted=0");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}
$total_restaurants = get_total_restaurants($connexion);


function get_count_clients($connexion){
    $sql = "SELECT COUNT(*) AS total_clients FROM clients WHERE is_deleted = 0";
    $stmt = $connexion->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC)['total_clients'];
}

$total_clients = get_count_clients($connexion);


function get_restaurant($connexion){
    $sql = "SELECT * FROM restaurant WHERE is_deleted = False ORDER BY created_at DESC";
    $stmt = $connexion->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
$restaurants = get_all_restaurant($connexion);

function get_vente_by_added_by_and_restaurant_id($connexion, $user_id, $limit, $offset, $date_filter = null, $month_filter = null,$keyword_filter=null) {
    $sql = "
        SELECT v.*, u.first_name, u.last_name, r.name AS restaurant_name
        FROM reservation_menu v
        JOIN users u ON v.added_by = u.id
        JOIN restaurant r ON v.restaurant_id = r.id
        WHERE v.added_by = :user_id
    ";

    // Ajouter des conditions de filtre pour la date ou le mois
    if ($date_filter) {
        $sql .= " AND DATE(v.created_at) = :date_filter";
    }
    if($keyword_filter){
        $sql.= " AND (v.name LIKE :keyword_filter OR v.type LIKE :keyword_filter)";
    }

    if ($month_filter) {
        $sql .= " AND MONTH(v.created_at) = :month_filter";
    }

    $sql .= " ORDER BY v.created_at DESC LIMIT :limit OFFSET :offset";

    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

    // Lier les paramètres de filtre
    if ($date_filter) {
        $stmt->bindParam(':date_filter', $date_filter, PDO::PARAM_STR);
    }

    if ($month_filter) {
        $stmt->bindParam(':month_filter', $month_filter, PDO::PARAM_INT);
    }
    if ($keyword_filter) {
        $stmt->bindValue(':keyword_filter', '%'.$keyword_filter.'%', PDO::PARAM_STR);
    }
    

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function count_total_ventes($connexion, $user_id, $date_filter = null, $month_filter = null, $keyword = null) {
    $sql = "SELECT COUNT(*) FROM reservation_menu v WHERE v.added_by = :user_id";

    if ($date_filter) {
        $sql .= " AND DATE(v.created_at) = :date_filter";
    }

    if ($month_filter) {
        $sql .= " AND MONTH(v.created_at) = :month_filter";
    }

    if ($keyword) {
        $sql .= " AND (v.name LIKE :keyword OR v.type LIKE :keyword)";
    }

    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

    if ($date_filter) {
        $stmt->bindParam(':date_filter', $date_filter, PDO::PARAM_STR);
    }

    if ($month_filter) {
        $stmt->bindParam(':month_filter', $month_filter, PDO::PARAM_INT);
    }

    if ($keyword) {
        $stmt->bindValue(':keyword', '%'.$keyword.'%', PDO::PARAM_STR);
    }
    

    $stmt->execute();
    return $stmt->fetchColumn(); // Retourne le nombre total d'enregistrements
}
function get_total_revenue($connexion, $user_id, $date_filter = null, $month_filter = null, $keyword = null) {
    $sql = "SELECT SUM(v.quantity * v.price) as total_revenue FROM reservation_menu v WHERE v.added_by = :user_id";

    if ($date_filter) {
        $sql .= " AND DATE(v.created_at) = :date_filter";
    }

    if ($month_filter) {
        $sql .= " AND MONTH(v.created_at) = :month_filter";
    }

    if ($keyword) {
        $sql .= " AND (v.name LIKE :keyword OR v.type LIKE :keyword)";
    }

    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

    if ($date_filter) {
        $stmt->bindParam(':date_filter', $date_filter, PDO::PARAM_STR);
    }

    if ($month_filter) {
        $stmt->bindParam(':month_filter', $month_filter, PDO::PARAM_INT);
    }

    if ($keyword) {
        $stmt->bindValue(':keyword', '%'.$keyword.'%', PDO::PARAM_STR);
    }

    $stmt->execute();
    return $stmt->fetchColumn() ?: 0; // Retourne 0 si NULL
}
// Fonction pour récupérer les réservations avec filtres de recherche
function get_reservation_sieste_by_added_by($connexion, $user_id, $limit, $offset, $keyword = null, $date = null, $mois = null) {
    $query = "
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
            r.mois,
            r.client_id, 
            c.first_name, 
            c.last_name
        FROM 
            reservation_sieste r
        JOIN 
            clients c ON r.client_id = c.id 
        WHERE 
            r.added_by = :user_id
    ";

    // Ajoutez les filtres si des valeurs sont passées
    if ($keyword) {
        $query .= " AND (r.type_chambre LIKE :keyword OR r.type_service LIKE :keyword OR c.first_name LIKE :keyword OR c.last_name LIKE :keyword)";
    }

    if ($date) {
        $query .= " AND r.date_entre = :date";
    }

    if ($mois) {
        $query .= " AND r.mois = :mois";
    }

    // Ajoutez les ordres et les limites de pagination
    $query .= " ORDER BY r.created_at DESC LIMIT :limit OFFSET :offset";

    $stmt = $connexion->prepare($query);
    
    // Lier les paramètres
    $stmt->bindParam(':user_id', $user_id);
    if ($keyword) {
        $stmt->bindValue(':keyword', "%" . $keyword . "%", PDO::PARAM_STR);
    }
    if ($date) {
        $stmt->bindParam(':date', $date);
    }
    if ($mois) {
        $stmt->bindParam(':mois', $mois);
    }
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// Fonction pour obtenir le nombre total de réservations avec filtres
function get_total_reservations_sieste($connexion, $user_id, $keyword = null, $date = null, $mois = null) {
    $query = "SELECT COUNT(*) AS total FROM reservation_sieste r WHERE r.added_by = :user_id";

    if ($keyword) {
        $query .= " AND (r.type_chambre LIKE :keyword OR r.type_service LIKE :keyword OR c.first_name LIKE :keyword OR c.last_name LIKE :keyword)";
    }

    if ($date) {
        $query .= " AND r.date_entre = :date";
    }

    if ($mois) {
        $query .= " AND r.mois = :mois";
    }

    $stmt = $connexion->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    if ($keyword) {
        $stmt->bindValue(':keyword', "%" . $keyword . "%", PDO::PARAM_STR);
    }
    if ($date) {
        $stmt->bindParam(':date', $date);
    }
    if ($mois) {
        $stmt->bindParam(':mois', $mois);
    }

    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}





// Fonction pour récupérer les réservations avec filtres de recherche
function get_reservation_nuitee_by_added_by($connexion, $user_id, $limit, $offset, $keyword = null, $date = null, $mois = null) {
    $query = "
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
            r.mois,
            r.client_id, 
            c.first_name, 
            c.last_name
        FROM 
            reservation_nuitee r
        JOIN 
            clients c ON r.client_id = c.id 
        WHERE 
            r.added_by = :user_id
    ";

    // Ajoutez les filtres si des valeurs sont passées
    if ($keyword) {
        $query .= " AND (r.type_chambre LIKE :keyword OR r.type_service LIKE :keyword OR c.first_name LIKE :keyword OR c.last_name LIKE :keyword)";
    }

    if ($date) {
        $query .= " AND r.date_entre = :date";
    }

    if ($mois) {
        $query .= " AND r.mois = :mois";
    }

    // Ajoutez les ordres et les limites de pagination
    $query .= " ORDER BY r.created_at DESC LIMIT :limit OFFSET :offset";

    $stmt = $connexion->prepare($query);
    
    // Lier les paramètres
    $stmt->bindParam(':user_id', $user_id);
    if ($keyword) {
        $stmt->bindValue(':keyword', "%" . $keyword . "%", PDO::PARAM_STR);
    }
    if ($date) {
        $stmt->bindParam(':date', $date);
    }
    if ($mois) {
        $stmt->bindParam(':mois', $mois);
    }
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// Fonction pour obtenir le nombre total de réservations avec filtres
function get_total_reservations_nuitee($connexion, $user_id, $keyword = null, $date = null, $mois = null) {
    $query = "SELECT COUNT(*) AS total FROM reservation_nuitee r WHERE r.added_by = :user_id";

    if ($keyword) {
        $query .= " AND (r.type_chambre LIKE :keyword OR r.type_service LIKE :keyword OR c.first_name LIKE :keyword OR c.last_name LIKE :keyword)";
    }

    if ($date) {
        $query .= " AND r.date_entre = :date";
    }

    if ($mois) {
        $query .= " AND r.mois = :mois";
    }

    $stmt = $connexion->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    if ($keyword) {
        $stmt->bindValue(':keyword', "%" . $keyword . "%", PDO::PARAM_STR);
    }
    if ($date) {
        $stmt->bindParam(':date', $date);
    }
    if ($mois) {
        $stmt->bindParam(':mois', $mois);
    }

    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}


function get_clients($connexion, $limit, $offset) {
    $stmt = $connexion->prepare("
        SELECT 
            c.id, 
            c.first_name, 
            c.last_name, 
            c.address, 
            c.phone, 
            c.created_at,
            u.first_name AS added_by_first_name,
            u.last_name AS added_by_last_name,
            m.name AS motel_name
        FROM clients c
        LEFT JOIN users u ON c.added_by = u.id
        LEFT JOIN motel m ON c.motel_id = m.id
        WHERE c.is_deleted = 0
        LIMIT :limit OFFSET :offset
    ");
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_total_clients_motel($connexion) {
    $stmt = $connexion->prepare("
        SELECT COUNT(*) AS total 
        FROM clients 
        WHERE is_deleted = 0
    ");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

function type_location(){
    $typesLocations = array(
        'Duplex',
        'Immeubles',
        'Villa',
        'Studio',
        'Camp',
        'Chambres',
        'Appartements'

    );
    return $typesLocations;
}
$typesLocations = type_location();

function get_all_owners($connexion, $page = 1, $limit = 10) {
    $offset = ($page - 1) * $limit; // Calcul du décalage

    $stmt = $connexion->prepare("
        SELECT * FROM owner WHERE is_deleted = False 
        LIMIT :limit OFFSET :offset
    ");
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Récupérer le nombre total de propriétaires pour la pagination
function count_owners($connexion) {
    $stmt = $connexion->query("SELECT COUNT(*) as total FROM owner WHERE is_deleted = False");
    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}

function get_tenants($connexion, $limit, $offset) {
    try {
        $stmt = $connexion->prepare("
            SELECT 
                t.id, 
                t.first_name, 
                t.last_name, 
                t.num_cni AS id_number,  -- Correspondance avec 'id_number' dans ta table
                t.phone, 
                t.address, 
                t.added_by, 
                t.created_at,
                t.property_type,
                o.first_name AS owner_first_name, 
                o.last_name AS owner_last_name
            FROM tenants t
            LEFT JOIN owner o ON t.owner_id = o.id
            WHERE t.is_deleted = 0
            LIMIT :limit OFFSET :offset
        ");

        // Vérification que limit et offset sont bien des entiers
        $limit = (int) $limit;
        $offset = (int) $offset;

        // Bind des valeurs pour LIMIT et OFFSET
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erreur SQL dans get_tenants : " . $e->getMessage());
    }
}



function get_total_tenants($connexion) {
    try {
        $stmt = $connexion->prepare("
            SELECT COUNT(*) AS total 
            FROM tenants 
            WHERE is_deleted = 0
        ");

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    } catch (PDOException $e) {
        die("Erreur SQL dans get_total_tenants : " . $e->getMessage());
    }
}


function get_all_info_immo($connexion) {
    $stmt = $connexion->prepare("SELECT id FROM immo LIMIT 1");
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC); // Récupère un seul enregistrement
}
// Appel de la fonction
$info_immo = get_all_info_immo($connexion);
// Vérification si un résultat est trouvé
$info_immo_id = $info_immo["id"];
