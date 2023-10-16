<?php

session_start();
require_once "common.php";

# Get parameters passed from login.php
$_POST = json_decode(file_get_contents('php://input'),true);
$username = $_POST["username"];
$password = $_POST["password"];

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

# Check if user exists 
$success = false;
if($user != null){
    # Get stored hashed password
    $hashed = $user->getHashedPassword();
    # Check if entered password matches stored hashed password
    $success = password_verify($password,$hashed);

}

if($success) {
    $_SESSION["user"] = $username;
}

echo $success;


?>