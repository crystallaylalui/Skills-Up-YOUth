<?php


require_once "../common.php";

$req = $_SERVER['REQUEST_METHOD'];

$dao = new UserDAO();

if ($req == "GET") {

    // if (isset($_GET["user_id"])) { 
    //     echo $dao->readUserById($_GET["user_id"]);
    // } else {
    //     echo $dao->readAllUsers();
    // }
    
    echo $dao->getAllTasks();


// if request is post
} else if ($req == "POST") {

    $_POST = json_decode(file_get_contents('php://input'),true);

    $user_id = $_POST["user_id"];
    $points = $_POST["points"];

    $user = $dao->readUserById($_POST["user_id"]);
    $points += json_decode($user)->points;

    $status = $dao->updateUserPointsById($user_id, $points);

    if ($status) {
        echo $dao->readUserById($_POST["user_id"]);
    } else {
        echo $status;
    }
    
}
 

?>