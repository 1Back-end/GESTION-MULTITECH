<?php include("../include/menu.php"); ?>
<?php
include("fonction.php");
$ventes = get_all_my_ventes_secretariats($connexion, $user_id);
?>
<div class="main-container mt-3 pb-3">
    <div class="col-lg-12 col-sm-12 mb-3">
        <div class="row">
            <!-- FORMULAIRE -->
            <div class="col-md-4 col-sm-12 mb-3">
                <div class="card shadow-lg border-0 p-3">
                    <form action="" method="post" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <h6 class="text-uppercase fw-bold">Enregistrer / Modifier une vente</h6>
                        </div>

                        <input type="hidden" name="uuid" id="uuid" value="">

                        <div class="mb-3">
                            <label for="type_service" class="form-label">Type de service <span class="text-danger">*</span></label>
                            <input type="text" name="type_service" id="type_service" class="form-control form-control-lg" required>
                            <div class="invalid-feedback">Ce champ est requis.</div>
                        </div>

                        <div class="mb-3">
                            <label for="prix_unitaire" class="form-label">Prix unitaire (FCFA) <span class="text-danger">*</span></label>
                            <input type="number" name="prix_unitaire" id="prix_unitaire" class="form-control form-control-lg" min="1" required>
                            <div class="invalid-feedback">Ce champ est requis et doit être positif.</div>
                        </div>

                        <div class="mb-3">
                            <label for="quantite" class="form-label">Quantité <span class="text-danger">*</span></label>
                            <input type="number" name="quantite" id="quantite" class="form-control form-control-lg" min="1" required>
                            <div class="invalid-feedback">Ce champ est requis et doit être positif.</div>
                        </div>

                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-primary text-white shadow-none border-0 rounded-0">
                                 Enregistrer
                            </button>
                            <button type="reset" class="btn btn-danger text-white shadow-none border-0 rounded-0" id="btn-reset">
                                Annuler
                            </button>
                        </div>

                        <div class="mb-2 mt-3">
                            <?php include("process_add_vente_secretariat.php");?>
                            <?php if ($erreur): ?>
                                <div class="alert alert-danger text-center border-0"><?= htmlspecialchars($erreur) ?></div>
                            <?php endif; ?>
                            <?php if ($success): ?>
                                <div class="alert alert-success text-center border-0"><?= htmlspecialchars($success) ?></div>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>

            <!-- TABLEAU -->
            <div class="col-md-8 col-sm-12 mb-3">
                <div class="card shadow-lg border-0 p-3">
                    <h6 class="text-uppercase fw-bold mb-3">Historique des ventes</h6>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-striped" id="example">
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Service</th>
                                    <th>PU</th>
                                    <th>Qte</th>
                                    <th>Total</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($ventes)): ?>
                                    <?php foreach ($ventes as $index => $vente): ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><?= htmlspecialchars($vente['type_service']) ?></td>
                                            <td><?= $vente['prix_unitaire'] ?> FCFA</td>
                                            <td><?= $vente['quantite'] ?></td>
                                            <td><?= $vente['prix_total'] ?> FCFA</td>
                                            <td><?= date('d/m/Y H:i:s', strtotime($vente['created_at'])) ?></td>
                                            <td>
                                                <button 
                                                    type="button" 
                                                    class="btn btn-sm btn-warning btn-edit border-0 rounded-0 text-white" 
                                                    data-uuid="<?= $vente['uuid'] ?>"
                                                    data-type_service="<?= htmlspecialchars($vente['type_service']) ?>"
                                                    data-prix_unitaire="<?= $vente['prix_unitaire'] ?>"
                                                    data-quantite="<?= $vente['quantite'] ?>"
                                                >
                                                    Modifier
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="10" class="text-center">Aucune vente trouvée.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap validation JS -->
<script>
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>

<!-- Script pour remplir le formulaire lors du clic sur Modifier -->
<script>
    document.querySelectorAll('.btn-edit').forEach(button => {
        button.addEventListener('click', () => {
            document.getElementById('uuid').value = button.getAttribute('data-uuid');
            document.getElementById('type_service').value = button.getAttribute('data-type_service');
            document.getElementById('prix_unitaire').value = button.getAttribute('data-prix_unitaire');
            document.getElementById('quantite').value = button.getAttribute('data-quantite');

            // Scroll vers le formulaire
            document.querySelector('form').scrollIntoView({ behavior: 'smooth' });
        });
    });

    // Réinitialiser le champ uuid quand on clique sur "Annuler"
    document.getElementById('btn-reset').addEventListener('click', () => {
        document.getElementById('uuid').value = "";
    });
</script>