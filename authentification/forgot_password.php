<!DOCTYPE html>
<html>
<head>
	<!-- Basic admin Info -->
	<meta charset="utf-8">
	<title><?php echo strtoupper(ucfirst(str_replace(".php", "", basename($_SERVER['PHP_SELF']))));?></title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="../vendors/images/logo.png">
	<link rel="icon" type="image/png" sizes="32x32" href="../vendors/images/logo.png">
	<link rel="icon" type="image/png" sizes="16x16" href="../vendors/images/logo.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" type="text/css" href="../vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="../vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="../vendors/styles/style.css">
	<link rel="stylesheet" type="text/css" href="../vendors/styles/main.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>


<div class="container mt-5 pb-5">
    <div class="col-md-6 col-sm-12 mx-auto">
        <div class="card-box p-3">
            <!-- Titre et message -->
            <div class="mb-2 text-center">
                <h5 class="text-center big_tilte">Réinitialiser mon mot de passe</h5>
                <small>Veuillez entrer l'adresse mail liée à votre compte 📧</small>
            </div>

            <!-- Formulaire de réinitialisation -->
            <form action="" method="post">
                <!-- Champ Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Adresse mail</label>
                    <input type="email" name="email" id="email" class="shadow-none form-control form-control-lg" placeholder="email@gmail.com" required>
                </div>

                <!-- Bouton de soumission -->
                <div class="mb-3">
                    <button type="submit" class="btn btn-customize text-white btn-lg w-100 btn-responsive">Réinitialiser</button>
                </div>

                <!-- Lien de redirection pour connexion -->
                <div class="mb-2 text-center">
                    <small>Je me souviens de mon mot de passe ?</small>
                    <a href="login.php" class="text-center btn btn-link text-decoration-none">Me connecter</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Masquer le message de succès après 3 secondes
    setTimeout(function() {
        const successMessage = document.getElementById('success-message');
        if (successMessage) {
            successMessage.style.display = 'none';
        }
    }, 3000);
</script>


</body>
</html>