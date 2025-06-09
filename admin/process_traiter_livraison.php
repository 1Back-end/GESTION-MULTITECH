<?php
include("../database/connexion.php");
$erreur = '';
$success = '';

if (isset($_POST['submit'])) {

    $uuid = generateUUID();
    $reference = generate_livraison_reference();
    $product_uuid = $_POST["product_uuid"] ?? null;
    $recipient_name = $_POST["recipient_name"];
    $phone = $_POST["phone"];
    $delivery_price = $_POST["delivery_price"];
    $quantity = $_POST["quantity"];
    $location = $_POST["location"];
    $is_home_delivery = isset($_POST["is_home_delivery"]) ? 1 : 0;
    $delivery_man_id = $_POST["delivery_man"];
    $added_by = $_SESSION['id'] ?? null;


    try {
        $connexion->beginTransaction();

        // Récupérer le client_uuid depuis client_products
        $stmt = $connexion->prepare("SELECT client_uuid, quantity FROM client_products WHERE uuid = :uuid AND is_deleted = 0");
        $stmt->execute(['uuid' => $product_uuid]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            $erreur = "Produit non trouvé.";
        }

        $client_uuid = $product['client_uuid'];
        $stock_actuel = (int)$product['quantity'];

        // Vérifier si la quantité demandée est disponible
        if ($quantity > $stock_actuel) {
           $erreur = "Quantité demandée supérieure au stock disponible.";
        }

        // 1. Enregistrer la livraison
        $sql = "INSERT INTO livraisons_products (
                    uuid, reference, product_uuid, recipient_name, phone, delivery_price, 
                    quantity, location, is_home_delivery, delivery_man_id, added_by
                ) VALUES (
                    :uuid, :reference, :product_uuid, :recipient_name, :phone, :delivery_price,
                    :quantity, :location, :is_home_delivery, :delivery_man_id, :added_by
                )";

        $stmt = $connexion->prepare($sql);
        $stmt->execute([
            'uuid' => $uuid,
            'reference' => $reference,
            'product_uuid' => $product_uuid,
            'recipient_name' => $recipient_name,
            'phone' => $phone,
            'delivery_price' => $delivery_price,
            'quantity' => $quantity,
            'location' => $location,
            'is_home_delivery' => $is_home_delivery,
            'delivery_man_id' => $delivery_man_id,
            'added_by' => $added_by
        ]);

        // 2. Diminuer la quantité dans client_products
        $stmt = $connexion->prepare("UPDATE client_products SET quantity = quantity - :qty WHERE uuid = :uuid");
        $stmt->execute([
            'qty' => $quantity,
            'uuid' => $product_uuid
        ]);

        // 3. Mettre à jour le stock total du client
        $sql_stock = "UPDATE clients_abonnes 
                      SET stock_total = (
                        SELECT COALESCE(SUM(quantity), 0) 
                        FROM client_products 
                        WHERE client_uuid = :client_uuid AND is_deleted = 0
                      )
                      WHERE uuid = :client_uuid";

        $stmt_stock = $connexion->prepare($sql_stock);
        $stmt_stock->execute(['client_uuid' => $client_uuid]);

        $connexion->commit();

        $success = "Livraison traitée avec succès.";

    } catch (Exception $e) {
        $connexion->rollBack();
        $erreur = "Erreur : " . $e->getMessage();
    }
}
?>
