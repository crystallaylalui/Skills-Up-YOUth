<?php
    require_once '../common.php';

    # Get parameters passed from register.php
    $_POST = json_decode(file_get_contents('php://input'),true);
    
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    # Hash entered password
    $hashed = password_hash($password, PASSWORD_DEFAULT);

    # Add new user
    $dao = new UserDAO();
    $status = $dao->createUser($username, $email, $hashed, 0, "[]", "[[0, 0],[0, 0],[0, 0],[0, 0]]");

    echo $status;
?>