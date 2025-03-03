<?php include("../include/menu.php"); ?>

<div class="main-container mt-3 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card-box p-3">
            <div class="text-center">
                <h5 class="text-uppercase">Ajouter une vente</h5>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-sm-12 mb-3">
    <?php include("process_add_client.php"); ?>
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
                <select name="type_vente" required class="shadow-none form-control select-custom" id="type_vente">
                <option disabled selected>Veuillez choisir une option</option>
                <option>Plat</option>
                <option >Boisson</option>
                </select>
                </div>
                
                <div class="mb-3">
                    <label for="">Nom (plat ou boisson)<span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control shadow-none" required>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 mb-3">
                <div class="mb-3">
                    <label for="">Quantite <span class="text-danger">*</span></label>
                    <input type="text" name="qte" class="form-control shadow-none" required>
                </div>

                <div class="mb-3">
                    <label for="">prix unitaire<span class="text-danger">*</span></label>
                    <input type="text" name="address" class="form-control shadow-none" required>
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