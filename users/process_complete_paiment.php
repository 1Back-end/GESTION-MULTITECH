<?php
include("../database/connexion.php");

$erreur = "";
$success = "";

if (isset($_POST["submit"])) {
    $montant = $_POST["montant"];
    $id_paiment = $_POST["id_paiment"];

    // Step 1: Get tenant_id from the payment table using the payment id (id_paiment)
    $sql_payment = "SELECT tenant_id FROM payment WHERE id = :id_paiment";
    $stmt_payment = $connexion->prepare($sql_payment);
    $stmt_payment->execute(['id_paiment' => $id_paiment]);
    $payment_exists = $stmt_payment->fetch(PDO::FETCH_ASSOC);

    if ($payment_exists) {
        // Step 2: Get the price the tenant needs to pay from the tenant table using tenant_id
        $tenant_id = $payment_exists['tenant_id'];
        $sql_tenant = "SELECT price FROM tenants WHERE id = :tenant_id";
        $stmt_tenant = $connexion->prepare($sql_tenant);
        $stmt_tenant->execute(['tenant_id' => $tenant_id]);
        $tenant = $stmt_tenant->fetch(PDO::FETCH_ASSOC);

        if ($tenant) {
            $price_to_pay = $tenant['price'];

            // Step 3: Check if the payment already exists and its status
            $sql_payment_details = "SELECT * FROM payment WHERE id = :id_paiment";
            $stmt_payment_details = $connexion->prepare($sql_payment_details);
            $stmt_payment_details->execute(['id_paiment' => $id_paiment]);
            $payment_details = $stmt_payment_details->fetch(PDO::FETCH_ASSOC);

            if ($payment_details) {
                if ($payment_details['status'] == "Payé") {
                    // If payment is already fully paid
                    $erreur = "Le paiement a déjà été effectué pour ce mois.";
                } else {
                    // Check if adding the new amount exceeds the required payment
                    if ($montant + $payment_details['montant'] > $price_to_pay) {
                        $erreur = "Le montant payé dépasse le montant à payer.";
                    } elseif ($montant + $payment_details['montant'] <= $price_to_pay) {
                        // If the new payment is within the limit, update the payment
                        $new_amount = $montant + $payment_details['montant'];
                        $status = "Partiellement payé"; // Status is updated to partially paid

                        // Step 4: Update the payment table with the new amount and status
                        $sql_update_payment = "UPDATE payment SET montant = :montant, status = :status WHERE id = :id_paiment";
                        $stmt_update_payment = $connexion->prepare($sql_update_payment);
                        $stmt_update_payment->execute([
                            'montant' => $new_amount,
                            'status' => $status,
                            'id_paiment' => $id_paiment
                        ]);

                        $success = "Le paiement a été complété avec succès.";
                    }
                }
            }
        } else {
            $erreur = "Impossible de récupérer les informations du locataire.";
        }
    } else {
        $erreur = "Aucun paiement trouvé pour cet identifiant.";
    }
}
?>
