<?php
include("../include/menu.php");

?>

<?php
require_once('../database/connexion.php');
require_once('../fonction/fonction.php');

$livreurs = get_all_users_where_role_is_livreur($connexion);
?>
<div class="main-container mt-3 pb-5">
    <div class="col-lg-8 col-sm-12 mb-3 mx-auto">
    <?php include("process_traiter_livraison.php"); ?>
    <?php if ($erreur): ?>
    <div class="alert alert-danger text-center border-0 rounded-0"><?= $erreur ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="alert alert-success text-center border-0 rounded-0"><?= $success ?></div>
    <?php endif; ?>
</div>
    <div class="col-lg-8 col-sm-12 mb-3 mx-auto">
        <div class="card shadow border-0 rounded-0 p-4">

            <h5 class="mb-4">📦 Préparation de la livraison</h5>
            <p class="text-muted">Veuillez remplir les informations ci-dessous pour organiser la livraison du produit.</p>

            <form method="post" class="needs-validation" novalidate>
                <input type="hidden" name="product_uuid" value="<?= htmlspecialchars($_GET['uuid']) ?>">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="recipient_name" class="form-label">Nom du client</label>
                        <input type="text" class="form-control" id="recipient_name" name="recipient_name" required>
                        <div class="invalid-feedback">Veuillez entrer le nom du client.</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">Téléphone</label>
                        <input type="tel" class="form-control" id="phone" name="phone" pattern="^[0-9]{8,15}$" required>
                        <div class="invalid-feedback">Numéro de téléphone invalide.</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="delivery_price" class="form-label">Prix de livraison</label>
                        <input type="number" class="form-control" id="delivery_price" name="delivery_price" min="0" required>
                        <div class="invalid-feedback">Saisir un prix valide.</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="quantity" class="form-label">Quantité à livrer</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
                        <div class="invalid-feedback">Quantité requise.</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="location" class="form-label">Lieu de livraison</label>
                        <input type="text" class="form-control" id="location" name="location" required>
                        <div class="invalid-feedback">Lieu requis.</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="delivery_man" class="form-label">Livreur</label>
                        <select class="shadow-none form-control select-custom" id="delivery_man" name="delivery_man" required>
                            <option value="">-- Sélectionnez un livreur --</option>
                            <?php foreach ($livreurs as $livreur): ?>
                                <option value="<?= htmlspecialchars($livreur['id']) ?>">
                                    <?= htmlspecialchars($livreur['first_name'] . ' ' . $livreur['last_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">Veuillez choisir un livreur.</div>
                    </div>
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" id="is_home_delivery" name="is_home_delivery" value="1">
                    <label class="form-check-label" for="is_home_delivery">
                        Livraison à domicile
                    </label>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="liste_livraisons_products.php" class="btn btn-secondary border-0 rounded-0">
                        <i class="fa fa-arrow-left me-1"></i> Retour
                    </a>
                    <button type="submit" name="submit" class="btn btn-primary border-0 rounded-0">Valider la livraison</button>
                </div>
            </form>
        </div>
    </div>
</div>