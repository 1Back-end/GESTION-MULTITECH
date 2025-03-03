<?php
include("../database/connexion.php");

$erreur = "";
$success = "";

if (isset($_POST["submit"])) {
    $user_id = $_POST["user_id"] ?? null;
    $restaurant_id = $_POST["restaurant_id"] ?? null;
    $id = generateUUID();


    try {
        // Vérifier si l'utilisateur a déjà un motel
        $stmt = $connexion->prepare("SELECT COUNT(*) FROM user_restaurant WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        $exists = $stmt->fetchColumn();

        if ($exists) {
            $erreur = "Cet utilisateur est déjà affecté à un restaurant.";
        } else {
            // Insérer l'affectation
            $stmt = $connexion->prepare("INSERT INTO user_restaurant (id, user_id, restaurant_id) VALUES (:id, :user_id, :restaurant_id)");
            $stmt->execute([
                'id' => $id,
                'user_id' => $user_id,
                'restaurant_id' => $restaurant_id
            ]);

            $success = "Affectation réussie !";
        }
    } catch (PDOException $e) {
        $erreur = "Erreur : " . $e->getMessage();
    }
}
?>
