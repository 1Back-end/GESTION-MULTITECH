<?php include("../include/menu.php"); ?>

<?php
include("../database/connexion.php");

// Récupérer l'uuid dans l'URL, validation simple
$uuid = $_GET['uuid'] ?? null;
if (!$uuid) {
    die("UUID manquant");
}

// Récupérer les données du dossier
$stmt = $connexion->prepare("SELECT * FROM customers_dossiers WHERE uuid = ?");
$stmt->execute([$uuid]);
$dossier = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<div class="main-container mt-3 pb-5">
    <div class="col-md-6 col-sm-12 mb-3">
        <?php include("process_finalise_dossier.php"); ?>
        <?php if (!empty($success)): ?>
    <div class="alert alert-success mt-3"><?= $success ?></div>
<?php endif; ?>

<?php if (!empty($erreur)): ?>
    <div class="alert alert-danger mt-3"><?= $erreur ?></div>
<?php endif; ?>
    </div>
    <div class="col-md-6 col-sm-12 mb-3">
    <div class="shadow bg-white border-0 p-3">
        <h5 class="text-uppercase mb-3">
            Finaliser le dossier de <?= htmlspecialchars($dossier['prefixe'] ?? '') ?> <?= htmlspecialchars($dossier['nom_complet'] ?? '') ?>
        </h5>

        <?php if ($dossier['condition_visite'] === 'Achat Terrain' || $dossier['condition_visite'] === 'Achat Maison'): ?>
            <p class="text-justify">
                Le client s’engage à verser à l’agence une commission équivalente à 
                <strong>5% du montant de la transaction</strong>, le jour du versement.
                En cas de contact direct avec le vendeur sans passer par l’agence, le client devra payer une amende de 
                <strong>5% supplémentaires</strong>.
            </p>
        <?php elseif ($dossier['condition_visite'] === 'Location'): ?>
            <p class="text-justify">
                Le client s’engage à verser à l’agence une commission équivalente à 
                <strong>un mois de loyer</strong>, le jour du versement.
                En cas de contact direct avec le bailleur sans passer par l’agence, le client devra payer une amende de 
                <strong>un mois de loyer supplémentaire</strong>.
            </p>
        <?php else: ?>
                <p class="text-justify">La commission sera déterminée selon la nature spécifique de la prestation.</p>
        <?php endif; ?>

        <form action="" method="post">
            <div class="mb-3">
                <?php if ($dossier['condition_visite'] === 'Achat Terrain' || $dossier['condition_visite'] === 'Achat Maison'): ?>
                    <label for="montantVerse" class="form-label">5% du montant de la transaction</label>
                <?php elseif ($dossier['condition_visite'] === 'Location'): ?>
                    <label for="montantVerse" class="form-label">Un mois de loyer</label>
                <?php else: ?>
                    <label for="montantVerse" class="form-label">Montant de la transaction</label>
                <?php endif; ?>


                <input type="number" class="form-control" id="montantVerse" name="montant_verse" required min="0" step="100">
            </div>

            <div class="mb-3">
                <label for="references" class="form-label">Références (personnes)</label>
                <textarea class="form-control" id="references" name="references" rows="3" placeholder="Entrez une ou plusieurs références séparées par des virgules" required></textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="ouvertures_dossiers.php" class="btn btn-secondary">Annuler</a>
                <button type="submit" name="submit" class="btn btn-success">Finaliser</button>
            </div>
        </form>
    </div>
</div>
