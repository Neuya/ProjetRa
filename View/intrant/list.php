<p>Ci-contre la liste de l'ensemble des intrants présents dans la base de données</p>
<table>
    <tr>
        <th>Code</th>
        <th>Type</th>
        <th>Unite</th>
    </tr>
<?php 

foreach($tabIntrants as $tab)
{
    echo "<tr><td>".$tab->getCode()."</td><td>".$tab->getType()."</td><td>".$tab->getUnite()."</td></tr>"; 
}

?>

</table>