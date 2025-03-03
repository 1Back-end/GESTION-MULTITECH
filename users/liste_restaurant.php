<?php include("../include/menu.php"); ?>
<?php include("fonction.php");?>

<div class="main-container mt-3 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
    <div class="card-box p-3">
        <div class="d-flex align-items-center justify-content-between">
            <div class="mr-auto">
            <?php if ($restaurant_name): ?>
        <h5 class="text-uppercase">Bienvenue au restaurant <?php echo htmlspecialchars($restaurant_name); ?></h5>
    <?php else: ?>
        <h4 class="text-uppercase">Aucun restaurant assigné.</h4>
    <?php endif; ?>
            </div>
            <div class="ml-auto">
                <a href="add_vente.php" class="btn btn-customize text-white text-uppercase">
                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    Ajouter
                </a>
            </div>
        </div>
    </div>
    </div>