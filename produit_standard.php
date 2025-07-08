<!DOCTYPE html>
<html lang="fr">
<?php include_once("../fonction.php"); ?>
<?php include_once("../database/db.php"); ?>
<head>
    <meta charset="utf-8">
    <title>IMMO INVESTMENT SCI</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="shortcut icon" href="../package/img/logo.png" type="image/x-icon">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
   

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-iEUCYXZQBrGKEj6Xj9YWDqTinQFPw7Dx6dIDMnF+NPJbCjZZScsik3XR1nNJvVKRtkiIqgcbnepvI9gypYNE1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Libraries Stylesheet -->
    <link href="../package/lib/animate/animate.min.css" rel="stylesheet">
    <link href="../package/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../package/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../package/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-dark" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar Start -->
        <div class="container-fluid nav-bar bg-transparent">
            <nav class="navbar navbar-expand-lg bg-white navbar-light py-0 px-4">
                <a href="../index.php" class="navbar-brand d-flex align-items-center text-center">
                    <div >
                        <img class="img-fluid" src="../package/img/logo.png" alt="Icon" style="width: 65px; height: 65px; margin-right: 10px;">
                    </div>
                    <h5 class="m-0 text-primary">IMMO INVESTMENT<span class="text-dark"> SCI</span></h5>
                </a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto">
                        <a href="../index.php" class="nav-item nav-link active">Acceuil</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link  dropdown-toggle" data-bs-toggle="dropdown">A Vendre</a>
                    <div class="dropdown-menu rounded-0 m-0 ">
                        <a href="../pages/Maison.php" class="dropdown-item">Maisons</a>
                        <a href="../pages/immeuble.php" class="dropdown-item">Immeubles</a>
                        <a href="../pages/appartements.php" class="dropdown-item">Appartements</a>
                        <a href="../pages/duplex.php" class="dropdown-item">Duplex</a>
                        <a href="../pages/villa.php" class="dropdown-item">Villas</a>
                        <a href="terrains.php" class="dropdown-item">Terrains</a>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link  dropdown-toggle" data-bs-toggle="dropdown">A Louer</a>
                    <div class="dropdown-menu rounded-0 m-0 ">
                        <a href="chambres.php" class="dropdown-item">Chambres Moderne</a>
                        <a href="studios.php" class="dropdown-item">Studios Moderne</a>
                        <a href="appartements.php" class="dropdown-item">Appartements Moderne</a>
                        <a href="duplex.php" class="dropdown-item">Duplex</a>
                        <a href="Maison.php" class="dropdown-item">Maisons</a>
                        <a href="immeuble.php" class="dropdown-item">Immeubles</a>
                        <a href="villa.php" class="dropdown-item">Villas</a>
                        <a href="../pages/terrains.php" class="dropdown-item">Terrains</a>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link  dropdown-toggle" data-bs-toggle="dropdown">IMMO</a>
                    <div class="dropdown-menu rounded-0 m-0 ">
                        <a href="apropos.php" class="dropdown-item">A propos</a>
                        <a href="contact.php" class="dropdown-item">Contact</a>
                    </div>
                </div>
                    </div>
                    <!-- Pour les petits écrans -->
                    <div class="d-block d-lg-none">
                        <a href="../login/login.php" class="btn-add btn btn-dark text-white outline-none border-0 btn-sm">Se connecter</a>
                        <span class="mx-2"></span>
                        <a href="../utilisateurs/creation_compte.php" class="btn-add btn btn-success outline-none btn-sm text-white px-3">S'Inscrire</a>
                    </div>
                     <br><br>
                    <!-- Pour les grands écrans -->
                    <div class="d-none d-lg-block">
                        <a href="../login/login.php" class="btn btn-dark outline-none text-white border-0">Se connecter</a>
                        <span class="mx-2"></span>
                        <a href="../utilisateurs/creation_compte.php" class="btn btn-success outline-none text-white px-3">S'Inscrire</a>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Navbar End -->


        <!-- Header Start -->
        <!-- Header Start -->
<div class="container-fluid header bg-white p-0">
  <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
    <div class="col-md-6 p-5 mt-lg-5"><br><br><br>
      <h1 class="display-5 animated fadeIn mb-4">
        Découvrez nos <span class="text-primary">Produits VIP</span>
      </h1>
      <p>
        Explorez notre sélection exclusive de biens VIP, alliant luxe, confort et prestige.
        Ces logements haut de gamme sont parfaits pour ceux qui recherchent une qualité supérieure,
        des finitions raffinées et une expérience résidentielle incomparable.
        Trouvez dès maintenant votre résidence d’exception.
      </p>
    </div>
    <div class="col-md-6 animated fadeIn">
      <img class="img-fluid" src="../img/carousel-3.jpg" alt="">
    </div>
  </div>
</div>

<div class="container-xxl py-5">
  <div class="container">
    <div class="row g-0 gx-5 align-items-end">
      <div class="col-md-6 col-sm-12">
        <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
          <h1 class="mb-3 mt-5">Produits VIP</h1>
          <p>
            Découvrez notre sélection exclusive de produits VIP, alliant luxe, confort et prestige. 
            Ces biens haut de gamme sont parfaits pour les clients exigeants qui recherchent une qualité supérieure, 
            des finitions raffinées et une expérience résidentielle exceptionnelle.
          </p>
        </div>
      </div>
    </div>


   <?php
function isVIP($type, $prix) {
    return match ($type) {
        'Chambre Moderne' => $prix >= 35000 && $prix <= 70000,
        'Studio Moderne' => $prix >= 75000,
        'Appartement Moderne' => $prix >= 150000,
        'Villa' => $prix >= 250000,
        'Duplex' => $prix >= 350000,
        default => false,
    };
}

$sql = "SELECT *, SUBSTRING_INDEX(photo, ',', 1) AS photo_principale 
        FROM produits 
        WHERE statut = 'Accepté' AND STATUS = 'Present' 
        ORDER BY date_ajout DESC";

$result = $connexion->query($sql);
?>



    <div class="row">
    <?php if ($result && $result->rowCount() > 0): ?>
      <?php foreach ($result as $row): ?>
        <?php 
            $type = $row['type_logement'];
            $prix = (int)$row['prix'];
            if (!isVIP($type, $prix)) continue;

            $photo = $row['photo_principale'];
            $description = implode("\n", array_slice(explode("\n", $row['description']), 0, 5));
        ?>
        <div class="col-md-4 col-sm-12 mb-4">
          <div class="shadow-sm p-2 bg-white wow fadeInUp rounded text-center" data-wow-delay="0.1s">
            <div class="card-body text-dark p-1">
              <div class="img-area mb-3">
                <img src="../uploads/<?php echo $photo; ?>" class="img-card" alt="Image du produit">
              </div>
              <a href="#" class="btn btn-sm btn-danger text-white"><?= htmlspecialchars($type); ?></a>
              <p class="text-center line-champ"><?= nl2br(htmlspecialchars($description)); ?></p>
              <p class="text-muted">Prix : <?= number_format($prix, 0, ',', ' ') ?> FCFA</p>
            </div>
            <div class="pb-2">
              <a href="details.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger py-2 px-2 text-white">
                Voir plus <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="alert alert-info">Aucun produit VIP disponible.</div>
    <?php endif; ?>
    </div>
  </div>
</div>


                  

        
         <!-- Footer Start -->
         <?php include_once("footer.php");?>
        <!-- Footer End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../package/lib/wow/wow.min.js"></script>
    <script src="../package/lib/easing/easing.min.js"></script>
    <script src="../package/lib/waypoints/waypoints.min.js"></script>
    <script src="../package/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="../package/js/main.js"></script>
</body>

</html>