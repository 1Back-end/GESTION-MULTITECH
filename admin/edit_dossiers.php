<?php include("../include/menu.php"); ?>

<div class="main-container mt-3 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card-box p-3">
            <div class="text-center">
                <h5 class="text-uppercase">Modifier le dossier d'un client</h5>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-sm-12 mb-3">
    <?php include("process_edit_dossiers.php"); ?>
    <?php if ($erreur): ?>
    <div class="alert alert-danger text-center border-0"><?= $erreur ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="alert alert-success text-center border-0"><?= $success ?></div>
    <?php endif; ?>
</div>
<?php
include("../database/connexion.php");

// Récupérer l'uuid dans l'URL, validation simple
$uuid = $_GET['uuid'] ?? null;
if (!$uuid) {
    die("UUID manquant");
}

// Récupérer les données du dossier
$stmt = $connexion->prepare("SELECT * FROM customers_dossiers WHERE uuid = ?");
$stmt->execute([$uuid]);
$dossier = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$dossier) {
    die("Dossier non trouvé");
}

// Récupérer les prestations liées au dossier
$stmt2 = $connexion->prepare("SELECT prestation FROM prestations_client WHERE client_uuid = ?");
$stmt2->execute([$uuid]);
$prestations = $stmt2->fetchAll(PDO::FETCH_COLUMN);
?>

<div class="col-md-12 col-sm-12 mb-3">
    <div class="shadow bg-white rounded-0 p-3 border-0">
        <form action="" method="post">
            <div class="text-muted mb-3">
                Informations personnelles du client
            </div>
            <div class="row">
                <!-- Préfixe -->
                <div class="col-md-4 mb-3">
                    <label>Préfixe <span class="text-danger">*</span></label>
                    <select name="prefixe" required class="form-control shadow-none select-custom">
                        <option disabled <?= empty($dossier['prefixe']) ? 'selected' : '' ?>>Choisir une option</option>
                        <option value="Mlle" <?= (isset($dossier['prefixe']) && $dossier['prefixe'] === 'Mlle') ? 'selected' : '' ?>>Mlle</option>
                        <option value="M" <?= (isset($dossier['prefixe']) && $dossier['prefixe'] === 'M') ? 'selected' : '' ?>>M</option>
                        <option value="Mme" <?= (isset($dossier['prefixe']) && $dossier['prefixe'] === 'Mme') ? 'selected' : '' ?>>Mme</option>
                    </select>
                </div>
                <!-- Nom complet -->
                <div class="col-md-4 mb-3">
                    <label>Nom complet <span class="text-danger">*</span></label>
                    <input type="text" name="nom_complet" class="form-control shadow-none" required value="<?= htmlspecialchars($dossier['nom_complet'] ?? '') ?>">
                    <input type="hidden" name="uuid" class="form-control shadow-none" required value="<?= htmlspecialchars($dossier['uuid'] ?? '') ?>">
                </div>
                <!-- Profession -->
                <div class="col-md-4 mb-3">
                    <label>Profession <span class="text-danger">*</span></label>
                    <input type="text" name="profession" class="form-control shadow-none" required value="<?= htmlspecialchars($dossier['profession'] ?? '') ?>">
                </div>
                <!-- N° CNI -->
                <div class="col-md-4 mb-3">
                    <label>N° CNI <span class="text-danger">*</span></label>
                    <input type="text" name="cni" class="form-control shadow-none" required value="<?= htmlspecialchars($dossier['cni'] ?? '') ?>">
                </div>
                <!-- Téléphone -->
                <div class="col-md-4 mb-3">
                    <label>N° Téléphone <span class="text-danger">*</span></label>
                    <input type="tel" name="telephone" class="form-control shadow-none" required value="<?= htmlspecialchars($dossier['telephone'] ?? '') ?>">
                </div>
                <!-- Mail -->
                <div class="col-md-4 mb-3">
                    <label>Mail <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control shadow-none" required value="<?= htmlspecialchars($dossier['email'] ?? '') ?>">
                </div>
            </div>

            <div class="text-muted mt-4 mb-3">
                Veuillez cocher l'une des cases ci-dessous
            </div>
            <div class="row">
                <?php
                // Liste des prestations possibles
                $allPrestations = [
                    "Prestations sur achat terrain",
                    "Prestations sur location terrain",
                    "Prestations sur gestion terrain",
                    "Service de nettoyage",
                    "Service de rénovation",
                    "Clé en main",
                    "Service de déménagement",
                    "Projet location/construction long terme",
                    "Autres prestations"
                ];
                foreach ($allPrestations as $prest) {
                    $checked = in_array($prest, $prestations) ? 'checked' : '';
                    // generate id from value for label
                    $id = strtolower(str_replace([' ', '/'], '-', $prest));
                    echo '<div class="col-md-4 mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input fs-3" type="checkbox" id="'. $id .'" name="prestations[]" value="'. htmlspecialchars($prest) .'" '. $checked .'>
                            <label class="form-check-label" for="'. $id .'">'. htmlspecialchars($prest) .'</label>
                        </div>
                    </div>';
                }
                ?>
            </div>

            <div class="text-muted mb-3">Bien vouloir détailler la prestation</div>
            <div class="mb-3">
                <label>Description <span class="text-danger">*</span></label>
                <textarea name="description" class="form-control shadow-none" rows="5" required><?= htmlspecialchars($dossier['description'] ?? '') ?></textarea>
            </div>

            <div class="text-muted mt-4 mb-3">
                La visite des lieux est soumise à ouverture d'un dossier dont les montants varient selon les cas suivants :
            </div>

<div class="row">
    <!-- Choix des conditions -->
    <div class="col-md-3 mb-3">
        <label>Conditions <span class="text-danger">*</span></label>
        <select required class="form-control shadow-none select-custom" id="conditions-select" name="condition_type">
            <option selected disabled>Choisir une option</option>
            <option value="Achat Terrain">Achat Terrain</option>
            <option value="Achat Maison">Achat Maison</option>
            <option value="Location">Location</option>
            <option value="Autres prestations">Autres prestations</option>
        </select>
    </div>

    <!-- Sous-options selon la prestation -->
    <div class="col-md-3 mb-3">
        <div id="details-prestation">
            <div id="achat-terrain-details" class="details-option" style="display:none;">
                <label for="achat-terrain-option">Achat Terrain</label>
                <select class="form-control shadow-none select-custom" id="achat-terrain-option" name="option_visite">
                    <option disabled selected>Choisir une option</option>
                    <option>Milieu urbain</option>
                    <option>Milieu rural</option>
                </select>
            </div>

            <div id="achat-maison-details" class="details-option" style="display:none;">
                <label for="achat-maison-option">Achat Maison</label>
                <select class="form-control shadow-none select-custom" id="achat-maison-option" name="option_visite">
                    <option disabled selected>Choisir une option</option>
                    <option>Milieu urbain</option>
                    <option>Milieu rural</option>
                </select>
            </div>

            <div id="location-details" class="details-option" style="display:none;">
                <label for="location-option">Location</label>
                <select class="form-control shadow-none select-custom" id="location-option" name="option_visite">
                    <option disabled selected>Choisir une option</option>
                    <option>Chambre / Studio</option>
                    <option>Appartement / Villa</option>
                    <option>Duplex</option>
                    <option>Espace commercial</option>
                </select>
            </div>

            <div id="autres-details" class="details-option" style="display:none;">
                <label for="autres-option">Autres prestations</label>
                <select class="form-control shadow-none select-custom" id="autres-option" name="option_visite">
                    <option selected>Sur négociation</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Montant à choisir ou saisir -->
    <div class="col-md-4 mb-3" id="montant-block" style="display:none;">
        <label id="montant-label">Choisir le montant <span class="text-danger">*</span></label>

        <!-- Sélection du montant -->
        <select id="montant-select" name="frais_ouverture" class="form-control shadow-none select-custom">
            <option selected disabled>Choisir une option</option>
            <option>5 000</option>
            <option>10 000</option>
            <option>15 000</option>
            <option>20 000</option>
            <option>50 000</option>
            <option>100 000</option>
        </select>

        <!-- Champ pour négociation -->
        <input type="text" id="montant-input" name="frais_ouverture" class="form-control shadow-none" placeholder="Entrer le montant négocié" style="display:none;">
    </div>
</div>

<!-- Bouton de soumission -->
<button type="submit" name="submit" class="btn btn-primary">Soumettre</button>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const conditionSelect = document.getElementById("conditions-select");
    const detailsOptions = document.querySelectorAll("#details-prestation .details-option");
    const montantBlock = document.getElementById("montant-block");
    const montantSelect = document.getElementById("montant-select");
    const montantInput = document.getElementById("montant-input");

    // Fonction de mise à jour de l'affichage
    function updateDetailsVisibility() {
        // Masquer tous les détails
        detailsOptions.forEach(div => {
            div.style.display = "none";
            const select = div.querySelector("select");
            if (select) select.disabled = true;
        });

        // Masquer montant
        montantBlock.style.display = "none";
        montantSelect.style.display = "none";
        montantInput.style.display = "none";

        // Afficher en fonction de la sélection
        switch (conditionSelect.value) {
             case "Achat Terrain":
                document.getElementById("achat-terrain-details").style.display = "block";
                document.getElementById("achat-terrain-option").disabled = false;
                montantSelect.style.display = "block";
                montantBlock.style.display = "block";
                break;

            case "Achat Maison":
                document.getElementById("achat-maison-details").style.display = "block";
                document.getElementById("achat-maison-option").disabled = false;
                montantSelect.style.display = "block";
                montantBlock.style.display = "block";
                break;

            case "Location":
                document.getElementById("location-details").style.display = "block";
                document.getElementById("location-option").disabled = false;
                montantSelect.style.display = "block";
                montantBlock.style.display = "block";
                break;

            case "Autres":
                document.getElementById("autres-details").style.display = "block";
                document.getElementById("autres-option").disabled = false;
                montantInput.style.display = "block"; // Champ de saisie visible
                montantBlock.style.display = "block";
                break;
        }
    }

    // Initialiser à l'ouverture
    updateDetailsVisibility();

    // Mettre à jour au changement de la sélection
    conditionSelect.addEventListener("change", updateDetailsVisibility);
});
</script>


































