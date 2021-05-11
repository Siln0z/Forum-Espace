<?php
    namespace App\Controller;
    
    use App\Core\AbstractController as AC;
    use App\Model\Manager\SujetManager;

    class SujetController extends AC
    {
        public function __construct(){
            $this->manager = new SujetManager();
        }

        public function index()
        {
            $sujets = $this->manager->getAll();

            return $this->render("sujet/home.php", [
                "sujet" => $sujets,
                "title" => "liste des sujets"
            ]);
        }
        public function voirSujet($id)
        {
            if($id){
                
                $sujet = $this->manager->GetOneById($id);
                $reponses = $this->manager->getAllReponsesBySujet($id);
                // $commentaires = $this->manager->findCommentairesByFilm($id);

                return $this->render("sujet/voir.php", [
                    "sujet" => $sujet,
                    // "title"   => $sujet->getTitre(),
                    "reponses" => $reponses,
                    // "commentaires" => $commentaires
                ]);
            }  
            else $this->redirectToRoute("home","index");
        }
    }