<?php
$bug = $params["bug"];

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php require("stdafx.php");?>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>EditBug</title>
</head>
<body class="container">
    <div>
    <form>
        <fieldset>
            <legend>Edition du bug : <?=$bug->getTitre();?></legend>
            <div class="form-group">
                <label for="Desc">Description</label>
                <textarea class="form-control" id="Desc" rows="5"></textarea>
            </div>
        </fieldset>
        <button type="submit" class="btn btn-primary">Valider</button>
    </form>
    </div>
    <a href="../list" class="btn btn-success app-form"><i class="fas fa-arrow-circle-left fa-3x"></i></a>   
</body>
</html>