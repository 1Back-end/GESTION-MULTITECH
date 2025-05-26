<?php
include("../database/connexion.php");
include("../fonction/fonction.php");

$erreur = "";
$success = "";

if (isset($_POST["submit"])) {
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
    $code_dossier = generateDossierCode(); // Par ex. 10 caractères

    // Vérifier si le client existe déjà (par email, téléphone ou cni)
    $checkStmt = $connexion->prepare("SELECT COUNT(*) FROM customers_dossiers WHERE email = :email OR telephone = :telephone OR cni = :cni");
    $checkStmt->execute([
        'email' => $email,
        'telephone' => $telephone,
        'cni' => $cni
    ]);
    $exists = $checkStmt->fetchColumn();

    if ($exists > 0) {
        $erreur = "Ce client a déjà ouvert un dossier (email, téléphone ou CNI déjà utilisé).";
    } else {
        $connexion->beginTransaction();

        try {
            $client_uuid = generateUUID();

            // Insertion du client
            $stmt = $connexion->prepare("INSERT INTO customers_dossiers (
                uuid,code_dossier, prefixe, nom_complet, profession, cni, telephone, email, description, 
                condition_visite, option_visite, added_by,frais_ouverture
            ) VALUES (
                :uuid,:code_dossier, :prefixe, :nom_complet, :profession, :cni, :telephone, :email, :description,
                :condition_visite, :option_visite, :added_by,:frais_ouverture
            )");

            $stmt->execute([
                'uuid' => $client_uuid,
                'code_dossier' => $code_dossier,
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
                'frais_ouverture' => $frais_ouverture
            ]);

            // Insertion des prestations
            if (!empty($prestations)) {
                $stmt = $connexion->prepare("INSERT INTO prestations_client (
                    uuid, client_uuid, prestation, added_by
                ) VALUES (
                    :uuid, :client_uuid, :prestation, :added_by
                )");

                foreach ($prestations as $prestation) {
                    $stmt->execute([
                        'uuid' => generateUUID(),
                        'client_uuid' => $client_uuid,
                        'prestation' => $prestation,
                        'added_by' => $added_by
                    ]);
                }
            }

            $connexion->commit();
            $success = "Client et prestations enregistrés avec succès.";
            echo "<script>setTimeout(function {window.location.href='ouvertures_dossiers.php'; } , 3000)</script>";
        } catch (Exception $e) {
            $connexion->rollBack();
            $erreur = "Erreur : " . $e->getMessage();
        }
    }
}
?>
