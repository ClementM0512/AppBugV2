<?php
namespace AppBug\Controller;
use AppBug\Models\BugManager;
use AppBug\Models\Bug;

class BugController{

    public function Add(){
        
        if(isset($_POST['titre'])){
            $bugManager = new BugManager();
            $bug = new Bug("",$_POST['titre'],$_POST['description'],$_POST['statut'],"",$_POST['NDD'],"","",$_POST['URL']);
            $bugManager->addBug($bug);
            header('Location: list'); 
        }
        else{
            $content = $this->render('src/Views/addBug', []);
            return $this->sendHttpResponse($content, 200);
        }
    }

    public function List(){
        $bugManager = new BugManager();
        
        $headers = apache_request_headers();

        if (isset($headers["xmlHttpRequest"])) {

            if(isset($_GET['filter'])){
                $bugs = $bugManager->findByStatut();
            }else{
                $bugs = $bugManager->findAll();    
            }

            $response=[
                'success' => true,
                'id'=> $bugs
            ];
    
            echo json_encode($response);

        }else {
            $bugs = $bugManager->findAll();
            $content = $this->render('src/Views/list', ['bugs' => $bugs]);    
            return $this->sendHttpResponse($content, 200);
        }
        
    }

    public function Show($id){
        $bugManager = new BugManager();
        $bug = $bugManager->find($id);
        $content = $this->render('src/Views/show', ['bug' => $bug]);
        
        return $this->sendHttpResponse($content, 200);    
    }

    public function Update($id){
        $bugManager = new BugManager();
        $bug = $bugManager->find($id);

        if (isset($_POST)) {//Si data en post
            if (isset($_POST['statut'])) {
                $bug->setStatut($_POST['statut']);

                $bugManager->UpdateBug($bug); 

                http_response_code(200);
                 header("Content-Type: application/json");
                $response=[
                    'success' => true,
                    'id'=> $bug->getId()
                ];
            }
            else {
                $content = $this->render('src/Views/edit', ['bug' => $bug]);
        
                return $this->sendHttpResponse($content, 200);    
            }
    
        }
        
        

        echo json_encode($response);
    }

    public function render($templatePath, $params){
        $templatePath = $templatePath . ".php";

        ob_start();
        $params;
        
        require($templatePath);

        return ob_get_clean();
    }

    public static function sendHttpResponse($content, $code = 200){
        http_response_code($code);

        header('content-type: text/html');

        echo $content;
    }

    public function Error(){
        $content = $this->render('404',[]);
        
        return $this->sendHttpResponse($content, 200);
    }
}
?>