<?php 
include("../database/connexion.php");
$erreur ="";
$success="";

if(isset($_POST['submit'])) {
    // Récupération des données du formulaire
    $id = $_GET["id"];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];
    $nationality = $_POST['nationality'];
    $property_type = $_POST['property_type'];
    $id_number = $_POST['id_number'];
    $residence_location = $_POST['residence_location'];
    $property_location = $_POST['property_location'];
    $details = $_POST['details'];

    // Validation ou toute logique nécessaire ici

    // Préparation de la requête de mise à jour
    $stmt = $connexion->prepare("UPDATE owner SET first_name = :first_name, last_name = :last_name, phone_number = :phone_number, nationality = :nationality, property_type = :property_type, id_number = :id_number, residence_location = :residence_location, property_location = :property_location, details = :details WHERE id = :id");

    // Exécution de la requête
    $result = $stmt->execute([
        'first_name' => $first_name,
        'last_name' => $last_name,
        'phone_number' => $phone_number,
        'nationality' => $nationality,
        'property_type' => $property_type,
        'id_number' => $id_number,
        'residence_location' => $residence_location,
        'property_location' => $property_location,
        'details' => $details,
        'id' => $id
    ]);

    // Vérification du succès de l'opération
    if ($result) {
        $success ="Les informations ont été mises à jour avec succès.";
    } else {
        $erreur ="Une erreur est survenue lors de la mise à jour.";
    }
}

    $stmt = $connexion->prepare("SELECT * FROM owner WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $resultat = $stmt->fetch();

?>
