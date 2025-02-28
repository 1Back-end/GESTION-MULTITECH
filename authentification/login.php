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

<div class="container mt-5 pb-5">

<div class="message-container" style="max-width: 400px; margin: 0 auto;">
<?php include("process_login.php"); ?>
        <?php if ($erreur): ?>
            <div class="alert alert-danger mt-3 text-center border-0"><?= $erreur ?></div>
        <?php endif; ?>
</div>

    <div class="login-box card-box border-radius-10">
        <div class="login-title text-center mb-4">
            <h5>Veuillez vous connectez à votre compte</h5>
        </div>
        <form method="POST"> 
            <!-- Email Field -->
            <div class="mb-3">
                <label for="">Email</label>
                <input type="text" name="username" class="shadow-none form-control form-control-lg" placeholder="email@domaine.com" required>
            </div>

            <!-- Password Field -->
             <label for="">Mot de passe</label>
            <div class="mb-3 position-relative form-group d-flex align-items-center justify-content-between">
                <input type="password" name="password" id="password" class="shadow-none form-control form-control-lg" placeholder="***************" required>
                <span id="toggle-password" class="fa fa-eye-slash position-absolute" style="right:10px; cursor:pointer;"></span> 
            </div>

            <!-- Forgot Password Link -->
            <div class="row pb-3">
                <div class="col-6"></div>
                <div class="col-6 text-right">
                    <div class="forgot-password">
                        <a href="Forgot_Password.php">Mot de passe oublié</a>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mb-2">
                <button name="submit" type="submit" class="btn-responsive btn btn-customize btn-lg btn-block text-white submit_btn mb-2">Se Connecter 
                    <i class="fa fa-sign-in" id="submit_icon"></i>
                </button>
            </div>
        </form>
    </div>

</div>

<script>
    // Password Toggle functionality
    document.getElementById('toggle-password').addEventListener('click', function() {
        const passwordField = document.getElementById('password');
        const toggleIcon = document.getElementById('toggle-password');

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        } else {
            passwordField.type = 'password';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        }
    });
</script>



</body>
</html>
