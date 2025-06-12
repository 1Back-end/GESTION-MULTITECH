<?php 

include("../include/menu.php"); 
include("fonction.php");
include("../database/connexion.php");

// Récupérer l'UUID de l'agent
$uuid = $_GET['uuid'] ?? null;
if (!$uuid) {
    // Rediriger si pas d'uuid
    header("Location: gestion_agencies.php?error=UUID manquant");
    exit();
}
// Récupérer l'agence de l'utilisateur connecté
$agency = get_my_agency($connexion, $user_id);
$agency_uuid = $agency['uuid'] ?? null;

// Récupérer les données de l'agent s'il appartient bien à l'agence
$stmt = $connexion->prepare("SELECT * FROM agents_for_agency WHERE uuid = :uuid AND agency_uuid = :agency_uuid AND added_by = :user_id AND is_deleted = 0");
$stmt->execute([
    'uuid' => $uuid,
    'agency_uuid' => $agency_uuid,
    'user_id' => $user_id
]);
$agent = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$agent) {
    header("Location: gestion_agencies.php?error=Agent introuvable ou non autorisé");
    exit();
}
?>

<!-- Ensuite dans ton formulaire, tu pré-remplis les champs avec les données : -->
<div class="main-container mt-3 pb-5 ">


<div class="col-lg-12 col-sm-12 mb-3">
    <?php include("process_edit_agency.php"); ?>
    <?php if (!empty($erreur)) : ?>
    <div class="alert alert-danger text-center border-0 rounded-0"><?= $erreur ?></div>
<?php elseif (!empty($success)) : ?>
    <div class="alert alert-success text-center border-0 rounded-0"><?= $success ?></div>
<?php endif; ?>
</div>

    <div class="col-lg-12 col-sm-12 mb-3">
    <div class="card shadow border-0 p-3">
        <div class="mb-3 text-center">
            <h5 class="text-uppercase">Modifier un agent dans l'agence <?= htmlspecialchars($agency_name) ?></h5>
           
        </div>
        <hr>

    <div class="mt-3">
    <form action="" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
    <input type="hidden" name="uuid" value="<?= htmlspecialchars($agent['uuid']) ?>">
    <div class="row">
        <div class="col-lg-4 col-sm-12 mb-3">
            <label>Nom complet <span class="text-danger">*</span></label>
            <input type="text" name="fullname" class="form-control shadow-none" value="<?= htmlspecialchars($agent['fullname']) ?>" required>
            <div class="invalid-feedback">Ce champ est requis !</div>
        </div>
        <div class="col-lg-4 col-sm-12 mb-3">
            <label>Email <span class="text-danger">*</span></label>
            <input type="email" name="email" class="form-control shadow-none" value="<?= htmlspecialchars($agent['email']) ?>" required>
            <div class="invalid-feedback">Ce champ est requis !</div>
        </div>
        <div class="col-lg-4 col-sm-12 mb-3">
            <label>Numéro de téléphone <span class="text-danger">*</span></label>
            <input type="tel" name="phone" class="form-control shadow-none" value="<?= htmlspecialchars($agent['phone']) ?>" required>
            <div class="invalid-feedback">Ce champ est requis !</div>
        </div>
        <div class="col-lg-4 col-sm-12 mb-3">
            <label>Second numéro de téléphone</label>
            <input type="tel" name="phone_2" class="form-control shadow-none" value="<?= htmlspecialchars($agent['phone_2']) ?>">
        </div>
        <div class="col-lg-4 col-sm-12 mb-3">
            <label>Numéro de CNI <span class="text-danger">*</span></label>
            <input type="text" name="cni_number" class="form-control shadow-none" value="<?= htmlspecialchars($agent['cni_number']) ?>" required>
            <div class="invalid-feedback">Ce champ est requis !</div>
        </div>
        <div class="col-lg-4 col-sm-12 mb-3">
            <label>Adresse <span class="text-danger">*</span></label>
            <input type="text" name="address" class="form-control shadow-none" value="<?= htmlspecialchars($agent['address']) ?>" required>
            <div class="invalid-feedback">Ce champ est requis !</div>
        </div>
        <div class="col-lg-4 col-sm-12 mb-3">
            <label>Photo actuelle</label><br>
            <?php if ($agent['photo']): ?>
                <img src="../uploads/agents/<?= htmlspecialchars($agent['photo']) ?>" alt="Photo agent" style="max-width:150px;">
            <?php else: ?>
                <p>Aucune photo</p>
            <?php endif; ?>
        </div>
        <div class="col-lg-4 col-sm-12 mb-3">
            <label>Changer la photo</label>
            <input type="file" name="photo" class="form-control shadow-none">
        </div>
        <div class="col-lg-4 col-sm-12 mb-3">
            <label>Rôle <span class="text-danger">*</span></label>
            <select name="position" id="position" required class="shadow-none form-control select-custom">
                <option disabled>Veuillez choisir une option</option>
                <option value="Livreur" <?= ($agent['position'] === 'Livreur') ? 'selected' : '' ?>>Livreur</option>
                <option value="Ramasseur" <?= ($agent['position'] === 'Ramasseur') ? 'selected' : '' ?>>Ramasseur</option>
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