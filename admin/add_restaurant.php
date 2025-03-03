<?php include("../include/menu.php"); ?>

<div class="main-container mt-3 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card-box p-3">
            <div class="text-center">
                <h5 class="text-uppercase">Ajouter un retaurant</h5>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-sm-12 mb-3">
    <?php include("process_add_restaurant.php"); ?>
    <?php if ($erreur): ?>
    <div class="alert alert-danger text-center border-0"><?= $erreur ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="alert alert-success text-center border-0"><?= $success ?></div>
    <?php endif; ?>
</div>

<div class="col-md-12  col-sm-12 mb-3">
    <div class="card-box p-3">
    <form action="" method="post">
        <div class="row">
            <div class="col-md-6 col-sm-12 mb-3">
                <div class="mb-3">
                <label for="">Nom <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control shadow-none" required>
                </div>
                <div class="mb-3">
                    <label for="">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control shadow-none" required>
                </div>
                <div class="mb-3">
                    <label for="">Téléphone <span class="text-danger">*</span></label>
                    <input type="text" name="phone" class="form-control shadow-none" required>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 mb-3">
                <div class="mb-3">
                    <label for="">Adresse <span class="text-danger">*</span></label>
                    <input type="text" name="address" class="form-control shadow-none" required>
                </div>
                <div class="mb-3">
                    <label for="">Description</label>
                    <textarea name="description" class="form-control shadow-none" rows="5"></textarea>
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