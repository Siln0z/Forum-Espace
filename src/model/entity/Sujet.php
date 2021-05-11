<?php

namespace App\Model\Entity;
    
use App\Core\AbstractEntity as AE;
use App\Core\EntityInterface;

class Sujet extends AE implements EntityInterface
    {
        private $id;
        private $dateCreation;
        private $titre;
        private $moderationSujet;
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
         * Get the value of dateCreation
         */ 
        public function getDateCreation($format = "d/m/Y H:i:s")
        {
                return $this->dateCreation->format($format);
        }

        /**
         * Set the value of dateCreation
         *
         * @return  self
         */ 
        public function setDateCreation($dateCreation)
        {
                $this->dateCreation = new \DateTime($dateCreation);

                return $this;
        }

        /**
         * Get the value of titre
         */ 
        public function getTitre()
        {
                return $this->titre;
        }

        /**
         * Set the value of titre
         *
         * @return  self
         */ 
        public function setTitre($titre)
        {
                $this->titre = $titre;

                return $this;
        }

        /**
         * Get the value of moderationSujet
         */ 
        public function getModerationSujet()
        {
                return $this->moderationSujet;
        }

        /**
         * Set the value of moderationSujet
         *
         * @return  self
         */ 
        public function setModerationSujet($moderationSujet)
        {
                $this->moderationSujet = $moderationSujet;

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