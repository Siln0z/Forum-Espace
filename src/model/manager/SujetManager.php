<?php
namespace App\Model\Manager;

use App\Core\AbstractManager as AM;
use App\Core\ManagerInterface;
use App\Core\Session;

class SujetManager extends AM implements ManagerInterface
{
    public function __construct(){
        parent::connect();
    }

    public function getAll(){
        return $this->getResults(
            "App\Model\Entity\Sujet",
            "SELECT * FROM sujet ORDER BY dateCreation DESC"
        );
    }

    public function getOneById($id){
        return $this->getOneOrNullResult(
            "App\Model\Entity\Sujet",
            "SELECT * FROM sujet WHERE id = :num", 
            [
                "num" => $id
            ]
        );
    }
    public function getAllReponsesBySujet($id){
        return $this->getResults(
            "App\Model\Entity\Reponse",
            "SELECT * FROM reponse WHERE sujet_id = :num",
            [
                "num" => $id
            ]
        );
    }

    public function insertSujet($titre){
        $this->executeQuery(
            "INSERT INTO sujet (titre, utilisateur_id) VALUES (:titre, :utilisateur)",
            [
                "titre" => $titre,
                "utilisateur" => Session::get("utilisateur")->getId()
            ]
        );
        return $this->getLastInsertId();
    }

    public function changerEtatSujet($id, $etat){
        return $this->executeQuery(
            "UPDATE sujet SET moderationSujet = :etat WHERE id = :id",
            [
                "id"    => $id,
                "etat"  => $etat ? 1 : 0
            ]
        );

    }
    public function getAvailableSujet(){
        return $this->getResults(
            "App\Model\Entity\sujet",
            "SELECT * FROM sujet WHERE moderationSujet IS TRUE"
        );
    }

   

   

}
