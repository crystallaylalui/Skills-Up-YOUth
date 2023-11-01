<?php 
class ConnectionManager {

    public function getConnection() {
    $servername = 'localhost';
    $dbname = 'wad2_project';
    $username = 'root';
    $password = 'root';
    $port = 8888;
    $url  = "mysql:host=$servername;dbname=$dbname;port=$port";

    return new PDO($url, $username, $password);
    }
}
?>