<?php include("../include/menu.php"); ?>
<?php include("../fonction/fonction.php");?>

<?php
if (isset($_GET["id"])) {
    $id_user = $_GET["id"];
    # code...
}

?>

<div class="main-container mt-3 pb-5">
   <div class="col-md-12 col-sm-12 mb-3">
       <div class="card-box p-3">
            <div class="row">
                <div class="col-md-4 col-sm-12 mb-3">
                    <input type="text" class="form-control shadow-none" placeholder="rechercher par mot clé ...">
                </div>
                <div class="col-md-3 col-sm-12 mb-3">
                    <input type="date" class="form-control shadow-none">
                </div>
                <div class="col-md-3 col-sm-12 mb-3">
                    <select name="" class="shadow-none form-control select-custom" id="">
                        <option disabled selected>Choisir une option</option>
                        <?php
                        $mois = tousLesMois();
                        foreach ($mois as $nomMois) {
                            echo "<option value=\"" . $nomMois . "\">" . $nomMois . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-2 col-sm-12 mb-2 text-end">
                    <button type="submit" name="afficher" class="shadow-none btn btn-customize text-white w-100 btn-lg">Afficher</button>
                </div>
            </div>
        </div>
        </div>