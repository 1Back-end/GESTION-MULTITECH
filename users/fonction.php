<?php
include("../database/connexion.php");

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

?>
