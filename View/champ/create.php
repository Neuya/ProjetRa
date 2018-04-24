<?php 
echo "Vous vous apprêtez à insérer un champ dans la Station :<strong> ".$station->getNom().""
        . "</strong> située en <strong>".$station->getPays().""
        . "</strong> à <strong>".$station->getVille()."</strong>";

?>


<form action="index.php" method="post">
    <input type="hidden" name="action" value="created">
    <input type="hidden" name="controller" value ="champ">
    <input type="hidden" name="idStation" value="<?php echo $idStation ?>">
    <fieldset>
        <legend>Inserez ici vos données sur le champ</legend>
        Nom :
        <input type="text" name="nom">
        <br></br>
        Longitude :
        <input type="text" name="longitude">
        <br></br>
        Latitude :
        <input type="text" name="latitude">
        <br></br>
        Altitude :
        <input type="text" name="altitude">
        <br></br>
    </fieldset>
    <button type="submit" class="btn waves-effect waves-light">Inserer le champ</button>
    
    
    
    
</form>
