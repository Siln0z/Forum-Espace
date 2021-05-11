<?php
    namespace App\Controller;
    
    use App\Core\AbstractController as AC;
    use App\Model\Manager\UtilisateurManager;
    use App\Core\Session;
   
    class UtilisateurController extends AC
    {
        public function __construct(){
            $this->manager = new UtilisateurManager();
        }

        public function index()
        {
            $utilisateurs = $this->manager->getAll();

            return $this->render("utilisateur/home.php", [
                "utilisateurs" => $utilisateurs,
                "title"   => "Liste des utilisateurs"
            ]);
        }

        public function bloquerUtilisateur($id)
        {
            if($id){
            $utilisateur = $this->manager->getOneById($id);
                if($utilisateur->getBlocage()){
                    $this->manager->EtatUtilisateur($id, '0');
                    Session::addFlash('error', "Utilisateur bloqué !");
                }
                else{
                    $this->manager->EtatUtilisateur($id, '1');
                    Session::addFlash('success', "Utilisateur débloqué !");
                }
            }
            return $this->redirectToRoute("home", "membres");
        }

        public function membres(){
            $utilisateurs = $this->manager->getAll();

            return $this->render("home/membres.php", [
                "utilisateurs" => $utilisateurs,
                "title"   => "Liste des utilisateurs"
            ]);
            return $this->render("home/membres.php");
        }
        
        public function nbSujetsReponses(){
            $utilisateurs = $this->manager->getList();

            return $this->render("utilisateur/home.php", [
                "utilisateur" => $utilisateurs,
                "title"   => "Nombre de sujets et de réponses d'un utilisateur"
            ]);
        }
    }

    
   