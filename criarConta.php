<?php


session_start();
require_once('db.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<form action="" method="POST">
    
    <input type="text" id="name" name="name" placeholder="Digite seu nome: "><br>

    <input type="radio" id="tipoAdm" name="tipo" value="adiministrador">
	<label for="tipoAdm">adiministrador</label><br>
	<input type="radio" id="tipoALuno" name="tipo" value="aluno">
	<label for="tipoAluno">Aluno</label><br>

    <input type="email" id="email" name="username" placeholder="Digite seu email: ">
    <input type="text" id="nsa" name="nsa" placeholder="Digite seu nsa: ">
    <input type="password" id="password" name="password" placeholder="Digite sua senha: " >

    <button type="submit">Cadastrar</button>
</form>


<?php



if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = $_POST['name'];
    $username = $_POST['username'];
    $nsa = $_POST['nsa'];
    $password = $_POST['password'];
    $tipo = $_POST['tipo'];

    $query = "INSERT INTO usuariosetec (tipo, nsa, nome, username, password) VALUES ('$tipo', '$nsa', '$name', '$username', '$password')";
    $result = $conn->query($query);


    if($result === true){
    if($conn->affected_rows > 0){
        echo "Usuario cadastrado" ;
        echo "<a href='logout.php'>Sair</a>";
    }else{
        echo "erro";
    }
}
}

?>

</body>
</html>