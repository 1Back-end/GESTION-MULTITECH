<!DOCTYPE html>
<html>
<head>
	<!-- Basic admin Info -->
	<meta charset="utf-8">
	<title><?php echo strtoupper(ucfirst(str_replace(".php", "", basename($_SERVER['PHP_SELF']))));?></title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="vendors/images/logo.png">
	<link rel="icon" type="image/png" sizes="32x32" href="vendors/images/logo.png">
	<link rel="icon" type="image/png" sizes="16x16" href="vendors/images/logo.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/style.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/main.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    
<div class="container mt-5 p-0">
  <div class="col-lg-12 col-sm-12 mb-3">
     <div class="row">

   <div class="col-lg-4 col-sm-12">
    <div class="card h-100 shadow border-0 rounded-3 p-4 text-center">
        <div class="mb-3">
            <div class="login-title">
                <img src="logo_wam.jpg" alt="Logo Wam Services" style="width: 80px;" class="img-fluid">
            </div>
        </div>

        <div class="mb-3">
            <h5 class="fw-bold text-primary">Bienvenue sur Wam Services</h5>
            <p class="text-muted mb-1">Votre solution simple et rapide pour expédier vos colis en toute sécurité.</p>
            <p class="small text-secondary">Version : 1.1</p>
        </div>

        <div class="row g-2 mt-3">
            <div class="col-12">
                <a href="package/add_package.php" class="btn btn-primary rounded-pill w-100 shadow-sm">
                    Expédier un colis maintenant <i class="fa fa-paper-plane ms-2" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
</div>





<div class="col-lg-4 col-sm-12 mt-3">
  <div class="card h-100 shadow border-0 rounded-3 p-4 text-center">
    <div class="mb-3">
      <div class="login-title mb-4">
        <img src="vendors/images/logo.png" alt="Logo GESTION MULTITECH" style="width: 80px;" class="img-fluid mx-auto">
      </div>
    </div>
    <div class="mb-3">
      <h5 class="fw-bold text-primary">Bienvenue sur GESTION MULTITECH</h5>
      <p class="text-muted mb-1">
        Votre solution complète pour la gestion immobilière facile et efficace.
      </p>
      <p class="small text-secondary">Version : 1.1</p>
    </div>
    <div class="col-12">
      <a href="authentification/login.php" class="btn btn-primary rounded-pill w-100 shadow-sm">
        Cliquer pour continuer <i class="fa fa-sign-in ms-2" aria-hidden="true"></i>
      </a>
    </div>
  </div>
</div>





   </div>
  </div>
</div>



</body>
</html>
