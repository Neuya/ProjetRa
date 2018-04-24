<?php

$tab_itk_send = serialize($tab_id_itk);
//echo "<input type='hidden' name='tab_itk' value=$tab_itk_send></input>";
echo "<a class='btn' href='index.php?action=create&controller=traitement&tab_itk=$tab_itk_send'>"
        . "Ajouter un Itinéraire technique aux essais insérés</a>";
    
