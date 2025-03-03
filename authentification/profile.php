<?php
include("../include/menu.php");
include("../database/connexion.php");

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: ../authentification/login.php");
    exit();
}

// Récupérer l'identifiant de l'utilisateur depuis la session
$id_user = $_SESSION['id']; // Récupérer l'ID de l'utilisateur connecté

// Préparer la requête SQL pour récupérer les informations de l'utilisateur
$sql = "SELECT * FROM users WHERE id = :user_id";

// Préparation de la requête
$stmt = $connexion->prepare($sql);

// Liaison des paramètres
$stmt->bindParam(':user_id', $id_user, PDO::PARAM_INT);

// Exécution de la requête
$stmt->execute();

// Récupérer les données de l'utilisateur
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifier si des données ont été trouvées
if (!$user) {
    // Gérer l'erreur si l'utilisateur n'est pas trouvé
    echo "Utilisateur introuvable.";
    exit();
}
?>
<style>
    input[type="tel"] {
        font-family: "Rubik", system-ui;
        font-size: 12px;
    }
</style>
<div class="main-container pb-5">
<div class="col-md-12 col-sm-12 mb-3">
    <?php include("process_update_profil.php"); ?>
    <?php if ($erreur): ?>
    <div class="alert alert-danger text-center border-0"><?= $erreur ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="alert alert-success text-center border-0"><?= $success ?></div>
    <?php endif; ?>
</div>



    <div class="container mt-2 p-2">
   
        <!-- Account page navigation -->
        <nav class="nav nav-borders">
 
            <a class="nav-link active ms-0" href="#">Profile</a>
        </nav>
        <hr class="mt-0 mb-4">
        <div class="row">
            <div class="col-xl-4 p-2">
                <div class="card-box mb-4 mb-xl-0 p-3">
                    <h4 class="text-center">Photo de profil</h4>
                    <div class="card-body text-center">
                        <?php if (!empty($user['photo'])): ?>
                            <img src="../uploads/<?= $user['photo'] ?>" class="shadow-none img-account-profile rounded-circle mb-2" id="photoPreview">
                        <?php else: ?>
                            <img src="../vendors/images/profile.png" class="shadow-none img-account-profile rounded-circle mb-2" id="photoPreview">
                        <?php endif; ?>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Profile picture upload button -->
                            <label for="photoInput" style="cursor: pointer;color: #1F4283;">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                Modifier la photo
                            </label>
                            <input type="file" id="photoInput" name="photo" style="display: none;">
                            <div class="small font-italic text-muted mb-4">JPG ou PNG ne dépassant pas 5 Mo</div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <div class="card-box mb-4 mb-xl-0 p-3">
                    <h4 class="text-center">Informations du compte</h4>
                    <div class="card-body p-0">
                        <form action="" method="POST">
                            <div class="row gx-3 mb-2">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputFirstName">Prénom</label>
                                    <input class="shadow-none form-control shadow-none" name="prenom" value="<?= htmlspecialchars($user['first_name']); ?>" type="text">
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputLastName">Nom</label>
                                    <input class="shadow-none form-control shadow-none" name="id_user" value="<?= htmlspecialchars($user['id']); ?>" type="hidden">
                                    <input class="shadow-none form-control shadow-none" name="nom" value="<?= htmlspecialchars($user['last_name']); ?>" type="text">
                                </div>
                            </div>

                            <div class="mb-2">
                                <label class="small mb-1" for="inputEmailAddress">E-mail</label>
                                <input class="shadow-none form-control shadow-none" name="email" value="<?= htmlspecialchars($user['email']); ?>" id="inputEmailAddress" type="email">
                            </div>

                            <div class="mb-2">
                                <label class="small mb-1" for="inputAddress">Adresse</label>
                                <input class="shadow-none form-control shadow-none" name="adresse" value="<?= htmlspecialchars($user['address']); ?>" id="inputAddress" type="text">
                            </div>

                            <div class="row gx-3 mb-2">
                                <div class="col-md-12">
                                    <label class="small mb-1" for="inputPhone">Numéro de téléphone</label>
                                    <input class="shadow-none form-control shadow-none" name="telephone" value="<?= htmlspecialchars($user['phone_number']); ?>" id="inputPhone" type="tel">
                                </div>
                            </div>

                            <button class="btn btn-customize btn-responsive text-white shadow-none" name="modifier" type="submit">Modifier <i class="bi bi-save"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('photoInput').addEventListener('change', function(event) {
        var file = event.target.files[0];
        var reader = new FileReader();
        
        reader.onload = function(e) {
            document.getElementById('photoPreview').src = e.target.result;
        };

        reader.readAsDataURL(file);
    });

    // Masquer les messages après 2 secondes
    setTimeout(function() {
        document.getElementById('success_message').style.display = 'none';
    }, 2000);

    setTimeout(function() {
        document.getElementById('error_message').style.display = 'none';
    }, 2000);
</script>
