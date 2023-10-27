

<?php
// 1. get all users
//     - if userid provided, get particular user

// 2. post user


require_once "../common.php";

$req = $_SERVER['REQUEST_METHOD'];

$dao = new UserDAO();

// if request is get
if ($req == "GET") {

    if (isset($_GET["user_id"])) { 
        echo $dao->readUserById($_GET["user_id"]);
    } else {
        echo $dao->readAllUsers();
    }
    

// if request is post
} else if ($req == "POST") {

    $_POST = json_decode(file_get_contents('php://input'),true);

    echo "TESTTTT";
}


?>