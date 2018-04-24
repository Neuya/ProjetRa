<?php


class ModelStade {
    
    private   $idStade;
    private   $description;
 
    
    public function __construct($id=NULL,$descr=NULL) {
        if(!is_null($id) && !is_null($descr))
        {
            $this->idStade=$id;
            $this->description=$descr;
        }
    }
    
    public function getIdStade()
    {
        return $this->idStade;
    }
    
    public function getDescription()
    {
        return $this->description;
    }
    
    public function save()
    {
        $sql = "INSERT INTO "
                . "Stade (idStade,description)"
                . " VALUES (:id,:desc)";
        
        $req = Model::$pdo->prepare($sql);
        $values = array(
            "id"=>$this->idStade,
            "desc"=>$this->description
            
        );
        $req->execute($values);
    }
    
    
    public static function readAll()
    {
       $sql = "SELECT * FROM Stade";
       $req = Model::$pdo->query($sql);
       $req->setFetchMode(PDO::FETCH_CLASS,"ModelStade");
       $stades = $req->fetchAll();
       return $stades;
    }
    
    public static function recupCSV($csv)
    {
        $data=[];
        $compteur = 0;
        $tab_id_existant = [];
        
        foreach($csv as $line) 
        {
             $data[] = str_getcsv($line);
        }

          
        for ($i=1;$i<count($data);$i++)
        {
            $stade=$data[$i];
            if(!ModelStade::existe($stade[0]))
            {
            $modelStade = new ModelStade($stade[0],$stade[1]);
            $modelStade->save();
            }
            else
            {
                $tab_id_existant[$compteur]=$stade[0];
                $compteur++;
            }
        }
    
        return $tab_id_existant;
    }
    
    public static function existe($idStade)
    {
        $sql = "SELECT COUNT(*) FROM Stade Where idStade = '$idStade'";
        $rep = Model::$pdo->query($sql);
        $existe_tab = $rep->fetch();
        $rep->closeCursor();
        $existe = $existe_tab[0];
        
        return ($existe==1);
    }
    
    public static function search($idStade)
    {
        $sql = "SELECT * FROM `stade` WHERE idStade LIKE '$idStade'";
        $req = Model::$pdo->query($sql);
        $req->setFetchMode(PDO::FETCH_CLASS,"ModelStade");
        
        $stade = $req->fetchAll();
        $req->closeCursor();
        
        return $stade;
        
    }
}
