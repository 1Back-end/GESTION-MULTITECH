<?php
include("../include/menu.php");
include("../database/connexion.php");

// Vérifier la présence du uuid produit dans l'URL
if (!isset($_GET["uuid"])) {
    die("Aucune livraison trouvée.");
}

$uuid = $_GET["uuid"];

// Récupération de la livraison
$stmt = $connexion->prepare("SELECT reference FROM livraisons_products WHERE uuid = :uuid");
$stmt->execute([':uuid' => $uuid]);
$livraison = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$livraison) {
    die("Livraison introuvable.");
}
?>

<div class="main-container mt-5">
     <div class="col-md-6 col-sm-12 mb-3 mx-auto">
    <?php include("process_finaliser_livraison.php"); ?>
    <?php if ($erreur): ?>
    <div class="alert alert-danger text-center border-0 rounded-0"><?= $erreur ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="alert alert-success text-center border-0 rounded-0"><?= $success ?></div>
    <?php endif; ?>
</div>

    <div class="col-lg-6 col-sm-12 mx-auto">
        <div class="card shadow border-0 rounded-0 p-3 py-3">
            
            <div class="mb-3">
                <p class="text-muted" style="text-align:justify;">
                        Vous êtes sur le point de finaliser la livraison <strong><?= htmlspecialchars($livraison['reference']) ?></strong>.  
                        Veuillez saisir le montant exact effectivement perçu pour cette livraison. Ce montant sera enregistré comme preuve de paiement final, et l'état de la livraison sera mis à jour comme <strong>Livré</strong>.
                        <span class="text-muted">Assurez-vous de vérifier le montant avec le livreur avant de valider l'opération.</span>
                </p>
            </div>

            <form action="" method="post" class="needs-validation" novalidate>
                <input type="hidden" name="uuid" value="<?= htmlspecialchars($uuid) ?>">

                <div class="mb-3">
                    <label for="price" class="form-label">Montant à verser</label>
                    <input type="number" class="form-control shadow-none" id="price" name="price_delivery_exactly" required min="0" step="0.01">
                    <div class="invalid-feedback">
                        Veuillez saisir un montant valide.
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="liste_livraisons_products.php" class="btn btn-secondary rounded-0">
                        <i class="fas fa-arrow-left"></i> Retour
                    </a>
                    <button type="submit" name="submit" class="btn btn-success rounded-0">
                        <i class="fas fa-check"></i> Valider
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

