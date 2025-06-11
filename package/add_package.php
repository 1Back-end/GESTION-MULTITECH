<!DOCTYPE html>
<html lang="en">
<head>
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
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/css/intlTelInput.min.css">

</head>
<body>
<?php
require_once('../fonction/fonction.php');
$agencies = get_active_agency($connexion);
?>

<style>
    .iti__country {
  display: flex;
  align-items: center;
  padding: 5px 10px;
  outline: 0;
  width: 220px;
}
</style>


<div class="container mt-3 pb-5">
    <div class="col-md-8 p-0 mx-auto col-sm-12 mb-3">
    <?php include("process_add_package.php"); ?>
    <?php if ($erreur): ?>
    <div class="alert alert-danger text-center border-0 rounded-0"><?= $erreur ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="alert alert-success text-center border-0 rounded-0"><?= $success ?></div>
    <?php endif; ?>
</div>
    <div class="col-lg-8 p-0 col-sm-12 mb-3 mx-auto">
        <div class="card shadow border-0 rounded-0 p-3">
            <p class="text-muted text-center mb-3">
                Veuillez remplir ces champs pour effectuer l'envoi de votre colis
            </p>

            <form class="needs-validation" method="post" enctype="multipart/form-data" novalidate>

                <!-- Infos Expéditeur -->
                <h6 class="text-primary fs-6 mb-3">Vos informations personnelles</h6>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Nom complet</label>
                        <input type="text" name="sender_name" class="form-control shadow-none" required>
                        <div class="invalid-feedback">Champ requis</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Téléphone</label>
                        <input type="tel" id="phone" name="sender_phone" class="form-control shadow-none" required>
                        <div class="invalid-feedback" id="output">Champ requis</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Adresse</label>
                        <input type="text" name="sender_address" class="form-control shadow-none" required>
                        <div class="invalid-feedback">Champ requis</div>
                    </div>
                </div>

                <!-- Infos Destinataire -->
                <h6 class="text-primary fs-6 mb-3">Informations sur le destinataire</h6>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Nom complet</label>
                        <input type="text" name="recipient_name" class="form-control shadow-none" required>
                        <div class="invalid-feedback">Champ requis</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Téléphone</label>
                        <input type="tel" id="phone1" name="recipient_phone" class="form-control shadow-none" required>
                        <div class="invalid-feedback">Champ requis</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Adresse de livraison</label>
                        <input type="text" name="recipient_address" class="form-control shadow-none" required>
                        <div class="invalid-feedback">Champ requis</div>
                    </div>
                </div>

                <!-- Livraison à domicile -->
                <div class="form-check form-switch mb-4">
                    <input class="form-check-input" name="home_delivery" type="checkbox" id="home_delivery" name="home_delivery" value="1">
                    <label class="form-check-label" for="home_delivery">Livraison à domicile</label>
                </div>

                <!-- Détails colis -->
                <h6 class="text-primary mb-3">Détails du colis</h6>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Nom du colis</label>
                        <input type="text" name="package_name" class="form-control shadow-none" required>
                        <div class="invalid-feedback">Champ requis</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Type de colis</label>
                        <select name="package_type" class="shadow-none form-control select-custom" required>
                            <option value="">-- Sélectionner --</option>
                            <option value="Document">Document</option>
                            <option value="Petit colis">Petit colis</option>
                            <option value="Gros colis">Gros colis</option>
                        </select>
                        <div class="invalid-feedback">Champ requis</div>
                    </div>
                    <div class="col-12 mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control shadow-none" rows="3" required></textarea>
                        <div class="invalid-feedback">Champ requis</div>
                    </div>
                    <div class="col-12 mb-3">
                       <div class="row align-items-center mb-3">
                        <div class="col-md-12">
                            <label>Image du colis</label>
                            <input id="imageInput" type="file" name="image_path" class="form-control shadow-none" accept="image/*" required>
                            <div class="invalid-feedback">Veuillez ajouter une image</div>
                        </div>

                        <div class="col-12 d-flex justify-content-center mt-3">
                            <img id="imagePreview" src="" alt="Prévisualisation image" style="width: 100%; height: 200px; object-fit: contain; border: 1px solid #ddd; padding: 5px; border-radius: 4px;">

                        </div>
                        
                        </div>
                    </div>
                </div>

                <!-- Agence principale -->
                <div class="mb-4">
                        <label>Agence</label>
                        <select name="main_agency_uuid" class="shadow-none form-control select-custom" name="main_agency_uuid" required>
                            <option value="">-- Sélectionner une agence --</option>
                            <?php foreach ($agencies as $agency): ?>
                                <option value="<?= htmlspecialchars($agency['uuid']) ?>">
                                    <?= htmlspecialchars($agency['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">Veuillez choisir une agence</div>
                    </div>

                <!-- Bouton -->
              <div class="d-flex justify-content-between">
                    <a href="../index.php" class="btn btn-outline-secondary me-2 rounded-0">
                        Annuler
                    </a>
                    
                    <button type="submit" name="submit" class="btn btn-primary border-0 rounded-0">Envoyer le colis</button>
             </div>


            </form>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>

<script>
  const input1 = document.querySelector("#phone");
  const input2 = document.querySelector("#phone1");

  // Initialisation pour le champ #phone
  window.intlTelInput(input1, {
    initialCountry: "cm",
    countrySearch: true,
    geoIpLookup: function(success, failure) {
      fetch("https://ipapi.co/json")
        .then(res => res.json())
        .then(data => success(data.country_code))
        .catch(() => success("cm"));
    },
    utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js",
  });

  // Initialisation pour le champ #phone1
  window.intlTelInput(input2, {
    initialCountry: "cm",
    countrySearch: true,
    geoIpLookup: function(success, failure) {
      fetch("https://ipapi.co/json")
        .then(res => res.json())
        .then(data => success(data.country_code))
        .catch(() => success("cm"));
    },
    utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js",
  });
</script>


<script>
  // Bootstrap custom validation
  (function () {
    'use strict';
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  })();
</script>

<script>
  const imageInput = document.getElementById('imageInput');
  const imagePreview = document.getElementById('imagePreview');

  imageInput.addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
      const reader = new FileReader();

      reader.onload = function(e) {
        imagePreview.setAttribute('src', e.target.result);
        imagePreview.style.display = 'block';
      }

      reader.readAsDataURL(file);
    } else {
      imagePreview.setAttribute('src', '');
      imagePreview.style.display = 'none';
    }
  });
</script>

</body>
</html>