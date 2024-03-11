<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'app_food';
// $port = 3307;
$conn = mysqli_connect($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Restante do código...

?>
