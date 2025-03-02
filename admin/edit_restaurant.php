<?php include("../include/menu.php"); ?>

<div class="main-container mt-3 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card-box p-3">
            <div class="text-center">
                <h5 class="text-uppercase">modifier un restaurant</h5>
            </div>
        </div>
    </div>


<?php
include("../database/connexion.php");
$id = $_GET["id"];
$stmt = $connexion->prepare("SELECT * FROM restaurant WHERE id = :id");
$stmt->execute(['id' => $id]);
$resultat = $stmt->fetch();
?>

<div class="col-md-12 col-sm-12 mb-3">
    <?php include("process_edit_restaurant.php"); ?>
    <?php if ($erreur): ?>
    <div class="alert alert-danger text-center border-0"><?= $erreur ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="alert alert-success text-center border-0"><?= $success ?></div>
    <?php endif; ?>
</div>

<div class="col-md-12 col-sm-12 mb-3">
    <div class="card-box p-3">
        <form action="" method="post">
            <div class="row">
                <div class="col-md-6 col-sm-12 mb-3">
                    <div class="mb-3">
                        <label for="name">Nom <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control shadow-none" required value="<?= htmlspecialchars($resultat['name']); ?>">
                        <input type="hidden" name="id" id="id" class="form-control shadow-none" required value="<?= htmlspecialchars($resultat['id']); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" class="form-control shadow-none" required value="<?= htmlspecialchars($resultat['contact_email']); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="phone">Téléphone <span class="text-danger">*</span></label>
                        <input type="text" name="phone" id="phone" class="form-control shadow-none" required value="<?= htmlspecialchars($resultat['contact_phone']); ?>">
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 mb-3">
                    <div class="mb-3">
                        <label for="address">Adresse <span class="text-danger">*</span></label>
                        <input type="text" name="address" id="address" class="form-control shadow-none" required value="<?= htmlspecialchars($resultat['address']); ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control shadow-none" rows="5"><?= htmlspecialchars($resultat['description']); ?></textarea>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" name="submit" class="btn btn-customize text-white shadow-none">Modifier</button>
                <button type="reset" class="btn btn-secondary">Annuler</button>
            </div>
        </form>
    </div>
</div>
