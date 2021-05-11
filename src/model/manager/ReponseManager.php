<?php
namespace App\Model\Manager;

use App\Core\AbstractManager as AM;
use App\Core\ManagerInterface;
use App\Controller\ReponseController;
use App\Core\Session;

class ReponseManager extends AM implements ManagerInterface
{
    public function __construct(){
        parent::connect();
    }

    public function getAll(){
        return $this->getResults(
            "App\Model\Entity\Reponse",
            "SELECT * FROM reponse"
        );
    }

    public function getOneById($id){
        return $this->getOneOrNullResult(
            "App\Model\Entity\Reponse",
            "SELECT * FROM reponse WHERE id = :num", 
            [
                "num" => $id
            ]
        );
    }

    public function insertReponse($texte,$sujet_id){
        return $this->executeQuery(
            "INSERT INTO reponse (texte, sujet_id, utilisateur_id) VALUES (:texte, :sujet_id, :utilisateur)",
            [
                "texte" => $texte,
                "sujet_id" => $sujet_id,
                "utilisateur" => Session::get("utilisateur")->getId()
            ]
        );
    }
    public function changerEtatReponse($id, $etat){
        return $this->executeQuery(
            "UPDATE reponse SET moderationReponse = :etat WHERE id = :id",
            [
                "id"    => $id,
                "etat"  => $etat ? 0 : 1
            ]
        );

    }
    public function deleteReponse($id){
        return $this->executeQuery( 
            "DELETE FROM reponse WHERE id = :id",
            [
                "id" => $id 
            ]
        );
    }


}
