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
    $cni = $_POST["cni"] ?? null;  // CNI number
    $property_location = $_POST["property_location"] ?? null;
    $residence_location = $_POST["residence_location"] ?? null;
    $details = $_POST["details"] ?? null;

    if ($first_name && $last_name && $phone_number && $nationality && $property_type && $cni && $property_location && $residence_location && $details) {
        try {
            // Vérification si le numéro de téléphone existe déjà dans la base de données
            $sql_check_phone = "SELECT COUNT(*) FROM owner WHERE phone_number = :phone_number AND is_deleted = 1";
            $stmt_check_phone = $connexion->prepare($sql_check_phone);
            $stmt_check_phone->execute([':phone_number' => $phone_number]);
            $phone_exists = $stmt_check_phone->fetchColumn();

            // Vérification si le numéro de CNI existe déjà dans la base de données
            $sql_check_cni = "SELECT COUNT(*) FROM owner WHERE id_number = :id_number AND is_deleted = 1";
            $stmt_check_cni = $connexion->prepare($sql_check_cni);
            $stmt_check_cni->execute([':id_number' => $cni]);
            $cni_exists = $stmt_check_cni->fetchColumn();

            // Si le numéro de téléphone ou le numéro de CNI existe déjà
            if ($phone_exists > 0) {
                $erreur = "Ce numéro de téléphone est déjà utilisé par un autre propriétaire.";
            } elseif ($cni_exists > 0) {
                $erreur = "Ce numéro de CNI est déjà utilisé par un autre propriétaire.";
            } else {
                // Si les deux sont valides, procéder à l'insertion
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
            }
        } catch (PDOException $e) {
            $erreur = "Erreur lors de l'enregistrement : " . $e->getMessage();
        }
    } else {
        $erreur = "Tous les champs sont obligatoires.";
    }
}
?>
