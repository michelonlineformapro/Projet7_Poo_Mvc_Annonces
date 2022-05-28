<?php


//Appel de la classe mere Database.php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "../modeles/Database.php";

//Email herite de database pour acceder au singleton getPDO()
class EmailInscriptionUtilisateur extends Database
{
    //Reprise des propriétés privées de la table Utilisateurs de phpMyAdmin
    private $id_utilisateur;
    private $role;
    private $email_utilisateur;
    private $password_utilisateur;

    //Methode d' insertion et d'envoi d'email utilisateur
    public function validerInscriptionUtilisateurEmail(){
        //Instance de la classe PHPMailer
        $mail = new PHPMailer();
        //Trigger des erreurs
        try{
            //Config pour mailtrap
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER; //Autorise le debug
            $mail->isSMTP(); //Utilisation du service mail transfer protocole
            $mail->Host = 'smtp.mailtrap.io'; //Appel du host mailtrap
            $mail->SMTPAuth = true; //Autorise et impose un user name + password
            $mail->Username = '1e9a0eeda636b9'; //Generer lors de la création du compte mailTrap = dans l'espace mailtrap roue crantée + smtp setting -> zendFramework https://mailtrap.io/inboxes/1163067/messages
            $mail->Password = '64faa6d7e0bd01'; // Idem pour le mot de passe
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //La Transport Layer Security (TLS) ou « Sécurité de la couche de transport »
            $mail->Port = 2525; //Port pour mailtrap sinon ->587 ou 465 pour `PHPMailer::ENCRYPTION_SMTPS` et gmail
            $mail->setLanguage('fr', '../vendor/phpmailer/phpmailer/language/');
            $mail->CharSet = 'UTF-8';

            //Envoyeur et destinataire
            $mail->setFrom('annonce@gmail.com', 'Annonces Administration');
            $mail->addAddress('annonce@gmail.com', 'Administrateur Annonces.com');
            $mail->addReplyTo('annonce@gmail.com', 'Annonces Administration');
            //Format HTML
            $mail->isHTML(true);
            //Connexion a PDO
            $db = $this->getPDO();

            //Utilisation des propriétées privées desinféctée
            $this->email_utilisateur = trim(htmlspecialchars($_POST['email_utilisateur']));
            $this->password_utilisateur = trim(htmlspecialchars($_POST['password_utilisateur']));
            //le sujet de email
            $mail->Subject = "Validation de votre inscription sur le site annonces.com";


            //Verifié que le nom et l'email n'existe pas deja
            $checkDatas = $db->prepare("SELECT * FROM utilisateurs WHERE email_utilisateur = ?");
            $checkDatas->execute(array(
                $this->email_utilisateur
            ));
            //Parcours des nom et email des utilisateurs (1 a la fois)
            $utilisateur = $checkDatas->fetch();
            //Si le nom ou email existe deja = on affiche une erreur et stop le process
            if($utilisateur){
                ?>
                <div class='container text-center'>
                    <div class='alert alert-danger'>Ce email n'est pas disponible</div>
                    <a href='inscription-utilisateur' class="btn btn-warning">Recommencer</a>
                </div>
                <?php
            }else{
                //Sinon
                $role = "utilisateur";
                //Insertion des utilisateurs dans la table
                $ajouterUtlisateur = $db->prepare("INSERT INTO `utilisateurs`(`email_utilisateur`, `password_utilisateur`, `role`) VALUES (?,?,?)");
                //Liaison des paramètres
                $ajouterUtlisateur->bindParam(1, $this->email_utilisateur);
                $ajouterUtlisateur->bindParam(2, $this->password_utilisateur);
                $ajouterUtlisateur->bindParam(3, $role);

                //Hash du mot de passe
                $hash_password = password_hash($this->password_utilisateur, PASSWORD_DEFAULT);

                //Execution de la requète = le dernier paramètre est le mot de passe haché
                $ajouterUtlisateur->execute(array($this->email_utilisateur, $hash_password, $role));
                //Si ca marche on appel la redirection
                //Passer les valeur email + password dans url avec get
                //ATTENTION on passe de mailTrap a notre site URL est absolue = localhost/votreprojet/route
                $redirect = "http://localhost/Projet7_Poo_Mvc_Annonces/connexion-utilisateur";
                //Corp de la page HTML5 = ici le css est dans les balises
                $mail->Body = '
                     <!DOCTYPE html>
                        <html lang="fr">
                        <head>
                            <meta charset="UTF-8">
                            <meta http-equiv="Content-Type" content="text/html">
                            <title>Votre inscription sur Mic-Annonce.com</title>
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        </head>
                        <body style="color: #43617f; font-size: 22px;text-align: center; padding: 20px">
                        <div style="padding: 20px;">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS6fV5-gvJoErCmW1i-kzcc5C0slzboniFycw&usqp=CAU" width="75px" height="75px" alt="" title="mic_annonce.com">
                        </div>
                        <div style="padding: 20px;">
                            <h1>Annonce.com</h1>
                            <h2>Bonjour : '.$this->email_utilisateur.'</h2>
                            <p>Vous êtes desormais inscrit sur le site Annonce.com merci de valider votre inscription avec le liens suivant</p><br />
                            <p>Recapitulatif de vos information de connexion</p>                      
                            <p>Email :<b style="color: #8b0000"> '.$this->email_utilisateur.'</b></p>
                            <p>Mot de passe :<b style="color: #8b0000;">'.$this->password_utilisateur.'</p>
                            <br /><br />
                            <a href="' . $redirect . '" style="background-color: darkred; color: #F0F1F2; padding: 20px; text-decoration: none;">Confimer votre inscription sur notre site</a><br />
                            <br /><br />                      
                            <p style="color: #43617f;">Merci d\'utiliser notre site web</p>
                            <p style="color: #43617f;">Cordialement : Annonces.com: Michael MICHEL : Administrateur</p>    
                        </div>
                        </body>
                        </html>
                        ';
                //Conversion de HTML5
                $mail->body = "MIME-Version: 1.0" . "\r\n";
                $mail->body .= "Content-type:text/html;charset=utf8" . "\r\n";


                //Envoi de email
                $mail->send();
                //Message de succes + bouton pour aller a la connexion
                echo "<div class='container text-center'>
                            <div class='w-100 alert alert-success text-center'>Merci pour votre inscription, 
                            un email de validation vous à été envoyé, merci de validé votre inscription pour acceder à votre tableau de bord.</div>
                            <a href='connexion-utilisateur' class='btn btn-warning'>Connexion</a>                                                       
                        </div>";
            }

        } catch (Exception $e) {
            echo "<p class='alert alert-danger'>Une erreur est survenue lors de votre inscription, merci de vérifié les champs !</p>";
            die();
        }
    }
}