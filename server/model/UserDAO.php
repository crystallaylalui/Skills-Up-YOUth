<?php
    class UserDAO{

        # Add a new user to the database
        public function add($username, $hashedPassword){
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            
            $sql = "insert into user (username, hashed_password) 
                    values (:username, :hashed_password)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":username",$username);
            $stmt->bindParam(":hashed_password",$hashedPassword);
            $status = $stmt->execute();
            

            $stmt = null;
            $pdo = null;
            return $status;
        }

        # Retrieve a user with a given username
        # Return null if no such user exists
        public function retrieve($username){
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            
            $sql = "select * from user where username=:username";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":username",$username,PDO::PARAM_STR);
            $stmt->execute();
            
            $user = null;
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            if($row = $stmt->fetch()){
                $user = new User($row["username"],$row["hashed_password"]);
            }
            
            $stmt = null;
            $pdo = null;
            return $user;
        }

        public function retrieveAll(){
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            
            $sql = "select * from user";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            $users = [];
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            while( $row = $stmt->fetch() ) {
                $users[] = new User(
                    $row["username"], 
                    $row["hashed_password"],
                );
            }

            $stmt = null;
            $pdo = null;

            return $users;
        }
    }
?>