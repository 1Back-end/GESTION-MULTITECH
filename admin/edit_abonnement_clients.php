<?php include("../include/menu.php"); ?>

<?php
include("../database/connexion.php");

if (!isset($_GET['uuid'])) {
    header('Location: abonnement_clients.php?message=' . urlencode('Client non spécifié.') . '&type=warning');
    exit();
}

$uuid = $_GET['uuid'];

// Récupération des données du client
$sql = "SELECT * FROM clients_abonnes WHERE uuid = :uuid AND is_deleted = 0 LIMIT 1";
$stmt = $connexion->prepare($sql);
$stmt->bindParam(':uuid', $uuid, PDO::PARAM_STR);
$stmt->execute();
$clients_abonne = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$clients_abonne) {
    header('Location: abonnement_clients.php?message=' . urlencode('Client non trouvé.') . '&type=warning');
    exit();
}
?>

<div class="main-container mt-3 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card shadow border-0 rounded-0 p-3">
            <div class="text-center">
                <h5 class="text-uppercase">Modifier un client abonné</h5>
            </div>
        </div>
</div>

<div class="col-md-12 col-sm-12 mb-3">
    <?php include("process_edit_abonnement_clients.php"); ?>
    <?php if ($erreur): ?>
    <div class="alert alert-danger text-center border-0 rounded-0"><?= $erreur ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="alert alert-success text-center border-0 rounded-0"><?= $success ?></div>
    <?php endif; ?>
</div>

<div class="col-lg-12 col-sm-12 mb-3">
    <div class="card shadow border-0 rounded-0 p-3">
        <form action="" method="post" class="needs-validation" novalidate>
            <div class="row">
                <div class="col-lg-6 col-sm-12 mb-3">
                    <div class="mb-3">
                        <label>Prénom <span class="text-danger">*</span></label>
                        <input type="text" name="firstname" class="form-control shadow-none" value="<?= htmlspecialchars($clients_abonne['firstname']) ?>" required>
                        <div class="invalid-feedback">Ce champ est requis.</div>
                    </div>

                    <div class="mb-3">
                        <label>Nom <span class="text-danger">*</span></label>
                        <input type="text" name="lastname" class="form-control shadow-none" value="<?= htmlspecialchars($clients_abonne['lastname']) ?>" required>
                        <div class="invalid-feedback">Ce champ est requis.</div>
                    </div>

                    <div class="mb-3">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control shadow-none" value="<?= htmlspecialchars($clients_abonne['email']) ?>" required>
                        <div class="invalid-feedback">Veuillez entrer une adresse email valide.</div>
                    </div>

                    <div class="mb-3">
                        <label>Numéro de téléphone <span class="text-danger">*</span></label>
                        <input type="text" name="tel1" class="form-control shadow-none" value="<?= htmlspecialchars($clients_abonne['tel1']) ?>" required>
                        <div class="invalid-feedback">Ce champ est requis.</div>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12 mb-3">
                    <div class="mb-3">
                        <label>Second Numéro de téléphone <span class="text-danger">*</span></label>
                        <input type="text" name="tel2" class="form-control shadow-none" value="<?= htmlspecialchars($clients_abonne['tel2']) ?>" required>
                        <div class="invalid-feedback">Ce champ est requis.</div>
                    </div>

                    <div class="mb-3">
                        <label>Adresse <span class="text-danger">*</span></label>
                        <input type="text" name="address" class="form-control shadow-none" value="<?= htmlspecialchars($clients_abonne['address']) ?>" required>
                        <div class="invalid-feedback">Ce champ est requis.</div>
                    </div>

                    <div class="mb-3">
                        <label>CNI <span class="text-danger">*</span></label>
                        <input type="text" name="cni_number" class="form-control shadow-none" value="<?= htmlspecialchars($clients_abonne['cni_number']) ?>" required>
                        <div class="invalid-feedback">Ce champ est requis.</div>
                    </div>

                    <div class="mb-3">
                        <label>Abonnement Mensuel <span class="text-danger">*</span></label>
                        <input type="number" name="price_for_abonnement" min="0" class="form-control shadow-none" value="<?= htmlspecialchars($clients_abonne['price_for_abonnement']) ?>" required>
                        <div class="invalid-feedback">Veuillez entrer un montant valide.</div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" name="submit" class="btn btn-customize text-white shadow-none border-0 rounded-0">Enregistrer</button>
                <a href="abonnement_clients.php" class="btn btn-secondary shadow-none border-0 rounded-0">Annuler</a>
            </div>
        </form>
    </div>
</div>

<script>
  (function () {
    'use strict'
    const forms = document.querySelectorAll('.needs-validation')
    Array.from(forms).forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }
        form.classList.add('was-validated')
      }, false)
    })
  })()
</script>
