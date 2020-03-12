<?php
namespace AppBug\Controller;
use AppBug\Models\BugManager;
use AppBug\Models\Bug;

class BugController{
    
    public function Add(){
        $bugManager = new BugManager();
        // $bug = json_encode("",$_POST['titre'],$_POST['description'],$_POST['statut'],"",$_POST['NDD'],"","",$_POST['URL']);
        $bug = json_encode();
        $bugManager->addBug($bug);
        
        return $this->sendJsonResponse($content, 200);
        //retrun json
    }
    
    public function List(){
        $bugManager = new BugManager();
        $bugs = $bugManager->FindAll();
        dd($bugs);
        foreach ($bugs as $bug) {
            $content = json_encode([
                'titre' => $bug->getTitre(),
                'description' => $bug->getDescription(),
                'statut' => $bug->getStatut(),
                'NDD' => $bug->getNdd(),
                'IP' => $bug->getIp(),
                'URL' => $bug->getURL(),
            ]);
            $content += $content;
        }
        dd($content);
        return $this->sendJsonResponse($content, 200);
        //return du json
    }

    public function Show($id){


        return $this->sendJsonResponse($content, 200); 
        //return du json   
    }

    //modif a faire, retourner json
    public static function sendJsonResponse($content, $code = 200){
        http_response_code($code);

        header('content-type: text/http');

        echo $content;
    }

    public function Error(){
        $content = $this->render('404',[]);
        
        return $this->sendJsonResponse($content, 200);
    }
}
?>