<?php
    require_once '../common.php';

    # Get parameters passed from register.php
    // $_POST = json_decode(file_get_contents('php://input'),true);
    // $username = $_POST["username"];
    // $password = $_POST["password"];
    // $email = $_POST["email"];

    
    // foreach(json_decode($users_json, true)->$users as $user) {
    //     $username = $user->username;
    //     // $password = $user->password;
    //     // $email = $user->email;

    //     echo $username;
    //     // echo $password;
    //     // echo $email;
    // }

    // # Hash entered password
    // $hashed = password_hash($password, PASSWORD_DEFAULT);

    // # Add new user
    // $dao = new UserDAO();


    // $status = $dao->createUser($username, $email, $hashed);

    // echo $status;

    header("Access-Control-Allow-Origin: *");

    const FILENAME = "users.json";

    $json_str = file_get_contents(FILENAME);
    $users = json_decode($json_str);
    $json_str = json_encode($json_str,JSON_PRETTY_PRINT);

    // $users[] = [}
    //     "username" => $nickname,
    //     "text" => $text
    // ];

    echo $users;
?>