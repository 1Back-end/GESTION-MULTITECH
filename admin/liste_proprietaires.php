<?php include("../include/menu.php"); ?>
<?php include("../fonction/fonction.php");?>
<style>
    .text-color{
  color: #1F4283;
}
</style>
<div class="main-container mt-3 pb-5">
   <div class="col-md-12 col-sm-12 mb-3">
   <div class="card-box p-3">
        <div class="d-flex align-items-center justfify-content-between">
            <div class="mr-auto">
                <h5 class="text-uppercase">Liste des Propriétaires</h5>
            </div>
            <div class="ml-auto">
                <a href="add_proprietaire.php" class="btn btn-customize text-white text-uppercase">
                <i class="fa fa-plus" aria-hidden="true"></i>
                    Ajouter
                </a>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 mb-3">
       <div class="card-box p-3">
            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom complet</th>
                            <th>Residence</th>
                            <th>N° Téléphone</th>
                            <th>Nationalité</th>
                            <th>Créé le</th>
                            <th>N° CNI</th>
                        </tr>
                    </thead>
                    <tbody>
                                <td colspan="7">Aucun élément trouvé</td>

                    </tbody>
                </table>
            </div>

    </div>
   </div>