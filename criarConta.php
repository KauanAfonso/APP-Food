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
    


</body>
</html>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APP Food</title>
    <link rel="stylesheet" href="login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <header>
        <h1>BEM-VINDO</h1>
    </header>

    <main>
        <div class="container" id="media">
            <div class="sombra" id="container-a">
                <div id="login">
                
    <form action="criarConta.php" method="POST">

    <h4>Cadastrar Aluno</h4><br>
    
    <input type="text" class="form-control" id="name" name="name" placeholder="Digite seu nome: ">

	

    <input type="email" class="form-control" id="email" name="username" placeholder="Digite seu email: ">
    <input type="text" class="form-control" id="nsa" name="nsa" placeholder="Digite seu rm: ">
    <input type="password" class="form-control" id="password" name="password" placeholder="Digite sua senha: " ><br>
    
    <button type="submit" class="btn btn-dark" >Cadastrar</button>
</form>


<?php



if($_SERVER['REQUEST_METHOD'] === 'POST'){

    if(!empty($_POST['name']) && !empty($_POST['username']) && !empty($_POST['nsa']) && !empty($_POST['password']) && !empty($_POST['tipo'])   ){
    $name = $_POST['name'];
    $username = $_POST['username'];
    $nsa = $_POST['nsa'];
    $password = $_POST['password'];
    $tipo = 'aluno';


    $query = "INSERT INTO usuariosetec (tipo, rm, nome, usuario, senha) VALUES ('$tipo', '$nsa', '$name', '$username', '$password')";
    $result = $conn->query($query);


    if($result === true){
    if($conn->affected_rows > 0){
        echo "Usuario cadastrado" ;
        echo "<a href='logout.php'>Sair</a>";
    }else{
        echo "erro";
    }
}
}else{

    echo "<p>Por favor coloque os valores correto!</p>";
}
}
?>
               
                
                </div>
            </div>
            <div id="container-b">
             
            </div>
        </div>
    </main>

    <footer>
        <p>@copyright2023 <img src="imagens/@copyright2023.png" alt="@copyright2023"></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>
