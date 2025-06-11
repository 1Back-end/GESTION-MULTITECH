<?php

include("../database/connexion.php"); // ta connexion PDO
include("../fonction/fonction.php"); // ta fonction pour générer UUID

$erreur = "";
$success = "";

if (isset($_POST['submit'])) {
    // Récupérer et sécuriser les champs
    $client_uuid = $_POST['client_uuid'] ?? '';
    $product_name = trim($_POST['product_name'] ?? '');
    $category = $_POST['category'] ?? '';
    $quantity = intval($_POST['quantity'] ?? 0);
    $price = floatval($_POST['price'] ?? 0);
    $weight = isset($_POST['weight']) && $_POST['weight'] !== '' ? floatval($_POST['weight']) : null;
    $declared_value = isset($_POST['declared_value']) && $_POST['declared_value'] !== '' ? floatval($_POST['declared_value']) : null;
    $description = trim($_POST['description'] ?? '');
    $added_by = $_SESSION['id'] ?? null;
    $ref = generate_products_code();

    // Validation des champs obligatoires
    if (empty($client_uuid)) {
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
            $upload_dir = '../uploads/products/'; // dossier serveur pour déplacer l'image
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            $tmp_name = $_FILES['product_image']['tmp_name'];
            $ext = pathinfo($_FILES['product_image']['name'], PATHINFO_EXTENSION);
            $filename = generateUUID() . '.' . $ext;  // Assure-toi que ta fonction s'appelle bien generateUUID()

            $destination = $upload_dir . $filename;

            if (move_uploaded_file($tmp_name, $destination)) {
                // On stocke ici le chemin relatif **sans** ../ pour la base de données et affichage côté client
                $product_image_path = $filename;
            }
        }

        // Insertion en base du produit
        $product_uuid = generateUUID();
        $created_at = date('Y-m-d H:i:s');

        $sql = "INSERT INTO client_products 
                (uuid,ref, client_uuid, product_name, category, quantity, price, weight, declared_value, description, product_image, created_at,added_by)
                VALUES
                (:uuid,:ref, :client_uuid, :product_name, :category, :quantity, :price, :weight, :declared_value, :description, :product_image, :created_at, :added_by)";

        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':uuid', $product_uuid);
        $stmt->bindParam(':ref', $ref);
        $stmt->bindParam(':client_uuid', $client_uuid);
        $stmt->bindParam(':product_name', $product_name);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':weight', $weight);
        $stmt->bindParam(':declared_value', $declared_value);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':product_image', $product_image_path);
        $stmt->bindParam(':created_at', $created_at);
        $stmt->bindParam(':added_by', $added_by, PDO::PARAM_STR);

        try {
            $connexion->beginTransaction();
            $stmt->execute();

            // Mise à jour du stock total du client (somme des quantités)
            $sql_stock = "UPDATE clients_abonnes 
                          SET stock_total = (
                            SELECT COALESCE(SUM(quantity), 0) FROM client_products WHERE client_uuid = :client_uuid
                          )
                          WHERE uuid = :client_uuid";

            $stmt_stock = $connexion->prepare($sql_stock);
            $stmt_stock->execute(['client_uuid' => $client_uuid]);

            $connexion->commit();

            $success = "Produit ajouté avec succès.";
            echo "<script>setTimeout(function() { window.location.href='liste_produits_clients.php'; }, 3000);</script>";
        } catch (PDOException $e) {
            $connexion->rollBack();
            $erreur = "Erreur lors de l'enregistrement du produit : " . $e->getMessage();
        }
    }

}
