<?php
    namespace App\Controller;
    
    use App\Core\AbstractController as AC;
    use App\Core\Session;
    use App\Model\Manager\InscriptionManager;
    use App\Model\Manager\SujetManager;
    use App\Model\Manager\ReponseManager;
    use App\Model\Manager\UtilisateurManager;

    class SecurityController extends AC
    {
        public function __construct(){
            $this->manager = new InscriptionManager();
            $this->smanager = new SujetManager();
            $this->rmanager = new ReponseManager();
            $this->umanager = new UtilisateurManager();
        }
        /**
         * display the login form or compute the login action with post data
         * 
         * @return mixed the render of the login view or a Router redirect (if login action succeeded)
         */
        public function connexion(){
            if(isset($_POST["submit"])){
                $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
                $password = filter_input(INPUT_POST, "password", FILTER_VALIDATE_REGEXP, [
                    "options" => [
                        "regexp" => "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/"
                        //au moins 6 caractères, MAJ, min et chiffre obligatoires
                    ]
                ]);

                if($email && $password){
                    if($pseudo = $this->manager->getUtilisateurByEmail($email)){//on récupère l'utilisateur si l'email saisi correspond en BDD
                        if(password_verify($password, $this->manager->getPasswordByEmail($email))){
                            Session::set("utilisateur", $pseudo);
                            Session::addFlash('success', "Bienvenue $pseudo !");
                            
                            return $this->redirectToRoute("home");
                        }
                        else Session::addFlash('error', "Le mot de passe est erroné");
                    }
                    else Session::addFlash('error', "E-mail inconnu !");
                }
                else Session::addFlash('error', "Tous les champs sont obligatoires et doivent respecter...");

            }

            return $this->render("home/connexion.php");
        }

        public function deconnexion(){
            Session::remove("utilisateur");
            Session::addFlash('success', "Déconnexion réussie, à bientôt !");
            return $this->redirectToRoute("home");
        }

        public function inscription(){
            if(isset($_POST["submit"])){
                $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_DEFAULT);
                $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
                $password = filter_input(INPUT_POST, "password", FILTER_VALIDATE_REGEXP, [
                    "options" => [
                        "regexp" => "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/"
                        //au moins 6 caractères, MAJ, min et chiffre obligatoires
                    ]
                ]);
                $password_repeat = filter_input(INPUT_POST, "password_repeat", FILTER_DEFAULT);
                
                if($email && $password && $pseudo){
                    if(!$this->manager->getUtilisateurByEmail($email)){
                        if($password === $password_repeat){

                            $hash = password_hash($password, PASSWORD_ARGON2I);

                            if($this->manager->insertInscription($pseudo, $email, $hash)){
                                Session::addFlash('success', "Inscription réussie, $pseudo, connectez-vous !");
                                
                                return $this->redirectToRoute("security", "connexion");
                            }
                            else Session::addFlash('error', "Une erreur est survenue...");
                        }
                        else{
                            Session::addFlash('error', "Les mots de passe ne correspondent pas !");
                            Session::addFlash('notice', "Tapez les mêmes mots de passe dans les deux champs !");
                        }
                    }
                    else Session::addFlash('error', "Cette adresse mail est déjà liée à un compte...");
                }
                else Session::addFlash('notice', "Les champs saisis ne respectent pas les valeurs attendues !");
            }

            return $this->render("home/inscription.php");
        }

        public function nouveauSujet(){
            if(isset($_POST["submit"])){

                $titre = filter_input(INPUT_POST, "titre", FILTER_DEFAULT);
                $texte = filter_input(INPUT_POST, "message", FILTER_DEFAULT);

                if($titre && $texte){
                            $sujet_id = $this->smanager->insertSujet($titre);
                            $this->rmanager->insertReponse($texte,$sujet_id);
                            Session::addFlash('success', "Sujet publié avec succes!");
                            
                            return $this->redirectToRoute("sujet", "voirSujet", ["id"=>$sujet_id]);
                            
                }
                else Session::addFlash('error', "le message ne peut pas être mis en ligne !");
            }

            return $this->render("sujet/nouveauSujet.php");
        }
        
        public function RepondreAuSujet($sujet_id){
            if(isset($_POST["submit"])){
            
                $texte = filter_input(INPUT_POST, "message", FILTER_DEFAULT);

                if($texte){
                    $this->rmanager->insertReponse($texte,$sujet_id);
                    Session::addFlash('success', "Réponse publiée avec succes!");

                    return $this->redirectToRoute("sujet", "voirSujet", ["id"=>$sujet_id]);
                }
                else Session::addFlash('notice', "La réponse n'a pas été publiée !");
            }
            return $this->render("sujet/voir.php");
        }

        public function etatSujet($id){

            if($id){
                $sujet = $this->smanager->getOneById($id);
                if($sujet->getModerationSujet()){
                    $this->smanager->changerEtatSujet($id, false);
                    Session::addFlash('error', "sujet desactivé !");
                }
                else{
                    $this->smanager->changerEtatSujet($id, true);
                    Session::addFlash('success', "sujet activé !");
                }
            }
    
            return $this->redirectToRoute("home");
        }
        
    
        public function deleteRep($id){
            if($id){
                $reponse = $this->rmanager->getOneById($id);
                if($this->rmanager->deleteReponse($id)){
                    Session::addFlash('success', "La réponse à été supprimée !");
                }
                else{
                    Session::addFlash('error', "Une erreur est survenue");
                }
            }
            else Session::addFlash('error', "Une erreur est survenue");
            
            return $this->redirectToRoute("sujet", "voirSujet", ["id" => $reponse->getSujet()->getId()]);
        }

        
        

                //     public function membres(){

                //     return $this->render("home/membres.php", [
                //         "utilisateurs" =>$this->UtilisateurManager->getList(), 
                //         "title"        => "Membres du forum"
                //     ]);
                // }

        
    }