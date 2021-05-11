<?php
    namespace App\Controller;
    
    use App\Core\AbstractController as AC;
   
    class RegleController extends AC
    {
        public function __construct(){
        }

        public function index()
        {
            $regles = $this->manager->getAll();

            return $this->render("home/regle.php", [
                "sujets" => $regles,
                "title"  => "regle"
            ]);
        }

    }