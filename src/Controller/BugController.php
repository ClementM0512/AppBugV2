<?php
namespace AppBug\Controller;
use AppBug\Models\BugManager;
use AppBug\Models\Bug;

class BugController{
    
    public function Add(){
        $bugManager = new BugManager();
        $bug = new Bug("",$_POST['titre'],$_POST['description'],$_POST['statut'],"",$_POST['NDD'],"","",$_POST['URL']);
        // dd($bug);
        $bugManager->addBug($bug);
        
        return $this->sendJsonResponse($bug, 200);
        //retrun json
    }
    
    public function List(){
        $bugManager = new BugManager();
        $bugs = $bugManager->FindAll();
        $json = json_encode($bugs);

        return $this->sendJsonResponse($json, 200);
    }

    public function Show($id){

        $bugManager = new BugManager();
        $bug = $bugManager->Find($id);
        $json = json_encode($bug);

        return $this->sendJsonResponse($json, 200);
        //return du json   
    }

    //modif a faire, retourner json
    public static function sendJsonResponse($content, $code = 200){
        http_response_code($code);

        header('Content-Type', 'application/json');
        dd($content);
        echo $content;
    }

    public function Error(){
        $content = 'Error 404';
        
        return $this->sendJsonResponse($content, 200);
    }
}
?>