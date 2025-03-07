<?php
include("../database/connexion.php");
include("fonction.php");

$erreur = "";
$success = "";
if (isset($_POST["submit"])) {
    // Récupérer les données du formulaire
    $first_name = $_POST["first_name"] ?? null;
    $last_name = $_POST["last_name"] ?? null;
    $num_cni = $_POST["num_cni"] ?? null;
    $phone = $_POST["phone"] ?? null;
    $address = $_POST["address"] ?? null;
    $price = $_POST["price"] ?? null;
    $property_type = $_POST["property_type"] ?? null;


    $id = generateUUID(); // Générer un nouvel ID unique pour le locataire
    $user_id = $_SESSION['id'] ?? null;  // ID de l'utilisateur qui ajoute le locataire
    $owner_id = $_POST["owner_id"];  // ID du propriétaire (si disponible)

    // Vérifier si le locataire existe déjà avec le même numéro CNI
    $stmt = $connexion->prepare("SELECT id FROM tenants WHERE num_cni = :num_cni");
    $stmt->execute(['num_cni' => $num_cni]);
    $existing_tenant = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existing_tenant) {
        // Si un locataire avec ce CNI existe déjà, afficher une erreur
        $erreur = "Ce locataire existe déjà avec ce numéro CNI.";
    } else {
        // Si le locataire n'existe pas, procéder à l'insertion
        try {
            $stmt = $connexion->prepare("INSERT INTO tenants (id, first_name, last_name, num_cni, phone, address, price, added_by, owner_id, created_at, property_type, is_deleted) 
                                        VALUES (:id, :first_name, :last_name, :num_cni, :phone, :address, :price, :added_by, :owner_id, NOW(), :property_type, 0)");
            $stmt->execute([
                'id' => $id,
                'first_name' => $first_name,  // Prénom
                'last_name' => $last_name,    // Nom de famille
                'num_cni' => $num_cni,
                'phone' => $phone,
                'address' => $address,
                'price' => $price,
                'added_by' => $user_id,
                'owner_id' => $owner_id,
                'property_type' => $property_type
            ]);
            $success = "Locataire ajouté avec succès!";
        } catch (Exception $e) {
            $erreur = "Erreur lors de l'enregistrement : " . $e->getMessage();
        }
    }
}

?>
