<?php
include("../include/menu.php");
include("../fonction/fonction.php");


$result = get_all_product_by_clients($connexion);
$products_clients = $result['data'];
$total_pages = $result['total_pages'];
$current_page = $result['current_page'];

?>

<div class="main-container mt-3 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card shadow border-0 rounded-0 p-3">
            <div class="text-center">
                <h5 class="text-uppercase">Liste des produits clients</h5>
            </div>
        </div>
</div>

    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card shadow border-0 rounded-0 p-3">
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle" id="example" class="display">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Ref.</th>
                            <th>Image</th>
                            <th>produit</th>
                            <th>Catégorie</th>
                            <th>Quantité</th>
                            <th>Prix</th>
                            <th>Poids</th>
                            <th>Valeur déclarée</th>
                            <th>Client</th>
                            <th>Ajouté par</th>
                            <th>Créer le</th>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($products_clients) > 0): ?>
                            <?php foreach ($products_clients as $index => $product): ?>
                                <tr>
                                    <td><?= ($index + 1) + (($current_page - 1) * 25) ?></td>
                                      <td><?= htmlspecialchars($product['ref']) ?></td>
                                    <?php
                                        $image = !empty($product['product_image']) 
                                            ? '../uploads/products/' . $product['product_image'] 
                                            : '../vendors/images/product.svg'; // image par défaut
                                    ?>
                                   
                                    <td><img src="<?= htmlspecialchars($image) ?>" alt="Produit" width="80" height="80" class="img-thumbnail"></td>
                                    <td><?= htmlspecialchars($product['product_name']) ?></td>
                                    <td><?= htmlspecialchars($product['category']) ?></td>
                                    <td><?= (int) $product['quantity'] ?></td>
                                    <td><?= number_format($product['price'], 2, ',', ' ') ?> FCFA</td>
                                    <td><?= $product['weight'] ? $product['weight'] . ' kg' : 'Non renseigné' ?></td>
                                    <td><?= $product['declared_value'] ? number_format($product['declared_value'], 2, ',', ' ') . ' FCFA' : 'Non renseigné' ?></td>
                                     <td><?= htmlspecialchars($product['client_first_name'] . ' ' . $product['client_last_name']) ?></td>
                                    <td><?= htmlspecialchars($product['user_first_name'] . ' ' . $product['user_last_name']) ?></td>
                                    <td><?= date('d/m/Y H:i', strtotime($product['created_at'])) ?></td>

                                    <td class="text-center">
                                         <button class="btn btn-outline-secondary btn-xs btn-sm dropdown-toggle  rounded-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu border-0 shadow-sm border-0 rounded-0" aria-labelledby="dropdownMenuButton">
                                            <li>
                                                <a class="dropdown-item text-warning fs-6" href="edit_products_client.php?uuid=<?= $product['uuid'] ?>">
                                                <i class="fa-solid fa-pen-to-square me-2"></i> Modifier le produit
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item text-success fs-6" href="preparer_livraison.php?uuid=<?= $product['uuid'] ?>">
                                                <i class="fa-solid fa-cart-shopping me-2"></i> Préparer la livraison
                                                </a>
                                            </li>
                                            </ul>
                                        </div>
                                    </td>


                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" class="text-center">Aucun produit trouvé.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <!-- <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?= ($i === $current_page) ? 'active' : '' ?>">
                            <a class="page-link border-0 shadow-none rounded-0" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav> -->
        </div>
    </div>
</div>
