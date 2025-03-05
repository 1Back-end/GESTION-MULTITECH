<?php include("../include/menu.php"); ?>
<?php include("../fonction/fonction.php");?>
<div class="main-container mt-3 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card-box p-3">
            <div class="text-center">
                <h5 class="text-uppercase">modifier un propriétaire</h5>
            </div>
        </div>
    </div>
    <?php
    include("../database/connexion.php");
    $id = $_GET["id"];
    $stmt = $connexion->prepare("SELECT * FROM owner WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $resultat = $stmt->fetch();
    ?>
    <div class="col-md-12 col-sm-12 mb-3">
    <?php include("process_update_owner.php"); ?>
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
                            <label for="">Nom <span class="text-danger">*</span></label>
                            <input type="text" name="first_name" class="form-control shadow-none" value="<?php echo htmlspecialchars($resultat['first_name']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="">Numéro de téléphone <span class="text-danger">*</span></label>
                            <input type="text" name="phone_number" class="form-control shadow-none" value="<?php echo htmlspecialchars($resultat['phone_number']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="">Nationalité <span class="text-danger">*</span></label>
                            <input type="text" name="nationality" class="form-control shadow-none" value="<?php echo htmlspecialchars($resultat['nationality']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="type_property_type">Type propriété <span class="text-danger">*</span></label>
                            <select name="property_type" id="property_type" required class="shadow-none form-control select-custom">
                                <option disabled selected>Veuillez choisir une option</option>
                                <?php foreach ($typesLocations as $typesLocation): ?>
                                    <option value="<?php echo htmlspecialchars($typesLocation); ?>" <?php echo ($resultat['property_type'] == $typesLocation) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($typesLocation); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        <div class="mb-3">
                            <label for="">Prénom <span class="text-danger">*</span></label>
                            <input type="text" name="last_name" class="form-control shadow-none" value="<?php echo htmlspecialchars($resultat['last_name']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="">Numéro CNI <span class="text-danger">*</span></label>
                            <input type="text" name="id_number" class="form-control shadow-none" value="<?php echo htmlspecialchars($resultat['id_number']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="">Résidence <span class="text-danger">*</span></label>
                            <input type="text" name="residence_location" class="form-control shadow-none" value="<?php echo htmlspecialchars($resultat['residence_location']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="">Localisation propriété <span class="text-danger">*</span></label>
                            <input type="text" name="property_location" class="form-control shadow-none" value="<?php echo htmlspecialchars($resultat['property_location']); ?>" required>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="">Description <span class="text-danger">*</span></label>
                    <textarea name="details" id="description" rows="5" class="form-control shadow-none" required><?php echo htmlspecialchars($resultat['details']); ?></textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" name="submit" class="btn btn-customize text-white shadow-none">Modifier</button>
                    <button type="reset" class="btn btn-secondary">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>
