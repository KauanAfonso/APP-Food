<?php

session_start();
require('db.php');

if(!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin'){
    header('location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .menu {
            background: linear-gradient(to left, black, #3a3939, black);
            color: white;
            padding: 50px;
            margin-bottom: 20px;
            text-align: center;
        }

        .menu a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-size: 1.2em;
            transition: color 0.3s;
        }

        .menu a:hover {
            color: #dddddd;
        }

        .menu p {
            font-size: 1.4em;
            margin: 10px 0;
        }

        .card {
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Adicionando sombra ao card */
            border-radius: 10px; /* Bordas arredondadas */
            overflow: hidden; /* Para que a borda arredondada seja aplicada corretamente */
        }

        .card img {
            width: 100%;
            height: 200px; /* Definindo uma altura fixa para todas as imagens */
            object-fit: cover; /* Garantindo que as imagens mantenham suas proporções */
        }

        .card-title {
            font-size: 1.25em;
            font-weight: bold;
            text-align: center; /* Centralizando o título */
            margin-top: 15px;
        }

        .card-body {
            padding: 15px;
        }

        .container {
            max-width: 800px;
            margin: auto; /* Centralizando o container */
            padding: 0 20px;
        }

        .footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
        }

        /* Estilo dos botões */
        .btn {
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="menu">
    <a href="logout.php">Sair</a>
    <p>BEM VINDO ADMINISTRADOR!</p>
</div>

<div class="container">
    <div class="card">
        <img src="https://i0.wp.com/frigideira.aiqfome.com/wp-content/uploads/2022/01/xig-gaucho-1593448754811_v2_4x3.jpg?fit=1884%2C1413&ssl=1" alt="Imagem do card 1">
        <h2 class="card-title">Verificar Pedidos</h2>
        <a href="pedidos.php" class="btn btn-dark">Verificar Pedidos</a>
    </div>
    <div class="card">
        <img src="https://diaonline.ig.com.br/wp-content/uploads/2020/07/salgados-em-rio-verde-opcoes-para-comprar-na-hora-ou-encomendar.png" alt="Imagem do card 2">
        <h2 class="card-title">Editar Produto</h2>
        <a href="EditarProduto.php" class="btn btn-dark">EditarProduto</a>
    </div>
    <div class="card">
        <img src="https://acrediteounao.com/wp-content/uploads/2018/12/AN-batata-frita-batatas-fritas.jpg" alt="Imagem do card 3">
        <h2 class="card-title">Excluir Produto</h2>
        <a href="ExcluirProduto.php" class="btn btn-dark">Excluir Produto</a>
    </div>
    <div class="card">
        <img src="https://riotfest.org/wp-content/uploads/2016/10/sdfl.jpg" alt="Imagem do card 3">
        <h2 class="card-title">Criar Produtos</h2>
        <a href="CriarProdutos.php" class="btn btn-dark">Criar Produtos</a>
    </div>
    <div class="card">
        <img src="https://static.vecteezy.com/system/resources/previews/000/592/782/original/vector-message-icon.jpg" alt="Imagem do card 4">
        <h2 class="card-title">Visualizar Mensagens</h2>
        <a href="visualizarMensagem.php" class="btn btn-dark">visualizar Mensagem</a>
    </div>
</div><br><br>
<div class="footer">
    <p>&copy; 2024 APP_FOOD</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+BxAOaXUuUpPbX4T7k/To8xEzF+0g" crossorigin="anonymous"></script>
</body>
</html>
