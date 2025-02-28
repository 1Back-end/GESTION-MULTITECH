<?php
include("../database/connexion.php"); 
include("../fonction/fonction.php");

if (isset($_GET["id"])) {
    $id_user = $_GET["id"];

    try {
        // Préparer et exécuter la requête pour mettre à jour le statut de l'utilisateur
        $stmt = $connexion->prepare("UPDATE users SET status = 'active' WHERE id = :id");
        $stmt->bindParam(':id', $id_user);
        $stmt->execute();

        // Vérifier si le statut a été mis à jour avec succès
        if ($stmt->rowCount() > 0) {
            // Redirection avec message de succès
            header("Location: utilisateurs.php?msg=Utilisateur activé avec succès");
            exit();
        } else {
            // Cas où aucun utilisateur n'a été trouvé pour cet ID
            header("Location: utilisateurs.php?msg=Aucun utilisateur trouvé avec cet ID");
            exit();
        }
    } catch (Exception $e) {
        // Gestion d'une exception si une erreur se produit
        header("Location: utilisateurs.php?msg=Erreur lors de la mise à jour: " . $e->getMessage());
        exit();
    }
} else {
    // Cas où l'ID est manquant dans l'URL
    header("Location: utilisateurs.php?msg=ID utilisateur manquant");
    exit();
}
?>
