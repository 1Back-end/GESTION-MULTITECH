<?php include("../include/menu.php"); ?>
<?php include("fonction.php");?>

<div class="main-container mt-3 pb-5">
    <?php if ($motels_name): ?>
        <h4 class="text-uppercase">Bienvenue au motel <?php echo htmlspecialchars($motels_name); ?></h4>
    <?php else: ?>
        <h4 class="text-uppercase">Aucun motel assigné.</h4>
    <?php endif; ?>
</div>
