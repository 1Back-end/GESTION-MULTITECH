<?php include("../include/menu.php"); ?>
<?php include("../fonction/fonction.php"); ?>

<div class="main-container mt-3 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card-box p-3">
            <div class="text-center">
                <h5 class="text-uppercase">Ajouter un propriétaire</h5>
            </div>
        </div>
    </div>
<div class="col-md-12 col-sm-12 mb-3">
    <div class="card-box p-3">
        <form action="" method="post">
            <div class="row">
                <div class="col-md-6 col-sm-12 mb-3">
                    <div class="mb-3">
                    <label for="">Nom <span class="text-danger">*</span></label>
                    <input type="text" name="first_name"  class="form-control shadow-none" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Numéro de téléphone <span class="text-danger">*</span></label>
                        <input type="text" name="phone_number"  class="form-control shadow-none" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Nationalité <span class="text-danger">*</span></label>
                        <input type="text" name="nationality"  class="form-control shadow-none" required>
                    </div>
                    <div class="mb-3">
                    <div class="mb-3">
                            <label for="type_chambre">Type propriété <span class="text-danger">*</span></label>
                            <select name="type_chambre" id="type_chambre" required class="shadow-none form-control select-custom">
                                <option disabled selected>Veuillez choisir une option</option>
                                <?php foreach ($typesLocations as $typesLocation): ?>
                                    <option value="<?php echo htmlspecialchars($typesLocation); ?>">
                                        <?php echo htmlspecialchars($typesLocation); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 mb-3">
                    <div class="mb-3">
                    <label for="">Prénom <span class="text-danger">*</span></label>
                    <input type="text" name="last_name"  class="form-control shadow-none" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Numéro CNI <span class="text-danger">*</span></label>
                        <input type="text" name="cni"  class="form-control shadow-none" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Résidence <span class="text-danger">*</span></label>
                        <input type="text" name="residence"  class="form-control shadow-none" required>
                </div>
                <div class="mb-3">
                    <label for="">Localisation propriété <span class="text-danger">*</span></label>
                    <input type="text" name="location"  class="form-control shadow-none" required>
                </div>
            </div>
            </div>

            <div class="mb-3">
                <label for="">Description <span class="text-danger">*</span></label>
                <textarea name="description" id="description"rows="5" class="form-control shadow-none" required></textarea>
            </div>
            <div class="d-flex justify-content-between">
            <button type="submit" name="submit" class="btn btn-customize text-white shadow-none">Enregistrer</button>
            <button type="reset" class="btn btn-secondary">Annuler</button>
        </div>
        </form>
   </div>
</div>