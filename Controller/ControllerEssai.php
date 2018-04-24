<?php

require_once File::build_path(array("Model","ModelEssai.php"));

class ControllerEssai{
    
    
    
    public static function create()
    {
        $champ = ModelEssai::getChamp(myGet("idChamp"));
        
        $pagetitle="Insertion d'essais";
        $controller="Essai";
        $view="create";
        require_once(File::build_path(array("View","view.php")));
        
    }
    
    public static function created()
    {
        $idChamp = myGet("idChamp");
        $uploaddir = File::build_path(array('uploads')).'/';
        
        $uploadfile = $uploaddir . basename($_FILES['csvessai']['name']);
        
        move_uploaded_file($_FILES['csvessai']['tmp_name'], $uploadfile);
       
        $fichier = file($uploadfile);
        
        $tab_id_itk = ModelEssai::recupCSV($fichier,$idChamp);    
        $pagetitle="Essai correctement inséré";
        $controller="Essai";
        $view="created";
        require_once File::build_path(array("View","view.php"));
        
    }
    
    public static function readAllByChamp()
    {
        $tab_essai = ModelEssai::getAllEssaiByChamp(myGet('idChamp'));
        $controller="Essai";
        $pagetitle="Liste des essais du champ";
        $view="listbychamp";
        require_once(File::build_path(array("View","view.php")));   
    }
}

