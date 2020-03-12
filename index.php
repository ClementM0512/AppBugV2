<?php
require "vendor/autoload.php";
use AppBug\Controller\BugController;
use AppBug\Models\BugManager;
// var_dump($_SERVER["REQUEST_URI"]);

$arguments = explode("/", $_SERVER["REQUEST_URI"]);

// var_dump($arguments);



switch ($arguments[4]) {

    case "":
    case "list":
        $mana = new BugManager();
        $mana->FindByStatut();

        return (new BugController())->List();
        break;
    case "show":
        $id = $arguments[5];
        return (new BugController())->Show($id);
        break;
    case "add":
        return (new BugController())->Add();
        break;
    case "updt":
        $idBug = $arguments[5];
        return (new BugController())->Update($idBug);
        break;
    case "edit":
        $idBug = $arguments[5];
        return (new BugController())->Update($idBug);
        break;
    default:
        return (new BugController())->Error(); //Erreur 404
}

?>