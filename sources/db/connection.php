<?php 
$host ='localhost';
$db="fitness_project";
$user ="root";
$pass="";

$conn = new mysqli($host, $user, $pass, $db);

if($conn->connect_error){
    die("connection failed: ". $conn->connect_error);
}


?>

