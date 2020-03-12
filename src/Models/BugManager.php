<?php
  namespace AppBug\Models;
  use AppBug\Models\Bug;
  use AppBug\Models\Manager;
  use GuzzleHttp\Client;
  
  class BugManager extends Manager{
    private $bugs = [];

    function __construct() {

    }

    private function GetIpURL($URL){
      $NDD = parse_url($URL, PHP_URL_HOST);
      $ip = $this->GetIpNDD($NDD);
      return [
        'ipURL' => $ip,
        'URL'   => $URL
      ];
    }

    private function GetIpNDD($NDD){
      $client = new Client();
      $uri = 'http://ip-api.com/json/'.$NDD;
      $response = $client->request('GET', $uri);

      $data = json_decode($response->getBody()); 
      $data = $data->query;
      return $data;
    }

    public function Find($id){
      $bdd = $this->connexionBdd();
      $state = $bdd->prepare('SELECT * FROM `bug` WHERE id=:id');
      $state->execute(['id' => $id]);

      $data = $state->fetch(\PDO::FETCH_ASSOC);
      $bug = new Bug($data['id'], $data['titre'], $data['description'], $data['statut'], $data['createdAt'], 
      $data['NDD'] , $data['IP'], $data['ipURL'], $data['URL']);

      return($bug);
    }

    public function FindAll() {
      foreach($this->bugs as $bug){
        return $this->bugs;
      }
    }

    public function load(){
      $bdd = $this->connexionBdd();
      $bugs = $bdd->query('SELECT * FROM `bug` ORDER BY `id`',\PDO::FETCH_ASSOC);
      // var_dump($bdd);

      while ($donnee=$bugs->fetch()){
        $bug = new Bug($donnee['id'], $donnee['titre'], $donnee['description'], $donnee['statut'], $donnee['createdAt'], 
        $donnee['NDD'] , $donnee['IP'], $donnee['ipURL'], $donnee['URL']);
        //var_dump($bug);
        array_push($this->bugs,$bug);
      }
    }

    public function addBug(Bug $newBug){
      $bdd = $this->connexionBdd();
      $date = new \DateTime();
      $date = $date->format('Y-m-d H:i:s');

      $ip = $this->GetIpNDD($newBug->getNDD());
      $ipURL = $this->getIpURL($newBug->getIpURL());

      $state = $bdd->prepare("INSERT INTO `bug` (titre, description, statut, createdAt, NDD, IP, ipURL, URL)
       VALUE (:title, :description, :statut, :createdAt, :NDD, :IP, :ipURL, :URL)");
      $state->execute([
        'title' => $newBug->getTitre(),
        'description' => $newBug->getDescription(),
        'statut' => $newBug->getStatut(),
        'createdAt' => $date,
        'NDD' => $newBug->getNdd(),
        'IP' => $ip,
        'ipURL' => $ipURL['ipURL'],
        'URL' => $ipURL['URL'],
      ]);

    }

    public function UpdateBug(Bug $bug){
      $bdd = $this->connexionBdd();
      // var_dump($bug->getTitre());die;
      $state = $bdd->prepare("UPDATE `bug` SET titre = :title, description = :description, statut = :statut WHERE id=:id");
      $state->execute([
        'title' => $bug->getTitre(),
        'description' => $bug->getDescription(),
        'statut' => $bug->getStatut(),
        'id' => $bug->getId()]);
      
    }

    public function FindByStatut() {
      $bdd = $this->connexionBdd();
      $bugs = $bdd->query('SELECT * FROM `bug` WHERE statut=0 ORDER BY `id`',\PDO::FETCH_ASSOC);

      while ($donnee=$bugs->fetch()){
        $bug = new Bug($donnee['id'], $donnee['titre'], $donnee['description'], $donnee['statut'], $donnee['createdAt'],
        $donnee['NDD'] , $donnee['IP'], $donnee['ipURL'], $donnee['URL']);
        //var_dump($bug);
        array_push($this->bugs,$bug);
      }

      // var_dump($this->bugs);
      return($bugs);
    }


  }
?>
