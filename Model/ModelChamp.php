<?php

require_once File::build_path(array("Model","Model.php"));


class ModelChamp
{
    private $id;
    private $nom;
    private $longitude;
    private $latitude;
    private $altitude;
    private $idStation;
    
    //Constructeur
    public function __construct($id=NULL,$nom=NULL,$longi=NULL,$lati=NULL,$alti=NULL,$idStat=NULL) {
        
        if(!is_null($nom) && !is_null($longi)  && !is_null($lati)  && !is_null($alti)  && !is_null($idStat))
        {
            $this->id = $id;
            $this->nom = $nom;
            $this->longitude = $longi;
            $this->latitude = $lati;
            $this->altitude = $alti;
            $this->idStation = $idStat;
            
        }
    }
    
    //Getters
    public function getId()
    {
        return $this->id;
    }
    
    public function getNom()
    {
        return $this->nom;
    }
    
    public function getLatitude()
    {
        return $this->latitude;
    }
    
    public function getLongitude()
    {
        return $this->longitude;
    }
    
    public function getAltitude()
    {
        return $this->altitude;
    }
    
    public function getIdStation()
    {
        return $this->idStation;
    }
        
    public function save()
    {
        $sql = "INSERT "
                . "INTO Champ (id,nom,longitude,latitude,altitude,idStation) "
                . "VALUES (:id,:nom,:longitude,:latitude,:altitude,:idStation)";
        $req = Model::$pdo->prepare($sql);
        $values = array(
            "id"=>$this->id,
            "nom"=>$this->nom,
            "longitude"=>$this->longitude,
            "latitude"=>$this->latitude,
            "altitude"=>$this->altitude,
            "idStation"=>$this->idStation
        );
        $req->execute($values);
    }
    
    
    //Tous les noms des champs
    public static function getAllNameChamp()
    {
        $rep = Model::$pdo->query("SELECT nom FROM Champ ");
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelChamp');
        $tab_obj = $rep->fetchAll();
        return $tab_obj;
    }
    
    //Tous les champs de la station avec un id = $idStation
    public static function getChampByStation($idStation)
    {
        $rep = Model::$pdo->query("SELECT * FROM Champ WHERE idStation =$idStation");
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelChamp');
        $tab_obj = $rep->fetchAll();
        return $tab_obj;      
    }
    
    //Recupère infos station dans laquelle est compris le champ
    public static function getStationById($idStation)
    {
        $sql = "SELECT * "
                . "FROM Station_expe"
                ." WHERE id = $idStation";
        $rep = Model::$pdo->query($sql);
        $rep->setFetchMode(PDO::FETCH_CLASS,"ModelStation");
        $station=$rep->fetch();
        return $station;
        
    }
    
    //Renvoi le nombre d'essais effectués dans un champ donné
    public  function countNbEssaisChamp()
    {
        $idChamp=$this->id;
        $sql = "SELECT COUNT(*)"
                . " FROM Champ C"
                . " JOIN Essai E ON C.id=E.idChamp "
                . "WHERE E.idChamp=$idChamp";
        $rep = Model::$pdo->query($sql);
        $nbEssais = $rep->fetch();
        
        $rep->closeCursor();
        return $nbEssais[0];
    }
     

    public static function saveInconnu($idStation)
    {
        $nom="NA";
        $champ = new ModelChamp(NULL,$nom,1,1,1,$idStation);
        $champ->save();
        return Model::$pdo->lastInsertId();
    }
    
    public static function getChampById($idChamp)
    {
         $sql = "SELECT * "
                . "FROM Champ "
                . "WHERE id=$idChamp";
        $req = Model::$pdo->query($sql);
         $req->setFetchMode(PDO::FETCH_CLASS, 'ModelChamp');
        $champ = $req->fetch();     
        return $champ;
    }
    
    public function update()
    {
        
        $sql = "UPDATE Champ "
                . "SET nom=':nom',longitude=':longitude',latitude=':latitude',altitude=':altitude' "
                . "WHERE id=:id";
        $req = Model::$pdo->prepare($sql);
        $values = array(
            "id"=>$this->id,
            "nom"=>$this->nom,
            "longitude"=>$this->longitude,
            "latitude"=>$this->latitude,
            "altitude"=>$this->altitude
        );
        $req->execute($values);
    }
   
    
    
    
    
    
}
