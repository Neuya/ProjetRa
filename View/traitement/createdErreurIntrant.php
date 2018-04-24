

<p> Attention les données suivantes n'existent pas dans la base de données ! </p>
<p> Pour assurer la cohérence de la base veuillez remplir les informations suivantes manquantes</p>
<form method='post' action ='index.php'>
<?php 

foreach($tabIntrantsInconnus as $tab)
{
    for ($i=0;$i<count($tab);$i++)
    {
        echo "Le code intrant <strong>'$tab[$i]'</strong>  est inconnu à la base.";
        echo
            "<fieldset>
            <legend>Inserez ici les données pour le traitement <strong>'$tab[$i]'</strong></legend>
            Code de l'intrant : 
            <input type='text' placeholder='Ex : $tab[$i]' name='code$i'><br></br>
            Type de l'intrant :
            <input type ='text' placeholder='Ex : Ajout d'azote' name='type$i'><br></br>
            Unite de l'intrant :
            <input type='text' placeholder='Ex : Kg/h' name='unite$i'><br></br>
            </fieldset>";
    }
}
?>

<p> Après avoir confirmé l'envoi, vous retournerez sur la page précédente. </p>

        <input type='hidden' name='action' value='created'>
        <input type='hidden' name='controller' value='intrant'>
        <input type='hidden' name='nombreIntrant' value=<?php echo "'$i'"?>>
        <input type='submit' value='Inserer'>
</form>;