<?php

namespace App\Model\Entity;
    
use App\Core\AbstractEntity as AE;
use App\Core\EntityInterface;

class Utilisateur extends AE implements EntityInterface
    {
        private $id;
        private $pseudo;
        private $email;
        private $password;
        private $dateInscription;
        private $role;
        private $blocage;

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
         * Get the value of pseudo
         */ 
        public function getPseudo()
        {
                return $this->pseudo;
        }

        /**
         * Set the value of pseudo
         *
         * @return  self
         */ 
        public function setPseudo($pseudo)
        {
                $this->pseudo = $pseudo;

                return $this;
        }

       
        /**
         * Get the value of dateInscription
         */ 
        public function getDateInscription($format = "d/m/Y H:i:s")
        {
                return $this->dateInscription->format($format);
        }

        /**
         * Set the value of dateInscription
         *
         * @return  self
         */ 
        public function setDateInscription($dateInscription)
        {
                $this->dateInscription = new \DateTime($dateInscription);

                return $this;
        }

        /**
         * Get the value of role
         */ 
        public function getRole()
        {
                return $this->role;
        }

        /**
         * Set the value of role
         *
         * @return  self
         */ 
        public function setRole($role)
        {
                $this->role = $role;

                return $this;
        }
        public function hasRole($role){
                return $this->role == $role ? true : false;
        }

        /**
         * Get the value of blocage
         */ 
        public function getBlocage()
        {
                return $this->blocage;
        }

        /**
         * Set the value of blocage
         *
         * @return  self
         */ 
        public function setBlocage($blocage)
        {
                $this->blocage = $blocage;

                return $this;
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of password
         */ 
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }
        public function __toString(){
                return $this->pseudo;
        }
    }