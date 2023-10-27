
<?php
    // 1. get all course

    // 2. post course

    require_once "../common.php"; 

    $req = $_SERVER['REQUEST_METHOD'];

    $dao = new CourseDAO();

    // if request is get
    if ($req == "GET") {
        // get course by id
        if (isset($_GET["course_id"])) {
            // echo "TEST";
            echo $dao->getCourseById($_GET["course_id"]);

        } else {
            echo $dao->getAllCourse();
        }

        
    } else if ($req == "POST") {
        $_POST = json_decode(file_get_contents('php://input'),true);

        $playlist_url = $_POST["playlist_url"];
        $title = $_POST["title"];
        $description = $_POST["description"];
        $badges = $_POST["badges"];

        echo $dao->createCourse($playlist_url, $title, $description ,$badges);
    }
?>