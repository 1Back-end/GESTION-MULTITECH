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
    <div class="col-md-4 mb-3">
        <label>Conditions <span class="text-danger">*</span></label>
        <select required class="form-control shadow-none select-custom" id="conditions-select" name="condition_type">
            <option disabled <?= empty($dossier['condition_type']) ? 'selected' : '' ?>>Choisir une option</option>
            <option value="Achat" <?= (isset($dossier['condition_type']) && $dossier['condition_type'] === 'Achat') ? 'selected' : '' ?>>Achat terrain ou maison</option>
            <option value="Location" <?= (isset($dossier['condition_type']) && $dossier['condition_type'] === 'Location') ? 'selected' : '' ?>>Location</option>
            <option value="Autres" <?= (isset($dossier['condition_type']) && $dossier['condition_type'] === 'Autres') ? 'selected' : '' ?>>Autres prestations</option>
        </select>
    </div>
    <div class="col-md-4 mb-3">
        <div id="details-prestation">
            <!-- Achat details -->
            <div id="achat-details" class="details-option" style="display:none;">
                <label for="achat-option">Achat terrain ou maison</label>
                <select class="form-control shadow-none select-custom" id="achat-option" name="option_visite">
                    <option disabled <?= (empty($dossier['option_visite']) || 
                        (!str_starts_with($dossier['option_visite'], 'Milieu urbain') 
                        && !str_starts_with($dossier['option_visite'], 'Milieu rural'))) ? 'selected' : '' ?>>Choisir une option</option>
                    <option value="Milieu urbain - 20 000 FCFA" <?= (isset($dossier['option_visite']) && strpos($dossier['option_visite'], 'Milieu urbain') === 0) ? 'selected' : '' ?>>Milieu urbain - 20 000 FCFA</option>
                    <option value="Milieu rural - 10 000 FCFA" <?= (isset($dossier['option_visite']) && strpos($dossier['option_visite'], 'Milieu rural') === 0) ? 'selected' : '' ?>>Milieu rural - 10 000 FCFA</option>
                </select>
            </div>

            <!-- Location details -->
            <div id="location-details" class="details-option" style="display:none;">
                <label for="location-option">Location</label>
                <select class="form-control shadow-none select-custom" id="location-option" name="option_visite">
                    <option disabled <?= (empty($dossier['option_visite']) || 
                        !preg_match('/^(Chambre \/ Studio|Appartement \/ Villa|Duplex|Espace commercial)/', $dossier['option_visite'])) ? 'selected' : '' ?>>Choisir une option</option>
                    <option value="Chambre / Studio - 5 000 FCFA" <?= (isset($dossier['option_visite']) && strpos($dossier['option_visite'], 'Chambre / Studio') === 0) ? 'selected' : '' ?>>Chambre / Studio - 5 000 FCFA</option>
                    <option value="Appartement / Villa - 10 000 FCFA" <?= (isset($dossier['option_visite']) && strpos($dossier['option_visite'], 'Appartement / Villa') === 0) ? 'selected' : '' ?>>Appartement / Villa - 10 000 FCFA</option>
                    <option value="Duplex - 15 000 FCFA" <?= (isset($dossier['option_visite']) && strpos($dossier['option_visite'], 'Duplex') === 0) ? 'selected' : '' ?>>Duplex - 15 000 FCFA</option>
                    <option value="Espace commercial - 15 000 FCFA" <?= (isset($dossier['option_visite']) && strpos($dossier['option_visite'], 'Espace commercial') === 0) ? 'selected' : '' ?>>Espace commercial - 15 000 FCFA</option>
                </select>
            </div>

            <!-- Autres prestations -->
            <div id="autres-details" class="details-option" style="display:none;">
                <label for="autres-option">Autres prestations</label>
                <select class="form-control shadow-none select-custom" id="autres-option" name="option_visite">
                    <option selected>Sur négociation</option>
                </select>
            </div>
        </div>
    </div>
</div>

            <button type="submit" name="submit" class="btn btn-primary">Soumettre</button>
        </form>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const conditionSelect = document.getElementById("conditions-select");
    const detailsOptions = document.querySelectorAll("#details-prestation .details-option");

    function updateDetailsVisibility() {
        detailsOptions.forEach(div => {
            div.style.display = "none";
            const select = div.querySelector("select");
            if (select) select.disabled = true;
        });

        switch (conditionSelect.value) {
            case "Achat":
                document.getElementById("achat-details").style.display = "block";
                document.getElementById("achat-option").disabled = false;
                break;
            case "Location":
                document.getElementById("location-details").style.display = "block";
                document.getElementById("location-option").disabled = false;
                break;
            case "Autres":
                document.getElementById("autres-details").style.display = "block";
                document.getElementById("autres-option").disabled = false;
                break;
            default:
                // aucun select actif
                break;
        }
    }

    // Initialisation au chargement (pour afficher la bonne option si déjà sélectionnée)
    updateDetailsVisibility();

    // Au changement de la sélection
    conditionSelect.addEventListener("change", updateDetailsVisibility);
});
</script>
