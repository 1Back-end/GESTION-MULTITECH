<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>


<link rel="stylesheet" href="style.css">
<style>
    body{
        font-family: "Rubik", system-ui;
        font-weight:500;
    }
</style>
<?php 
$id_paiement = $_GET["id_paiement"];
include_once("../database/connexion.php");


// Vérifier si des résultats ont été retournés
if ($paiement) {
    // Générer un code aléatoire pour le reçu
    $code_recu = random_int(10000000000000, 99999999999999);
    ?>
    
    <div class="container mt-5 pb-5">
        <div class="col-md-12 col-sm-12 mb-3 mx-auto">
            
            <div class="bouton ">
                <button id="btnPrint" class="shadow-none btn btn-success btn-sm text-white me-2 btn-print">Imprimer en PDF <i class="fa fa-print" aria-hidden="true"></i></button>
            </div>
        </div>

        <div class="col-md-12 col-sm-12 mx-auto mb-3 bouton">
            <div class="page">
                <div class="cote-a-cote">
                    <img src="https://i.imgur.com/Vlo2aJM.png" alt="Logo">
                    <div>
                        <p>Reçu N° : #<?= htmlspecialchars($code_recu) ?></p>
                        <p>Date : <?= htmlspecialchars($paiement['date_payment']) ?></p>
                    </div>
                </div>
                <div class="cote-a-cote">
                    <p class="text-capitalize">Nom & Prénom : <?= htmlspecialchars($paiement['NOM_EMPLOYE'] . ' ' . $paiement['PRENOM_EMPLOYE']) ?></p>
                </div>
                <div class="cote-a-cote">
                    <p>Email : <?= htmlspecialchars($paiement['EMAIL_EMPLOYE']) ?></p>
                </div>
                <div class="cote-a-cote">
                    <p>Contact : +237<?= htmlspecialchars($paiement['CONTACT_EMPLOYE']) ?></p>
                </div>
                <div class="cote-a-cote">
                    <p>Département : <?= htmlspecialchars($paiement['NOM_DEPARTEMENT']) ?></p>
                </div>
                <div class="cote-a-cote">
                    <p>Poste : <?= htmlspecialchars($paiement['LIBELLE_POSTE']) ?></p>
                </div>
                <table class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <th scope="col">Salaire</th>
                            <th scope="col">Augmentation</th>
                            <th scope="col">Prime</th>
                            <th scope="col">Déduction</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= number_format($paiement['SALAIRE_BASE']) ?> XAF</td>
                            <td><?= number_format($paiement['AUGMENTATIONS']) ?> XAF</td>
                            <td><?= number_format($paiement['PRIMES']) ?> XAF</td>
                            <td><?= number_format($paiement['DEDUCTIONS']) ?> XAF</td>
                        </tr>
                    </tbody>
                </table>
                <div class="signature">
                    <p class="fw-bold text-gray-800">Salaire Net : <?= htmlspecialchars($paiement['TOTAL_SALAIRE']) ?> XAF</p>
                </div>
                <div class="footer">
                    <p>Ceci est un reçu officiel de paiement confirmant la réception du salaire pour la période spécifiée.</p>
                </div>
                <div class="signature">
                    <p>Signature</p>
                    <p>_________</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Script pour l'action du bouton Imprimer
        document.addEventListener("DOMContentLoaded", function() {
            var btnPrint = document.getElementById('btnPrint');
            
            btnPrint.addEventListener("click", function() {
                // Ici vous pouvez ajouter le script pour lancer l'impression
                window.print();
            });
        });
    </script>

<?php
} else {
    // Si aucun paiement n'est trouvé, afficher un message d'erreur
    echo "<p>Aucun paiement trouvé pour l'ID donné.</p>";
    echo $id_paiement;
    
}
?>
