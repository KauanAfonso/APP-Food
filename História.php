<?php

session_start();
require('db.php');

if(!isset($_SESSION['username'])){
    header('location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conheça a Nossa História</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-repeat: no-repeat;
            background-image: url('https://i.pinimg.com/originals/06/ba/54/06ba54e16ef5f91f32ae107e729375b1.jpg');
            background-size: cover;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .content {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            max-width: 600px;
        }

        h1 {
            color: #ffc107;
        }

        p {
            font-size: 18px;
        }

        .btn-custom {
            background-color: #ffc107;
            border: none;
            color: black;
            padding: 10px 20px;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 8px;
            text-decoration: none;
        }

        .btn-custom:hover {
            background-color: #e0a800;
        }
    </style>
</head>
<body>
    <div class="content">
        <h1>Conheça a nossa História!</h1>
        <p>Começamos na ETEC com a ideia de diminuir a quantidade de fila da cantina.</p>
        <a href="fale_conosco.php" class="btn-custom">Voltar</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
