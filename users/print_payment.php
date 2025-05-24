
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo strtoupper(ucfirst(str_replace(".php", "", basename($_SERVER['PHP_SELF']))));?></title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="../vendors/images/logo.png">
	<link rel="icon" type="image/png" sizes="32x32" href="../vendors/images/logo.png">
	<link rel="icon" type="image/png" sizes="16x16" href="../vendors/images/logo.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" type="text/css" href="../vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="../vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="../vendors/styles/style.css">
	<link rel="stylesheet" type="text/css" href="../vendors/styles/main.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<style>

@import url('https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap');
.cote-a-cote {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
}
.cote-a-cote img {
    max-width: 150px;
}
.cote-a-cote div {
    margin-left: 20px;
}
.cote-a-cote p {
    margin: 5px 0;
}


.page {
    width: 210mm;
    min-height: 200mm;
    padding: 20mm;
    margin: 5mn auto;
    border: 1px #D3D3D3 solid;
    border-radius: 5px;
    background: white;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    
}
.subpage {
    padding: 1cm;
    
    height: 257mm;
    
}

@page {
    size: A4;
    margin: 0;
}
@media print {
    html, body {
        width: 210mm;
        height: 297mm;        
    }
    .page {
        margin: 0;
        border: initial;
        border-radius: initial;
        width: initial;
        min-height: initial;
        box-shadow: initial;
        background: initial;
        page-break-after: always;
    }
}

    
    .bouton {
        display: flex;
        align-items: center;
        justify-content: center;
       
    }
    .cote-a-cote img {
        max-width: 150px;
    }
    .cote-a-cote p {
        margin: 3px 0;
    }
    
    
    .total-row {
        font-weight: bold;
    }
    .footer {
        margin-top: 30px;
    }
    .signature {
        margin-top: 20px;
        text-align: right;
    }
    .total-row {
        text-align: right;
    }
    .signature p {
        margin: 0;
    }
    @media print {
        .btn-print {
            display: none !important; /* Masque le bouton lors de l'impression */
        }
    }

</style>
<?php 
$id_paiement = $_GET["id"];
include_once("../database/connexion.php");

// Requête pour récupérer les informations du paiement et du bénéficiaire
$sql = $connexion->prepare("SELECT 
    p.date_payment, 
    p.montant, 
    p.mois, 
    b.first_name, 
    b.last_name, 
    b.num_cni, 
    b.phone, 
    b.address 
FROM payment p
JOIN tenants b ON p.tenant_id = b.id
WHERE p.id = :id_paiement");

$sql->execute(['id_paiement' => $id_paiement]);
$paiement = $sql->fetch(PDO::FETCH_ASSOC);

if ($paiement) {
    $code_recu = random_int(10000000000000, 99999999999999);
    ?>
    
    <div class="container mt-5 pb-5 d-flex justify-content-center">
    <div class="col-md-8 col-sm-12 mb-3">
       <div class="d-flex align-items-center justify-content-between">
        <div class="mb-0">
             <button id="btnPrint" class="btn btn-success btn-print  btn-sm mb-4">Imprimer en PDF <i class="fa fa-print"></i></button>
        </div>
        <a href="" class="btn btn-secondary">
            Retour
        </a>
       </div>
        <div class="page">
            <div class="cote-a-cote">
                <img src="logo_immo.jpeg" alt="Logo" class="img-fluid" style="max-width: 150px;">
                <div>
                    <p><strong>Reçu N° :</strong> #<?= htmlspecialchars($code_recu) ?></p>
                    <p><strong>Date :</strong> <?= htmlspecialchars($paiement['date_payment']) ?></p>
                </div>
            </div>
            <div class="cote-a-cote">
                <p><strong>Nom & Prénom :</strong> <?= htmlspecialchars($paiement['first_name'] . ' ' . $paiement['last_name']) ?></p>
            </div>
            <div class="cote-a-cote">
                <p><strong>Numéro CNI :</strong> <?= htmlspecialchars($paiement['num_cni']) ?></p>
            </div>
            <div class="cote-a-cote">
                <p><strong>Téléphone :</strong> <?= htmlspecialchars($paiement['phone']) ?></p>
            </div>
            <div class="cote-a-cote">
                <p><strong>Adresse :</strong> <?= htmlspecialchars($paiement['address']) ?></p>
            </div>
           

            <p>Ce reçu confirme que le locataire, <strong><?= htmlspecialchars($paiement['first_name'] . ' ' . $paiement['last_name']) ?></strong>, a effectué un paiement de <strong><?= number_format($paiement['montant']) ?> XAF</strong> pour le mois de <strong><?= htmlspecialchars($paiement['mois']) ?></strong>. Ce paiement a été reçu par l'entreprise <strong>IMMO SCI</strong> en règlement de la location du bien concerné.</p>
            <div class="footer">
                <p>Ceci est un reçu officiel confirmant le paiement pour le mois de <strong><?= htmlspecialchars($paiement['mois']) ?></strong>.</p>
            </div>
            <div class="signature">
                <p><strong>Signature</strong> _________________  <strong>Fait le : </strong><span id="date"></span></p>
            </div>



        </div>
    </div>
</div>

<script>
    document.getElementById('btnPrint').addEventListener("click", function() {
        window.print();
    });
</script>
<script>
    document.getElementById('date').textContent = new Date().toLocaleDateString('fr-FR');
</script>

    
    <?php
} else {
    echo "<p>Aucun paiement trouvé pour l'ID donné.</p>";
}
?>

    
</body>
</html>








