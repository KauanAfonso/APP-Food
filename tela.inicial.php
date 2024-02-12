<?php

session_start();

if(!isset($_SESSION['username'])){
    header("Location: index.php");
    exit();
}

require_once('db.php');

$usuario = "SELECT nome FROM usuariosetec WHERE username = '{$_SESSION['username']}'";
$result = $conn->query($usuario);

$elemento = $result->fetch_assoc(); //transformar a consulta do banco em um valor em array;
$nome = $elemento['nome']; //acessando o valor
$nomeMaiusculo = strtoupper($nome);

//selecionando todos os produtos 
$queryProdutos = "SELECT * from produtos;";
$produtosFinais = $conn->query($queryProdutos);


//consultas para selecionar produtos por categoria:

//categoria = 'Lanches';
$queryProdutosLanches = "SELECT * FROM produtos WHERE categoria = 'Lanches'";
$queryProdutosLanchesFinais = $conn->query($queryProdutosLanches);
// print_r($queryProdutosLanchesFinais);

//categoria = 'Pasteis'
$queryProdutosPasteis = "SELECT * FROM produtos WHERE categoria = 'Pasteis'";
$queryProdutosPasteisFinais = $conn->query($queryProdutosPasteis);
// print_r($queryProdutosPasteisFinais);


//categoria = 'Batatas'
$queryProdutosBatatas = "SELECT * FROM produtos WHERE categoria = 'Batatas'";
$queryProdutosBatatasFinais = $conn->query($queryProdutosBatatas);
// print_r($queryProdutosBatatasFinais);

//categoria = 'Doces'
$queryProdutosDoces = "SELECT * FROM produtos WHERE categoria = 'Doces'";
$queryProdutosDocesFinais = $conn->query($queryProdutosDoces);
// print_r($queryProdutosDocesFinais);


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
      <h5>SEJA BEM-VINDO <?php echo " " .  $nome . "!" ?>;</h5>

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
          <h1>SEJA BEM-VINDO<?php echo ": " . " <h1>$nomeMaiusculo</h1>"  ?></h1>
        </div>

        <button id="mn-hamburguer" onclick="toggleMenu()">≣</button>


        <div class="navegacao">
          <a href="#">SOBRE</a>
          <a href="#">LOGIN</a>
          <a href="logout.php">SAIR</a>


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

    <div class="position-div" >
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
<p class='todosProdutos' style="margin-top: 580px;display:;">


<?php

//se a consuta retornar mais de uma linha
if($produtosFinais->num_rows >0){

  //iterando sobre cada linha onde a consulta se tornou um array associativo e armazenando em uma variave $row, onde consigo acessar cada valor atraves de sua posição
  
  while ($row = $produtosFinais->fetch_assoc()) {
      echo "
     
      <div class='container text-center' style='display: none;'>
      <div class='row'>
        <div class='col-md-12'>
        <div class=\"card mb-3\" style=\"max-width:700px; height:180px;\">
        <div class=\"row g-0\">
            <div class=\"col-md-4\">
                <img src=\"{$row['imagem']}\" class=\"img-fluid rounded-start\" alt=\"Product Image\">
            </div>
            <div class=\"col-md-8\">
                <div class=\"card-body\">
                    <h5 class=\"card-title\">{$row['nome']}</h5>
                    <p class=\"card-text\">{$row['descricao']}</p>
                    <p class=\"card-text\"><small class=\"text-body-secondary\">Preço: R$ {$row['preco']}</small></p>
                    <button type='button' class='btn btn-danger'>Adicioinar ao carrinho</button>
                </div>
            </div>
        </div>
    </div>
        </div>
      
      </div>
    </div>
";

      
  }
}  
?>

  
</p>


<?php 

if($queryProdutosLanchesFinais->num_rows > 0){

while($row2 = $queryProdutosLanchesFinais->fetch_assoc()){
  echo "
     
  <div class='container2 text-center' style='display: none;'>
  <div class='row'>
    <div class='col-md-12'>
    <div class=\"card mb-3\" style=\"max-width:700px; height:180px;\">
    <div class=\"row g-0\">
        <div class=\"col-md-4\">
            <img src=\"{$row2['imagem']}\" class=\"img-fluid rounded-start\" alt=\"Product Image\">
        </div>
        <div class=\"col-md-8\">
            <div class=\"card-body\">
                <h5 class=\"card-title\">{$row2['nome']}</h5>
                <p class=\"card-text\">{$row2['descricao']}</p>
                <p class=\"card-text\"><small class=\"text-body-secondary\">Preço: R$ {$row2['preco']}</small></p>
                <button type='button' class='btn btn-danger'>Adicioinar ao carrinho</button>
            </div>
        </div>
    </div>
</div>
    </div>
  
  </div>
</div>
";
}

}


?>


<?php 

if($queryProdutosPasteisFinais->num_rows > 0){

while($row3 = $queryProdutosPasteisFinais->fetch_assoc()){
  echo "
     
  <div class='container3 text-center' style='display: none;'>
  <div class='row'>
    <div class='col-md-12'>
    <div class=\"card mb-3\" style=\"max-width:700px; height:180px;\">
    <div class=\"row g-0\">
        <div class=\"col-md-4\">
            <img src=\"{$row3['imagem']}\" class=\"img-fluid rounded-start\" alt=\"Product Image\">
        </div>
        <div class=\"col-md-8\">
            <div class=\"card-body\">
                <h5 class=\"card-title\">{$row3['nome']}</h5>
                <p class=\"card-text\">{$row3['descricao']}</p>
                <p class=\"card-text\"><small class=\"text-body-secondary\">Preço: R$ {$row3['preco']}</small></p>
                <button type='button' class='btn btn-danger'>Adicioinar ao carrinho</button>
            </div>
        </div>
    </div>
</div>
    </div>
  
  </div>
</div>
";
}

}


?>


<?php 

if($queryProdutosBatatasFinais->num_rows > 0){

while($rows4 = $queryProdutosBatatasFinais->fetch_assoc()){
  echo "
     
  <div class='container4 text-center' style='display: none;'>
  <div class='row'>
    <div class='col-md-12'>
    <div class=\"card mb-3\" style=\"max-width:700px; height:180px;\">
    <div class=\"row g-0\">
        <div class=\"col-md-4\">
            <img src=\"{$rows4['imagem']}\" class=\"img-fluid rounded-start\" alt=\"Product Image\">
        </div>
        <div class=\"col-md-8\">
            <div class=\"card-body\">
                <h5 class=\"card-title\">{$rows4['nome']}</h5>
                <p class=\"card-text\">{$rows4['descricao']}</p>
                <p class=\"card-text\"><small class=\"text-body-secondary\">Preço: R$ {$rows4['preco']}</small></p>
                <button type='button' class='btn btn-danger'>Adicioinar ao carrinho</button>
            </div>
        </div>
    </div>
</div>
    </div>
  
  </div>
</div>
";
}

}


?>


<?php


if($queryProdutosDocesFinais->num_rows >0){

  while($row5 = $queryProdutosDocesFinais->fetch_assoc()){
    echo  "
     
    <div class='container5 text-center' style='display: none;'>
    <div class='row'>
      <div class='col-md-12'>
      <div class=\"card mb-3\" style=\"max-width:700px; height:180px;\">
      <div class=\"row g-0\">
          <div class=\"col-md-4\">
              <img src=\"{$row5['imagem']}\" class=\"img-fluid rounded-start\" alt=\"Product Image\">
          </div>
          <div class=\"col-md-8\">
              <div class=\"card-body\">
                  <h5 class=\"card-title\">{$row5['nome']}</h5>
                  <p class=\"card-text\">{$row5['descricao']}</p>
                  <p class=\"card-text\"><small class=\"text-body-secondary\">Preço: R$ {$row5['preco']}</small></p>
                  <button type='button' class='btn btn-danger'>Adicioinar ao carrinho</button>
              </div>
          </div>
      </div>
  </div>
      </div>
    
    </div>
  </div>
  ";
  }

}

?>
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


<!----------------codigo em javascript para manipular o dom:--------------------->

<script>
 
var produtos = document.querySelectorAll('.container');
var Lanches = document.querySelectorAll('.container2');
var Pasteis = document.querySelectorAll('.container3');
var Batatas = document.querySelectorAll('.container4');
var Doces = document.querySelectorAll('.container5');

function esconder(elemento){
  elemento.forEach(element => {

    element.style.display = 'none'
      
  });
}


document.getElementById('img5').addEventListener('click' , function(){
    
  
    produtos.forEach(function(element) {
    if(element.style.display == 'none'){
      element.style.display = 'inline-block'; 
    }else{
      element.style.display = 'none'; 
    }
   
    });

  esconder(Doces)
  esconder(Lanches)
  esconder(Pasteis)
  esconder(Batatas)
})




document.getElementById('img2').addEventListener('click' , function(){

    Lanches.forEach(function(element) {
    if(element.style.display == 'none'){
      element.style.display = 'inline-block'; 
    }else{
      element.style.display = 'none'; 
    }
   
    });

  esconder(produtos)
  esconder(Doces)
  esconder(Pasteis)
  esconder(Batatas)
})


document.getElementById('img3').addEventListener('click' , function(){

Pasteis.forEach(function(element) {
if(element.style.display == 'none'){
  element.style.display = 'inline-block'; 
}else{
  element.style.display = 'none'; 
}

});

  esconder(produtos)
  esconder(Lanches)
  esconder(Doces)
  esconder(Batatas)

})


document.getElementById('img1').addEventListener('click' , function(){

Batatas.forEach(function(element) {
if(element.style.display == 'none'){
  element.style.display = 'inline-block'; 
}else{
  element.style.display = 'none'; 
}

});

  esconder(produtos)
  esconder(Lanches)
  esconder(Pasteis)
  esconder(Doces)
})


document.getElementById('img4').addEventListener('click' , function(){

  Doces.forEach(function(element){
  if(element.style.display == 'none'){
    element.style.display = 'inline-block'; 
}else{
  element.style.display = 'none'; 
  
}


  })

  esconder(produtos)
  esconder(Lanches)
  esconder(Pasteis)
  esconder(Batatas)

 
}



)



</script>

</html>


