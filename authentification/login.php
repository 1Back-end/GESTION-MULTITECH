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

<?php include("process_login.php"); ?>
<div class="container mt-5 pb-5">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-5">
          <div class="card border border-light-subtle rounded-3 shadow-sm">
            <div class="card-body p-3 p-md-4 p-xl-5">
              
            <p class="fs-6 fw-normal text-center text-secondary mb-4">Veuillez vous connecter à votre compte pour accéder à toutes les fonctionnalités disponibles.</hp>

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
            <div class="mb-3">
                 <?php if ($erreur): ?>
                    <p class="text-danger"><?= $erreur ?></div>
                <?php endif; ?>

                <?php if(!empty($_GET["msg"])) : ?>
                <?php $msg = $_GET["msg"]; ?>
                    <div class="text-danger"><?= $msg ?> !</div>
                <?php endif; ?>

            </div>
        </form>
    </div>
</div>
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
