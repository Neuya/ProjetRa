<?php

require_once (File::build_path(array('Model','ModelTraitement.php')));
require_once (File::build_path(array('Model','ModelEssai.php')));
require_once (File::build_path(array("Model","ModelStade.php")));
require_once (File::build_path(array("Model","ModelIntrant.php")));

class ControllerTraitement
{
    
    public static function create()
    {       
        $tab_id_itk = unserialize(myGet("tab_itk"));
       
        $tab_ref_itk = [];
        for ($i=0;$i<count($tab_id_itk);$i++)
        {
            $tab_ref_itk[$i]= ModelTraitement::getRefITK($tab_id_itk[$i]);
        }
        
        $controller="traitement";
        $view = "create";
        $pagetitle = "Inserez vos traitements";
        require_once(File::build_path(array('View','view.php')));        
    }
    
    public static function createdInconnu()
    {
        $uploaddir = File::build_path(array('uploads')).'/';
        
        $uploadfile = $uploaddir . basename($_FILES['csvstade']['name']);
        
        move_uploaded_file($_FILES['csvstade']['tmp_name'], $uploadfile);
       
        $fichier = file($uploadfile);
        
        ModelStade::recupCSV($fichier);
        $tab_id_itk = unserialize(myGet("tab_itk"));
        
        $tab_ref_itk = [];
        for ($i=0;$i<count($tab_id_itk);$i++)
        {
            $tab_ref_itk[$i]= ModelTraitement::getRefITK($tab_id_itk[$i]);
        }
        
        $controller="traitement";
        $view = "create";
        $pagetitle = "Stades insérés";
        require_once(File::build_path(array('View','view.php')));      
    }
    
    public static function created()
    {
        $tab = myGet("tab_itk");
        $tab_itk = unserialize($tab);
        $uploaddir = File::build_path(array('uploads')).'/';
        
        $tab_fichiers = [];
        $tabStadesInconnus = [];        
        $tabIntrantsInconnus = [];
        $aStadeInconnu = false;
        $aIntrantInconnu = false;
        
        $controller = "traitement";
        for ($i=0;$i<count($tab_itk);$i++)
        {
            $uploadfile = $uploaddir . basename($_FILES["csvITK$i"]["name"]);
            
            move_uploaded_file($_FILES["csvITK$i"]['tmp_name'], $uploadfile);
            
            $tab_fichiers[$i] = file($uploadfile);
        }
        
        for ($i=0;$i<count($tab_itk);$i++)
        {  
            $tabStadesInconnus[$i] = ModelTraitement::existeStades($tab_fichiers[$i]);
            $tabIntrantsInconnus[$i] = ModelTraitement::existeIntrants($tab_fichiers[$i]);
            if(!empty($tabStadesInconnus[$i]))
            {
                $aStadeInconnu = true;
            }
            if(!empty($tabIntrantsInconnus[$i]))
            {
                $aIntrantInconnu = true;
            }
        }    
        
       
        if(!($aStadeInconnu && $aIntrantInconnu))
        {
            for ($i=0;$i<count($tab_itk);$i++)
            {

                 $tab_id_trait=ModelTraitement::recupCSV($tab_fichiers[$i]);
                 $dateSemis=myGet("dateSemis$i");      
                 $nomSemoir=myGet("typeSemis$i");
                 if($dateSemis!="")
                 {
                    $id_ITK=ModelTraitement::updateITK($tab_itk[$i],$dateSemis,$nomSemoir);
                 }
            
                 for ($j=0;$j<count($tab_id_trait);$j++)
                 {
                  ModelTraitement::saveAssocITKTrait($tab_itk[$i], $tab_id_trait[$j]);
                 }
            }
                   
            $view="created";
            $pagetitle="Traitements insérés";
            
        }
        
        else 
        {
            $pagetitle = "Erreur dans le csv";
            $tab_id_itk = serialize($tab_itk);
            if ($aStadeInconnu)
            {
                $view = "createdErreurStade";  
            }
            if ($aIntrantInconnu)
            {
                $view = "createdErreurIntrant";
            }
        }
        
        require_once(File::build_path(array('View','view.php')));
    }
    
    
    
}

