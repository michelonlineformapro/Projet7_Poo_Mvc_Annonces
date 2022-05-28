<?php
//On demarre une session php
session_start();
/*
 * ob_start() démarre la temporisation de sortie.
 *  Tant qu'elle est enclenchée, aucune donnée, hormis les en-têtes, n'est envoyée au navigateur, mais temporairement mise en tampon.
 */

ob_start();
//Auto loader de class
require "../vendor/autoload.php";
//Appel des controleurs
require_once "../controleurs/UtilisateursControleur.php";
require_once "../controleurs/AdministrationControleur.php";
require_once "../controleurs/AnnoncesControlleur.php";
require_once "../controleurs/RegionsControlleur.php";
require_once "../controleurs/CategoriesControlleur.php";

//Si dans url, un paramètre url existe
if(isset($_GET['url'])){
    $url = $_GET['url'];
}else{
    $url = 'mic-location';
}
//Si index.php?url= null
if($_GET['url'] === ""){
    $url = 'mic-location';
}

//******************PAGE SPLASH *********************//

if($url === "mic-location"){
    $title = "-Mic Annonces-";
    afficherSplashPage();
}
//******************PAGE ACCUEIL *********************//
elseif($url === "accueil"){
    $title = "ACCUEIL -Mic Annonces-";
    afficherLesAnnonces();
    if(isset($_POST['btn-search-text'])){
        //echo $_POST['recherche'];
        rechercheGlobaleMotCle();
        //header("Location: resultat-recherche-texte");
    }
    if(isset($_POST['btn-search-CR'])){
        afficherAnnonceParCategorieEtRegion();
    }
}
//******************DETAILS ANNONCES VISITEUR*****************//
elseif ($url === "details-annonce-visiteur" && isset($_GET['id_details']) && $_GET['id_details'] > 0){
    $title = "DETAILS ANNONCES -Mic Annonces-";
    afficherDetailsVisiteurs();
}
//*************EMAIL VENDEUR*****************************//
elseif ($url === "email_vendeur") {
    $title = "CONTACTER UN VENDEUR -Mic Annonces-";
    afficherUtilisateurParIDEmail();
}
//*****************EXPORT ANNONCE EN PDF************************//
elseif ($url === "pdf" & isset($_GET['id_annonce']) && $_GET['id_annonce'] > 0) {
    annoncePDF($_GET['id_annonce']);
}
//******************CARTE DE FRANCE*********************//
elseif ($url === "region"){
    $title = "Annonce -ANNONCE PAR REGION-";
    $id = $_GET['id'];
    annonceParRegion($_GET['id']);
}
//******************INSCRIPTION UTILISATEUR*********************//
elseif ($url === "inscription-utilisateur"){
    $title = "INSCRIPTION -Mic Annonces-";
    require_once "utilisateurs/inscription_utilisateur.php";
    //Appel de la fonction du controlleur
    envoiEmailInscriptionUtilisateur();
}

//******************CONNECTER UTILISATEUR**********************//
elseif ($url === "connexion-utilisateur"){
    $title = "CONNEXION -Mic Annonces-";
    require_once "utilisateurs/connexion_utilisateur.php";
    //Appel de la fonction du controlleur
    connexionUtilisateur();

}
//********************TABLEUR DE BORD UTILISATEUR**************//
elseif ($url === "gestion_annonces" && $_SESSION['connecter_utilisateur'] && $_SESSION['connecter_utilisateur'] === true){
    $title = "TABLEAU DE BORD UTILISATEUR -Mic Annonces-";
    afficherLesAnnoncesParUtilisateur();
}
//*****************DETAILS ANNONCES UTILISATEURS*****************//
elseif ($url === "details_annonce" && isset($_SESSION['connecter_utilisateur']) && $_SESSION['connecter_utilisateur'] === true && isset($_GET['id_details']) && $_GET['id_details'] > 0){
    $title = "Annonce.com -DETAILS ANNONCES-";
    afficherDetails();
}
//**********************AJOUTER ANNONCE UTILISATEUR*************//
elseif ($url === "ajouter_annonce" && $_SESSION['connecter_utilisateur'] && $_SESSION['connecter_utilisateur'] === true){
    $title = "AJOUTER ANNONCES UTILISATEUR -Mic Annonces-";
    ajouterAnnonceParUtilisateur();
}
//****************EDITER ANONCE UTILISATEURS*********************//
elseif ($url === "editer_annonce" && $_SESSION['connecter_utilisateur'] && $_SESSION['connecter_utilisateur'] === true && isset($_GET['id_details']) && $_GET['id_details'] > 0){
    $title = "AJOUTER ANNONCES UTILISATEUR -Mic Annonces-";
    editerAnnonceParUrilisateur();
}


//****************SUPPRIMER ANNONCE UTILISATEUR**************//
elseif ($url === "supprimer_annonce"  && isset($_SESSION['connecter_utilisateur']) && $_SESSION['connecter_utilisateur'] === true && isset($_GET['id_suppr']) && $_GET['id_suppr'] > 0) {
    $title = "Annonces.com -SUPPRIMER ANNONCES-";
    supprimerAnnonceUtilisateur();
}




//*********************TABLEAU DE BORD ADMINISTRATION******************//
elseif ($url === "espace_administration" && $_SESSION['connecter_admin'] && $_SESSION['connecter_admin'] === true){
    $title = "ESPACE ADMINISTRATION -Mic Annonces-";
    afficherTouteLesTables();
}
//*********************INSCRIPTION ADMINISTRATEUR******************//
elseif ($url === "ajouter_administrateur" && $_SESSION['connecter_admin'] && $_SESSION['connecter_admin'] === true){
    $title = "ESPACE ADMINISTRATION -Mic Annonces-";
    require_once "administration/ajouter_administrateur.php";
    inscriptionAdmin();
}
/*********************SUPPRIMER ADMIN****************/
elseif ($url === "supprimer_administrateur" && $_SESSION['connecter_admin'] && $_SESSION['connecter_admin'] === true){
    $title = "ESPACE ADMINISTRATION -Mic Annonces-";
    supprimerAdmin();
}


elseif ($url === "deconnexion"){
    require_once "deconnexion.php";
}


//Si la route $url n'est pas formée de [#: A-Z a-z O-9] soit index.php?url=NON VALIDE
//On effectue une redirection
elseif($url !=  '#:@&-[\w]+)#'){
    //On redirige vers la page d'accueil
    header("Location: accueil");
}

/*
 * ob_get_clean — Lit le contenu courant du tampon (du cache)de sortie puis l'efface
 */
//ici $content se situe dans le dossier template.php
$content = ob_get_clean();
require_once "template.php";
