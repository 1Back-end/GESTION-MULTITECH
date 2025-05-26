
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
    height: 297mm;
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

/* CONFIGURATION IMPRESSION */
@page {
    size: A4;
    margin: 0;
}

@media print {
    html, body {
        width: 210mm;
        height: 297mm;
        margin: 0;
        padding: 0;
    }

    .page {
        margin: 0;
        border: none;
        border-radius: 0;
        width: 100%;
        height: 100%;
        box-shadow: none;
        background: white;
        page-break-after: avoid;
        page-break-inside: avoid;
    }
}

</style>
<?php
$uuid = $_GET['uuid'];
include_once("../database/connexion.php");

// Récupération des données du dossier
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
    cd.option_visite
FROM customers_dossiers cd
WHERE cd.uuid = :uuid AND cd.is_deleted = 0");

$sql->execute(['uuid' => $uuid]);
$dossier = $sql->fetch(PDO::FETCH_ASSOC);

// Récupération de la prestation du client
$req = $connexion->prepare("SELECT prestation FROM prestations_client WHERE client_uuid = :uuid LIMIT 1");
$req->execute(['uuid' => $uuid]);
$prestation = $req->fetchColumn();

$code_recu = random_int(1000000000, 9999999999) . random_int(1000000000, 9999999999);
?>

<?php if ($dossier): ?>
    <div class="container mt-5 pb-5 d-flex justify-content-center">
        <div class="col-md-8 col-sm-12 mb-3">
            <div class="cote-a-cote">
                <div>
                    <a href="ouvertures_dossiers.php" class="btn btn-secondary btn-print btn-sm">
                    <i class="fa-solid fa-backward-fast"></i> Retour sur le menu
                </a>
                </div>
                <div>
                    <button id="btnPrint" class="btn btn-success btn-print btn-sm">
                    Imprimer la fiche en PDF <i class="fa fa-print"></i>
                </button>
                </div>
            </div>

            <div class="page border-0">
                 <h5 class="text-uppercase text-center fw-bold">Fiche d'ouverture du dosssier</h5>
                <div class="cote-a-cote">
                    <img src="logo_immo.jpeg" class="logo-cercle" alt="Logo">
                    <div>
                        <p><strong>Fiche N° :</strong> #<?= htmlspecialchars($code_recu) ?></p>
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
                        <p class="mb-3"><strong>Nom & Prénom :</strong> <?= htmlspecialchars($dossier['nom_complet']) ?></p>
                        <p class="mb-3"><strong>Numéro CNI :</strong> <?= htmlspecialchars($dossier['cni']) ?></p>
                        </div>
                    <div>
                        <p class="mb-3"><strong>Téléphone :</strong> <?= htmlspecialchars($dossier['telephone']) ?></p>
                        <p class="mb-3"><strong>Profession :</strong> <?= htmlspecialchars($dossier['profession']) ?></p>
                    </div>
                </div>

                <hr>

                <p class="text-justify">
                    Cette fiche atteste que le client <strong><?= htmlspecialchars($dossier['nom_complet']) ?></strong> a réglé la somme de 
                    <strong><?= number_format($dossier['frais_ouverture'], 0, ',', ' ') ?> FCFA</strong> 
                    au titre des frais d’ouverture de dossier, en date du <strong><?= (new DateTime($dossier['date_soumission']))->format('d/m/Y H:i:s') ?></strong>, pour la prestation suivante
                    <strong><?= htmlspecialchars($prestation) ?></strong>,
                    réalisée sous la condition <strong><?= htmlspecialchars($dossier['condition_visite']) ?></strong>, 
                    avec l'option <strong><?= htmlspecialchars($dossier['option_visite']) ?></strong>.
                </p>

                <div class="footer mt-4">
                    <p><strong>Clauses et conditions :</strong></p>
                    <ul>
                        <p class="text-justify">Les frais d’ouverture de dossier ne sont ni remboursables, ni inclus dans les frais de commission.</p>

                        <?php if ($dossier['condition_visite'] == 'Achat Terrain' || $dossier['condition_visite'] == 'Achat Maison'): ?>
                            <p class="text-justify">Le client s’engage à verser à l’agence une commission équivalente à <strong>5% du montant de la transaction</strong>, le jour du versement.
                            en cas de contact direct avec le vendeur sans passer par l’agence, le client devra payer une amende de <strong>5% supplémentaires</strong>.</p>
                        <?php elseif ($dossier['condition_visite']== 'Location'): ?>
                            <p class="text-justify">Le client s’engage à verser à l’agence une commission équivalente à <strong>un mois de loyer</strong>, le jour du versement.
                            En cas de contact direct avec le bailleur sans passer par l’agence, le client devra payer une amende de <strong>un mois de loyer supplémentaire</strong>.</p>
                        <?php else: ?>
                            <p class="text-justify">La commission sera déterminée selon la nature spécifique de la prestation.</p>
                        <?php endif; ?>

                        <p class="text-justify">La SCIIMAO ne peut prétendre à la prime convenue que si la transaction connaît un heureux aboutissement.
                        Le client s’expose à une clause pénale de 10 000 FCFA par jour de retard dès le premier jour après la date d’échéance de la transaction.
                       Une fois la visite faite, si le client contacte directement le vendeur ou le bailleur sans l’agence, il s’expose à une pénalité conformément aux clauses ci-dessus.</p>
                    </ul>
                </div>


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
        </div>
    </div>
<?php else: ?>
    <p class="text-danger">Aucun dossier trouvé.</p>
<?php endif; ?>

<script>
    document.getElementById('btnPrint').addEventListener("click", function () {
        window.print();
    });
    document.getElementById('date').textContent = new Date().toLocaleDateString('fr-FR');
</script>
