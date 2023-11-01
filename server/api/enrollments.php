<?php
    // 1. get all enrollments/ get user enrollments

    // 2. post course

    require_once "../common.php"; 

    session_start();

    $req = $_SERVER['REQUEST_METHOD'];

    $dao = new EnrollmentDAO();

    // if request is get
    if ($req == "GET") {
        // get course by id
        if (isset($_GET["user_id"]) & isset($_GET["course_id"])) {
            // echo "TEST";
            echo $dao->getEnrollment($_GET["user_id"], $_GET["course_id"]);
            // echo "getEnrollment";

        } else {
            echo $dao->getAllUserEnrollment($_GET["user_id"]);
            // echo "getUserEnrollment";
        }

        
    } else if ($req == "POST") {
        $_POST = json_decode(file_get_contents('php://input'),true);

        $user_id = $_POST["user_id"];
        $course_id = $_POST["course_id"];
        $content = $_POST["content"];
        $completed = $_POST["completed"];

        if (isset($_POST['update'])) {
            echo $dao->updateEnrollment($user_id,$course_id,$content,$completed);
        } else {
            $start_date = $_POST["start_date"];
            echo $dao->createEnrollment($user_id, $course_id, $content, $start_date, $completed);
        }
    }
?>