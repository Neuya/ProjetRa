<p> Attention les stades suivants n'existent pas dans la base de données ! </p>

<?php 

foreach($tabStadesInconnus as $tab)
{
    for ($i=0;$i<count($tab);$i++)
    {
    echo "<p> Le stade $tab[$i] est inconnu à la base! </p>";
    }
}
?>

<p> Pour assurer la cohérence des données veuillez insérer un csv de type Stade afin de compléter les stades manquants </p>
<p> Après avoir envoyé le csv, vous retournerez sur la page précédente pour l'insertion des données sur les traitements </p>

<form method="post" action ="index.php?" enctype='multipart/form-data'>
    <input type="hidden" name="action" value="createdInconnu">
    <input type="hidden" name="controller" value="traitement">
<fieldset>
        <input type="file" name="csvstade"></input>
        <legend>Inserez ici votre fichier CSV portant sur les stades</legend>
    </fieldset>
    <input type="submit" value="Envoyer le CSV"></input>
    <?php echo "<input type='hidden' name='tab_itk' value=$tab_id_itk>";
    ?>
</form>