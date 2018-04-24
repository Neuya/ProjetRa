<?php


class ModelIntrant {
   
   private $code;
   private $type;
   private $unite;
   
   public function __construct ($code = NULL, $type = NULL, $unite = NULL)
   {
       if(!is_null($code) && !is_null($type) && !is_null($unite))
       {
           $this->code = $code;
           $this->type = $type;
           $this->unite = $unite;
       }
   }
   
   public function getCode()
   {
       return $this->code;
   }
   
   public function getType()
   {
       return $this->type;
   }
   
   public function getUnite()
   {
       return $this->unite;
   }
   
   public function save()
   {
       $sql = "INSERT INTO Type_Traitement (code,type,unite)"
               . " VALUES (:code,:type,:unite)";
       $req = Model::$pdo->prepare($sql);
       
       $values = array(
           "code"=>$this->code,
           "type"=>$this->type,
           "unite"=>$this->unite
       );
       
       $req->execute($values);
   }
   
   public static function getById($id)
   {
       $sql = "SELECT * "
               . "FROM Type_Traitement"
               . " WHERE code=$id";
       $req = Model::$pdo->query($sql);
       $req->setFetchMode(PDO::FETCH_CLASS,"ModelIntrant");
       $intrant = $req->fetchAll();
       return $intrant[0];
   }
   
   public static function getAll()
   {
       $sql = "SELECT * FROM Type_Traitement";
       
       $req = Model::$pdo->query($sql);
       $req->setFetchMode(PDO::FETCH_CLASS,"ModelIntrant");
       $intrants = $req->fetchAll();
       
       return $intrants;
   }
   
   public static function existe($code)
   {
       $sql = "SELECT COUNT(*) FROM Type_Traitement WHERE code LIKE '$code'";
       
       $req = Model::$pdo->query($sql);
       $existe = $req->fetch();
       $req->closeCursor();
       return $existe[0]>0;
   }
    
    
    
}
