<?php 
    class User{
        private $user_id;
        private $username;
        private $email;
        private $hashedPassword;
        private $points;
        private $badges;
        private $tasks;
        public function __construct($user_id, $username, $email, $hashedPassword, $points, $badges, $tasks){
            $this->user_id = $user_id;
            $this->username = $username;
            $this->email = $email;
            $this->hashedPassword = $hashedPassword;
            $this->points = $points;
            $this->badges = $badges;
            $this->tasks = $tasks;
        }
        public function getUserId(){
            return $this->user_id;
        }
        public function getUsername(){
            return $this->username;
        }
        public function getEmail(){
            return $this->email;
        }
        public function getHashedPassword(){
            return $this->hashedPassword;
        }
        public function getPoints(){
            return $this->points;
        }
        public function setPoints($points){
            $this->points = $points;
        }
        public function getBadges(){
            return $this->badges;
        }
        public function setBadges($badges){
            $this->badges = $badges;
        }
        public function getTasks(){
            return $this->tasks;
        }
        public function setTasks($tasks){
            $this->tasks = $tasks;
        }
    }
?>