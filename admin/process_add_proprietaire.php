<?php
include("../database/connexion.php");
include("../fonction/fonction.php");

$erreur = "";
$success = "";

if (isset($_POST["submit"])) {
    $id = generateUUID();
    $first_name = $_POST["first_name"] ?? null;
    $last_name = $_POST["last_name"] ?? null;
    $phone_number = $_POST["phone_number"] ?? null;
    $nationality = $_POST["nationality"] ?? null;
    $property_type = $_POST["property_type"] ?? null;
    $cni = $_POST["cni"] ?? null;
    $property_location = $_POST["property_location"] ?? null;
    $residence_location = $_POST["residence_location"] ?? null;
    $details = $_POST["details"] ?? null;

    if ($first_name && $last_name && $phone_number && $nationality && $property_type && $cni && $property_location && $residence_location && $details) {
        try {
            $sql = "INSERT INTO owner (id, last_name, first_name, phone_number, id_number, residence_location, nationality, property_location, property_type, details) 
                    VALUES (:id, :last_name, :first_name, :phone_number, :id_number, :residence_location, :nationality, :property_location, :property_type, :details)";
            
            $stmt = $connexion->prepare($sql);
            $stmt->execute([
                ':id' => $id,
                ':last_name' => $last_name,
                ':first_name' => $first_name,
                ':phone_number' => $phone_number,
                ':id_number' => $cni,
                ':residence_location' => $residence_location,
                ':nationality' => $nationality,
                ':property_location' => $property_location,
                ':property_type' => $property_type,
                ':details' => $details
            ]);

            $success = "Propriétaire enregistré avec succès !";
        } catch (PDOException $e) {
            $erreur = "Erreur lors de l'enregistrement : " . $e->getMessage();
        }
    } else {
        $erreur = "Tous les champs sont obligatoires.";
    }
}

?>
