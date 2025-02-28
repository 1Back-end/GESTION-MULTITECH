<?php include("../include/menu.php"); ?>


<div class="main-container mt-3 pb-5">
   <div class="col-md-12 col-sm-12 mb-3">
   <div class="card-box p-3">
        <div class="d-flex align-items-center justfify-content-between">
            <div class="mr-auto">
                <h5 class="text-uppercase">Liste des utilisateurs</h5>
            </div>
            <div class="ml-auto">
                <a href="add_user.php" class="btn btn-customize text-white text-uppercase">
                <i class="fa fa-plus" aria-hidden="true"></i>
                    Ajouter
                </a>
            </div>
        </div>
    </div>
   </div>

   <div class="col-md-12 col-sm-12 mb-3">
    <div class="card-box p-3">
        <div class="table-responsive">
            <table class="table table-striped table-bordered text-center">
                <thead>
                    <tr>
                        <td>#</td>
                        <th>Nom complet</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Statut</th>
                        <th>Ajouté le</th>
                        <th>Actions</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="10">Aucun élément trouvé</td>
                    </tr>
                </tbody>

            </table>
        </div>
    </div>
   </div>
</div>