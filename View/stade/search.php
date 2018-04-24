<?php

require_once File::build_path(array("View","stade","list.php"));

if(empty($stade))
{
    echo "Aucun stade ne correspond à votre recherche";
}
