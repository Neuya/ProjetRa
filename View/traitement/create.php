

<strong><h5>Attention vérifiez bien que les types d'intrants et les codes des stades que vous 
        allez insérer existent bien dans la base de données. Le cas échéant vous serez contraints 
        d'insérez un CSV ou de remplir un formulaire afin de rajouter les données manquantes.</h5></strong>


<?php 
require_once File::build_path(array("Model","ModelSemis.php"));

$listeNoms = ModelSemis::getAllNom();
$options = "";
for ($i=0;$i<count($listeNoms);$i++)
{
    $options = $options."<option>".$listeNoms[$i][0]."</option>";
}

echo "<form enctype='multipart/form-data' method='post' action='index.php'>";
echo  "<input type='hidden' name='action' value='created'>"
    ."<input type='hidden' name='controller' value='traitement'>";
for ($i=0;$i<count($tab_id_itk);$i++)
{
    echo "<fieldset>"
    ."<legend>Inserez ici votre fichier CSV portant sur le traitement</legend>"
             ."<strong style='color : red;' >Référence ITK : ".$tab_ref_itk[$i]."</strong><br></br>"
             ."Date Semis : <input type='date' name='dateSemis$i'></input><br></br>"
             ."Type de Semis : <select name='typeSemis$i'>$options</select><br></br>"
             ."<div class='file-field input-field'>"
                ."<div class='btn'>"
                    ."<span>Parcourir</span>"
                    ."<input  type='file' name='csvITK$i' >"
                ."</div>"
                ."<div class='file-path-wrapper'>"
                    ."<input class='file-path validate' type='text'>"
                ."</div>"
             ."</div>"
        ."</fieldset>"
        ."<br></br>";

}
$tab_itk_send = serialize($tab_id_itk);
$tab_ref_itk_send = serialize($tab_ref_itk);
echo "<input type='hidden' name='tab_itk' value=$tab_itk_send></input>";
echo "<input type='submit' value='Envoyer'></input>";
echo "</form>";

?>
 
