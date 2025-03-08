<?php 
include("../include/menu.php"); 
include("fonction.php");

if (isset($_GET["id"])) {
    $id_paiment = $_GET["id"];

}
?>

<div class="main-container mt-3 pb-5">
    <div class="col-md-6 col-sm-12 mb-3">
        <div class="card-box p-3">
            <div class="text-center">
                <h5 class="text-uppercase">Compléter le paiement</h5>
            </div>
    </div>
    </div>
    <div class="col-md-6 col-sm-12 mb-3">
    <?php include("process_complete_paiment.php"); ?>
    <?php if ($erreur): ?>
    <div class="alert alert-danger text-center border-0"><?= $erreur ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="alert alert-success text-center border-0"><?= $success ?></div>
    <?php endif; ?>
</div>
<div class="col-md-6 col-sm-12 mb-3">
    <div class="card-box p-3">
       <form action="" method="post">
       <div class="mb-3">
            <label for="">Montant à compléter <span class="text-danger">*</span></label>
            <input type="text" name="montant" id="montant" class="form-control shadow-none" required>
            <input type="hidden" value="<?php echo $id_paiment;?>" name="id_paiment" id="id_paiment" class="form-control shadow-none" required>

        </div>
        <div class="mb-3">
            <button type="submit" name="submit" class="btn btn-customize text-white text-uppercase">
                Payer <span class="fas fa-credit-card"></span>
            </button>
        </div>
       </form>
    </div>
</div>