<?php

include("../database/connexion.php");
include("../fonction/fonction.php");

$erreur = "";
$success = "";

if (isset($_POST['submit'])) {
    // Récupérer et sécuriser les champs
    $product_uuid = $_POST['product_uuid'] ?? '';
    $client_uuid = $_POST['client_uuid'] ?? '';
    $product_name = trim($_POST['product_name'] ?? '');
    $category = $_POST['category'] ?? '';
    $quantity = intval($_POST['quantity'] ?? 0);
    $price = floatval($_POST['price'] ?? 0);
    $weight = isset($_POST['weight']) && $_POST['weight'] !== '' ? floatval($_POST['weight']) : null;
    $declared_value = isset($_POST['declared_value']) && $_POST['declared_value'] !== '' ? floatval($_POST['declared_value']) : null;
    $description = trim($_POST['description'] ?? '');
    $added_by = $_SESSION['id'] ?? null;

    // Validation des champs obligatoires
    if (empty($product_uuid)) {
        $erreur = "Produit introuvable.";
    } elseif (empty($client_uuid)) {
        $erreur = "Le client est obligatoire.";
    } elseif (empty($product_name)) {
        $erreur = "Le nom du produit est obligatoire.";
    } elseif (empty($category)) {
        $erreur = "La catégorie est obligatoire.";
    } elseif ($quantity <= 0) {
        $erreur = "La quantité doit être supérieure à zéro.";
    } elseif ($price <= 0) {
        $erreur = "Le prix doit être supérieur à zéro.";
    }

    if ($erreur === "") {
        // Gestion image uploadée (optionnelle)
        $product_image_path = null;

        if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
            $upload_dir = '../uploads/products/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            $tmp_name = $_FILES['product_image']['tmp_name'];
            $ext = pathinfo($_FILES['product_image']['name'], PATHINFO_EXTENSION);
            $filename = generateUUID() . '.' . $ext;

            $destination = $upload_dir . $filename;

            if (move_uploaded_file($tmp_name, $destination)) {
                $product_image_path = $filename;
            }
        }

        // Préparation de la requête UPDATE
        // Si une nouvelle image est uploadée, on met à jour le champ product_image, sinon on garde l'ancien
        if ($product_image_path) {
            $sql = "UPDATE client_products SET
                        product_name = :product_name,
                        category = :category,
                        quantity = :quantity,
                        price = :price,
                        weight = :weight,
                        declared_value = :declared_value,
                        description = :description,
                        product_image = :product_image,
                        added_by = :added_by
                    WHERE uuid = :product_uuid";
        } else {
            $sql = "UPDATE client_products SET
                        product_name = :product_name,
                        category = :category,
                        quantity = :quantity,
                        price = :price,
                        weight = :weight,
                        declared_value = :declared_value,
                        description = :description,
                        added_by = :added_by
                    WHERE uuid = :product_uuid";
        }

        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':product_name', $product_name);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':weight', $weight);
        $stmt->bindParam(':declared_value', $declared_value);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':added_by', $added_by, PDO::PARAM_STR);
        $stmt->bindParam(':product_uuid', $product_uuid);

        if ($product_image_path) {
            $stmt->bindParam(':product_image', $product_image_path);
        }

        try {
            $stmt->execute();

            // Mise à jour du stock total du client
            $sql_stock = "UPDATE clients_abonnes 
                          SET stock_total = (
                            SELECT COALESCE(SUM(quantity), 0) FROM client_products WHERE client_uuid = :client_uuid AND is_deleted = 0
                          )
                          WHERE uuid = :client_uuid";

            $stmt_stock = $connexion->prepare($sql_stock);
            $stmt_stock->execute(['client_uuid' => $client_uuid]);

            $success = "Produit mis à jour avec succès.";
            echo "<script>setTimeout(function() { window.location.href='liste_produits_clients.php'; }, 3000);</script>";
        } catch (PDOException $e) {
            $erreur = "Erreur lors de la mise à jour du produit : " . $e->getMessage();
        }
    }
}
