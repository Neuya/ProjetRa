<?php


class ControllerAppli {

    public static function accueil(){
                    
                    $pagetitle="Bienvenue!";
                    $controller="appli";
                    $view="Accueil";
                    require File::build_path(array("View","view.php"));
                }
     
    public static function insertion()
    {
        $pagetitle="Choisissez l'action a effectuer";
        $controller="appli";
        $view = "insertion";
        require File::build_path(array("View","view.php"));
                
    }
}