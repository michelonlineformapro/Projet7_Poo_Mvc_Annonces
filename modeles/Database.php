<?php

class Database
{
    private $db_host = "localhost";
    private $db_dbname = "petite_annonces";
    private $db_user = "root";
    private $db_pass = "";

    protected $isConnected;

    public function getPDO(){
        //Par defaut la connexion est nul
        $this->isConnected = null;
        //Si c nul
        if($this->isConnected === null){
            //On essaie de ce connecter
            try{
                $this->isConnected = new PDO("mysql:host=".$this->db_host.";dbname=".$this->db_dbname.";charset=utf8", $this->db_user, $this->db_pass);
                //DEBUG DE PDO MySQL
                $this->isConnected->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //echo "C bon t connecté";
                //ici avec le bool isConnected : true ou false = 1 instance de la classe PDO
                return $this->isConnected;
            //Sinon on declenche une erreur
            }catch (PDOException $exception){
                echo "Erreur de connexion à PDO";
                die();
            }
        }
    }
}