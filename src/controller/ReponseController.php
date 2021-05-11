<?php
    namespace App\Controller;
    
    use App\Core\AbstractController as AC;
    use App\Model\Manager\ReponseManager;
   
    class ReponseController extends AC
    {
        public function __construct(){
            $this->manager = new ReponseManager();
        }

        public function index()
        {
            $reponses = $this->manager->getAll();

            return $this->render("reponse/home.php", [
                "reponses" => $reponses,
                "title"   => "Liste des reponses"
            ]);
        }
    //     public function voirReponse($id)
    //     {
    //         if($id){
                
    //             $reponse = $this->manager->GetOneById($id);
               

    //             return $this->render("reponse/voir.php", [
    //                 "sujet" => $reponse,
    //             ]);
    //         }  
    //         else $this->redirectToRoute("home","index");
    //     }
    }