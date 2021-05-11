<?php
    namespace App\Controller;
    
    use App\Core\AbstractController as AC;
    use App\Model\Manager\SujetManager;
   
    class HomeController extends AC
    {
        public function __construct(){
            $this->manager = new SujetManager();
        }

        public function index()
        {
            $sujets = $this->manager->getAll();

            return $this->render("home/home.php", [
                "sujets" => $sujets,
                "title"  => "sujets"
            ]);
        }

    }