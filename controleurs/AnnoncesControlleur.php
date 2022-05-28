<?php
require_once "../modeles/Annonces.php";

//////////////////LA SPLSH PAGE/////////////
function afficherSplashPage(){
    $annonceModele = new Annonces();
    $annonce = $annonceModele->donneesModeleAnnonce();
    require_once "../vues/splash.php";
    return $annonce;
}


///////////////////////POUR LES SIMPLES VISITEURS//////////////
//POUR LES VISITEURS//////
function afficherLesAnnonces()
{
    //Instance de la classe Annonce
    $annonce = new Annonces();
    //stock dansune variable l'appel de la methode concernée
    $recupAnnonce = $annonce->afficherToutesAnnonces();
    require_once "../vues/accueil.php";
    return $recupAnnonce;
}

function afficherDetailsVisiteurs()
{
    //Instance de la classe Annonce
    $annonce = new Annonces();
    $details = $annonce->afficherDetailsUneAnnonce();
    require_once "../vues/annonces/details-annonce-visiteur.php";
    return $details;
}


////////////////////POUR LES UTILISATEURS//////////////////////
///
//Afficher le annonces par utilisateur
function afficherLesAnnoncesParUtilisateur()
{
    //Insatnce du de la classe Annonce
    $annonce = new Annonces();
    $annonceParUtilisateur = $annonce->afficherAnnoneParUtilisateur();
    require_once "../vues/utilisateurs/gestion_annonces_utilisateur.php";
    return $annonceParUtilisateur;
}

//Afficher les details d'une annonces utilisateurs
//Affiche les details d'une annone d'un utilisateur
function afficherDetails()
{
    //Instance de la classe Annonce
    $annonce = new Annonces();
    $details = $annonce->afficherDetailsUneAnnonce();
    require_once "../vues/utilisateurs/details_annonce_utilisateur.php";
    return $details;
}

//Ajouter une annonce pour 1 utlisateur
function ajouterAnnonceParUtilisateur()
{
    require_once "../vues/utilisateurs/ajouter_annonces_utilisateur.php";
    $annonce = new Annonces();

    //Si on click
    if (isset($_POST['btn_ajouter_annonce'])) {
        //Upload de la photo
        if (isset($_FILES['photo_annonce'])) {
            $repertoire = "../assets/img/";
            $photo_annonce = $repertoire . basename($_FILES['photo_annonce']['name']);
            $_POST['photo_annonce'] = $photo_annonce;
            if (move_uploaded_file($_FILES['photo_annonce']['tmp_name'], $photo_annonce)) {
                echo "<p class='alert alert-success'>Le fichier est valide et téléchargé avec succès !</p>";
            } else {
                echo "<p class='alert alert-danger'>Erreur lors du téléchargement de votre fichier !</p>";
            }
        } else {
            echo "<p class='alert alert-danger'>Le fichier est invalide seul les format .png, .jpg, .bmp, .svg, .webp sont autorisé !</p>";
        }
        if (isset($_POST['nom_annonce']) && isset($_POST['description_annonce']) && isset($_POST['prix_annonce']) && isset($_POST['photo_annonce']) && isset($_POST['date_depot']) && isset($_POST['categorie_id']) && $_SESSION['id_utilisateur'] && isset($_POST['regions_id'])) {
            $ajouterAnnonce = $annonce->ajouterUneAnnonce();
            if ($ajouterAnnonce) {
                ?>
                <style>
                    #ajouter-annonce-form {
                        display: none;
                    }
                </style>
                <?php
                echo "<p class='alert alert-success'>Votre annonce a bien été ajouté, veuillez patienter vous allez etre rediriger !</p>";
                header("Refresh:3; url=gestion_annonces", true, 303);
            } else {
                echo "<p class='alert alert-danger'>Une erreur est survenue durant l'ajout de votre annonce merci de réessayé !</p>";
            }
        } else {
            echo "<p class='alert alert-danger'>Erreur : Merci de remplir tous les champs !</p>";
        }
    }

}

//Mettre a jour annonce utilisateur
//Editer une annonce pour un utilisateur
function editerAnnonceParUrilisateur()
{
    require_once "../vues/utilisateurs/editer_annonces_utilisateur.php";
    $annonce = new Annonces();
    //Si on click
    if (isset($_POST['btn_editer_annonce'])) {
        //Upload de la photo
        if (isset($_FILES['photo_annonce'])) {
            $repertoire = "../assets/img/";
            $photo_annonce = $repertoire . basename($_FILES['photo_annonce']['name']);
            $_POST['photo_annonce'] = $photo_annonce;
            if (move_uploaded_file($_FILES['photo_annonce']['tmp_name'], $photo_annonce)) {
                echo "<p class='alert alert-success'>Le fichier est valide et téléchargé avec succès !</p>";
            } else {
                echo "<p class='alert alert-danger'>Erreur lors du téléchargement de votre fichier !</p>";
            }
        } else {
            echo "<p class='alert alert-danger'>Le fichier est invalide seul les format .png, .jpg, .bmp, .svg, .webp sont autorisé !</p>";
        }
        if (isset($_POST['nom_annonce']) && isset($_POST['description_annonce']) && isset($_POST['prix_annonce']) && isset($_POST['photo_annonce']) && isset($_POST['date_depot']) && isset($_POST['categorie_id']) && $_SESSION['id_utilisateur'] && isset($_POST['regions_id'])) {
            $editerAnnonce = $annonce->editerUneAnnonce();
            if ($editerAnnonce) {
                ?>
                <style>
                    #editer-annonce-form {
                        display: none;
                    }
                </style>
                <?php
                echo "<p class='alert alert-success'>Votre annonce a bien été mis a jour, veuillez patienter vous allez etre rediriger !</p>";
                header("Refresh:3; url=gestion_annonces", true, 303);
            } else {
                echo "<p class='alert alert-danger'>Une erreur est survenue durant l'ajout de votre annonce merci de réessayé !</p>";
            }
        } else {
            echo "<p class='alert alert-danger'>Erreur : Merci de remplir tous les champs !</p>";
        }
    }
}

//Supprimer une annone d'un utilisateur
function supprimerAnnonceUtilisateur()
{
    //Instance du model (classe) annonce
    $annonce = new Annonces();
    $delete = $annonce->suprimerAnnonce();
    if ($delete) {
        echo "<p class='alert alert-success'>Votre annonce a bien été supprimer, veuillez patienter vous allez etre rediriger !</p>";
        header("Refresh:3; url=gestion_annonces", true, 303);
    } else {
        echo "rien a supprimer";
    }

}

//Exporter l'annonce ne PDF
function annoncePDF($id){
    $annonce = new Annonces();
    $_GET['id_annonce'] = $id;
    $afficherPDF = $annonce->pdfExportParId($id);
    return $afficherPDF;
}

//Recherche plain texte
function rechercheGlobaleMotCle(){
    $annonce = new Annonces();
    $results = $annonce->rechercheAnnonceMotCle();
    //var_dump($results);
    ?>
        <style>
            #annonces-accueil, #carte-accueil{
                display: none;
            }
        </style>

    <div class="container mt-3 text-center animate__animated animate__backInDown shadow">
            <h3 class="text-danger">RESULTAT DE VOTRE RECHERCHE : <?= $_POST['recherche'] ?></h3>
            <?php
            foreach ($results as $details){
                ?>
                <div class="mt-3 col-sm-12 col-lg-4 mt-2 container p-3">
                    <div id="annonce-card" class="card">
                        <div class="mt-3 text-center">
                            <img width="25%" class="img-fluid" src="~/<?= $details['photo_annonce'] ?>" alt="<?= $details['nom_annonce'] ?>" title="<?= $details['nom_annonce'] ?>">
                        </div>

                        <div class="card-body">
                            <h5 class="card-title"><?= $details['nom_annonce'] ?></h5>
                            <p class="card-text"><b>Description :</b></p>
                            <p><?= $details['description_annonce'] ?></p>
                            <p><b>Prix : </b><?= $details['prix_annonce'] ?> €</p>
                            <p><b>Catégorie : </b><?= $details['type_categorie'] ?></p>
                            <p><b>Nom du vendeur : </b><?= $details['email_utilisateur'] ?></p>
                            <p><b>Région : </b><?= $details['nom_region'] ?></p>
                            <?php
                            $date_depot = new DateTime($details['date_depot']);
                            ?>
                            <p><em>Date de dépot : <?= $date_depot->format('d-m-Y') ?></em></p>
                            <a href="accueil" type="button" class="btn btn-outline-warning mt-3">Retour</a>
                            <!--Modal contact vendeur-->
                            <!-- Button trigger modal -->
                            <a href="email_vendeur?id_user=<?= $details['utilisateur_id'] ?>" class="btn btn-outline-secondary mt-3">Contacter le vendeur</a>
                            <a target="_blank" href="pdf&id_annonce=<?= $details['id_annonce'] ?>" class="btn btn-outline-danger mt-3">Exporter l'annonce au format PDF</a>
                        </div>
                    </div>
                </div>
                <?php
            }
        ?>
    </div>
        <?php

    //return $results;
}

//Recherche par categorie et region
function afficherAnnonceParCategorieEtRegion()
{
    $annonce = new Annonces();
    $results = $annonce->getAnnonceByRegionAndCategorie();
    //var_dump($results);
    ?>
    <style>
        #annonces-accueil, #carte-accueil{
            display: none;
        }
    </style>

    <div class="container mt-3 text-center animate__animated animate__backInDown shadow">
        <h3 class="text-danger">RESULTAT DE VOTRE RECHERCHE : </h3>
        <?php
        foreach ($results as $details){
            ?>
            <div class="mt-3 col-sm-12 col-lg-4 mt-2 container p-3">
                <div id="annonce-card" class="card">
                    <div class="mt-3 text-center">
                        <img width="25%" class="img-fluid" src="~/<?= $details['photo_annonce'] ?>" alt="<?= $details['nom_annonce'] ?>" title="<?= $details['nom_annonce'] ?>">
                    </div>

                    <div class="card-body">
                        <h5 class="card-title"><?= $details['nom_annonce'] ?></h5>
                        <p class="card-text"><b>Description :</b></p>
                        <p><?= $details['description_annonce'] ?></p>
                        <p><b>Prix : </b><?= $details['prix_annonce'] ?> €</p>
                        <p><b>Catégorie : </b><?= $details['type_categorie'] ?></p>
                        <p><b>Nom du vendeur : </b><?= $details['email_utilisateur'] ?></p>
                        <p><b>Région : </b><?= $details['nom_region'] ?></p>
                        <?php
                        $date_depot = new DateTime($details['date_depot']);
                        ?>
                        <p><em>Date de dépot : <?= $date_depot->format('d-m-Y') ?></em></p>
                        <a href="accueil" type="button" class="btn btn-outline-warning mt-3">Retour</a>
                        <!--Modal contact vendeur-->
                        <!-- Button trigger modal -->
                        <a href="email_vendeur?id_user=<?= $details['utilisateur_id'] ?>" class="btn btn-outline-secondary mt-3">Contacter le vendeur</a>
                        <a target="_blank" href="pdf&id_annonce=<?= $details['id_annonce'] ?>" class="btn btn-outline-danger mt-3">Exporter l'annonce au format PDF</a>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <?php

}

