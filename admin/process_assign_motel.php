<?php
include("../database/connexion.php");

$erreur = "";
$success = "";

if (isset($_POST["assign_motel"])) {
    $user_id = $_POST["user_id"] ?? null;
    $motel_id = $_POST["motel_id"] ?? null;
    $id = generateUUID();


    try {
        // Vérifier si l'utilisateur a déjà un motel
        $stmt = $connexion->prepare("SELECT COUNT(*) FROM user_motel WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        $exists = $stmt->fetchColumn();

        if ($exists) {
            $erreur = "Cet utilisateur est déjà affecté à un motel.";
        } else {
            // Insérer l'affectation
            $stmt = $connexion->prepare("INSERT INTO user_motel (id, user_id, motel_id) VALUES (:id, :user_id, :motel_id)");
            $stmt->execute([
                'id' => $id,
                'user_id' => $user_id,
                'motel_id' => $motel_id
            ]);

            $success = "Affectation réussie !";
        }
    } catch (PDOException $e) {
        $erreur = "Erreur : " . $e->getMessage();
    }
}
?>
