<?php 
include("../include/menu.php"); 
include("../database/connexion.php");

// Vérifier la présence du uuid produit dans l'URL
if (!isset($_GET["uuid"])) {
    die("Aucun produit trouvé.");
}
$product_uuid = $_GET["uuid"];

// Fonction pour récupérer le produit client avec infos client
function get_product_with_client(PDO $connexion, string $product_uuid) {
    $stmt = $connexion->prepare("
        SELECT cp.*, c.firstname, c.lastname 
        FROM client_products cp
        INNER JOIN clients_abonnes c ON c.uuid = cp.client_uuid AND c.is_deleted = 0
        WHERE cp.uuid = :product_uuid AND cp.is_deleted = 0
    ");
    $stmt->execute(['product_uuid' => $product_uuid]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

$product = get_product_with_client($connexion, $product_uuid);
if (!$product) {
    die("Produit introuvable ou supprimé.");
}
?>

<div class="main-container mt-4 pb-5">
    <div class="col-md-8 col-sm-12 mb-3 mx-auto">
          <?php include("process_edit_product.php"); ?>
        <?php if ($erreur): ?>
            <div class="alert alert-danger text-center border-0 rounded-0"><?= htmlspecialchars($erreur) ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="alert alert-success text-center border-0 rounded-0"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>
    </div>

    <div class="col-lg-8 col-sm-12 mb-3 mx-auto">
        <div class="card shadow border-0 rounded-0 p-4">

            <div class="d-flex align-items-center justify-content-between mb-4">
                <a href="liste_produits_clients.php" class="btn btn-secondary rounded-0 border-0">← Retour</a>
                <h4 class="text-uppercase">Modifier le produit : 
                    <span class="text-primary"><?= htmlspecialchars($product['product_name']) ?></span> 
                    <br><small>Client : <?= htmlspecialchars($product['firstname'] . ' ' . $product['lastname']) ?></small>
                </h4>
            </div>

            <form action="" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                <input type="hidden" name="client_uuid" value="<?= htmlspecialchars($product['client_uuid']) ?>">
                <input type="hidden" name="product_uuid" value="<?= htmlspecialchars($product['uuid']) ?>">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="product_name" class="form-label">Nom du produit <span class="text-danger">*</span></label>
                        <input type="text" name="product_name" id="product_name" class="form-control" required 
                               placeholder="Ex : Télévision Samsung" 
                               value="<?= htmlspecialchars($product['product_name']) ?>">
                        <div class="invalid-feedback">Ce champ est requis.</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="category" class="form-label">Catégorie <span class="text-danger">*</span></label>
                        <select name="category" id="category" class="shadow-none form-control select-custom" required>
                            <option value="" disabled>-- Choisissez une catégorie --</option>
                            <?php
                            $categories = ["Electronique", "Vêtements", "Alimentaire", "Meubles", "Cosmétiques", "Papeterie", "Autres"];
                            foreach ($categories as $cat): ?>
                                <option value="<?= $cat ?>" <?= ($product['category'] === $cat) ? 'selected' : '' ?>><?= $cat ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">Ce champ est requis.</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="quantity" class="form-label">Quantité <span class="text-danger">*</span></label>
                        <input type="number" name="quantity" id="quantity" min="1" class="form-control" required 
                               placeholder="Ex : 3" 
                               value="<?= htmlspecialchars($product['quantity']) ?>">
                        <div class="invalid-feedback">Ce champ est requis.</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="price" class="form-label">Prix unitaire (FCFA) <span class="text-danger">*</span></label>
                        <input type="number" name="price" id="price" min="0" step="0.01" class="form-control" required 
                               placeholder="Ex : 15000" 
                               value="<?= htmlspecialchars($product['price']) ?>">
                       <div class="invalid-feedback">Ce champ est requis.</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="weight" class="form-label">Poids (kg)</label>
                        <input type="number" name="weight" id="weight" min="0" step="0.01" class="form-control" 
                               placeholder="Ex : 2.5" 
                               value="<?= htmlspecialchars($product['weight']) ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="declared_value" class="form-label">Valeur déclarée (FCFA)</label>
                        <input type="number" name="declared_value" id="declared_value" min="0" step="0.01" class="form-control" 
                               placeholder="Valeur assurée" 
                               value="<?= htmlspecialchars($product['declared_value']) ?>">
                    </div>

                    <div class="col-12 mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" rows="3" class="form-control" 
                                  placeholder="Description facultative du produit" required><?= htmlspecialchars($product['description']) ?></textarea>
                        <div class="invalid-feedback">Ce champ est requis.</div>
                    </div>

                    <div class="col-12 mb-4">
                        <label for="product_image" class="form-label">Image du produit (optionnelle)</label>
                        <input type="file" name="product_image" id="product_image" accept="image/*" class="form-control">
                        <?php if (!empty($product['product_image'])): ?>
                            <img src="../uploads/<?= htmlspecialchars($product['product_image']) ?>" alt="Image produit" class="img-thumbnail mt-2" style="max-width: 150px;">
                        <?php endif; ?>
                    </div>
                </div>

                <button type="submit" name="submit" class="btn btn-primary rounded-0">Modifier le produit</button>
            </form>
        </div>
    </div>
</div>

<script>
// Validation Bootstrap standard
(() => {
  'use strict';
  const forms = document.querySelectorAll('.needs-validation');
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
    }, false);
  });
})();
</script>
