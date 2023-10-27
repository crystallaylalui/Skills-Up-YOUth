<?php
    class UserDAO{

        public function createUser($username, $email, $hashedPassword) {
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            
            $sql = "insert into user (username, email, hashed_password, points, badges) 
                    values (:username, :email, :hashed_password, 0, '[]')";

            
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":username",$username);
            $stmt->bindParam(":email",$email);
            $stmt->bindParam(":hashed_password",$hashedPassword);
            $status = $stmt->execute();
            

            $stmt = null;
            $pdo = null;

            return $status;
        }

        # Retrieve a user with a given username
        # Return null if no such user exists
        public function readUser($username){
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            
            $sql = "select * from user where username=:username";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":username",$username,PDO::PARAM_STR);
            $stmt->execute();
            
            $user = null;
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            if($row = $stmt->fetch()){
                $user = new User(
                    $row["user_id"], 
                    $row["username"], 
                    $row["email"], 
                    $row["hashed_password"], 
                    $row["points"], 
                    $row["badges"]
                );
                // $user = array(
                //     'user_id' => $row['user_id'],
                //     'username' => $row["username"],
                //     "email"=> $row["email"],
                //     'hashed_password' => $row["hashed_password"],
                //     "points"=> $row["points"]
                // );
            }
            
            $stmt = null;
            $pdo = null;
            return $user;
        }

        public function readUserById($user_id){
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            
            $sql = "select * from user where user_id=:user_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":user_id",$user_id,PDO::PARAM_STR);
            $stmt->execute();
            
            $user = null;
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            if($row = $stmt->fetch()){
                // $user = new User($row["user_id"], $row["username"], $row["email"], $row["hashed_password"], $row["points"]);
                $user = array(
                    'user_id' => $row['user_id'],
                    'username' => $row["username"],
                    "email"=> $row["email"],
                    'hashed_password' => $row["hashed_password"],
                    "points"=> $row["points"],
                    "badges"=> $row["badges"],
                );
            }
            
            $stmt = null;
            $pdo = null;
            return json_encode($user);
        }

        public function readAllUsers(){
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            
            $sql = "select * from user";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            $users = [];
            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            while( $row = $stmt->fetch() ) {
                // $users[] = new User(
                //     $row["user_id"],
                //     $row["username"],
                //     $row["email"], 
                //     $row["hashed_password"],
                //     $row["points"],
                // );
                $users[] = array(
                    'user_id' => $row['user_id'],
                    'username' => $row["username"],
                    "email"=> $row["email"],
                    'hashed_password' => $row["hashed_password"],
                    "points"=> $row["points"],
                    "badges" => $row["badges"]
                );
            }

            $stmt = null;
            $pdo = null;

            return json_encode($users);
        }
        public function updateUserPointsById($user_id, $points) {
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            
            $sql = "update user set points=:points where user_id=:user_id";
            
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":user_id",$user_id);
            $stmt->bindParam(":points",$points);
            
            $status = $stmt->execute();

            $stmt = null;
            $pdo = null;

            return $status;
        }

        public function getAllBadges(){
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();

            $sql = "select * from badge";

            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $badges = [];
            while( $row = $stmt->fetch() ) {
                $badges[] = array(
                    "badge_id" => $row["badge_id"],
                    "badge_name"=> $row["badge_name"],
                    "badge_type"=> $row["badge_type"],
                    "badge_img"=> $row["badge_img"],
                );
            }

            $stmt = null;
            $pdo = null;

            return json_encode($badges); 
        }

        public function getBadgesById($badge_id){
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();

            $sql = "select * from badge where badge_id=:badge_id";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":badge_id",$badge_id);

            $stmt->execute();
            $badge = null;
            while( $row = $stmt->fetch() ) {
                $badge = array(
                    "badge_id" => $row["badge_id"],
                    "badge_name"=> $row["badge_name"],
                    "badge_type"=> $row["badge_type"],
                    "badge_img"=> $row["badge_img"],
                );
            }

            $stmt = null;
            $pdo = null;

            return json_encode($badge); 
        }

        public function updateUserBadgeById($user_id, $badges) {
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();

            $badges = json_encode($badges);
            
            $sql = "update user set badges=:badges where user_id=:user_id";
            
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":user_id",$user_id);
            $stmt->bindParam(":badges", $badges);
            
            $status = $stmt->execute();

            $stmt = null;
            $pdo = null;

            return $status;
        }

    }
    
?>