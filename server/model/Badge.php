<?php

    class Badge{
        private $badge_id;
        private $badge_name;
        private $badge_type;
        private $badge_img;

        public function __construct($badge_id, $badge_name, $badge_type, $badge_img){
            $this->badge_id = $badge_id;
            $this->badge_name = $badge_name;
            $this->badge_type = $badge_type;
            $this->badge_img = $badge_img;
        }
        public function getBadgeId(){
            return $this->badge_id;
        }
        public function getBadgeName(){
            return $this->badge_name;
        }
        public function getBadgeType(){
            return $this->badge_type;
        }
        public function getBadgeImg(){
            return $this->badge_img;
        }
    }

?>