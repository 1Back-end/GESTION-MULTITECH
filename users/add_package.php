<?php 
include("../include/menu.php");
?>

<div class="main-container mt-3 pb-5">

 <div class="col-md-12 col-sm-12 mb-3">
    <?php include("process_add_package.php"); ?>
    <?php if ($erreur): ?>
    <div class="alert alert-danger text-center border-0 rounded-0"><?= $erreur ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="alert alert-success text-center border-0 rounded-0"><?= $success ?></div>
    <?php endif; ?>
</div>





     <div class="col-lg-12 col-sm-12 mb-3">
        <div class="card shadow border-0 rounded-0 p-3">
            <p class="text-muted text-center mb-3 text-uppercase fw-bold">
                Veuillez remplir ces champs pour effectuer l'enregistrement du colis dans l'
                <?= htmlspecialchars($agency_name) ?>
            </p>

            <hr>

            <form  class="needs-validation" method="post" enctype="multipart/form-data" novalidate>

                <!-- Infos Expéditeur -->
                <h5 class="fs-6 mb-3 text-uppercase">informations personnelles de l'expéditeur</h5>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label>Nom complet <span class="text-danger">*</span></label>
                        <input type="text" name="sender_name" class="form-control shadow-none" required>
                        <div class="invalid-feedback">Champ requis</div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Téléphone <span class="text-danger">*</span></label>
                        <input type="tel" id="phone" name="sender_phone" class="form-control shadow-none" required>
                        <div class="invalid-feedback" id="output">Champ requis</div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Adresse <span class="text-danger">*</span></label>
                        <input type="text" name="sender_address" class="form-control shadow-none" required>
                        <div class="invalid-feedback">Champ requis</div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>N° CNI <span class="text-danger">*</span></label>
                        <input type="text" name="sender_cni" class="form-control shadow-none">
                        <div class="invalid-feedback">Champ requis</div>
                    </div>
                </div>

                <!-- Infos Destinataire -->
                <h5 class="fs-6 text-uppercase mb-3">Informations du destinataire</h5>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label>Nom complet</label>
                        <input type="text" name="recipient_name" class="form-control shadow-none" required>
                        <div class="invalid-feedback">Champ requis</div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Téléphone</label>
                        <input type="tel" id="phone1" name="recipient_phone" class="form-control shadow-none" required>
                        <div class="invalid-feedback">Champ requis</div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Adresse de livraison</label>
                        <input type="text" name="recipient_address" class="form-control shadow-none" required>
                        <div class="invalid-feedback">Champ requis</div>
                    </div>
                   <div class="col-md-3 mb-3">
                        <label>N° CNI <span class="text-danger">*</span></label>
                        <input type="text" name="recipient_cni" class="form-control shadow-none">
                        <div class="invalid-feedback">Champ requis</div>
                    </div>
                </div>

                <!-- Livraison à domicile -->
                <div class="form-check form-switch mb-4">
                    <input class="form-check-input" name="home_delivery" type="checkbox" id="home_delivery" name="home_delivery" value="1">
                    <label class="form-check-label" for="home_delivery">Livraison à domicile</label>
                </div>

                <!-- Détails colis -->
                <h5 class="mb-3 text-uppercase">Détails du colis</h5>
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

                <!-- Bouton -->
              <div class="d-flex justify-content-between">
                    <a href="package_agencies.php" class="btn btn-outline-secondary me-2 rounded-0">
                        Annuler
                    </a>
                    
                    <button  type="submit" name="submit" class="btn btn-primary border-0 rounded-0">Enregistrer le colis</button>
             </div>
            </form>
        </div>
    </div>
</div>


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


<script>
    (() => {
  'use strict'
  const forms = document.querySelectorAll('.needs-validation')
  // Loop over them and prevent submission
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})()
</script>