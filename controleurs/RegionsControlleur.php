<?php
require_once "../modeles/Regions.php";

function listerRegions(){
    $region = new Regions();
    $afficher_region = $region->afficherToutesRegions();
    ?>
    <option class="text-success" value="">Choix de la région</option>
    <?php
    foreach ($afficher_region as $reg){
        ?>
        <option value="<?= $reg['id_regions'] ?>"><?= $reg['nom_region'] ?></option>
        <?php
    }
    return $afficher_region;
}

function annonceParRegion($id){
    $region = new Regions();
    $id = $_GET['id'];
    $annonceParRegion = $region->afficherAnnonceParRegion($id);
    if($annonceParRegion){
        require_once '../vues/annonces/annonce_region.php';
    }else{
        echo "<p class='alert-warning text-center p-2 mt-2'><b>Pas d'annonce pour cette region</b></p>";
    }
}
