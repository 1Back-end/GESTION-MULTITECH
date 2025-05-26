
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
/* CONTENEUR GLOBAL */
.page {
    width: 210mm;
    height: 190mm;
    padding: 20mm;
    margin: 0 auto;
    border: 1px solid #D3D3D3;
    border-radius: 5px;
    background: white;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    box-sizing: border-box;
}

/* SOUS-PAGE */
.subpage {
    padding: 0;
    height: auto;
    box-sizing: border-box;
}

/* COTE À COTE */
.cote-a-cote {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
}

.cote-a-cote img {
    max-width: 150px;
}

.logo-cercle {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border-radius: 50%;
    border: 2px solid #1F4283;
}

.cote-a-cote div {
    margin-left: 20px;
}

.cote-a-cote p {
    margin: 3px 0;
}

/* BOUTON NON IMPRIMÉ */
@media print {
    .btn-print {
        display: none !important;
    }
}

/* TEXTE ET TABLEAU */
.total-row {
    font-weight: bold;
    text-align: right;
}

.footer {
    margin-top: 30px;
}

.signature {
    margin-top: 20px;
    text-align: right;
}

.signature p {
    margin: 0;
}

@page {
    size: 210mm 148.5mm; /* A4 largeur, demi-hauteur */
    margin: 0;
}

@media print {
    html, body {
        width: 210mm;
        height: 148.5mm;
        margin: 0;
        padding: 0;
    }

    .page {
        align-items: center;
        justify-content: center;
        width: 210mm;
        height: 148.5mm;
        margin: 0;
        padding: 20mm 10mm; /* moins de padding horizontal */
        box-sizing: border-box;
        border: none;
        border-radius: 0;
        box-shadow: none;
        background: white;
        page-break-after: avoid;
        page-break-inside: avoid;
        overflow: hidden;
        border: 1px solid red; /* pour debug */
    }

    .btn-print {
        display: none !important;
    }
}



</style>

<?php
$uuid = $_GET['uuid'] ?? null;
if (!$uuid) {
    echo "<p class='text-danger'>UUID du dossier manquant.</p>";
    exit;
}

include_once("../database/connexion.php");

// Récupérer les données du dossier client
$sql = $connexion->prepare("SELECT 
    cd.nom_complet,
    cd.cni,
    cd.telephone,
    cd.email,
    cd.date_soumission,
    cd.profession,
    cd.code_dossier,
    cd.frais_ouverture,
    cd.condition_visite,
    cd.option_visite,
    cd.is_deleted
FROM customers_dossiers cd
WHERE cd.uuid = :uuid AND cd.is_deleted = 0
LIMIT 1");
$sql->execute(['uuid' => $uuid]);
$dossier = $sql->fetch(PDO::FETCH_ASSOC);

if (!$dossier) {
    echo "<p class='text-danger'>Aucun dossier trouvé ou dossier supprimé.</p>";
    exit;
}

// Récupérer les infos de finalisation du dossier
$sqlFin = $connexion->prepare("SELECT montant_verse, date_finalisation FROM finalisations_dossiers WHERE dossier_uuid = :uuid AND is_deleted = 0 ORDER BY date_finalisation DESC LIMIT 1");
$sqlFin->execute(['uuid' => $uuid]);
$finalisation = $sqlFin->fetch(PDO::FETCH_ASSOC);

if (!$finalisation) {
    echo "<p class='text-danger'>Aucune finalisation enregistrée pour ce dossier.</p>";
    exit;
}

// Récupérer la prestation
$reqPresta = $connexion->prepare("SELECT prestation FROM prestations_client WHERE client_uuid = :uuid LIMIT 1");
$reqPresta->execute(['uuid' => $uuid]);
$prestation = $reqPresta->fetchColumn() ?: "Prestation non précisée";

// Générer un code reçu aléatoire

$code_recu = random_int(1000000000, 9999999999);
?>

<?php if ($dossier): ?>
   <div class="container mt-5 pb-5 d-flex justify-content-center">
        <div class="col-md-8 col-sm-12 mb-3">
            <div class="cote-a-cote">
                <div>
                    <a href="ouvertures_dossiers.php" class="btn btn-secondary btn-print btn-sm text-start">
                    <i class="fa-solid fa-backward-fast"></i> Retour sur le menu
                </a>
                </div>
                <div>
                    <button id="btnPrint" class="btn btn-success btn-print btn-sm text-end">
                    Imprimer le reçu  en PDF <i class="fa fa-print"></i>
                </button>
                </div>
            </div>
            <div class="page border-0"> 
                <h5 class="text-uppercase text-center fw-bold">Reçu de finalisation du dosssier</h5>
                <div class="cote-a-cote">
                    <img src="logo_immo.jpeg" alt="Logo"  class="logo-cercle" style="margin-bottom:15px">
                    <div>
                        <p><strong>Reçu N° :</strong> #<?= htmlspecialchars($code_recu) ?></p>
                        <p><strong>Référence :</strong> <?= htmlspecialchars($dossier['code_dossier']) ?></p>
                        <p><strong>Date et Heure :</strong> <?= (new DateTime($dossier['date_soumission']))->format('d/m/Y H:i:s') ?></p>
                    </div>
                </div>
                <hr>
                <div class="text-center">
                    <small class="text-center">Informations du client</small>
                </div>
                <div class="cote-a-cote">
                        <div>
                            <p><strong>Nom & Prénom :</strong> <?= htmlspecialchars($dossier['nom_complet']) ?></p>
                        <p><strong>Numéro CNI :</strong> <?= htmlspecialchars($dossier['cni']) ?></p>
                        </div>
                    <div>
                        <p><strong>Téléphone :</strong> <?= htmlspecialchars($dossier['telephone']) ?></p>
                        <p><strong>Profession :</strong> <?= htmlspecialchars($dossier['profession']) ?></p>
                    </div>
                </div>


                <hr>

                 <p>
                    Ce reçu atteste que le client <strong><?= htmlspecialchars($dossier['nom_complet']) ?></strong> a réglé la somme de 
                    <strong><?= number_format($finalisation['montant_verse'], 0, ',', ' ') ?> FCFA</strong> au titre de la finalisation du dossier, 
                    en date du <strong><?= (new DateTime($finalisation['date_finalisation']))->format('d/m/Y H:i:s') ?></strong>, 
                    pour la prestation <strong><?= htmlspecialchars($prestation) ?></strong>, 
                    réalisée sous la condition <strong><?= htmlspecialchars($dossier['condition_visite']) ?></strong>, 
                    avec l'option <strong><?= htmlspecialchars($dossier['option_visite']) ?></strong>.
                </p>



<div class="signature mt-5">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="mr-auto">
                            <p><strong>Nom du client :</strong> <?= htmlspecialchars($dossier['nom_complet']) ?></p>
                            <p><strong>Signature du client</strong><br>___________________</p>
                        </div>
                        <div class="ml-auto">
                            <p><strong>Fait le :</strong> <span id="date"></span></p>
                            <p><strong>La Direction</strong><br>___________________</p>
                        </div>
                    </div>
                </div>

</div>

<script>
    document.getElementById('btnPrint').addEventListener('click', function () {
        window.print();
    });
    document.getElementById('date').textContent = new Date().toLocaleDateString('fr-FR');
</script>

<?php endif; ?>