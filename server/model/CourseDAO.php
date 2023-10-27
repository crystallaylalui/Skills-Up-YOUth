<?php

    class CourseDAO{

        public function createCourse($url, $title, $description, $badges){
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            
            $sql = "insert into course (playlist_url, course_title , course_description, course_badges) 
                    values (:url, :title, :description, :badges)";

            
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":url",$url);
            $stmt->bindParam(":title",$title);
            $stmt->bindParam(":description",$description);
            $stmt->bindParam(":badges",$badges);
            $status = $stmt->execute();
            

            $stmt = null;
            $pdo = null;

            return $status;
        }

        public function getAllCourse(){
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            
            $sql = "select * from course";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            $courses = [];
            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            while( $row = $stmt->fetch() ) {
                $courses[] = array(
                    'course_id' => $row['course_id'],
                    'playlist_url' => $row["playlist_url"],
                    "course_title"=> $row["course_title"],
                    'course_description' => $row["course_description"],
                    "course_badges" => $row["course_badges"]
                );
            }

            $stmt = null;
            $pdo = null;

            return json_encode($courses);
        }

        public function getCourseById($course_id){
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            
            $sql = "select * from course where course_id=:course_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":course_id",$course_id);
            $stmt->execute();

            $course = null;
            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            while( $row = $stmt->fetch() ) {
                $course = array(
                    'course_id' => $row['course_id'],
                    'playlist_url' => $row["playlist_url"],
                    "course_title"=> $row["course_title"],
                    'course_description' => $row["course_description"],
                    "course_badges" => $row["course_badges"]
                );
            }

            $stmt = null;
            $pdo = null;

            return json_encode($course);
        }

    }


?>