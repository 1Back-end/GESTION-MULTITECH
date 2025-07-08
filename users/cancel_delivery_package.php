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
    <?php include("process_cancel_delivery.php"); ?>
    <?php if (!empty($erreur)) : ?>
        <div class="alert alert-danger text-center border-0 rounded-0"><?= htmlspecialchars($erreur) ?></div>
    <?php elseif (!empty($success)) : ?>
        <div class="alert alert-success text-center border-0 rounded-0"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>
</div>

<?php if ($package): ?>
 <div class="col-md-6 col-sm-12 mb-3">
    <div class="card shadow border-0 rounded-3 p-3">
        <p class="mb-3 text-justify">
            Vous êtes sur le point d'annuler la livraison du colis. Pour finaliser cette opération, vous devez saisir la raison de l'annulation.
        </p>
        <form method="POST" class="needs-validation" novalidate>
            <input type="hidden" name="package_uuid" value="<?= htmlspecialchars($package['uuid']) ?>">

            <div class="mb-3">
                <label for="">Entrer la raison <span class="text-danger">*</span></label>
                <textarea name="reason_cancel_delivery" class="form-control shadow-none" rows="5" required></textarea>
            </div>
            <div class="mb-3 d-flex justify-content-between">
                <a href="package_agencies.php" class="btn btn-outline-secondary me-2 rounded-0">Annuler</a>
                <button type="submit" name="submit" class="btn btn-primary border-0 rounded-0 shadow-none">Enregistrer</button>
            </div>
        </form>
    </div>
</div>
<?php endif; ?>

<script>
(() => {
  'use strict'

  // Validation Bootstrap
  const forms = document.querySelectorAll('.needs-validation')
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
