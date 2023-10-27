<?php

    class Course {

        private $course_id;
        private $playlist_url;
        private $course_title;
        private $course_description;
        private $course_badges;

        public function __construct($course_id, $playlist_url, $course_title, $course_description, $course_badges) {
            $this->course_id = $course_id;
            $this->course_title = $course_title;
            $this->course_description = $course_description;
            $this->course_badges = $course_badges;
        }

    }

?>