<?php

session_start();
require('db.php');

if(!isset($_SESSION['username'])){
    header('location: index.php');
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./fconosco.css">
</head>

<body>
    <div class="menu">

        <div >
            <a id="item_menu" href="tela.inicial.php">HOME</a>
        
        </div>

        <div >
            <p style="font-size: 1.4em;">Como você prefere falar com a gente?</p>
        </div>

    </div>


    <div class="container">
        <div class="box_a">
            <a href="tela_de_email.php">
                <img style="width: 50px; height: 50px; padding: 10px;"
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSqRkwnP-W891hgpqXGQeY_fftb-n5S0pyPtkxlEDpEeg&s"
                    alt="carta">
                <h1 style="margin: 0px;">E-mail</h1>
                <p>Tem alguma dúvida?</p>
                <p>cantinaetec@gmail.com</p>
            </a>

        </div>
        <div class="box_b">
            <a href="contato_telefone.php">
                <img style="width: 50px; height: 50px; padding: 10px;"
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQxmci_aKXt4u6J5guWoYlrEjtWoS0FnmA_e3W3fDpd7w&s" alt="telfone">
                <h1 style="margin: 0px;">Telefone</h1>
                <p>Mande mensagem!</p>
                <p>(19) 9.9877-3575</p>
            </a>

        </div>

        <div class="box_b" style='margin:50px 10px;'>
            <a href="História.php">
                <img style="width: 50px; height: 50px; padding: 10px;"
                    src="https://image.freepik.com/icones-gratis/sobre-nos_318-33259.jpg" alt="telfone">
                <h1 style="margin: 0px;">Sobre Nós</h1>
                <p>Mande mensagem!</p>
                <p>(19) 9.9877-3575</p>
            </a>

        </div>
    </div>

    <footer><br><br>
    <div><img src="imagem/logo.png" alt="" style="width: 5%;"></div>
   

    <style>
        footer {
    background-image: linear-gradient(to bottom, #c22a2a,var(--cor3));
    bottom: 0;
    position: fixed;
    width: 100vw;
    height: 100px;
    padding: 1px 0px 5px 0px;
    text-align: center;
    color: white;
    text-shadow: 10px 5px 10px rgba(0, 0, 0, 0.301);
    margin: 15px 0 0 0;
}
    </style>
    
</footer>

</body>



</html>