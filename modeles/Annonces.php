<?php

require_once "../modeles/Database.php";
class Annonces extends Database
{
    ////////////////////////PROPRIETEES PRIVEES/////////////////////////////
    //Intitulé des colones de la tables annonces php myd Admin
    private $id_annonce;
    private $nom_annonce;
    private $description_annonce;
    private $prix_annonce;
    private $date_depot;
    private $photo_annonce;
    private $categorie_id;
    private $utilisateur_id;
    private $region_id;

    ////////////////////////////////////SPlASH PAGE////////////////////////////////////
    public function donneesModeleAnnonce(){
        ?>
            <div class="mt-5 text-center">
                <h1 class="text-center text-secondary">MIC ANNONCES</h1>
                <em>Ces données viennent du modèles Annonce.php</em>
            </div>

        <?php
    }

    /////////////////////////////////////POUR LES SIMPLES VISITEURS/////////////////////////////////////
    public function afficherToutesAnnonces(){
        $db = $this->getPDO();

        //Requète SQL + limite
        $sql = "SELECT * FROM annonces 
                INNER JOIN utilisateurs ON annonces.utilisateur_id = utilisateurs.id_utilisateur 
                INNER JOIN categories ON annonces.categorie_id = categories.id_categorie 
                INNER JOIN regions ON annonces.regions_id = regions.id_regions ORDER BY Rand() DESC";
        $annonces = $db->query($sql);

        return $annonces;
    }

    /////////////////////////////////////POUR LES UTILISATEURS INSCRITS//////////////////////////////////

    //AFFICHER TOUTES LES ANNONCES PAR UTILISATEUR////
    public function afficherAnnoneParUtilisateur(){
        //Connexion a PDO
        $db = $this->getPDO();
        //Requète SQL + jointure
        $sql = "SELECT * FROM annonces INNER JOIN utilisateurs
                ON annonces.utilisateur_id = utilisateurs.id_utilisateur INNER JOIN categories 
                ON annonces.categorie_id = categories.id_categorie INNER JOIN regions 
                ON annonces.regions_id = regions.id_regions WHERE utilisateur_id = ?";
        //Recup de id utilisateur
        $this->id_annonce = $_SESSION['id_utilisateur'];
        //Requète préparée
        $request = $db->prepare($sql);
        //Lié les paramètres
        $request->bindParam(1, $this->id_annonce);

        //Execution de la requète
        $request->execute();
        //Retourne un objet de resultats

        return $request->fetchAll();
    }


    //AFFICHE LES DETAILS 1 ANNONCES PAR UTILISATEUR///
    public function afficherDetailsUneAnnonce(){
        //Coonexion PDO
        $db = $this->getPDO();
        $sql = "SELECT * FROM annonces 
                INNER JOIN utilisateurs ON annonces.utilisateur_id = utilisateurs.id_utilisateur 
                INNER JOIN categories ON annonces.categorie_id = categories.id_categorie 
                INNER JOIN regions ON annonces.regions_id = regions.id_regions 
                WHERE id_annonce = ?";
        //Recup de id utilisateur
        $this->id_annonce = $_GET['id_details'];
        //Requète préparée
        $request = $db->prepare($sql);
        //Lié les paramètres
        $request->bindParam(1, $this->id_annonce);

        //Execution de la requète
        $request->execute();
        //Retourne un objet de resultats
        $details = $request->fetch();
        return $details;
    }

    //AJOUTER UNE ANNONCES PAR UTILISATEUR////
    //Passage de paramètres dans la methode et assignation au variables du formulaire
    public function ajouterUneAnnonce(){
        $db = $this->getPDO();
        //Les propriétés privée
        $this->nom_annonce = trim(htmlspecialchars($_POST['nom_annonce']));
        $this->description_annonce = trim(htmlspecialchars($_POST['description_annonce']));
        $this->prix_annonce = trim(htmlspecialchars($_POST['prix_annonce']));
        $this->date_depot = trim(htmlspecialchars($_POST['date_depot']));
        $this->photo_annonce = trim(htmlspecialchars($_POST['photo_annonce']));
        $this->categorie_id = trim(htmlspecialchars($_POST['categorie_id']));
        $this->utilisateur_id = trim(htmlspecialchars($_POST['id_utilisateur']));
        $this->region_id = trim(htmlspecialchars($_POST['regions_id']));

        //Requète SQL :
        $sql = "INSERT INTO `annonces`(`nom_annonce`, `description_annonce`, `prix_annonce`, `photo_annonce`, `date_depot`, `categorie_id`, `utilisateur_id`, `regions_id`) VALUES (?,?,?,?,?,?,?,?)";

        //Requète préparée
        $insert = $db->prepare($sql);

        //Liés les paramètre du formulaire a la table phpmyadmin
        $insert->bindParam(1, $this->nom_annonce);
        $insert->bindParam(2, $this->description_annonce);
        $insert->bindParam(3, $this->prix_annonce);
        $insert->bindParam(4, $this->photo_annonce);
        $insert->bindParam(5, $this->date_depot);
        $insert->bindParam(6, $this->categorie_id);
        $insert->bindParam(7, $this->utilisateur_id);
        $insert->bindParam(8, $this->region_id);

        $insert->execute(array(
            $this->nom_annonce,
            $this->description_annonce,
            $this->prix_annonce,
            $this->photo_annonce,
            $this->date_depot,
            $this->categorie_id,
            $this->utilisateur_id,
            $this->region_id
        ));
        return $insert;
    }

    //*****************METTRE A JOUR ANNONCE**********************//
    //Editer une annonce par utilisateur
    public function editerUneAnnonce(){
        $db = $this->getPDO();
        //Les propriétés privée
        $this->nom_annonce = trim(htmlspecialchars($_POST['nom_annonce']));
        $this->description_annonce = trim(htmlspecialchars($_POST['description_annonce']));
        $this->prix_annonce = trim(htmlspecialchars($_POST['prix_annonce']));
        $this->date_depot = trim(htmlspecialchars($_POST['date_depot']));
        $this->photo_annonce = trim(htmlspecialchars($_POST['photo_annonce']));
        $this->categorie_id = trim(htmlspecialchars($_POST['categorie_id']));
        $this->utilisateur_id = trim(htmlspecialchars($_POST['id_utilisateur']));
        $this->region_id = trim(htmlspecialchars($_POST['regions_id']));
        $this->id_annonce = $_GET['id_details'];

        //La requète sql
        $sql = "UPDATE `annonces` SET `nom_annonce`= ?,`description_annonce`= ?,`prix_annonce`= ?,`photo_annonce`= ?,`date_depot`= ?,`categorie_id`= ?,`utilisateur_id`= ?,`regions_id`= ? WHERE id_annonce = ?";
        //La requète préparée
        $update = $db->prepare($sql);
        //Execution de la requète
        $update->execute(array(
            $this->nom_annonce,
            $this->description_annonce,
            $this->prix_annonce,
            $this->photo_annonce,
            $this->date_depot,
            $this->categorie_id,
            $this->utilisateur_id,
            $this->region_id,
            $this->id_annonce));
        return $update;
    }

    /*****************SUPPRIMER ANNONCES UTILISATEURS*************/
    //Supprimer une annonce par utilisateur
    public function suprimerAnnonce(){
        //Appel de  la classe mere et de la methode PDO
        $db = $this->getPDO();
        //Requète sql
        $sql = 'DELETE FROM `annonces` WHERE `id_annonce` = ?';
        //Creation de la requète péparée
        $stmt = $db->prepare($sql);
        $this->id_annonce = $_GET['id_suppr'];
        //Lié les paramètre (ici id de annonce a $_GET id url)
        $stmt->bindParam(1, $this->id_annonce);
        //Execution de la requète
        $delete = $stmt->execute();
        //Retourne l'objet avec son id
        return $delete;
    }

    /*******************EXPORTER ANNONCE AU FORMAT PDF****************/
    public function pdfExportParId($annonceID){
        ob_get_clean();
        //Instance de la classe
        require "../assets/FPDF/fpdf.php";
        $db = $this->getPDO();
        $query = "SELECT * FROM annonces 
                INNER JOIN utilisateurs ON annonces.utilisateur_id = utilisateurs.id_utilisateur 
                INNER JOIN categories ON annonces.categorie_id = categories.id_categorie 
                INNER JOIN regions ON annonces.regions_id = regions.id_regions 
                WHERE id_annonce = ?";
        $req = $db->prepare($query);
        $_GET['id_annone'] = $annonceID;
        $req->bindParam(1, $annonceID);
        $req->execute();
        $details_annonces = $req->fetch();

        $this->nom_annonce = $details_annonces['nom_annonce'];
        $this->description_annonce = $details_annonces['description_annonce'];
        $this->prix_annonce = $details_annonces['prix_annonce'];
        $this->photo_annonce = $details_annonces['photo_annonce'];
        $this->categorie_id = $details_annonces['type_categorie'];
        $this->utilisateur_id = $details_annonces['email_utilisateur'];
        $this->region_id = $details_annonces['nom_region'];

        $pdf = new FPDF('P','mm','A4');
        //Sortie
        $pdf->AddPage();
        //Header
        $pdf->Image('../assets/img/logo-mini.png');

        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(40,10,'Votre annonces : ');
        $pdf->Ln(10);
        $pdf->Cell(190,10, iconv('UTF-8', 'ISO-8859-2', 'Nom du annonce : '.$this->nom_annonce));

        $pdf->Ln(10);
        $pdf->Image(''.$details_annonces['photo_annonce'], 100, 200, 100,100);


        $pdf->Ln(10);
        $pdf->SetFont('Arial','',12);
        $pdf->MultiCell(190,10,'Description de l\'annonce : '.utf8_decode($this->description_annonce), 1, 'J');
        $pdf->Ln(10);
        $pdf->Cell(190,10,'Prix du produit : '.$this->prix_annonce. ' EUROS');
        $pdf->Ln(10);
        $pdf->Cell(190,10,iconv('UTF-8', 'ISO-8859-2', 'Catégorie : '.$this->categorie_id));
        $pdf->Ln(10);
        $pdf->Cell(190,10,'Nom du vendeur : '.$this->utilisateur_id);
        $pdf->Ln(10);
        $pdf->Cell(190,10,iconv('UTF-8', 'ISO-8859-2', 'Région : '.$this->region_id));
        $pdf->Ln(10);
        //$pdf->AddLink("http://localhost/bon_coin_mic/region&id=3");


        $pdf->Output('','annonces.pdf',true);
    }

    //******************ANNONCE PAR MOT CLE***************************//
    public function rechercheAnnonceMotCle(){
        $db = $this->getPDO();
        //Recup de input recherche
        $recherche = $_POST['recherche'];
        //var_dump($recherche);


        $sql = "SELECT * FROM annonces 
                INNER JOIN utilisateurs ON annonces.utilisateur_id = utilisateurs.id_utilisateur 
                INNER JOIN  categories ON annonces.categorie_id = categories.id_categorie 
                INNER JOIN regions ON annonces.regions_id = regions.id_regions 
                WHERE nom_annonce LIKE '%$recherche%' 
                OR description_annonce LIKE '%$recherche%' 
                OR prix_annonce LIKE '%$recherche%' 
                OR type_categorie LIKE '%$recherche%' OR nom_region LIKE '%$recherche%'";
        $res = $db->query($sql);
        if($res){
            return $res;
        }else{
            ?>
                <h3 class="text-danger">PAS DE RESULTAT</h3>
            <?php
        }


    }

    //******************ANNONCE PAR CATEGORIE ET REGION**************//

    //Afficher les détails de l'annonce par regions et categories
    public function getAnnonceByRegionAndCategorie(){
        $db = $this->getPDO();

        //Recup de input recherche
        if(isset($_POST['categorie_id']) && isset($_POST['region_id'])){
            $cat = $_POST['categorie_id'];
            $reg = $_POST['region_id'];
        }else{
            $cat = 1;
            $reg = 1;
            if(empty($cat) || empty($reg)){
                echo "<p class='alert-danger mt-2 p-2'>Merci de remplir les champs Catégorie et Région</p>";
            }
        }


        $sql = "SELECT * FROM annonces 
                INNER JOIN utilisateurs ON annonces.utilisateur_id = utilisateurs.id_utilisateur 
                INNER JOIN  categories ON annonces.categorie_id = categories.id_categorie 
                INNER JOIN regions ON annonces.regions_id = regions.id_regions 
                WHERE regions_id = ? AND categorie_id = ? ";
        $stmt = $db->prepare($sql);

        $stmt->bindParam(1, $_POST['region_id']);
        $stmt->bindParam(2, $_POST['categorie_id']);
        $stmt->execute();
        return $stmt->fetchAll();
    }

}