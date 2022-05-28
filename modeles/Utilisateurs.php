<?php
//Appel de la classe mere Database.php + methode getPDO
require_once "../modeles/Database.php";
class Utilisateurs extends Database
{
    //Les propriétées privées
    private $id_utilisateur;
    private $nom_utilisateur;
    private $email_utilisateur;
    private $password_utilisateur;
    private $role;

    //Connecter un utilisateur
    public function connecterUtilisateur(){
        //Connexion a la base de données
        $db = $this->getPDO();
        //On assigne les champs du formulaire aux propriétées privées
        $this->email_utilisateur = $_POST['email_utilisateur'];
        $this->password_utilisateur = $_POST['password_utilisateur'];
        $this->role = $_POST['role'];

        //Requète SQL
        $sql = "SELECT * FROM utilisateurs WHERE email_utilisateur = ? AND role = ?";

        //Requète préparée
        $stmt = $db->prepare($sql);
        //Liés les params du formulaire a la table
        $stmt->bindParam(1, $this->email_utilisateur);
        $stmt->bindParam(2, $this->role);

        //Execute la requète
        $stmt->execute(array(
            $this->email_utilisateur,
            $this->role
        ));

        //Compter les elements dans table et verifié qu'il y a au - une valeur
        if($stmt->rowCount() >= 1){
            $row =  $stmt->fetch();

                if($this->email_utilisateur === $row['email_utilisateur'] && password_verify($this->password_utilisateur, $row['password_utilisateur']) && $this->role === $row['role']) {
                    if ($row['role'] === "utilisateur") {
                        session_start();
                        $_SESSION['connecter_utilisateur'] = true;
                        //On stock dans une variable de session l'id de chaque utilisateur
                        $_SESSION['id_utilisateur'] = $row['id_utilisateur'];
                        //Son email
                        $_SESSION['email_utilisateur'] = $this->email_utilisateur;
                        //La redirection
                        header("Location: gestion_annonces");
                    }
                    if($row['role'] === "administrateur"){
                        session_start();
                        $_SESSION['connecter_admin'] = true;
                        $_SESSION['email_admin'] = $this->email_utilisateur;
                        header("Location: espace_administration");

                    }
                }else{
                    echo "<p class='alert alert-danger'>Erreur ! Merci de vérifié votre email et mot de passe pour les utilisateurs</p>";
                }


        }else{
            echo "<p class='alert alert-danger'>Aucun utilisateur ne possèdent cet email et mot de passe: Erreur de fetch</p>";

        }
    }

    //Utilisateur par id
    public function utilisateurParId($id){
        $db = $this->getPDO();
        $sql = "SELECT *  FROM utilisateurs WHERE id_utilisateur = ?";
        $stmt = $db->prepare($sql);
        $_GET['id_user'] = $id;
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $get_user = $stmt->fetch();
        return $get_user;
    }
}