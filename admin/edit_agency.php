<?php include("../include/menu.php"); ?>
<?php
require_once('../fonction/fonction.php');

$chef_agences = get_all_users_where_role_is_chef_agence($connexion);
?>
<div class="main-container mt-3 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card shadow border-0 rounded-0 p-3">
            <div class="text-center">
                <h5 class="text-uppercase">Modifier  l'agence</h5>
            </div>
        </div>
</div>


<?php
include("../database/connexion.php");

if (!isset($_GET['uuid'])) {
    header('Location: list_of_agencies.php?message=' . urlencode('Agence non spécifié.') . '&type=warning');
    exit();
}

$uuid = $_GET['uuid'];

// Récupération des données du client
$sql = "SELECT * FROM main_agencies WHERE uuid = :uuid AND is_deleted = 0 LIMIT 1";
$stmt = $connexion->prepare($sql);
$stmt->bindParam(':uuid', $uuid, PDO::PARAM_STR);
$stmt->execute();
$agency = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$agency) {
    header('Location: list_of_agencies.php?message=' . urlencode('Agence non trouvé.') . '&type=warning');
    exit();
}
?>

<div class="col-md-12 col-sm-12 mb-3">
    <?php include("process_edit_agencies.php"); ?>
    <?php if ($erreur): ?>
    <div class="alert alert-danger text-center border-0 rounded-0"><?= $erreur ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="alert alert-success text-center border-0 rounded-0"><?= $success ?></div>
    <?php endif; ?>
</div>



<div class="col-lg-12 col-sm-12 mb-3">
    <div class="card shadow border-0 rounded-0 p-3">
        <form action="" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
            <div class="row">
                <div class="col-lg-6 col-sm-12 mb-3">
                    <div class="mb-3">
                        <label for="">Nom <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control shadow-none" required value="<?= htmlspecialchars($agency['name'] ?? '') ?>">
                        <input type="hidden" name="uuid" class="form-control shadow-none" required value="<?= htmlspecialchars($agency['uuid'] ?? '') ?>">
                        <div class="invalid-feedback">Ce champ est requis.</div>
                    </div>

                    <div class="mb-3">
                        <label for="">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control shadow-none" required value="<?= htmlspecialchars($agency['email'] ?? '') ?>">
                        <div class="invalid-feedback">Ce champ est requis.</div>
                    </div>

                    <div class="mb-3">
                        <label for="">Région <span class="text-danger">*</span></label>
                        <input type="text" name="region" class="form-control shadow-none" required value="<?= htmlspecialchars($agency['region'] ?? '') ?>">
                        <div class="invalid-feedback">Ce champ est requis.</div>
                    </div>
                    <div class="mb-3">
                        <label for="">Ville <span class="text-danger">*</span></label>
                        <input type="text" name="city" class="form-control shadow-none" required value="<?= htmlspecialchars($agency['city'] ?? '') ?>">
                        <div class="invalid-feedback">Ce champ est requis.</div>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12 mb-3">
                    

                    <div class="mb-3">
                        <label for="">Numéro de téléphone <span class="text-danger">*</span></label>
                        <input type="tel" name="phone" class="form-control shadow-none" required value="<?= htmlspecialchars($agency['phone'] ?? '') ?>">
                        <div class="invalid-feedback">Ce champ est requis.</div>
                    </div>

                    <div class="mb-3">
                        <label for="">Logo <span class="text-danger">*</span></label>
                        <input type="file" name="logo" class="form-control shadow-none">
                        <?php if (!empty($agency['logo'])): ?>
                            <small class="text-muted">Logo actuel : <?= htmlspecialchars($agency['logo']) ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="manager_uuid" class="form-label">Chef d'agence</label>
                        <select class="shadow-none form-control select-custom" name="manager_uuid" required>
                            <option value="">-- Sélectionnez un chef d'agence --</option>
                            <?php foreach ($chef_agences as $chef_agence): ?>
                                <option value="<?= htmlspecialchars($chef_agence['id']) ?>"
                                    <?= $chef_agence['id'] == $agency['manager_uuid'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($chef_agence['first_name'] . ' ' . $chef_agence['last_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">Ce champ est requis.</div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" name="submit" class="btn btn-customize text-white shadow-none border-0 rounded-0">Enregistrer</button>
                <a href="list_of_agencies.php" class="btn btn-secondary shadow-none border-0 rounded-0">Annuler</a>
            </div>
        </form>
    </div>
</div>
