<?php include("../include/menu.php"); ?>

<div class="main-container mt-3 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card-box p-3">
            <div class="text-center">
                <h5 class="text-uppercase">Ouvrir le dossier d'un client</h5>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-sm-12 mb-3">
    <?php include("process_add_dossiers.php"); ?>
    <?php if ($erreur): ?>
    <div class="alert alert-danger text-center border-0"><?= $erreur ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="alert alert-success text-center border-0"><?= $success ?></div>
    <?php endif; ?>
</div>

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
                        <option selected disabled>Choisir une option</option>
                        <option value="Mlle">Mlle</option>
                        <option value="M">M</option>
                        <option value="Mme">Mme</option>
                    </select>
                </div>
                <!-- Nom complet -->
                <div class="col-md-4 mb-3">
                    <label>Nom complet <span class="text-danger">*</span></label>
                    <input type="text" name="nom_complet" class="form-control shadow-none" required>
                </div>
                <!-- Profession -->
                <div class="col-md-4 mb-3">
                    <label>Profession <span class="text-danger">*</span></label>
                    <input type="text" name="profession" class="form-control shadow-none" required>
                </div>
                <!-- N° CNI -->
                <div class="col-md-4 mb-3">
                    <label>N° CNI <span class="text-danger">*</span></label>
                    <input type="text" name="cni" class="form-control shadow-none" required>
                </div>
                <!-- Téléphone -->
                <div class="col-md-4 mb-3">
                    <label>N° Téléphone <span class="text-danger">*</span></label>
                    <input type="tel" name="telephone" class="form-control shadow-none" required>
                </div>
                <!-- Mail -->
                <div class="col-md-4 mb-3">
                    <label>Mail <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control shadow-none" required>
                </div>
            </div>

            <div class="text-muted mt-4 mb-3">
                Veuillez cochez l'une des cases ci-dessous
            </div>
            <div class="row">
                <!-- Cases à cocher -->
                <div class="col-md-4 mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input fs-3" type="checkbox" id="achat" name="prestations[]" value="Prestations sur achat terrain">
                        <label class="form-check-label" for="achat">Prestations sur achat terrain</label>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input fs-3" type="checkbox" id="location" name="prestations[]" value="Prestations sur location terrain">
                        <label class="form-check-label" for="location">Prestations sur location terrain</label>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input fs-3" type="checkbox" id="gestion" name="prestations[]" value="Prestations sur gestion terrain">
                        <label class="form-check-label" for="gestion">Prestations sur gestion terrain</label>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input fs-3" type="checkbox" id="nettoyage" name="prestations[]" value="Service de nettoyage">
                        <label class="form-check-label" for="nettoyage">Service de nettoyage</label>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input fs-3" type="checkbox" id="renovation" name="prestations[]" value="Service de rénovation">
                        <label class="form-check-label" for="renovation">Service de rénovation</label>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input fs-3" type="checkbox" id="cle-en-main" name="prestations[]" value="Clé en main">
                        <label class="form-check-label" for="cle-en-main">Clé en main</label>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input fs-3" type="checkbox" id="deménagement" name="prestations[]" value="Service de déménagement">
                        <label class="form-check-label" for="deménagement">Service de déménagement</label>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input fs-3" type="checkbox" id="projet-long" name="prestations[]" value="Projet location/construction long terme">
                        <label class="form-check-label" for="projet-long">Projet location/construction long terme</label>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input fs-3" type="checkbox" id="autres" name="prestations[]" value="Autres prestations">
                        <label class="form-check-label" for="autres">Autres prestations</label>
                    </div>
                </div>
            </div>

            <div class="text-muted mb-3">Bien vouloir détailler la prestation</div>
            <div class="mb-3">
                <label>Description <span class="text-danger">*</span></label>
                <textarea name="description" class="form-control shadow-none" rows="5" required></textarea>
            </div>

            <div class="text-muted mt-4 mb-3">
                La visite des lieux est soumise à ouverture d'un dossier dont les montants varient selon les cas suivants :
            </div>

            <div class="row">
    <div class="col-md-4 mb-3">
        <label>Conditions <span class="text-danger">*</span></label>
        <select required class="form-control shadow-none select-custom" id="conditions-select" name="condition_type">
            <option selected disabled>Choisir une option</option>
            <option value="Achat">Achat terrain ou maison</option>
            <option value="Location">Location</option>
            <option value="Autres">Autres prestations</option>
        </select>
    </div>
    <div class="col-md-4 mb-3">
        <div id="details-prestation">
            <!-- Sous-options cachées par défaut -->
            <div id="achat-details" class="details-option" style="display:none;">
                <label for="achat-option">Achat terrain ou maison</label>
                <select class="form-control shadow-none select-custom" id="achat-option" name="option_visite">
                    <option disabled selected>Choisir une option</option>
                    <option>Milieu urbain - 20 000 FCFA</option>
                    <option>Milieu rural - 10 000 FCFA</option>
                </select>
            </div>

            <div id="location-details" class="details-option" style="display:none;">
                <label for="location-option">Location</label>
                <select class="form-control shadow-none select-custom" id="location-option" name="option_visite">
                    <option disabled selected>Choisir une option</option>
                    <option>Chambre / Studio - 5 000 FCFA</option>
                    <option>Appartement / Villa - 10 000 FCFA</option>
                    <option>Duplex - 15 000 FCFA</option>
                    <option>Espace commercial - 15 000 FCFA</option>
                </select>
            </div>

            <div id="autres-details" class="details-option" style="display:none;">
                <label for="autres-option">Autres prestations</label>
                <select class="form-control shadow-none select-custom" id="autres-option" name="option_visite">
                    <option selected>Sur négociation</option>
                </select>
            </div>

            <div id="default-details" class="details-option">
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

    // Désactiver tous les selects au chargement
    document.querySelectorAll("#details-prestation select").forEach(sel => sel.disabled = true);

    conditionSelect.addEventListener("change", function () {
        // Masquer toutes les options et désactiver tous les selects
        detailsOptions.forEach(div => {
            div.style.display = "none";
            const select = div.querySelector("select");
            if (select) select.disabled = true;
        });

        // Afficher et activer le bon champ selon la sélection
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
                document.getElementById("default-details").style.display = "block";
        }
    });
});
</script>
