
<?php
$role_user = $_SESSION['role'] ?? '';
$IsSuperAdmin = ($role_user == "super_admin");
$IsAdmin = ($role_user == "admin");
?>