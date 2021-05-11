<?php
namespace App\Model\Manager;

use App\Core\AbstractManager as AM;
use App\Core\ManagerInterface;

class InscriptionManager extends AM implements ManagerInterface
{
    public function __construct(){
        parent::connect();
    }
    public function getAll(){
        return;
    }

    public function getOneById($id){
        return;
    }
    

    public function insertInscription($pseudo, $email, $password){
        return $this->executeQuery(
            "INSERT INTO utilisateur (pseudo, email, password, role) VALUES (:pseudo, :mail, :pass, 'LAMBDA')",
            [
                "pseudo" => $pseudo,
                "mail" => $email,
                "pass" => $password
            ]
        );
    }

    function getUtilisateurByEmail($email){
        return $this->getOneOrNullResult(
            "App\Model\Entity\Utilisateur",
            "SELECT * FROM utilisateur WHERE email = :mail",
            [
                "mail" => $email
            ]
        );
    }

    function getPasswordByEmail($email){
        return $this->getOneValue(
            "SELECT password FROM utilisateur WHERE email = :mail",
            [
                "mail" => $email
            ]
        );
    }

}
