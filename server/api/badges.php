
 <?php
    // 1. get all badges

    require_once "../common.php"; 

    $req = $_SERVER['REQUEST_METHOD'];

    $dao = new UserDAO();

    // if request is get
    if ($req == "GET") {
        if (isset($_GET["badge_id"])) { 
            echo $dao->getBadgesById($_GET["badge_id"]);
        } else {
            echo $dao->getAllBadges();
        }
        
    } else if ($req == "POST") {
        $_POST = json_decode(file_get_contents('php://input'),true);

        $user_id = $_POST["user_id"];
        $badges = $_POST["badges"];

        echo $dao->updateUserBadgeById($user_id,$badges);
    }
    

?>