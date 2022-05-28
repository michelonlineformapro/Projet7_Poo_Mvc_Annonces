<?php
//Appel des modeles
require_once "../modeles/EmailInscriptionUtilisateur.php";
require_once "../modeles/Utilisateurs.php";

//Inscription et envoi d'email Utilisateurs
function envoiEmailInscriptionUtilisateur(){
    //Instance de la classe Email
    $emailUtilisateur = new EmailInscriptionUtilisateur();

    //Les champs du formulaire

    if(isset($_POST['email_utilisateur']) && !empty($_POST['email_utilisateur'])){
        $email = trim(htmlspecialchars($_POST['email_utilisateur']));
    }else{
        ?>
            <div class="text-center">
                <p class="alert alert-warning">Merci de remplir le champ email !</p>
            </div>
            <?php
    }
    if(isset($_POST['password_utilisateur']) && !empty($_POST['password_utilisateur'])){
        $password = trim(htmlspecialchars($_POST['password_utilisateur']));
    }else{
        ?>
        <div class="text-center">
            <p class="alert alert-warning">Merci de remplir le champ mot de pass !</p>
        </div>
        <?php
    }



    //La soumission du formulaire = recup de attribut name du bouton
    if(isset($_POST['btn-valide-inscription'])){

        //Check des email et mot de passe avec preg_match php et les regexs
        if (preg_match('/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}$/', $email)) {
            echo "<div class='container'>
                <p class='alert alert-warning text-success'>Votre email est valide</p>
                </div>";
        }

        if(preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $password)) {
            echo "<div class='container'>
                <p class='alert alert-warning text-success'>Votre mot de passe est valide !</p>
                </div>";
        }


        //Vérification de l'existance des champs du formulaires d'inscription
        if(isset($email) && isset($password)){
            //var_dump($_POST['nom_utilisateur']);
            //var_dump($_POST['email_utilisateur']);
            //var_dump($_POST['password_utilisateur']);

            //Check mot passe === mot de passe repeter
            if($_POST['password_utilisateur'] === $_POST['password_repeter']){
                $valideForm = true;
                if($valideForm){
                    $emailUtilisateur->validerInscriptionUtilisateurEmail();
                    ?>
                    <style>
                        #form-register-user{
                            display: none;
                        }
                    </style>
                    <?php
                }
            }else{
                //Erreur si les 2 mot de passe ne sont pas identiques
                echo "<p class='alert alert-danger'>Le mot de passe répeter n'est pas identique au mot de passe.</p>";
            }
        }else{
            //SINON AFFICHE UNE ERREUR :
            echo "<p class='alert alert-danger'>Erreur ! Merci de remplir tous les champs.</p>";
        }
    }
}
//Connecter un utilisateurs
function connexionUtilisateur(){
    //Instance de la classe Utilisateur
    $utilisateurClasse = new Utilisateurs();
    //Check des champs
    if(isset($_POST['btn-valide-connexion'])) {
        //Vérification de l'existance des champs du formulaires d'inscription
        if (isset($_POST['email_utilisateur']) && isset($_POST['password_utilisateur']) && isset($_POST['role'])) {
            $utilisateurClasse->connecterUtilisateur();
        }
    }

}
//Envoyer un email a un utilisateur
function afficherUtilisateurParIDEmail(){
    $utilisateur = new Utilisateurs();
    $id = $_GET['id_user'];
    //var_dump($id);
    $get_user = $utilisateur->utilisateurParId($id);
    require_once '../vues/utilisateurs/email_utilisateur.php';
    if(isset($_POST['btn-email-vendeur'])){
        //ICI LES FAUX UTILISATEUR NE RECEVRONS JAMMAIS EMAIL
        //REPLACER PAR LE VOTRE
        $to      = "test@mailhog.local";
        //$to      = $get_user['email_utilisateur'];
        $subject = 'Prise de contact';
        $message = $_POST['message_visiteur'];
        $headers = 'From: michel.michael38@gmail.com' . "\r\n" .
            'Reply-To: michel.michael38@gmail.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
        $sendMail = true;
        mail($to, $subject, $message, $headers);

        //var_dump($_POST['email_visiteur']);
        //var_dump($_POST['message_visiteur']);
        if($sendMail){
            ?>
                <style>
                    #email-form-contact{
                        display: none;
                    }
                </style>
            <?php
            echo "<p class='alert alert-success'>Votre email a bien été envoyé, veuillez patienter vous allez etre rediriger !</p>";
            header( "Refresh:3; url=accueil", true, 303);
        }
    }
    //var_dump($get_user);
    return $get_user;
}