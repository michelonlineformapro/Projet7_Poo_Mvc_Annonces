<h1 class="text-center text-warning mt-3 shadow p-3">GESTION DE VOS ANNONCES</h1>
<div id="user-dashboard">
    <a href="ajouter_annonce" class="btn btn-success">Ajouter une annonce</a>
    <div class="row mt-3 animate__animated animate__backInDown">
        <?php

        foreach ($annonceParUtilisateur as $data) {

        ?>
        <div class="col-sm-12 col-lg-4 mt-2">
            <div id="annonce-card" class="card shadow">
                <img class="card-img-top img-fluid" src="~/<?= $data['photo_annonce'] ?>"
                     alt="<?= $data['nom_annonce'] ?>" title="<?= $data['nom_annonce'] ?>">
                <div class="card-body">
                    <h5 class="card-title text-warning"><?= $data['nom_annonce'] ?></h5>
                    <p class="card-text text-info"><b>Description :</b></p>
                    <p><?= $data['description_annonce'] ?></p>
                    <p><b class="text-info">Prix : </b><?= $data['prix_annonce'] ?> €</p>
                    <p><b class="text-info">Catégorie : </b><?= $data['type_categorie'] ?></p>
                    <p><b class="text-info">Nom du vendeur : </b><?= $data['email_utilisateur'] ?></p>
                    <p><b class="text-info">Région : </b><?= $data['nom_region'] ?></p>
                    <?php
                    $date_depot = new DateTime($data['date_depot']);
                    ?>
                    <p><b class="text-info">Date de dépot : <?= $date_depot->format('d-m-Y') ?></b></p>

                    <a href="supprimer_annonce&id_suppr=<?= $data['id_annonce'] ?>" type="button" class="btn btn-outline-danger">Supprimer cette annonce</a>

                    <a class="mt-2 btn btn-outline-primary" href="editer_annonce&id_details=<?= $data['id_annonce'] ?>">Editer cette annonce</a>

                    <a href="details_annonce&id_details=<?= $data['id_annonce'] ?>" class="mt-2 btn btn-outline-success">Détails de l' annonce</a>


                </div>
            </div>
        </div>
        <?php
        }


