<?php

class ModelTraitement
{
    
    private $id;
    private $date;
    private $dose;
    private $idStade;
    private $codeIntrant;
    
    //Constructeur
    public function __construct($id = NULL,$date=NULL,$dose=NULL,$idStade=NULL,$codeIntrant=NULL) {
        if (!is_null($date) && !is_null($dose) && !is_null($idStade) && !is_null($codeIntrant))
        {
            $this->id=$id;
            $this->date=$date;
            $this->dose=$dose;
            $this->idStade=$idStade;
            $this->codeIntrant=$codeIntrant;
        }
    }
    
    //Getters
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getDate()
    {
        return $this->date;
    }
    
    public function getDose()
    {
        return $this->dose;
    }
    
    public function getIdStade()
    {
        return $this->idStade;
    }
    
    public function getcodeIntrant()
    {
        return $this->codeIntrant;
    }
    
    //Insertion d'un objet ModelTraitement dans la table Traitement de la BDD
    public function save()
    {
        $sql = "INSERT INTO Traitement"
                . "(id,date,dose,idStade,codeIntrant) "
                . "VALUES (:id,:date,:dose,:idStade,:codeIntrant)";
        $req_prep = Model::$pdo->prepare($sql);
        $values = array(
          "id" => $this->id,
          "date" => $this->date,
          "dose" => $this->dose,
          "idStade" => $this->idStade,
          "codeIntrant" => $this->codeIntrant
        );
        $req_prep->execute($values);
    }
    
    public static function getRefITK($idITK)
    {
        $sql = "SELECT refITK FROM ITK WHERE id=$idITK";
        $req = Model::$pdo->query($sql);
        $refITK = $req->fetch();
        $req->closeCursor();
        return $refITK[0];
    }
    
    public static function updateITK($idITK,$dateSemis,$nomSemoir)
    {
        $sql = "UPDATE ITK "
                . "SET dateSemis=:dateSemis,"
                . "nomSemoir=:nomSemoir "
                    . "WHERE id=:idITK";
        $req = Model::$pdo->prepare($sql);
        $values = [
            "dateSemis" => $dateSemis,
            "nomSemoir" => $nomSemoir,
            "idITK" => $idITK
            ];
        $req->execute($values);
        return $idITK;
    }
    
    //Insertion du couple idITK & idTraitement dans la table Assoc_Trait_ITK de la BDD
    public static function saveAssocITKTrait($idITK,$idTrait)
    {
        $sql = "INSERT INTO Assoc_Trait_ITK"
                . "(idITK,idTrait)"
                . "VALUES (:idITK,:idTrait)";
        $req_prep = Model::$pdo->prepare($sql);
        $values = array(
            "idITK" => $idITK,
            "idTrait" => $idTrait
       );
        $req_prep->execute($values);
    }
    
    /*Traite les données d'un CSV de type "ITK" :
     * - Insere les données du CSV dans la table Traitement
     * Renvoi un tableau avec l'ensemble des idTraitements générés (idTraitement Auto-Incrémenté)
    */
    public static function recupCSV($csv)
    {
          $data = [];
          $tab_id_trait = [];
 
          foreach($csv as $line) 
          {
             $data[] = str_getcsv($line);
          }
                   
          for ($i=1;$i<count($data);$i++)
          {
             $traitement = $data[$i];
             $dateTraitement = date("Y-m-d", strtotime($traitement[0]));
             /* TO DO test Stade existant ! */ 
             $ModelTrait = new ModelTraitement(NULL,$dateTraitement,
                        $traitement[1],$traitement[2],$traitement[3]);   
             $ModelTrait->save();
             $tab_id_trait[$i-1] = Model::$pdo->lastInsertId();
                
          }
 
          return $tab_id_trait;
         
    }
    
    public static function existeStades($csv)
    {
        require_once File::build_path(array("Model","ModelStade.php"));
        
        $stadesInconnu = [];
        $data = [];
 
        foreach($csv as $line) 
        {
           $data[] = str_getcsv($line);
        }
        for ($i=1;$i<count($data);$i++)
        {
            $traitement = $data[$i];
            $idStade = $traitement[2];

            if (!ModelStade::existe($idStade))
            {
               $stadesInconnu[$i-1] = $idStade;

            }
        }
        return $stadesInconnu;
          
    }
    
    public static function existeIntrants($csv)
    {
        require_once File::build_path(array("Model","ModelIntrant.php"));
         
        $intrantsInconnu = [];
        $data = [];
 
        foreach($csv as $line) 
        {
           $data[] = str_getcsv($line);
        }
        for ($i=1;$i<count($data);$i++)
        {
            $traitement = $data[$i];
            $codeIntrant = $traitement[3];

            if (!ModelIntrant::existe($codeIntrant))
            {
               $intrantsInconnu[$i-1] = $codeIntrant;
               echo $intrantsInconnu[$i-1];
            }
        }
        return $intrantsInconnu;
        
    }
    
    
}

