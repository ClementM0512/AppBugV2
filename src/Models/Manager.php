<?php
namespace AppBug\Models;
class Manager{

  function connexionBdd(){

    // require_once('params.php');

    try
    {
      $pdo_options[\PDO::ATTR_ERRMODE] = \PDO::ERRMODE_EXCEPTION;
      // $bdd = new \PDO('mysql:host='.HOST.';dbname='.TABLENAME.';charset=utf8', LOGIN, PASSWORD, $pdo_options);
      $bdd = new \PDO('mysql:host=localhost;dbname=appbug;charset=utf8', 'root', '', $pdo_options);
      //var_dump(HOST);
      //echo 'co etablie';
    }
    catch (Exception $e)
    {
      die('Erreur : ' . $e->getMessage());
    }
    return $bdd;
  }
}

?>