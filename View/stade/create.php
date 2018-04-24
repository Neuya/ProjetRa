<?php
?>

<form method="post" action ="index.php?" enctype='multipart/form-data'>
    <input type="hidden" name="action" value="create">
    <input type="hidden" name="controller" value="traitement">
    <fieldset>
        <input type="file" name="csvstade"></input>
        <legend>Inserez ici votre fichier CSV portant sur les stades</legend>
    </fieldset>
    <input type="submit" value="Envoyer le CSV"></input>
</form>