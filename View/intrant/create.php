<form method='post' action ='index.php'>
    <fieldset>
        <legend>Inserez ici les données pour le traitement</legend>
        Code de l'intrant : 
        <input type="text" placeholder="Ex : azote0" name="code"><br></br>
        Type de l'intrant :
        <input type ="text" placeholder="Ex : Ajout d'azote" name="type"><br></br>
        Unite de l'intrant :
        <input type="text" placeholder="Ex : Kg/h" name="unite"><br></br>
        <input type="hidden" name="action" value="created">
        <input type="hidden" name="controller" value="intrant">
        <input type="submit" value="Inserer">
</form>