<form action="index.php" method="post">
    <input type="hidden" name="action" value="created">
    <input type="hidden" name="controller" value ="station">
   
    <fieldset>
        <legend>Inserez ici vos données sur la station</legend>
        Nom :
        <input type="text" name="nom">
        <br></br>
        Ville :
        <input type="text" name="ville">
        <br></br>
        Pays :
        <input type="text" name="pays">
        <br></br>
        Longitude :
        <input type="text" name="longi">
        <br></br>
        Latitude :
        <input type="text" name="lati">
        <br></br>
    </fieldset>
    <button type="submit" class="btn waves-effect waves-light">Inserer la station</button>
    
    
    
    
</form>