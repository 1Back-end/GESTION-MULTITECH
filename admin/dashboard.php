<?php include("../include/menu.php"); ?>
<?php include("../fonction/fonction.php");?>
<style>
    h5, h6 {
    margin: 0;
    margin-bottom: 0px;
    padding: 0;
    font-weight: 700;
    color: #1F4283;
    font-family: "Rubik", system-ui;
    font-size: 14px;
}
</style>

<div class="main-container mt-3 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="d-flex align-items-center justify-content-between">
            <div class="mr-auto">
                <h4 class="text-uppercase">Tableau de bord</h4>
            </div>
            <div class="ml-auto">
                <?php echo getCurrentDateTime(); ?>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-sm-12 mb-3">
    <div class="row">
        <!-- Total Motel -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="card-box p-3">
                <div class="text-center">
                    <h6 class="mb-3 text-uppercase">Total Motels</h6>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="mr-auto">
                            <div class="logo">
                                <span class="icon-pending text-white font-weight-bold">
                                    <i class="fas fa-bed fs-3"></i>
                                </span>
                            </div>
                        </div>
                        <div class="ml-auto">
                            <h6 class="mr-2 fs-3"><?php echo $total_motels ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Clients -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="card-box p-3">
                <div class="text-center">
                    <h6 class="mb-3 text-uppercase">Total Clients</h6>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="mr-auto">
                            <div class="logo">
                                <span class="icon-pending text-white font-weight-bold">
                                    <i class="fas fa-users fs-3"></i>
                                </span>
                            </div>
                        </div>
                        <div class="ml-auto">
                            <h6 class="mr-2 fs-3"><?php echo $total_clients?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Admins -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="card-box p-3">
                <div class="text-center">
                    <h6 class="mb-3 text-uppercase">Total Admins</h6>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="mr-auto">
                            <div class="logo">
                                <span class="icon-pending text-white font-weight-bold">
                                    <i class="fas fa-user-shield fs-3"></i>
                                </span>
                            </div>
                        </div>
                        <div class="ml-auto">
                            <h6 class="mr-2 fs-3"><?php echo $total_admins?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
        <div class="card-box p-3">
            <div class="text-center">
                <h6 class="mb-3 text-uppercase">Total Restaurants</h6>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="mr-auto">
                        <div class="logo">
                            <span class="icon-pending text-white font-weight-bold">
                                <i class="fas fa-utensils fs-3"></i> <!-- Icône pour le restaurant -->
                            </span>
                        </div>
                    </div>
                    <div class="ml-auto">
                        <h6 class="mr-2 fs-3"><?php echo $total_restaurants?></h6> <!-- Remplacer 0 par le total des ventes -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="card-box p-3">
                <div class="text-center">
                    <h6 class="mb-3 text-uppercase">Total Proprietaires</h6>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="mr-auto">
                            <div class="logo">
                                <span class="icon-pending text-white font-weight-bold">
                                    <i class="fas fa-users fs-3"></i>
                                </span>
                            </div>
                        </div>
                        <div class="ml-auto">
                            <h6 class="mr-2 fs-3"><?php echo $total_owner?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="card-box p-3">
                <div class="text-center">
                    <h6 class="mb-3 text-uppercase">Total locataires</h6>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="mr-auto">
                            <div class="logo">
                                <span class="icon-pending text-white font-weight-bold">
                                    <i class="fas fa-users fs-3"></i>
                                </span>
                            </div>
                        </div>
                        <div class="ml-auto">
                            <h6 class="mr-2 fs-3"><?php echo $total_tenants?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
