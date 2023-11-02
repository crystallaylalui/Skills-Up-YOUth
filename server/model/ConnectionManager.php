<?php 
class ConnectionManager {

    public function getConnection() {
    $servername = 'localhost';
    $dbname = 'wad2_project';
    $username = 'root';
    $password = 'root';
<<<<<<< Updated upstream
    $port = "8888";
=======
    $port = '3306';
>>>>>>> Stashed changes
    $url  = "mysql:host=$servername;dbname=$dbname;port=$port";

    return new PDO($url, $username, $password);
    }
}
?>