<?php include("../include/menu.php"); ?>
<?php include("fonction.php"); ?>

<link rel="stylesheet" href="style.css">

<div class="main-container mt-3 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card-box p-3">
            <div class="text-center">
                <h5 class="text-uppercase">Enregistrer une nuitée</h5>
            </div>
        </div>
    </div>

<div class="col-md-12 col-sm-12 mb-3">
    <?php include("process_add_nuitee.php");?>
    <!-- Affichage des messages d'erreur ou de succès -->
<?php if ($erreur): ?>
    <div class="alert alert-danger text-center border-0">
        <?php echo htmlspecialchars($erreur); ?>
    </div>
<?php endif; ?>

<?php if ($success): ?>
    <div class="alert alert-success text-center border-0">
        <?php echo htmlspecialchars($success); ?>
    </div>
<?php endif; ?>


</div>

    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card-box p-3">
            <form action="" method="post">
                <div class="row">
                    <div class="col-md-6 col-sm-12 mb-3">
                        <div class="mb-3">
                            <label for="type_chambre">Type chambre <span class="text-danger">*</span></label>
                            <select name="type_chambre" id="type_chambre" required class="shadow-none form-control select-custom">
                                <option disabled selected>Veuillez choisir une option</option>
                                <?php foreach ($typeLogements as $typeLogement): ?>
                                    <option value="<?php echo htmlspecialchars($typeLogement); ?>">
                                        <?php echo htmlspecialchars($typeLogement); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="numero_chambre">Numéro de chambre <span class="text-danger">*</span></label>
                            <select name="numero_chambre" id="numero_chambre" required class="shadow-none form-control select-custom">
                                <option disabled selected>Veuillez choisir une option</option>
                                <?php foreach ($numero_motels as $numero_motel): ?>
                                    <option value="<?php echo htmlspecialchars($numero_motel["numero"]); ?>">
                                        <?php echo htmlspecialchars($numero_motel["numero"]); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="client">Client <span class="text-danger">*</span></label>
                            <select name="client_id" id="client" required class="shadow-none form-control select-custom">
                                <option disabled selected>Veuillez choisir une option</option>
                                <?php foreach ($clients as $client): ?>
                                    <option value="<?php echo htmlspecialchars($client["id"]); ?>">
                                    <?php echo htmlspecialchars($client["first_name"]) . ' ' . htmlspecialchars($client["last_name"]); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <a href="add_client.php" class="text-success text-uppercase text-decoration-none fw-bold">Ajouter un client</a>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-sm-12 mb-3">
                        <div class="mb-3">
                            <label for="prix">Prix <span class="text-danger">*</span></label>
                            <select name="prix" id="prix" class="shadow-none form-control select-custom">
                            <option disabled selected>Veuillez choisir une option</option>
                            </select>
                        </div>

                        <div class="mb-3">
                                <label for="date_entree">Date d'entrée <span class="text-danger">*</span></label>
                                <input type="datetime-local" name="date_entree" id="date_entree" class="form-control shadow-none" required>
                            </div>

                            <div class="mb-3">
                                <label for="date_sortie">Date sortie <span class="text-danger">*</span></label>
                                <input type="datetime-local" name="date_sortie" id="date_sortie" class="form-control shadow-none" required>
                            </div>

                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" name="submit" class="btn btn-customize text-white shadow-none">Enregistrer</button>
                    <button type="reset" class="btn btn-secondary">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#numero_chambre').change(function() {
        let numero = $(this).val(); // Récupérer le numéro de chambre sélectionné

        $.ajax({
            url: 'get_prix_nuitee.php',  // Le fichier PHP pour récupérer les prix
            type: 'POST',
            data: { numero: numero },
            dataType: 'json',
            success: function(response) {
                // Vider d'abord le champ prix pour ne pas avoir de doublons
                $('#prix').empty();
                
                // Ajouter une option par défaut
                $('#prix').append('<option disabled selected>Veuillez choisir un prix</option>');
                
                // Ajouter chaque prix de nuitée dans le select
                if (response.length > 0) {
                    response.forEach(function(prix) {
                        $('#prix').append('<option value="' + prix.prix_nuitee + '">' + prix.prix_nuitee + ' FCFA</option>');
                    });
                } else {
                    $('#prix').append('<option disabled>Aucun prix disponible</option>');
                }
            },
            error: function() {
                console.log("Erreur lors de la récupération des prix.");
            }
        });
    });
});
</script>
