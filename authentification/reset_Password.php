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

<style>
    .fa, .fas {
        font-weight: 900;
        font-size: 20px;
    }
</style>

<div class="container mt-5">
    <div class="align-items-center">
        <div class="login-box bg-white box-shadow border-radius-10">
            <div class="login-title mb-2">
                <h2 class="text-center fs-2">Nouveau mot de passe</h2>
                <small>Créez un mot de passe pour votre compte, essayez de ne pas le perdre cette fois ! 😊</small>
            </div>

            <form action="" method="POST">
                <!-- Mot de passe -->
                <div class="mb-4 position-relative form-group d-flex align-items-center justify-content-between">
                    <input type="password" name="password" id="password" class="form-control shadow-none form-control-lg" placeholder="Mot de passe">
                    <span id="toggle-password" class="fa fa-eye position-absolute" style="right:10px; cursor:pointer;"></span> 
                </div>

                <!-- Confirmer le mot de passe -->
                <div class="mb-4 position-relative form-group d-flex align-items-center justify-content-between">
                    <input type="password"  name="confirm_password" id="confirm_password" class="form-control shadow-none form-control-lg" placeholder="Confirmer mot de passe">
                    <span id="toggle-confirm-password" class="fa fa-eye position-absolute" style="right:10px; cursor:pointer;"></span> 
                </div>

                <!-- Bouton de validation -->
                <div class="row align-items-center mb-2">
                    <div class="col-md-12 col-sm-12">
                        <div class="input-group mb-0">
                            <button name="submit" class="btn btn-customize text-white shadow-none w-100 btn-lg" type="submit">Valider</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Fonction pour masquer/afficher le mot de passe
    document.getElementById('toggle-password').addEventListener('click', function () {
        const passwordField = document.getElementById('password');
        const passwordFieldType = passwordField.getAttribute('type');
        if (passwordFieldType === 'password') {
            passwordField.setAttribute('type', 'text');
            this.classList.remove('fa-eye');
            this.classList.add('fa-eye-slash');
        } else {
            passwordField.setAttribute('type', 'password');
            this.classList.remove('fa-eye-slash');
            this.classList.add('fa-eye');
        }
    });

    // Fonction pour masquer/afficher la confirmation du mot de passe
    document.getElementById('toggle-confirm-password').addEventListener('click', function () {
        const confirmPasswordField = document.getElementById('confirm_password');
        const confirmPasswordFieldType = confirmPasswordField.getAttribute('type');
        if (confirmPasswordFieldType === 'password') {
            confirmPasswordField.setAttribute('type', 'text');
            this.classList.remove('fa-eye');
            this.classList.add('fa-eye-slash');
        } else {
            confirmPasswordField.setAttribute('type', 'password');
            this.classList.remove('fa-eye-slash');
            this.classList.add('fa-eye');
        }
    });
</script>

</body>
</html>