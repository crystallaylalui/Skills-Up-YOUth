<?php 
    class User{
        private $username;
        private $hashedPassword;
        public function __construct($username,$hashedPassword){
            $this->username = $username;
            $this->hashedPassword = $hashedPassword;
        }
        public function getUsername(){
            return $this->username;
        }
        public function getHashedPassword(){
            return $this->hashedPassword;
        }
    }
?>