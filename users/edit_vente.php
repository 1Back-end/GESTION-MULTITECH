<?php include("../include/menu.php"); ?>

<?php
include("../database/connexion.php");
$erreur = "";
$success = "";
// Vérification si l'ID est passé dans l'URL
if (isset($_GET["id"])) {
    $id_vente = $_GET["id"];
    
    // Préparer la requête pour récupérer la vente par son ID
    $requete = $connexion->prepare("SELECT * FROM reservation_menu WHERE id = ?");
    $requete->execute([$id_vente]);
    $vente = $requete->fetch();
}

?>


<div class="main-container mt-3 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card-box p-3">
            <div class="text-center">
                <h5 class="text-uppercase">Modifier la vente</h5>
            </div>
        </div>
    </div>

<div class="col-md-12 col-sm-12 mb-3">
        <?php include("process_update_vente.php");?>
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
            <!-- ID caché de la vente -->
            <input type="hidden" name="id_vente" value="<?php echo htmlspecialchars($id_vente); ?>">
            <!-- Formulaire de modification -->
            <div class="row">
                <div class="col-md-6 col-sm-12 mb-3">
                    <div class="mb-3">
                        <label for="type_vente">Type de vente <span class="text-danger">*</span></label>
                        <select name="type_vente" required class="shadow-none form-control select-custom" id="type_vente">
                            <option disabled>Veuillez choisir une option</option>
                            <option value="Plat" <?php echo ($vente['type'] == "Plat") ? "selected" : ""; ?>>Plat</option>
                            <option value="Boisson" <?php echo ($vente['type'] == "Boisson") ? "selected" : ""; ?>>Boisson</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="name">Nom (plat ou boisson) <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control shadow-none" required value="<?php echo htmlspecialchars($vente['name']); ?>">
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 mb-3">
                    <div class="mb-3">
                        <label for="qte">Quantité <span class="text-danger">*</span></label>
                        <input type="number" name="qte" min="0" class="form-control shadow-none" required value="<?php echo htmlspecialchars($vente['quantity']); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="price">Prix unitaire <span class="text-danger">*</span></label>
                        <input type="number" min="0" name="price" class="form-control shadow-none" required value="<?php echo htmlspecialchars($vente['price']); ?>">
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
