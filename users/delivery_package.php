<?php 
include("../include/menu.php");
include("fonction.php");
$agents = get_agents_for_my_agency($connexion, $user_id);

?>


<?php 
include("../database/connexion.php");

$package = null;
$erreur = "";
$success = "";

// Récupérer l'UUID depuis GET
if (isset($_GET["uuid"])) {
    $uuid = $_GET["uuid"];

    $stmt = $connexion->prepare("SELECT * FROM packages WHERE uuid = :uuid AND is_deleted = 0");
    $stmt->execute([':uuid' => $uuid]);
    $package = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$package) {
        $erreur = "⚠️ Colis introuvable ou supprimé.";
    }
} else {
    $erreur = "⚠️ Aucun colis spécifié.";
}
?>

<div class="main-container mt-3 pb-5">
<div class="col-lg-6 col-sm-12 mb-3">
    <?php include("process_delivery_packages.php"); ?>
    <?php if (!empty($erreur)) : ?>
    <div class="alert alert-danger text-center border-0 rounded-0"><?= $erreur ?></div>
<?php elseif (!empty($success)) : ?>
    <div class="alert alert-success text-center border-0 rounded-0"><?= $success ?></div>
<?php endif; ?>

</div>
    <div class="col-md-6 col-sm-12 mb-3">
        <div class="card shadow border-0 rounded-3 p-4">
            <div class="text-justify mb-4">
                <strong>Attention !</strong> Vous êtes sur le point de marquer le colis 
                comme livré</span>.<br>
                Pour finaliser cette opération, veuillez sélectionner le livreur ayant effectué cette livraison.
            </div>

            <form method="POST" class="needs-validation" novalidate>
                <input type="hidden" name="package_uuid" value="<?= htmlspecialchars($package['uuid']  ?? '')?>">

                <div class="mb-3">
                    <label for="agent_uuid" class="form-label fw-bold">Choisir un livreur <span class="text-danger">*</span></label>
                    <select name="agent_uuid" id="agent_uuid" class="form-control shadow-none select-custom" required>
                        <option value="">-- Sélectionner --</option>
                        <?php foreach ($agents as $livreur): ?>
                            <option value="<?= htmlspecialchars($livreur['uuid']) ?>">
                                <?= htmlspecialchars($livreur['fullname']) ?>
                            </option>               
                        <?php endforeach; ?>       
                    </select>
                </div>

                <div class="mb-3">
                    <label for="">Montant de la livraison <span class="text-danger">*</span></label>
                    <input type="number" name="amount_delivery" class="form-control shadow-none" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="package_agencies.php" class="btn btn-outline-secondary rounded-0">Annuler</a>
                    <button type="submit" name="submit" class="btn btn-primary rounded-0">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
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