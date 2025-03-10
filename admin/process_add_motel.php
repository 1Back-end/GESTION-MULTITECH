<?php
include("../database/connexion.php");
include("../fonction/fonction.php");
include("../config/config_smtp.php");

$erreur = "";
$success = "";

if (isset($_POST["submit"])) {
    $name = $_POST["name"] ?? null;
    $email = $_POST["email"] ?? null;
    $phone = $_POST["phone"] ?? null;
    $address = $_POST["address"] ?? null;
    $description = $_POST["description"] ?? null;

    // Générer un UUID unique pour le motel
    $id = generateUUID();

    // Vérification si le motel avec le même nom existe déjà
    $query = "SELECT COUNT(*) FROM motel WHERE name = ? AND is_deleted = 1";
    $stmt = $connexion->prepare($query);
    $stmt->execute([$name]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        // Si un motel avec le même nom existe déjà, afficher une erreur
        $erreur = "Un motel avec ce nom existe déjà.";
    } else {
        // Si le nom est unique, procéder à l'insertion
        try {
            $query = "INSERT INTO motel (id, name, address, contact_email, contact_phone, description) 
                      VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $connexion->prepare($query);
            $stmt->execute([$id, $name, $address, $email, $phone, $description]);

            // Si l'insertion réussie, afficher un message de succès
            $success = "Le motel a été enregistré avec succès.";
        } catch (PDOException $e) {
            // Si une erreur survient pendant l'insertion
            $erreur = "Erreur lors de l'enregistrement du motel: " . $e->getMessage();
        }
    }
}
?>
