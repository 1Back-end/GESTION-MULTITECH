<?php 
include("../include/menu.php");
include("fonction.php");
$agents = get_agents_for_my_agency($connexion, $user_id);
?>


<?php 
include("../database/connexion.php");

$package = null;

if (isset($_GET["uuid"])) {
    $uuid = $_GET["uuid"];

    $stmt = $connexion->prepare("SELECT * FROM packages WHERE uuid = :uuid AND is_deleted = 0");
    $stmt->execute([':uuid' => $uuid]);
    $package = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>


<div class="main-container mt-3 pb-5">

 <div class="col-md-4 col-sm-12 mb-3">
    <div class="card shadow border-0 rounded-3 p-3">
        <p class="mb-3 text-justify">Vous etes sur le d'annuler la livraison du colis N° <strong><?= htmlspecialchars($package['ref']) ?></strong> du <strong>
            <?= date('d/m/Y H:i:s', strtotime($package['created_at'])) ?>
        </strong> comme livrer
            pour finaliser cette opération vous devez saisir le raison de l'annulation
        </p>
        <div class="mb-3">
            <label for="">Entrer la raison <span class="text-danger">*</span></label>
            <textarea name="description" class="form-control shadow-none" rows="3" required></textarea>
        </div>
        <div class="mb-3 d-flex justify-content-between">
            <a href="package_agencies.php" class="btn btn-outline-secondary me-2 rounded-0">
                Annuler
            </a>
            <button type="submit" class="btn btn-primary border-0 rounded-0 shadow-none">
                Enregistrer
            </button>
        </div>
    </div>
</div>


