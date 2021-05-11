<?php

namespace App\Model\Entity;
    
use App\Core\AbstractEntity as AE;
use App\Core\EntityInterface;

class Reponse extends AE implements EntityInterface
    {
        private $id;
        private $dateReponse;
        private $texte;
        private $moderationReponse;
        private $sujet;
        private $utilisateur;

        public function __construct($data){
            parent::hydrate($data, $this);
        }
        
        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of dateReponse
         */ 
        public function getDateReponse($format = "d/m/Y H:i:s")
        {
                return $this->dateReponse->format($format);
        }

        /**
         * Set the value of dateReponse
         *
         * @return  self
         */ 
        public function setDateReponse($dateReponse)
        {
                $this->dateReponse = new \DateTime($dateReponse);

                return $this;
        }

        /**
         * Get the value of texte
         */ 
        public function getTexte()
        {
                return $this->texte;
        }

        /**
         * Set the value of texte
         *
         * @return  self
         */ 
        public function setTexte($texte)
        {
                $this->texte = $texte;

                return $this;
        }

        /**
         * Get the value of moderationReponse
         */ 
        public function getModerationReponse()
        {
                return $this->moderationReponse;
        }

        /**
         * Set the value of moderationReponse
         *
         * @return  self
         */ 
        public function setModerationReponse($moderationReponse)
        {
                $this->moderationReponse = $moderationReponse;

                return $this;
        }

        /**
         * Get the value of sujet
         */ 
        public function getSujet()
        {
                return $this->sujet;
        }

        /**
         * Set the value of sujet
         *
         * @return  self
         */ 
        public function setSujet($sujet)
        {
                $this->sujet = $sujet;

                return $this;
        }

        /**
         * Get the value of utilisateur
         */ 
        public function getUtilisateur()
        {
                return $this->utilisateur;
        }

        /**
         * Set the value of utilisateur
         *
         * @return  self
         */ 
        public function setUtilisateur($utilisateur)
        {
                $this->utilisateur = $utilisateur;

                return $this;
        }
    }