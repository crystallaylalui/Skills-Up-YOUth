<?php

session_start();
require_once "../common.php";

# Get parameters passed from login.php
$_POST = json_decode(file_get_contents('php://input'),true);
$username = $_POST["username"];
$password = $_POST["password"];

$dao = new UserDAO();
$user = $dao->readUser($username);

# Check if user exists 
$success = false;
if($user != null){
    # Get stored hashed password
    $hashed = $user->getHashedPassword();
    # Check if entered password matches stored hashed password
    $success = password_verify($password,$hashed);

}

if($success) {
    $_SESSION["user_id"] = $user->getUserId();
}

echo $success;


?>