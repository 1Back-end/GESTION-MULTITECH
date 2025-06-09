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
                        <input class="form-check-input fs-3" type="checkbox" id="achat" name="prestations[]" value="Prestations sur achat Immobilière">
                        <label class="form-check-label" for="achat">Prestations sur achat Immobilière</label>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input fs-3" type="checkbox" id="location" name="prestations[]" value="Prestations sur location Immobilière">
                        <label class="form-check-label" for="location">Prestations sur location Immobilière</label>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input fs-3" type="checkbox" id="gestion" name="prestations[]" value="Prestations sur gestion Immobilière">
                        <label class="form-check-label" for="gestion">Prestations sur gestion Immobilière</label>
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
                        <input class="form-check-input fs-3" type="checkbox" id="cle-en-main" name="prestations[]" value="Construction clé en main">
                        <label class="form-check-label" for="cle-en-main">Construction clé en main</label>
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
    <!-- Choix des conditions -->
    <div class="col-md-3 mb-3">
        <label>Conditions <span class="text-danger">*</span></label>
        <select class="form-control shadow-none select-custom" id="conditions-select" name="condition_type" required>
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
                    <option>Chambre</option>
                    <option>Studio</option>
                    <option>Appartement</option>
                    <option>Villa</option>
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
        <label id="montant-label">Entrer le montant <span class="text-danger">*</span></label>
        <input type="text" id="montant-input" name="frais_ouverture" class="form-control shadow-none" placeholder="Entrer le montant">
    </div>
</div>

<!-- Bouton de soumission -->
<button type="submit" name="submit" class="btn btn-primary">Soumettre</button>

<!-- Script JavaScript -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const conditionSelect = document.getElementById("conditions-select");
    const detailsOptions = document.querySelectorAll("#details-prestation .details-option");
    const montantBlock = document.getElementById("montant-block");
    const montantInput = document.getElementById("montant-input");

    // Désactiver tous les selects au départ
    document.querySelectorAll("#details-prestation select").forEach(sel => sel.disabled = true);
    montantBlock.style.display = "none";
    montantInput.style.display = "none";

    conditionSelect.addEventListener("change", function () {
        // Masquer les détails
        detailsOptions.forEach(div => {
            div.style.display = "none";
            const select = div.querySelector("select");
            if (select) select.disabled = true;
        });

        // Masquer montant
        montantBlock.style.display = "none";
        montantInput.style.display = "none";

        // Affichage selon condition
        switch (conditionSelect.value) {
            case "Achat Terrain":
                document.getElementById("achat-terrain-details").style.display = "block";
                document.getElementById("achat-terrain-option").disabled = false;
                montantBlock.style.display = "block";
                montantInput.style.display = "block";
                break;

            case "Achat Maison":
                document.getElementById("achat-maison-details").style.display = "block";
                document.getElementById("achat-maison-option").disabled = false;
                montantBlock.style.display = "block";
                montantInput.style.display = "block";
                break;

            case "Location":
                document.getElementById("location-details").style.display = "block";
                document.getElementById("location-option").disabled = false;
                montantBlock.style.display = "block";
                montantInput.style.display = "block";
                break;

            case "Autres prestations":
                document.getElementById("autres-details").style.display = "block";
                document.getElementById("autres-option").disabled = false;
                montantBlock.style.display = "block";
                montantInput.style.display = "block";
                break;
        }
    });
});
</script>
