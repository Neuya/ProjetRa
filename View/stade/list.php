<form method='post' action='index.php'>
            <input type='hidden' name="action" value='recherche'>
            <input type='hidden' name="controller" value="stade">
            <fieldset>
                <legend>Rechercher un stade</legend>
                <input type ="search" placeholder="Entrer un code de stade" name="idStade">
                 <button type="submit" class="btn waves-effect waves-light">Rechercher</button>
            </fieldset>
</form>
<br></br>


    <?php
echo "<table class='striped' style='border 1px solid black'><tr><th>Code Stade</th><th>Description</th></tr>";
foreach ($stade as $_stade)
{
    echo "<tr><td>".$_stade->getIdStade();
    echo "</td><td>".$_stade->getDescription()."<a"
            . "href='index.php?action=update&controller=stade&idStade='".$_stade->getIdStade()."'>"
            . "<i style='color : green;' class='material-icons right'>create</i></a>";    
    echo "</td></tr>";
}
echo "</table>";
?>
<blockquote>
    Le stade que vous recherchez ne figure pas dans la liste? <br></br>
<a class="btn waves-effect waves-light" href='index.php?action=create&controller=stade'>Ajouter un ou plusieurs stades à la base</a>
</blockquote>
