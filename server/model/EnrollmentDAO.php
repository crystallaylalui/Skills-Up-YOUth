<?php

    class EnrollmentDAO {
        public function createEnrollment($user_id, $course_id, $content, $start_date, $completed){
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            
            $sql = "insert into enrollment (user_id, course_id, content, start_date, completed) 
                    values (:user_id, :course_id, :content, :start_date, :completed)";

            $start_date = date('Y-m-d H:i:s' , strtotime($start_date));

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":user_id",$user_id);
            $stmt->bindParam(":course_id",$course_id);
            $stmt->bindParam(":content",$content);
            $stmt->bindParam(":start_date", $start_date);
            $stmt->bindParam(":completed",$completed);
            $status = $stmt->execute();
            

            $stmt = null;
            $pdo = null;

            return $status;
        }

        public function updateEnrollment($user_id, $course_id, $content, $completed){
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            
            $sql = "update enrollment set content=:content, completed=:completed where user_id=:user_id and course_id=:course_id";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":user_id",$user_id);
            $stmt->bindParam(":course_id",$course_id);
            $stmt->bindParam(":content",$content);
            $stmt->bindParam(":completed",$completed);
            $status = $stmt->execute();
            

            $stmt = null;
            $pdo = null;

            return $status;
        }

        public function getEnrollment($user_id, $course_id) {
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            
            $sql = "select * from enrollment where user_id=:user_id and course_id=:course_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":user_id",$user_id);
            $stmt->bindParam(":course_id",$course_id);
            $stmt->execute();
            
            $enrollment = null;
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            if($row = $stmt->fetch()){
                $enrollment = array(
                    'enrollment_id'=>$row['enrollment_id'],
                    'user_id'=>$row['user_id'],
                    'course_id'=>$row['course_id'],
                    'content'=>$row['content'],
                    'start_date'=>$row['start_date'],
                    'completed'=>$row['completed'],
                );
            }
            
            $stmt = null;
            $pdo = null;
            return json_encode($enrollment);
        }

        public function getAllUserEnrollment($user_id) {
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            
            $sql = "select * from enrollment where user_id=:user_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":user_id",$user_id);
            $stmt->execute();

            $enrollment = [];
            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            while( $row = $stmt->fetch() ) {
                $enrollment[] = array(
                    'enrollment_id'=>$row['enrollment_id'],
                    'user_id'=>$row['user_id'],
                    'course_id'=>$row['course_id'],
                    'content'=>$row['content'],
                    'start_date'=>$row['start_date'],
                    'completed'=>$row['completed'],
                );
            }

            $stmt = null;
            $pdo = null;

            return json_encode($enrollment);
        }
    }

?>