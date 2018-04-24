<?php

require_once File::build_path(array("Model","ModelStade.php"));

class ControllerStade {
    
    
    
    public static function readAll()
    {
        $stade = ModelStade::readAll();
        $controller = "stade";
        $view = "list";
        $pagetitle="Liste des stades";
        require_once File::build_path(array("View","view.php"));
    }
    
    public static function create()
    {
        $controller="stade";
        $view="create";
        $pagetitle="Insertion de stades";
        require_once File::build_path(array('View','view.php'));
    }
    
    public static function created()
    {
        $uploaddir = File::build_path(array('uploads')).'/';
        
        $uploadfile = $uploaddir . basename($_FILES['csvstade']['name']);
        
        move_uploaded_file($_FILES['csvstade']['tmp_name'], $uploadfile);
       
        $fichier = file($uploadfile);
        
        $tab_id_stade=ModelStade::recupCSV($fichier);
        
        $controller="stade";
        $view="created";
        $pagetitle="Stades insérés";
        require_once File::build_path(array("View","view.php"));
    }
    
    public static function recherche()
    {
        $stade=ModelStade::search(myGet("idStade"));
        $controller="stade";
        $view = "search";
        $pagetitle="Résultats de votre recherche";
        require_once File::build_path(array("View","view.php"));
    }
}
