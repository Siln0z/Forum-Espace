<?php
namespace App\Model\Manager;

use App\Core\AbstractManager as AM;
use App\Core\ManagerInterface;
use App\Controller\UtilisateurController;

class UtilisateurManager extends AM implements ManagerInterface
{
    public function __construct(){
        parent::connect();
    }

    public function getAll(){
        return $this->getResults(
            "App\Model\Entity\Utilisateur",
            "SELECT * FROM utilisateur"
        );
    }

    public function getOneById($id){
        return $this->getOneOrNullResult(
            "App\Model\Entity\Utilisateur",
            "SELECT * FROM utilisateur WHERE id = :num", 
            [
                "num" => $id
            ]
        );
    }

    public function insertUtilisateur($mail, $password){
        return $this->executeQuery(
            "INSERT INTO utilisateur (email, password, role) VALUES (:mail, :pass, 'LAMBDA')",
            [
                "mail" => $mail,
                "pass" => $password
            ]
        );
    }

    

    function getUtilisateurByEmail($mail){
        return $this->getOneOrNullResult(
            "App\Model\Entity\Utilisateur",
            "SELECT * FROM utilisateur WHERE email = :mail",
            [
                "mail" => $mail
            ]
        );
    }

    function getPasswordByEmail($mail){
        return $this->getOneValue(
            "SELECT password FROM utilisateur WHERE email = :mail",
            [
                "mail" => $mail
            ]
        );
    }
    function getList(){
        return $this->getResults(
            "App\Model\Entity\Utilisateur",
            "SELECT * FROM utilisateur_list"
        );
    }

    public function EtatUtilisateur($id, $etat){
        return $this->executeQuery(
            "UPDATE utilisateur SET blocage = :etat WHERE id = :id",
            [
                "id"    => $id,
                "etat"  => $etat ? '1' : '0'
            ]
        );

    }

    
}
