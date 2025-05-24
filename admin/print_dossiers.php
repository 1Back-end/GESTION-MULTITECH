<?php
// Récupération de l'UUID du dossier
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
    cd.frais_ouverture
FROM customers_dossiers cd
WHERE cd.uuid = :uuid AND cd.is_deleted = 0");

$sql->execute(['uuid' => $uuid]);
$dossier = $sql->fetch(PDO::FETCH_ASSOC);

// Récupération de la prestation du client
$req = $connexion->prepare("SELECT prestation FROM prestations_client WHERE client_uuid = :uuid LIMIT 1");
$req->execute(['uuid' => $uuid]);
$prestation = $req->fetchColumn();

$code_recu = $code = random_int(1000000000, 9999999999) . random_int(1000000000, 9999999999);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Reçu ouverture dossier</title>

    <link rel="apple-touch-icon" sizes="180x180" href="../vendors/images/logo.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../vendors/images/logo.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../vendors/images/logo.png">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="../vendors/styles/core.css">
    <link rel="stylesheet" type="text/css" href="../vendors/styles/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="../vendors/styles/style.css">
    <link rel="stylesheet" type="text/css" href="../vendors/styles/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Rubik:wght@400;500&display=swap');
        body { font-family: 'Rubik', sans-serif; }
        .cote-a-cote { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .cote-a-cote img { max-width: 150px; }
        .page { width: 210mm; min-height: 200mm; padding: 20mm; margin: auto; background: white; box-shadow: 0 0 5px rgba(0, 0, 0, 0.1); }
        .footer, .signature { margin-top: 30px; }
        .signature p { text-align: right; margin: 0; }
        @media print {
            .btn-print { display: none !important; }
            .page { box-shadow: none; border: none; }
        }
    </style>
</head>
<body>
<?php if ($dossier): ?>
    <div class="container mt-5 pb-5 d-flex justify-content-center">
        <div class="col-md-8 col-sm-12 mb-3">
          <div class="d-flex align-items-center justify-content-between mb-4">
                <a href="ouvertures_dossiers.php" class="btn btn-secondary btn-sm">
                    <i class="fa-solid fa-backward-fast"></i> Retour sur le menu
                </a>
                <button id="btnPrint" class="btn btn-success btn-print btn-sm">
                    Imprimer la facture en PDF <i class="fa fa-print"></i>
                </button>
            </div>

            <div class="page">
                <div class="cote-a-cote">
                    <img src="logo_immo.jpeg" alt="Logo">
                    <div>
                        <p><strong>Reçu N° :</strong> #<?= htmlspecialchars($code_recu) ?></p>
                        <p><strong>Référence :</strong> <?= htmlspecialchars($dossier['code_dossier']) ?></p>
                        <p><strong>Date et Heure :</strong> <?= (new DateTime($dossier['date_soumission']))->format('d/m/Y H:i:s') ?></p>
                    </div>
                </div>

                <p><strong>Nom & Prénom :</strong> <?= htmlspecialchars($dossier['nom_complet']) ?></p>
                <p><strong>Numéro CNI :</strong> <?= htmlspecialchars($dossier['cni']) ?></p>
                <p><strong>Téléphone :</strong> <?= htmlspecialchars($dossier['telephone']) ?></p>
                <p><strong>Profession :</strong> <?= htmlspecialchars($dossier['profession']) ?></p>


                <hr>

                 <p>
                    Ce reçu atteste que le client <strong><?= htmlspecialchars($dossier['nom_complet']) ?></strong> a réglé la somme de 
                    <strong><?= number_format($dossier['frais_ouverture'], 0, ',', ' ') ?> FCFA</strong> 
                    au titre des frais d’ouverture de dossier, en date du <strong><?= htmlspecialchars($dossier['date_soumission']) ?></strong>.
                </p>


                <div class="footer mt-4">
                    <p><strong>Clauses et conditions :</strong></p>
                    <ul>
                        <li>Les frais d’ouverture de dossier ne sont ni remboursables, ni inclus dans les frais de commission.</li>
                        <li>Une fois que le client s’est enrichi des services de l’entreprise, il s’engage à verser à l’agence une commission équivalente à un mois de loyer pour les locations, ou 5% du montant de la transaction pour les achats/ventes, le jour du versement.</li>
                        <li>La SCIIMAO ne peut prétendre à la prime convenue que si la transaction connaît un heureux aboutissement.</li>
                        <li>Le client s’expose à une clause pénale de 10 000 FCFA par jour de retard dès le premier jour après la date d’échéance de la transaction.</li>
                        <li>Une fois la visite faite, si le client contacte directement le vendeur ou le bailleur sans l’agence, qui demeure le seul intermédiaire, il devra payer une amende d’un mois de commission supplémentaire (location) ou 5% supplémentaires (achat).</li>
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


<script>
    document.getElementById('btnPrint').addEventListener("click", function () {
        window.print();
    });
    document.getElementById('date').textContent = new Date().toLocaleDateString('fr-FR');
</script>

</body>
</html>
