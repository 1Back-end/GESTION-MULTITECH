<?php
include("../database/connexion.php");
$erreur ="";
$success ="";

// Si le formulaire est soumis
if (isset($_POST["submit"])) {
    // Récupération des données du formulaire
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $description = $_POST["description"];
    $id = $_GET["id"]; // Récupération de l'ID du motel depuis l'URL

    // Validation des données (par exemple, on vérifie que le nom est unique)
    $stmt = $connexion->prepare("SELECT COUNT(*) FROM restaurant WHERE name = :name AND id != :id");
    $stmt->execute(['name' => $name, 'id' => $id]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        $erreur = "Ce nom de restaurant existe déjà.";
    } else {
        // Mise à jour dans la base de données
        $sql = "UPDATE restaurant SET name = :name, contact_email = :email, contact_phone = :phone, address = :address, description = :description, updated_at = CURRENT_TIMESTAMP WHERE id = :id";
        $stmt = $connexion->prepare($sql);
        
        // Exécution de la requête
        $stmt->execute([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'description' => $description,
            'id' => $id
        ]);

        // Message de succès
        $success = "Les informations ont été mises à jour avec succès.";
    }
}
$id = $_GET["id"];
$stmt = $connexion->prepare("SELECT * FROM restaurant WHERE id = :id");
$stmt->execute(['id' => $id]);
$resultat = $stmt->fetch();

?>
