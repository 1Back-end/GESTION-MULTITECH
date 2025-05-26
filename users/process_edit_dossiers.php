<?php
include("../database/connexion.php");
include("../fonction/fonction.php");

$erreur = "";
$success = "";

if (isset($_POST["submit"])) {
    $uuid = $_POST['uuid'];  // UUID du client à modifier
    $prefixe = $_POST['prefixe'] ?? null;
    $nom_complet = $_POST['nom_complet'] ?? null;
    $profession = $_POST['profession'] ?? null;
    $cni = $_POST['cni'] ?? null;
    $telephone = $_POST['telephone'] ?? null;
    $email = $_POST['email'] ?? null;
    $description = $_POST['description'] ?? null;
    $condition = $_POST['condition_type'] ?? null;
    $option_visite = $_POST['option_visite'] ?? null;
    $prestations = $_POST['prestations'] ?? [];
    $added_by = $_SESSION['id'] ?? null;
    $frais_ouverture = $_POST['frais_ouverture'] ?? null;
    $added_by = $_SESSION['id'] ?? null;

    // Vérifier si un autre client (différent de celui qu'on modifie) a déjà cet email, téléphone ou CNI
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
                'uuid' => $uuid,
                'frais_ouverture'  => $frais_ouverture
            ]);

            // Suppression des anciennes prestations liées au client
            $deletePrestations = $connexion->prepare("DELETE FROM prestations_client WHERE client_uuid = :client_uuid");
            $deletePrestations->execute(['client_uuid' => $uuid]);

            // Insertion des nouvelles prestations
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
?>
