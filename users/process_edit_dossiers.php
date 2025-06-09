<?php
include("../database/connexion.php");
include("../fonction/fonction.php");

$erreur = "";
$success = "";

if (isset($_POST["submit"])) {
    $uuid = $_POST['uuid'];

    // Charger les anciennes données du client
    $oldDataStmt = $connexion->prepare("SELECT * FROM customers_dossiers WHERE uuid = :uuid");
    $oldDataStmt->execute(['uuid' => $uuid]);
    $oldData = $oldDataStmt->fetch(PDO::FETCH_ASSOC);

    if (!$oldData) {
        $erreur = "Client non trouvé.";
    } else {
        // Récupération des champs avec fallback sur l'ancienne valeur
        $prefixe         = $_POST['prefixe'] ?? $oldData['prefixe'];
        $nom_complet     = $_POST['nom_complet'] ?? $oldData['nom_complet'];
        $profession      = $_POST['profession'] ?? $oldData['profession'];
        $cni             = $_POST['cni'] ?? $oldData['cni'];
        $telephone       = $_POST['telephone'] ?? $oldData['telephone'];
        $email           = $_POST['email'] ?? $oldData['email'];
        $description     = $_POST['description'] ?? $oldData['description'];
        $condition       = $_POST['condition_type'] ?? $oldData['condition_visite'];
        $option_visite   = $_POST['option_visite'] ?? $oldData['option_visite'];
        $frais_ouverture = $_POST['frais_ouverture'] ?? $oldData['frais_ouverture'];
        $prestations     = $_POST['prestations'] ?? [];
        $added_by        = $_SESSION['id'] ?? null;

        // Vérifier l'unicité de l'email, téléphone ou CNI sauf pour ce client
        $checkStmt = $connexion->prepare("
            SELECT COUNT(*) FROM customers_dossiers 
            WHERE (email = :email OR telephone = :telephone OR cni = :cni) AND uuid != :uuid
        ");
        $checkStmt->execute([
            'email' => $email,
            'telephone' => $telephone,
            'cni' => $cni,
            'uuid' => $uuid
        ]);
        $exists = $checkStmt->fetchColumn();

        if ($exists > 0) {
            $erreur = "Un autre client utilise déjà cet email, téléphone ou CNI.";
        } else {
            $connexion->beginTransaction();

            try {
                // Mise à jour du client
                $stmt = $connexion->prepare("
                    UPDATE customers_dossiers SET 
                        prefixe = :prefixe,
                        nom_complet = :nom_complet,
                        profession = :profession,
                        cni = :cni,
                        telephone = :telephone,
                        email = :email,
                        description = :description,
                        condition_visite = :condition_visite,
                        option_visite = :option_visite,
                        added_by = :added_by,
                        frais_ouverture = :frais_ouverture
                    WHERE uuid = :uuid
                ");

                $stmt->execute([
                    'prefixe' => $prefixe,
                    'nom_complet' => $nom_complet,
                    'profession' => $profession,
                    'cni' => $cni,
                    'telephone' => $telephone,
                    'email' => $email,
                    'description' => $description,
                    'condition_visite' => $condition,
                    'option_visite' => $option_visite,
                    'added_by' => $added_by,
                    'frais_ouverture' => $frais_ouverture,
                    'uuid' => $uuid
                ]);

                // Supprimer les anciennes prestations
                $deletePrestations = $connexion->prepare("DELETE FROM prestations_client WHERE client_uuid = :client_uuid");
                $deletePrestations->execute(['client_uuid' => $uuid]);

                // Réinsérer les nouvelles prestations
                if (!empty($prestations)) {
                    $insertPrest = $connexion->prepare("
                        INSERT INTO prestations_client (uuid, client_uuid, prestation, added_by) 
                        VALUES (:uuid, :client_uuid, :prestation, :added_by)
                    ");

                    foreach ($prestations as $prestation) {
                        $insertPrest->execute([
                            'uuid' => generateUUID(),
                            'client_uuid' => $uuid,
                            'prestation' => $prestation,
                            'added_by' => $added_by
                        ]);
                    }
                }

                $connexion->commit();
                $success = "Client et prestations mis à jour avec succès.";
                echo "<script>setTimeout(function() { window.location.href = 'ouvertures_dossiers.php'; }, 3000);</script>";

            } catch (Exception $e) {
                $connexion->rollBack();
                $erreur = "Erreur : " . $e->getMessage();
            }
        }
    }
}
?>
