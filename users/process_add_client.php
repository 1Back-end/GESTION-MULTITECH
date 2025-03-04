<?php
include("../database/connexion.php");
include("fonction.php");

$erreur = "";
$success = "";

if (isset($_POST["submit"])) {
    // Récupérer les données du formulaire
    $first_name = $_POST["first_name"] ?? null;
    $last_name = $_POST["last_name"] ?? null;
    $cni = $_POST["cni"] ?? null;
    $phone = $_POST["phone"] ?? null;
    $address = $_POST["address"] ?? null;
    $id = generateUUID(); // Générer un nouvel ID unique
    $user_id = $_SESSION['id'] ?? null;
    $motel_id = $motel_data['id'] ?? null;  // ID du motel (si disponible)

    // Vérifier si le client existe déjà avec le même numéro CNI
    $stmt = $connexion->prepare("SELECT id FROM clients WHERE num_cni = :cni");
    $stmt->execute(['cni' => $cni]);
    $existing_client = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existing_client) {
        // Si un client avec ce CNI existe déjà, afficher une erreur
        $erreur = "Ce client existe déjà avec ce numéro CNI.";
    } else {
        // Si le client n'existe pas, procéder à l'insertion
        try {
            $stmt = $connexion->prepare("INSERT INTO clients (id, first_name, last_name, num_cni, phone, address, added_by, motel_id) 
                                        VALUES (:id, :first_name, :last_name, :num_cni, :phone, :address, :added_by, :motel_id)");
            $stmt->execute([
                'id' => $id,
                'first_name' => $first_name,  // Nom de famille
                'last_name' => $last_name,    // Prénom
                'num_cni' => $cni,
                'phone' => $phone,
                'address' => $address,
                'added_by' => $user_id,
                'motel_id' => $motel_id
            ]);
            $success = "Client ajouté avec succès!";
        } catch (Exception $e) {
            $erreur = "Erreur lors de l'enregistrement : " . $e->getMessage();
        }
    }
}
?>
