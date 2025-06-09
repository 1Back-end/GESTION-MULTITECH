<?php 
include("../database/connexion.php"); 
include("../fonction/fonction.php");

$erreur = "";
$success = "";

if (isset($_POST["submit"])) {
    $firstname = $_POST["firstname"] ?? null;
    $lastname  = $_POST["lastname"] ?? null;
    $email = $_POST["email"] ?? null;
    $address = $_POST["address"] ?? null;
    $tel1 = $_POST["tel1"] ?? null;
    $tel2 = $_POST['tel2'] ?? null;
    $cni_number = $_POST["cni_number"] ?? null;
    $price_for_abonnement = $_POST["price_for_abonnement"] ?? null;
    
    $uuid = generateUUID();
    $added_by = $_SESSION['id'] ?? null;
   
     if ($firstname && $lastname && $email && $address && $tel1  && $cni_number && $price_for_abonnement) {
        try {
            
            $sql_check_tel1 = "SELECT COUNT(*) FROM clients_abonnes WHERE tel1 = :tel1 AND is_deleted = 0";
            $stmt_check_tel1 = $connexion->prepare($sql_check_tel1);
            $stmt_check_tel1->execute([':tel1' => $tel1]);
            $phone_exists_tel1 = $stmt_check_tel1->fetchColumn();

            $sql_check_tel2 = "SELECT COUNT(*) FROM clients_abonnes WHERE tel2 = :tel2 AND is_deleted = 0";
            $stmt_check_tel2 = $connexion->prepare($sql_check_tel2);
            $stmt_check_tel2->execute([':tel2' => $tel1]);
            $phone_exists_tel2 = $stmt_check_tel2->fetchColumn();

           
            $sql_check_cni_number = "SELECT COUNT(*) FROM clients_abonnes WHERE cni_number = :cni_number AND is_deleted = 0";
            $stmt_check_cni_number = $connexion->prepare($sql_check_cni_number);
            $stmt_check_cni_number->execute([':cni_number' => $cni_number]);
            $cni_number_exists = $stmt_check_cni_number->fetchColumn();

            $sql_check_email = "SELECT COUNT(*) FROM clients_abonnes WHERE email = :email AND is_deleted = 0";
            $stmt_check_email = $connexion->prepare($sql_check_email);
            $stmt_check_email->execute([':email' => $email]);
            $email_exists = $stmt_check_email->fetchColumn();


            // Si le numéro de téléphone ou le numéro de CNI existe déjà
            if ($phone_exists_tel1 > 0) {
                $erreur = "Le numéro de téléphone $tel1 est déjà utilisé ";

            }elseif($phone_exists_tel2 > 0){
                $erreur = "Le numéro de téléphone $tel2 est déjà utilisé ";

            }elseif($email_exists > 0){
                $erreur = "L'email $email est déjà utilisé ";
            }
            elseif ($cni_number_exists > 0) {
                $erreur = "Ce numéro de CNI $cni_number est déjà utilisé.";

            } else {
                // Si les deux sont valides, procéder à l'insertion
                $sql = "INSERT INTO clients_abonnes (uuid, firstname, lastname, email, tel1, address, tel2, cni_number, price_for_abonnement,added_by) 
                        VALUES (:uuid, :firstname, :lastname, :email, :tel1, :address, :tel2, :cni_number, :price_for_abonnement,:added_by)";
                
                $stmt = $connexion->prepare($sql);
                $stmt->execute([
                    ':uuid' => $uuid,
                    ':firstname' => $firstname,
                    ':lastname' => $lastname,
                    ':email' => $email,
                    ':tel1' => $tel1,
                    ':address' => $address,
                    ':tel2' => $tel2,
                    ':cni_number' => $cni_number,
                    ':price_for_abonnement' => $price_for_abonnement,
                    ':added_by' => $added_by
                ]);

                $success = "Client abonné enregistré avec succès !";
                echo "<script>setTimeout(function {window.location.href='abonnement_clients.php'; } , 3000)</script>";
            }
        } catch (PDOException $e) {
            $erreur = "Erreur lors de l'enregistrement : " . $e->getMessage();
        }
    } else {
        $erreur = "Tous les champs sont obligatoires.";
    }
}
?>
