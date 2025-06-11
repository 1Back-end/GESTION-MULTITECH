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
    <div class="col-lg-6 col-sm-12 mx-auto">
        <div class="card shadow border-0 rounded-0 p-3 text-center">
            <div class="mb-2">
                <div class="login-title text-center mb-4">
                    <img src="vendors/images/logo.png" alt="Logo" style="width:80px;" class="img-fluid">
                </div>
            </div>
            <div class="mb-2">
                <p class="text-muted mb-0">
                    Bienvenue sur l'application GESTION MULTITECH — Version : 1.1 — Date création : 2025-02-28
                </p>

                
            </div>
            <div class="row g-2 mt-3">
                <div class="col-6 text-start">
                    <a href="package/add_package.php" class="btn btn-outline-primary w-100 rounded-0 shadow-none">
                        <i class="fas fa-box"></i> Expédier votre colis
                    </a>
                </div>
                <div class="col-6 text-end">
                    <a href="authentification/login.php" class="btn btn-customize border-0 rounded-0 text-white w-100 shadow-none">
                        Cliquer pour continuer <i class="fa fa-sign-in" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>



</body>
</html>
