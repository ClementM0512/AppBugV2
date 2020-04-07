<?php
require "vendor/autoload.php";
require_once "params.php";

use AppBug\Controller\BugController;
use AppBug\Models\BugManager;

// var_dump($_SERVER["REQUEST_URI"]);
$method = $_SERVER['REQUEST_METHOD'];

$length = strlen(base_url);

$uri = substr($_SERVER['REQUEST_URI'], $length + 1);

switch (true) {
    case $uri == "":
        header("Location: bug");
        break;
    case preg_match('#^bug/(\d+)$#', $uri, $matches) && $method == 'GET':
        // dd('b');
        $id = $matches[1];
        return (new BugController())->Show($id);
        break;
    case preg_match('#^bug(|\?.)#', $uri) && $method == 'GET':
        // dd('a');
        return (new BugController())->List();
        break;
    
    case preg_match('#^bug$#', $uri) && $method == 'POST':
        // dd('c');
        return (new BugController())->Add();
        break;
    // case "updt":
    //     dd('d');
    //     $idBug = $arguments[5];
    //     return (new BugController())->Update($idBug);
    //     break;
    // case "edit":
    //     dd('e');
    //     $idBug = $arguments[5];
    //     return (new BugController())->Update($idBug);
    //     break;
    default:
        dd('test');
        return (new BugController())->Error(); //Erreur 404
}

?>