<?php

session_start();

if(!isset($_SESSION['username'])){
    header("Location: index.php");
    exit();
}

echo "bem vindo , " . $_SESSION['username'] . "!<br>";
echo "<a href='logout.php'>Sair</a>";
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>APP Food</title>
  <link rel="stylesheet" href="style.inicial.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;500;700&family=Rubik+Moonrocks&display=swap" rel="stylesheet">
<script src="script.js" defer></script>
</head>


<body>

  <div id="conteudoMenuMobile">

    <nav>
      <h5>SEJA BEM-VINDO (NOME)</h5>

      <p id="fecharMenu" style="font-size: 1rem; cursor: pointer;" onclick="toggleMenu()">X</p>
    </nav>

    <a href="#">SOBRE</a>
    <a href="#">LOGIN</a>
    <a href="#">SAIR</a>

    <a data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">CARRINHO</a>


  </div>

  <header>
    <div>

      <nav>
        <div class="nome">
          <h1>SEJA BEM-VINDO (NOME)</h1>
        </div>

        <button id="mn-hamburguer" onclick="toggleMenu()">≣</button>


        <div class="navegacao">
          <a href="#">SOBRE</a>
          <a href="#">LOGIN</a>
          <a href="#">SAIR</a>


          <button type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
            aria-controls="offcanvasRight">CARRINHO</button>
        </div>


        <div style="background-color: #4a0000; color: white;" class="offcanvas offcanvas-end" tabindex="-1"
          id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">CARRINHO:</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            GFDGFDGFDGDFG
          </div>
        </div>



      </nav>
    </div>




    <div class="btn-comprar">

      <h2 class="CantinaEtec">CANTINA ETEC</h2>
      <P>O melhor custo benefício, você <br> encontra aqui!</P>
      <button type="button">COMPRAR</button>
    </div>

    <img src="imagens/lanche.png" alt="">

  </header>




  <main>

    <h1 style="position: absolute; top: 420px; left: calc(50% - 81.75px); ">Cardapio</h1>

    <div class="position-div">
      <div>
        <img class="img1" id="img1" src="imagens/carrossel/Group 13.png" alt="">
        <img class="img1" id="img2" style="margin-left: 200px;" src="imagens/carrossel/Group 14.png" alt="">
        <img class="img1" id="img3" style="margin-left: 400px;" src="imagens/carrossel/Group 15.png" alt="">
      </div>
      <div>
        <img class="img2" id="img4" src="imagens/carrossel/Group 16.png" alt="">
        <img class="img3" id="img5" src="imagens/carrossel/Group 17.png" alt="">
      </div>
    </div>




  </main>


  <footer>

    <p>@copyright2023 <img style="width: 20px;" src="imagens/@copyright2023.png" alt="@copyright2023"></p>

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