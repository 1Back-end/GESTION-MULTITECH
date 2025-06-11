<?php 
include("../include/menu.php"); 
include("../database/connexion.php");

// Vérifier la présence du uuid client dans l'URL
if (isset($_GET["uuid"])) {
    $client_uuid = $_GET["uuid"];
} else {
    die("Aucun client trouvé.");
}

// Fonction pour récupérer les infos client (ici juste le prénom)
function get_client_by_uuid($connexion, $client_uuid) {
    $stmt = $connexion->prepare("SELECT * FROM clients_abonnes WHERE uuid = :client_uuid AND is_deleted = 0");
    $stmt->execute(['client_uuid' => $client_uuid]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

$client = get_client_by_uuid($connexion, $client_uuid);
if (!$client) {
    die("Client introuvable ou supprimé.");
}

?>

<div class="main-container mt-4 pb-5">
    <div class="col-md-8 col-sm-12 mb-3 mx-auto">
    <?php include("process_save_product.php"); ?>
    <?php if ($erreur): ?>
    <div class="alert alert-danger text-center border-0 rounded-0"><?= $erreur ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="alert alert-success text-center border-0 rounded-0"><?= $success ?></div>
    <?php endif; ?>
</div>

    <div class="col-lg-8 col-sm-12 mb-3 mx-auto">
        <div class="card shadow border-0 rounded-0 p-4">

            <div class="d-flex align-items-center justify-content-between mb-4">
                <a href="abonnement_clients.php" class="btn btn-secondary rounded-0 border-0">← Retour</a>
                <h4 class="text-uppercase">Ajouter un produit pour : 
                    <span class="text-primary"><?= htmlspecialchars($client['firstname']) . ' ' . htmlspecialchars($client['lastname']) ?></span>
                </h4>
            </div>

            <form action="" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                <!-- UUID client caché pour le traitement -->
                <input type="hidden" name="client_uuid" value="<?= htmlspecialchars($client_uuid) ?>">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="product_name" class="form-label">Nom du produit <span class="text-danger">*</span></label>
                        <input type="text" name="product_name" id="product_name" class="form-control" required placeholder="Ex : Télévision Samsung">
                        <div class="invalid-feedback">Ce champ est requis.</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="category" class="form-label">Catégorie <span class="text-danger">*</span></label>
                        <select name="category" id="category" class="shadow-none form-control select-custom" required>
                            <option value="" disabled selected>-- Choisissez une catégorie --</option>
                            <option value="Electronique">Électronique</option>
                            <option value="Vêtements">Vêtements</option>
                            <option value="Alimentaire">Alimentaire</option>
                            <option value="Meubles">Meubles</option>
                            <option value="Cosmétiques">Cosmétiques</option>
                            <option value="Papeterie">Papeterie</option>
                            <option value="Autres">Autres</option>
                        </select>
                        <div class="invalid-feedback">Ce champ est requis.</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="quantity" class="form-label">Quantité <span class="text-danger">*</span></label>
                        <input type="number" name="quantity" id="quantity" min="1" class="form-control" required placeholder="Ex : 3">
                        <div class="invalid-feedback">Ce champ est requis.</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="price" class="form-label">Prix unitaire (FCFA) <span class="text-danger">*</span></label>
                        <input type="number" name="price" id="price" min="0" step="0.01" class="form-control" required placeholder="Ex : 15000">
                       <div class="invalid-feedback">Ce champ est requis.</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="weight" class="form-label">Poids (kg)</label>
                        <input type="number" name="weight" id="weight" min="0" step="0.01" class="form-control" placeholder="Ex : 2.5">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="declared_value" class="form-label">Valeur déclarée (FCFA)</label>
                        <input type="number" name="declared_value" id="declared_value" min="0" step="0.01" class="form-control" placeholder="Valeur assurée">
                    </div>

                    <div class="col-12 mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" rows="3" class="form-control" placeholder="Description facultative du produit"  required></textarea>
                        <div class="invalid-feedback">Ce champ est requis.</div>
                    </div>

                    <div class="col-12 mb-4">
                        <label for="product_image" class="form-label">Image du produit (optionnelle)</label>
                        <input type="file" name="product_image" id="product_image" accept="image/*" class="form-control">
                    </div>
                </div>

                <button type="submit" name="submit" class="btn btn-primary rounded-0">Ajouter le produit</button>
            </form>
        </div>
    </div>
</div>
