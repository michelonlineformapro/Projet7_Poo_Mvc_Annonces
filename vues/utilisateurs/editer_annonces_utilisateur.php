<?php
    require_once "../modeles/Annonces.php";
    $detailsClasse  = new Annonces();
    $details = $detailsClasse->afficherDetailsUneAnnonce();
?>
<div class="container w-50 animate__animated animate__backInDown p-3 bg-warning">
    <h1 class="alert alert-success text-center text-warning mt-3">EDITER ANNONCES</h1>

    <div id="editer-annonce-form">
        <form method="post" enctype="multipart/form-data">
            <h2>Editer votre annonces</h2>

            <div class="form-group">
                <label for="nom_annonce">Nom de l'annonce :</label>
                <input type="text" name="nom_annonce" class="form-control" value="<?= $details['nom_annonce'] ?>" placeholder="Nom de votre annonce" id="nom_annonce" required>
            </div>

            <div class="form-group">
                <label for="description_annonce">Description de l'annonce :</label>
                <textarea rows="6" name="description_annonce" class="form-control" placeholder="Description de votre annonce" id="description_annonce" required>
                    <?= $details['description_annonce'] ?>
                </textarea>
            </div>

            <div class="form-group">
                <label for="prix_annonce">Prix de l'annonce :</label>
                <input type="number" step="any" name="prix_annonce" value="<?= $details['prix_annonce'] ?>" class="form-control" placeholder="Prix de votre annonce en €" id="prix_annonce" required/>
            </div>

            <div class="form-group">
                <label for="date_depot">Date de depot de l'annonce :</label>
                <input type="date"  name="date_depot" value="<?= date("Y-m-d") ?>" class="form-control" id="date_depot" required/>
            </div>


            <div class="form-group">
                <label for="categorie_id">Catégorie de l'annonce :</label>
                <select name="categorie_id" class="form-control">
                    <?php
                    afficherToutesCategories();
                    ?>
                </select>
            </div>
            <input type="hidden" value="<?= $_SESSION['id_utilisateur'] ?>" name="id_utilisateur">


            <div class="form-group">
                <label for="regions_id">Région de l'annonce :</label>
                <select name="regions_id" class="form-control">
                    <?php
                    listerRegions()
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="photo_annonce">Photos de l'annonce :</label>
                <span class="d-flex justify-content-center">
                <input type="file"  name="photo_annonce" class="form-control" accept="image/gif, image/png, image/jpeg, image/svg, image/bmp, image/webp " placeholder="Photos 1 de votre annonce" id="photo_annonce1" required/>
            </span>
            </div>

            <div class="form-group">
                <button name="btn_editer_annonce" class="mt-3 btn btn-danger">Mettre à jour votre annonce</button>
                <a href="gestion_annonces" class="btn btn-outline-warning">Retour</a>
            </div>
        </form>
    </div>
</div>

