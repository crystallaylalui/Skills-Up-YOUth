<?php

    class Enrollment {

        private $enrollment_id;
        private $user_id;
        private $course_id;
        private $duration;
        private $last_watched_id;
        private $completed_video_id;
        private $completed;

        public function __construct($enrollment_id, $user_id, $course_id, $duration, $last_watched_id, $completed_video_id, $completed) {
            $this->enrollment_id = $enrollment_id;
            $this->user_id = $user_id;
            $this->course_id = $course_id;
            $this->duration = $duration;
            $this->last_watched_id = $last_watched_id;
            $this->completed = $completed;
            $this->completed_video_id = $completed_video_id;
        }



    }

?>