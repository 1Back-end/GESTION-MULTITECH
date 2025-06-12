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
	<!-- DataTables CSS -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

	
</head>
<body>



	<div class="header">
		<div class="header-left">
			<div class="menu-icon dw dw-menu"></div>
			<div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
			<div class="header-search">
				
			</div>
		</div>
		<div class="header-right">
			<div class="dashboard-setting user-notification">
				
			</div>
			<div class="user-notification">
				<div class="dropdown">
					
					<div class="dropdown-menu dropdown-menu-right">
						<div class="notification-list mx-h-350 customscroll">
						</div>
					</div>
				</div>
			</div>
            <?php include("../authentification/session_users.php"); ?>
			<div class="user-info-dropdown">
                <div class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="user-icon shadow-none">
                        <!-- Vérifier si une photo est disponible dans la session, sinon utiliser une image par défaut -->
                        <img class='rounded-circle img-fluid text-center' src="<?php echo !empty($_SESSION['photo']) ? '../uploads/' . $_SESSION['photo'] : '../vendors/images/profile.png'; ?>">
                    </span>
                    <span class="user-name font-14"><?php echo htmlspecialchars($_SESSION['name']); ?></span>
                </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list border-0 rounded-0">
                        <a class="dropdown-item" href="../authentification/profile.php"><i class="fa fa-user"></i>Mon compte</a>
                        <a class="dropdown-item" href="../authentification/logout.php"><i class="fa fa-sign-out-alt"></i>Déconnexion</a>
                    </div>
                </div>
            </div>

	
	<div class="left-side-bar">
		<div class="brand-logo">
			<a href="#">
				<h4 class="text-uppercase text-white">
					GESTION MULTITECH
				</h4>
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
        <?php include("../authentification/info_access.php");?>



			<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">

				<?php if ($IsGestionnaireMotelRestaurant): ?>
					<li>
					<a href="../users/dashboard.php" class="dropdown-toggle no-arrow">
						<span class="micon fas fa-tachometer-alt"></span><span class="mtext">Tableau de bord</span>
					</a>
					</li>

					<li>
					<a href="../users/sieste_motel.php" class="dropdown-toggle no-arrow">
						<span class="micon fas fa-bed"></span><span class="mtext">Sieste Motel</span>
					</a>
					</li>

					<li>
					<a href="../users/nuitee_motel.php" class="dropdown-toggle no-arrow">
						<span class="micon fas fa-moon"></span><span class="mtext">Nuitée Motel</span>
					</a>
					</li>

					<li>
					<a href="../users/liste_restaurant.php" class="dropdown-toggle no-arrow">
						<span class="micon fas fa-utensils"></span><span class="mtext">Restaurant</span>
					</a>
					</li>

				<?php elseif ($IsGestionnaireIMMO): ?>
					<li>
					<a href="#" class="dropdown-toggle no-arrow">
						<span class="micon fas fa-tachometer-alt"></span><span class="mtext">Tableau de bord</span>
					</a>
					</li>

					<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle">
						<span class="micon fa fa-home"></span><span class="mtext">IMMO</span>
					</a>
					<ul class="submenu">
						<li><a href="../users/liste_proprietaires.php">Propriétaires</a></li>
						<li><a href="../users/ouvertures_dossiers.php">Ouvertures dossiers</a></li>
					</ul>
					</li>

				<?php elseif ($IsChefAgence): ?>

					<li>
					<a href="../users/dashboard.php" class="dropdown-toggle no-arrow">
						<span class="micon fas fa-tachometer-alt"></span><span class="mtext">Tableau de bord</span>
					</a>
					</li>


					<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle">
						<span class="micon fa fa-cog"></span><span class="mtext">Service de livraisons</span>
					</a>
					<ul class="submenu">
						<!-- <li><a href="../users/abonnement_clients.php">Abonnement clients</a></li>
						<li><a href="../users/liste_produits_clients.php">Liste des produits clients</a></li> -->
						<!-- <li><a href="../users/liste_livraisons_products.php">Liste des livraisons clients</a></li> -->
						<li><a href="../users/gestion_agencies.php">Gestion de mon agence</a></li>
						<li><a href="../users/package_agencies.php">Gestion des livraisons mon agence</a></li>
					</ul>
					</li>

				<?php elseif ($IsSuperAdmin): ?>
					<li>
					<a href="../admin/dashboard.php" class="dropdown-toggle no-arrow">
						<span class="micon fas fa-tachometer-alt"></span><span class="mtext">Tableau de bord</span>
					</a>
					</li>

					<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle">
						<span class="micon fa fa-lock"></span><span class="mtext">Administrations</span>
					</a>
					<ul class="submenu">
						<li><a href="../admin/liste_motels.php">Motels</a></li>
						<li><a href="../admin/liste_restaurant.php">Restaurants</a></li>
						<li><a href="../admin/affectation_motels.php">Affectation Motels</a></li>
						<li><a href="../admin/affectation_restaurants.php">Affectation Restaurant</a></li>
						<li><a href="../admin/list_client.php">Liste des clients</a></li>
					</ul>
					</li>

					<li>
					<a href="../admin/utilisateurs.php" class="dropdown-toggle no-arrow">
						<span class="micon fas fa-users"></span><span class="mtext">Utilisateurs</span>
					</a>
					</li>

					<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle">
						<span class="micon fa fa-home"></span><span class="mtext">IMMO</span>
					</a>
					<ul class="submenu">
						<li><a href="../admin/liste_proprietaires.php">Propriétaires</a></li>
						<li><a href="../admin/ouvertures_dossiers.php">Ouvertures dossiers</a></li>
					</ul>
					</li>

					<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle">
						<span class="micon fa fa-cog"></span><span class="mtext">Paramètres</span>
					</a>
					<ul class="submenu">
						<li><a href="../admin/menu.php">Menu</a></li>
					</ul>
					</li>

					<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle">
						<span class="micon fa fa-cog"></span><span class="mtext">Service de livraisons</span>
					</a>
					<ul class="submenu">
						<li><a href="../admin/abonnement_clients.php">Abonnement clients</a></li>
						<li><a href="../admin/liste_produits_clients.php">Liste des produits clients</a></li>
						<li><a href="../admin/liste_livraisons_products.php">Liste des livraisons clients</a></li>
						<li><a href="../admin/list_of_agencies.php">Liste des agences</a></li>
						<li><a href="../admin/menu.php">Liste des livraisons</a></li>
						<li><a href="../admin/list__of_agents.php">Liste des agents</a></li>
					</ul>
					</li>

				<?php endif; ?>

				</ul>
			</div>
			</div>
			</div>
			</div>
			</div>

			</div>
	<!-- js -->
	<!-- js -->
	<script src="../vendors/scripts/core.js"></script>
	<script src="../vendors/scripts/script.min.js"></script>
	<script src="../vendors/scripts/process.js"></script>
	<script src="../vendors/scripts/layout-settings.js"></script>
	<script src="../vendors/scripts/dashboard.js"></script>
	<script src="../vendors/scripts/main.js"></script>
	<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</body>
</html>