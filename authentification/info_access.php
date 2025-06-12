
<?php
$role_user = $_SESSION['role'] ?? '';
$IsSuperAdmin = ($role_user == "super_admin");
$IsGestionnaireMotelRestaurant = ($role_user == "Gestionnaire Motel & Restaurant");
$IsGestionnaireIMMO = ($role_user == "Gestionnaire IMMO");
$IsChefAgence = ($role_user == "Chef d’agence");
?>