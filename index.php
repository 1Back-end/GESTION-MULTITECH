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

    <div class="col-md-6 col-sm-12 mx-auto">
        <div class="card-box p-3 text-center">
            <div class="mb-2">
                <div class="login-title text-center mb-4">
                    <img src="vendors/images/logo.png" alt="Logo" style="width:80px;" class="img-fluid">
                </div>
            </div>
            <div class="mb-2">
                <p class="text-muted">
                    GESTION MULTITECH est un système complet conçu pour gérer efficacement les motels et restaurants. Il permet de gérer les réservations, les types de repas, les utilisateurs et les ventes, tout en offrant une interface intuitive pour faciliter la gestion quotidienne de l'entreprise.
                </p>
                <div class="d-flex justify-content-between">
                    <p class="text-muted mb-0">Version : 1.0</p>
                    <p class="text-muted mb-0">Date création : 2025-02-28</p>
                </div>
            </div>
            <div class="mb-2">
                <a href="authentification/login.php" class="btn btn-customize text-white shadow-none">Cliquer pour continuer <i class="fa fa-sign-in" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>

</div>


</body>
</html>
