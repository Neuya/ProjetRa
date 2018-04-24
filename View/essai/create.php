<?php 
    
    require_once File::build_path(array("Model","ModelEssai.php"));
    require_once File::build_path(array("Model","ModelChamp.php"));
    $champEssai = $champ;
    $idChamp=$champEssai->getId();
    $station = ModelChamp::getStationById($champEssai->getIdStation());
    
    if(!$station->aChampInconnu())
    {
    echo "Vous vous apprêtez a insérer un CSV essai dans le champ nommé : ".$champEssai->getNom();
    echo "<br></br>Ce champ est situé dans la station : ".$station->getNom()." en ".$station->getPays()." à ".$station->getVille().".<br></br>";
    }
    else
    {
        echo "Vous vous apprêtez a insérer un essai directement dans la station nommée : <strong>".$station->getNom()." "
                . "</strong>en<strong> ".$station->getPays()."</strong> à <strong>".$station->getVille().".</strong><br></br>";
    }
?>


<form enctype="multipart/form-data" method="post" action="index.php" id="formessai" >
    <input type='hidden' name='action' value='created'>
    <input type='hidden' name='controller' value='essai'>
    <?php echo "<input type='hidden' name='idChamp' value='$idChamp'>"; ?>    
    <fieldset>
        <legend>Inserez ici votre fichier CSV de type essai</legend>
        <div class="file-field input-field">
            <div class="btn">
                <span>Parcourir</span>
                <input  type="file" name="csvessai" >
            </div>
            <div class="file-path-wrapper">
                <input class="file-path validate" type="text">
            </div>
            
        </div>
    </fieldset>
    <input class="btn" type="submit" value="Inserer l'essai"></input>
   
</form>