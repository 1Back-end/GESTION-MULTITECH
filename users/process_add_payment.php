<?php
include("../database/connexion.php");

$erreur = "";
$success = "";

if (isset($_POST["submit"])) {
    // Récupérer les données du formulaire
    $montant = $_POST["montant"] ?? null;
    $mois = $_POST["mois"] ?? null;
    $tenant_id = $_POST["tenant_id"] ?? null;
    $id = generateUUID();
    $added_by = $_SESSION['id'] ?? null;

    // Récupérer le montant à payer du locataire
    try {
        $stmt = $connexion->prepare("SELECT price FROM tenants WHERE id = :tenant_id");
        $stmt->execute(['tenant_id' => $tenant_id]);
        $tenant = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($tenant) {
            $price_to_pay = $tenant['price'];
            
            // Vérifier si le locataire a déjà payé pour ce mois
            $stmt = $connexion->prepare("SELECT * FROM payment WHERE tenant_id = :tenant_id AND mois = :mois");
            $stmt->execute(['tenant_id' => $tenant_id, 'mois' => $mois]);
            $payment_exists = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($payment_exists) {
                // Si un paiement a déjà été effectué pour ce mois
                if ($payment_exists['status'] == "Payé") {
                    $erreur = "Le paiement a déjà été effectué pour ce mois.";
                } else {
                    // Si un paiement partiel a été effectué, autoriser un paiement complémentaire
                    if ($montant + $payment_exists['montant'] > $price_to_pay) {
                        // Si le paiement total dépasse le montant dû
                        $erreur = "Le montant payé dépasse le montant à payer.";
                    } elseif ($montant + $payment_exists['montant'] <= $price_to_pay) {
                        // Mettre à jour le paiement partiel
                        $status = "Partiellement payé";
                    }
                }
            } else {
                // Si aucun paiement n'a été effectué pour ce mois
                if ($montant < $price_to_pay) {
                    $status = "Partiellement payé"; // Si le montant est inférieur au montant total
                } elseif ($montant == $price_to_pay) {
                    $status = "Payé"; // Si le montant est égal au montant total
                }
            }

            // Si aucune erreur, on insère le paiement dans la table payment
            if (empty($erreur)) {
                try {
                    $stmt = $connexion->prepare("INSERT INTO payment (id, tenant_id, date_payment, montant, added_by, status, mois) 
                    VALUES (:id, :tenant_id, NOW(), :montant, :added_by, :status, :mois)");
                    $stmt->execute([
                        'id' => $id,
                        'tenant_id' => $tenant_id,
                        'montant' => $montant,
                        'added_by' => $added_by,
                        'status' => $status,
                        'mois' => $mois
                    ]);
                    $success = "Paiement enregistré avec succès.";
                } catch (Exception $e) {
                    $erreur = "Erreur lors de l'enregistrement du paiement : " . $e->getMessage();
                }
            }
        } else {
            $erreur = "Locataire introuvable.";
        }
    } catch (Exception $e) {
        $erreur = "Erreur lors de la récupération du prix du locataire : " . $e->getMessage();
    }
}
?>
