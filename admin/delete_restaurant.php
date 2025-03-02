<?php
include("../database/connexion.php"); 


if (isset($_GET["id"])) {
    $id_restaurant = $_GET["id"];

    try {
        // Préparer et exécuter la requête de mise à jour
        $stmt = $connexion->prepare("UPDATE restaurant SET is_deleted = 1 WHERE id = :id");
        $stmt->bindParam(':id', $id_restaurant);
        $stmt->execute();

        // Vérifier si l'utilisateur a été supprimé avec succès
        if ($stmt->rowCount() > 0) {
            header("Location: liste_restaurant.php?msg=restaurant supprimé avec succès");
            exit();
        } else {
            // Cas où l'utilisateur n'a pas été trouvé ou n'a pas été supprimé
            header("Location: liste_restaurant.php?msg=Erreur lors de la suppression");
            exit();
        }
    } catch (Exception $e) {
        // Si une erreur se produit lors de l'exécution de la requête
        header("Location: liste_restaurant.php?msg=Erreur lors de la suppression: " . $e->getMessage());
        exit();
    }
} else {
    // Si l'id n'est pas fourni dans l'URL
    header("Location: utilisateurs.php?msg=ID restaurant manquant");
    exit();
}
?>
