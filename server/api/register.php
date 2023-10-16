<?php
    require_once 'common.php';

    # Get parameters passed from register.php
    $_POST = json_decode(file_get_contents('php://input'),true);
    $username = $_POST["username"];
    $password = $_POST["password"];

    # Hash entered password
    $hashed = password_hash($password, PASSWORD_DEFAULT);

    # Add new user
    $dao = new UserDAO();
    $status = $dao->add($username,$hashed);
    // if($status){
    //     echo "Registered successfully";
    // }
    // else{
    //     echo "Failed to register";
    // }

    echo $status;
?>