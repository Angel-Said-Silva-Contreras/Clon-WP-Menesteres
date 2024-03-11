<?php 

$server = "localhost";
$username = "root";
$password = "root";
$database = "php_login_database";
/*
$server = "localhost";
$username = "id20227482_root";
$password = "Admin1.@";
$database = "id20227482_php_login_database";
*/
try {
  $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
  die('Connection Failed: ' . $e->getMessage());
}

?>
