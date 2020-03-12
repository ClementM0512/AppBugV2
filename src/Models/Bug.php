<?php
namespace AppBug\Models;
class Bug{
    public $id;
    public $titre;
    public $description;
    public $statut;
    public $createdAt;
    public $NDD;
    public $IP;
    public $ipURL;
    public $URL;



    public function __construct($id, $titre, $description, $statut, $createdAt, $NDD, $IP, $ipURL, $URL) {
        $this->id = $id;
        $this->titre = $titre;
        $this->description = $description;
        $this->statut = $statut;
        $this->createdAt = $createdAt;
        $this->NDD = $NDD;
        $this->IP = $IP;
        $this->ipURL = $ipURL;
        $this->URL = $URL;
    }

    function getId() {
        return $this->id;
    }

    function getTitre() {
        return $this->titre;
    }

    function getDescription() {
        return $this->description;
    }

    function getStatut() {
        return $this->statut;
    }

    function getNdd() {
        return $this->NDD;
    }

    function getIp() {
        return $this->IP;
    }

    function getIpURL() {
        return $this->ipURL;
    }

    function getURL() {
        return $this->URL;
    }

    public function getCreatedAt(){
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt){
        $this->createdAt = $createdAt;

        return $this;
    }

    function setId($id) {
        $this->id = $id;

        return $this;
    }

    function setNdd($NDD) {
        $this->NDD = $NDD;

        return $this;
    }

    function setIp($IP) {
        $this->IP = $IP;

        return $this;
    }

    function setIpURL($ipURL) {
        $this->ipURL = $ipURL;

        return $this;
    }

    function setURL($URL) {
        $this->URL = $URL;

        return $this;
    }

    function setTitre($titre) {
        $this->titre = $titre;

        return $this;
    }

    function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    function setStatut($statut) {
        $this->statut = $statut;

        return $this;
    }


}

?>
