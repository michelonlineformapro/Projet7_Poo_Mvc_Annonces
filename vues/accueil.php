<!--BLOC DE RECHERCHE-->
<div class="mt-3 container animate__animated animate__backInDown shadow">
    <div class="text-center">
        <img src="assets/img/logo-mini.png" alt="mic-annonce.com" title="mic-annonce.com">
        <h3 class="text-secondary">
            Des millions de petites annonces et autant d’occasions de se faire plaisir
        </h3>
    </div>
    <div class="container mt-3">
        <div class="text-center">
            <h3 class="text-warning">RECHERCHER UNE ANNONCE</h3>
            <form method="post" class="w-50" style="margin-left: 25%">
                <input type="search" name="recherche" class="form-control" required placeholder="Rechercher une annonce"/>
                <button type="submit" name="btn-search-text" class="btn btn-outline-success mt-3">Rechercher</button>
            </form>
        </div>
    </div>


    <div class="container">
        <div class="text-center">
            <h3 class="text-info">Rechercher une annonce par catégorie et région</h3>

            <div id="search-form" class="d-flex justify-content-center">
                <form class="form-inline text-center mt-2" method="post">
                    <div class="row">
                        <div class="col-md-6 sol-sm-12">
                            <div class="form-group mb-2">
                                <select name="categorie_id" id="categorie" class="form-control form-search-item">
                                    <?php
                                    afficherToutesCategories();
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 sol-sm-12">
                            <div class="form-group mb-2 ml-2">
                                <select class="form-control" id="stock" name="region_id">
                                    <?php
                                    listerRegions()
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-2 ml-2">
                        <button type="submit" name="btn-search-CR" class="btn btn-outline-warning">Rechercher</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!--CARTE DE FRANCE ET RECHERCHE PAR REGION -->
<div id="carte-accueil" class="mt-3 container text-center animate__animated animate__backInDown shadow">
    <h2 class="text-center text-danger">VOTRE REGION :</h2>
    <link rel="stylesheet" href="assets/carte/cmap/style.css">
    <script src="assets/carte/cmap/jquery-1.11.1.min.js"></script>
    <script src="assets/carte/cmap/France-map.js"></script>
    <script>
        francefree();
    </script>
</div>


<!-- AFFICHER ANNONCES RANDOM + PAGINATION -->
<div id="annonces-accueil" class="mt-3 container shadow p-2 animate__animated animate__backInDown">
    <div class="text-center">
        <h2 class="text-danger p-5">NOS ANONCES</h2>
    </div>
    <div class="row mt-3">
        <?php
        foreach ($recupAnnonce as $data) {
            ?>
            <div class="col-sm-12 col-lg-3 mt-2">
                <div id="annonce-card" class="card">
                    <div class="text-center">
                        <h4 class="text-success p-4">ANNONCES N° : <?= $data['id_annonce'] ?></h4>
                        <h4 class="card-title"><?= $data['nom_annonce'] ?></h4>
                    </div>

                    <div class="img-annonce">
                        <img class="card-img-top img-fluid p-2" src="assets/<?= $data['photo_annonce'] ?>"
                             alt="<?= $data['nom_annonce'] ?>" title="<?= $data['nom_annonce'] ?>">
                    </div>

                    <div class="card-body">

                        <p><b class="text-info">Prix : </b><?= $data['prix_annonce'] ?> €</p>
                        <p><b class="text-info">Catégorie : </b><?= $data['type_categorie'] ?></p>
                        <p><b class="text-info">Nom du vendeur : </b><?= $data['email_utilisateur'] ?></p>
                        <p><b class="text-info">Région : </b><?= $data['nom_region'] ?></p>
                        <a href="details-annonce-visiteur&id_details=<?= $data['id_annonce'] ?>" class="btn btn-outline-success mt-2">Détails de l' annonce</a>

                    </div>
                </div>
            </div>
            <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
            <?php
        }
        ?>
    </div>
</div>
















