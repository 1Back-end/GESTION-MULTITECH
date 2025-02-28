<?php include("../include/menu.php"); ?>

<div class="main-container mt-3 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card-box p-3">
            <div class="text-center">
                <h5 class="text-uppercase">Ajouter un utilisateur</h5>
            </div>
        </div>
    </div>

<div class="col-md-12 col-sm-12 mb-3">
    <?php include("process_add_user.php"); ?>
    <?php if ($erreur): ?>
    <div class="alert alert-danger text-center border-0"><?= $erreur ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="alert alert-success text-center border-0"><?= $success ?></div>
    <?php endif; ?>
</div>

    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card-box p-3">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6 col-sm-12 mb-3">
                        <div class="mb-3">
                            <label for="first_name">Nom <span class="text-danger">*</span></label>
                            <input type="text" class="form-control shadow-none" id="first_name" name="first_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control shadow-none" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="adresse">Adresse <span class="text-danger">*</span></label>
                            <input type="text" class="form-control shadow-none" id="adresse" name="adresse" required>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 mb-3">
                        <div class="mb-3">
                            <label for="last_name">Prénom <span class="text-danger">*</span></label>
                            <input type="text" class="form-control shadow-none" id="last_name" name="last_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone">Numéro de téléphone <span class="text-danger">*</span></label>
                            <input type="text" class="form-control shadow-none" id="phone" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="photo">Photo</label>
                            <input type="file" class="form-control-file" id="photo" name="photo">
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" name="submit" class="btn btn-customize text-white shadow-none">Enregistrer</button>
                    <button type="reset" class="btn btn-secondary">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>
