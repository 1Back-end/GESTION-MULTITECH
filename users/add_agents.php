<?php 
include("../include/menu.php"); 
include("fonction.php");

?>

<div class="main-container mt-3 pb-5">
<div class="col-lg-12 col-sm-12 mb-3">
    <?php include("process_add_agents.php"); ?>
    <?php if (!empty($erreur)) : ?>
    <div class="alert alert-danger text-center border-0 rounded-0"><?= $erreur ?></div>
<?php elseif (!empty($success)) : ?>
    <div class="alert alert-success text-center border-0 rounded-0"><?= $success ?></div>
<?php endif; ?>
</div>
<div class="col-lg-12 col-sm-12 mb-3">
    <div class="card shadow border-0 p-3">
        <div class="mb-3 text-center">
            <h5 class="text-uppercase">Ajouter un agent dans l'agence <?= htmlspecialchars($agency_name) ?></h5>
           
        </div>
        <hr>
        <div class="mt-3">
            <form action="" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                <div class="row">

                    <div class="col-lg-4 col-sm-12 mb-3">
                        <label for="">Nom complet <span class="text-danger">*</span></label>
                        <input type="text" name="fullname" class="form-control shadow-none" required>
                        <div class="invalid-feedback">
                            Ce champ est requis !
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-12 mb-3">
                        <label for="">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control shadow-none" required>
                        <div class="invalid-feedback">
                            Ce champ est requis !
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12 mb-3">
                        <label for="">Numéro de téléphone <span class="text-danger">*</span></label>
                        <input type="tel" name="phone" class="form-control shadow-none" required>
                        <div class="invalid-feedback">
                            Ce champ est requis !
                        </div>
                    </div>

                     <div class="col-lg-4 col-sm-12 mb-3">
                        <label for="">Second numéro de téléphone <span class="text-danger">*</span></label>
                        <input type="tel" name="phone_2" class="form-control shadow-none">
                    </div>

                    <div class="col-lg-4 col-sm-12 mb-3">
                        <label for="">Numéro de CNI <span class="text-danger">*</span></label>
                        <input type="text" name="cni_number" class="form-control shadow-none" required>
                        <div class="invalid-feedback">
                            Ce champ est requis !
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-12 mb-3">
                        <label for="">Adresse <span class="text-danger">*</span></label>
                        <input type="text" name="address" class="form-control shadow-none" required>
                        <div class="invalid-feedback">
                            Ce champ est requis !
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-12 mb-3">
                        <label for="">Photo</label>
                        <input type="file" name="photo" class="form-control shadow-none">
                    </div>

                    <div class="col-lg-4 col-sm-12 mb-3">
                        <label for="">Role <span class="text-danger">*</span></label>
                        <select name="position" id="position" required class="shadow-none form-control select-custom">
                                <option disabled selected>Veuillez choisir une option</option>
                               <option>Livreur</option>
                               <option>Ramasseur</option>
                               
                        </select>
                    </div>




                </div>

                 <div class="d-flex justify-content-between">
                    <button type="submit" name="submit" class="btn btn-customize text-white shadow-none border-0 rounded-0">Enregistrer</button>
                    <a href="gestion_agencies.php" class="btn btn-secondary border-0 rounded-0">Annuler</a>
                    
                </div>
            </form>
        </div>



    </div>
    
</div>
</div>

<script>
    

// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
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