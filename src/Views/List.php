<?php

// include("./Models/bugManager.php");
// include("stdafx.php");
use AppBug\Models\BugManager;
$bugManager = new BugManager();
$bugManager->load();

?>


<!DOCTYPE html>
<html>
  <head>
    <?php require("stdafx2.php");?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Liste des bugs</title>
    <meta charset="utf-8" />
  </head>
  <body class="container">

    <h1 class="center title">Liste des bugs</h1>

    <div class="form-group">
    </br> <a href="add" class="btn btn-success"><i class="fa fa-plus fa-3x "></i></a>
    <div class="custom-control custom-checkbox checkbox-statut">
    
      <input type="checkbox" class="custom-control-input" id="customCheck1">
      <label class="custom-control-label" for="customCheck1">Filtre bugs non résolut</label>
    </div>
    </div>
    
    <table class="table">
      <h3 class="center"> Listes des bugs rencontrées</h3>
  
      <tr class="table-primary">
        <th><h4>Id du bug</h4></th>
        <th>Titre du bug</th>
        <th>Description du bug</th>
        <th>Statut du bug</th>
        <th>NDD</th>
        <th>IP</th>
        <th>ipURL</th>
        <th>Plus de détails</th>
        <th>Modifier</th>
      </tr>

      <tbody>
        <tr>
          
          <?php 
          foreach($bugManager->FindAll() as $bug){ ?>
            <tr id="Bug_<?= $bug->getId();?>">

              <td><?= $bug->getId();?></td>
              <td><?= $bug->getTitre();?></td>
              <td><?=$bug->getDescription();?> </td>
              <td id="td_<?= $bug->getId();?>"><?php
              if ($bug->getStatut()==0){?>
                <a href="" class="trigger badge badge-warning">Non traiter</a>
              <?php }
              else{ ?>
                <div class="badge badge-primary">Résolut</div>
              <?php } ?> </td>
              <td><?=$bug->getNdd();?> </td>
              <td><?=$bug->getIp();?> </td>
              <td><?=$bug->getIpURL();?></td>
              <td><a href="show/<?=$bug->getId()?>"><center><i class="fas fa-search fa-2x"></center></a></td>
              <td><a href="edit/<?=$bug->getId()?>"><center><i class="far fa-edit fa-2x"></center></a></td>
            </tr>
          <?php } ?>
      </tr>
    </table></div>
    
  </body>
  <script src="src/Ressources/js/app.js"></script>
</html>
