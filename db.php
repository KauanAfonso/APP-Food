<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'app_food_login';
//$port = 3307;
$conn = new mysqli($host, $user, $pass, $db);

if($conn ->connect_error){
    die("Erro na conexão: " . $conn->connect_error);
}



?>