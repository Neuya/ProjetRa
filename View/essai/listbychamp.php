<?php

foreach($tab_essai as $tab)
{
    $surfaceUE = $tab->getLargeurPassage()*$tab->getLongueurPlanche();
    echo "<span class='article_station'>";
    echo "<br>";
    echo "Nombre de planches : ".$tab->getNbPlanches();
    echo "</br>";
    echo "<br>";
    echo "Longueur d'une planche : ".$tab->getLongueurPlanche();
    echo "</br>";
    echo "<br>";
    echo "Nombre de passages : ".$tab->getNbPassages();
    echo "</br>";
    echo "<br>";
    echo "Surface d'une Unité Expérimentale : ".$surfaceUE." m²";
    echo "</br>";
    echo "<br>";
    echo "Latitude Essai : ".$tab->getLatitude();
    echo "</br>";
    echo "<br>";
    echo "Longitude Essai : ".$tab->getLongitude();
    echo "</br>";
    echo "<br>";
    echo "idEquipeITK : ".$tab->getIdITK();
    echo "</br>";
    echo "<br>";
    echo "</span>";
}