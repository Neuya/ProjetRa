<?php

//require_once "./../lib/File.php";
require_once File::build_path(array("Model","Model.php"));

class ModelEssai
{
    private $id;
    private $nbPlanches;
    private $nbPassages;
    private $longueurPlanche;
    private $largeurPassage;
    private $nbLignes;
    private $latitude;
    private $longitude;
    private $idITK;
    private $idChamp;
    
    
    //Constructeur
    public function __construct($id = NULL, $nbPl = NULL, $nbPa=NULL, $longueurPl=NULL, 
            $largPa=NULL, $nbL = NULL, $longiEssai=NULL,$latiEssai=NULL,$idEITK=NULL,$idC=NULL)
    {
        if(!is_null($nbPl) && !is_null($nbPa) && !is_null($longueurPl) 
                && !is_null($nbL) && !is_null($largPa) && !is_null($longiEssai)
                        && !is_null($latiEssai) && !is_null($idEITK) && !is_null($idC))
        {
            $this->id=$id;
            $this->nbPlanches=$nbPl;
            $this->nbPassages=$nbPa;
            $this->longueurPlanche=$longueurPl;
            $this->nbLignes=$nbL;
            $this->largeurPassage=$largPa;
            $this->latitude=$latiEssai;
            $this->longitude=$longiEssai;
            $this->idITK=$idEITK;
            $this->idChamp=$idC;
        }
    }
    
    //Getters
    public function getId()
    {
        return $this->id;
    }
    
     public function getNbPlanches()
    {
        return $this->nbPlanches;
    }
     public function getNbPassages()
    {
        return $this->nbPassages;
    }
     public function getNbLignes()
    {
        return $this->nbLignes;
    }
    
    
     public function getLongueurPlanche()
    {
        return $this->longueurPlanche;
    }
    
    public function getLargeurPassage()
    {
        return $this->largeurPassage;
    }
     public function getLatitude()
    {
        return $this->latitude;
    }
    
     public function getLongitude()
    {
        return $this->longitude;
    }
    
     public function getIdITK()
    {
        return $this->idITK;
    }
     public function getIdChamp()
    {
        return $this->idChamp;
    }
    
    //FONCTIONS 
    
    
    //Insertion dans la base de données
    public function save()
    {
        $sql = "INSERT INTO Essai (id,nbPlanches,nbPassages,longueurPlanche,largeurPassage,nbLignes,"
                . "latitude,longitude,idITK,idChamp) "
                . "VALUES (:id,:nbPl,:nbPa,:longPl,:largPa,:nbL,:latitudeEssai,:longiEssai,:idEITK,:idCh)";
        $req_prep = Model::$pdo->prepare($sql);
        $values = array(
          "id" => $this->id,
          "nbPl" => $this->nbPlanches,  
          "nbPa" => $this->nbPassages,  
          "longPl" => $this->longueurPlanche,
          "largPa" => $this->largeurPassage, 
          "nbL" => $this->nbLignes,  
          "latitudeEssai" => $this->latitude,  
          "longiEssai" => $this->longitude,  
          "idEITK" => $this->idITK,  
          "idCh" => $this->idChamp  
        );
        $req_prep->execute($values);
    } 
    
    //Fonction qui récupère tous les essais sur un champ donné en paramètre => $idC
    
    public static function getAllEssaiByChamp($idC)
    {
        $rep = Model::$pdo->query("SELECT * FROM Essai WHERE idChamp =$idC");
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelEssai');
        $tab_obj = $rep->fetchAll();
        return $tab_obj;    
    }
    
    public function toString()
    {
        echo "$this->nbPlanches";
    }
    
    //Traite un CSV de type "Essai" et insère les données présentes dans la BDD
    public static function recupCSV($csv,$idC)
    {
                    
          $data = [];
          $tab_itk = [];
          $tab_itk[0]="";
          $tab_id_itk = [];
          $compteurId = 0;
          foreach($csv as $line) 
          {
             $data[] = str_getcsv($line);
          }

          
          for ($i=1;$i<count($data);$i++)
          {
              $essai = $data[$i];
             // echo "$essai[0],$essai[1],$essai[2],$essai[3],$essai[4],$essai[5],$essai[6]";
               if(!in_array($essai[7],$tab_itk))
              {
                  $idITK = ModelEssai::saveITK($essai[7]);
                  $tab_id_itk[$compteurId]=$idITK;
                  $compteurId++;
              }
              $tab_itk[$i-1]=$essai[7];
             
              $modelEssai = new ModelEssai(NULL,$essai[0],$essai[1],
                      $essai[2],$essai[3],$essai[4],$essai[5],$essai[6],$idITK,$idC);
             // $modelEssai->toString();
             $modelEssai->save();
          }
          
          return $tab_id_itk;
                                        
    }
    
    public static function getChamp($idChamp)
    {
        $sql = "SELECT * "
                . "FROM Champ "
                . "WHERE id=$idChamp";
        $req = Model::$pdo->query($sql);
         $req->setFetchMode(PDO::FETCH_CLASS, 'ModelChamp');
        $champ = $req->fetch();     
        return $champ;
    }
    
        //Insertion de tuples correspondants dans la table ITK de la BDD
    public static function saveITK($refITK)
    {
        $sql = "INSERT INTO ITK"
                . "(id,dateSemis,refITK)"
                ."VALUES (:id,:dateSemis,:refITK)";
        $req_prep = Model::$pdo->prepare($sql);
        $values = array(
            "id" => NULL,
            "dateSemis"=>NULL,
            "refITK" => $refITK
        );
        $req_prep->execute($values);
        $id_ITK = Model::$pdo->lastInsertId();
        return $id_ITK;
    }

    //Fonction qui renvoi un tableau ne contenant que des éléments distincts
    //Utile pour distinguer les différents refITK insérés dans le CSV de type "Essai"
    //NB : a déplacer dans Model.php
    public static function ElementsDiffTab($tab)
    {
        $tabelem = [];
        $compteur = 1;
        $tabelem[0]=$tab[0];
        for ($i=1;$i<count($tab);$i++)
        {
            if(!in_array($tab[$i], $tabelem))
            {
                $tabelem[$compteur]=$tab[$i];
                $compteur++;
            }
        }
        return $tabelem;
    }
    
}

