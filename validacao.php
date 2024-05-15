
<?php

session_start();

require('db.php');


if($_SERVER['REQUEST_METHOD'] === "GET"){

    
    $idProduto = $_GET['idProduto'];
    $nameProduto = $_GET['nameProduto'];
    $descricaoProduto = $_GET['DescricaoProduto'];
    $categoriaProduto = $_GET['categoriaProduto'];
    $preco = $_GET['precoProduto'];
    $imagem = $_GET['imagem'];



    $query = "UPDATE produtos SET nome = '$nameProduto' , categoria = '$categoriaProduto' , descricao = '$descricaoProduto', preco = '$preco', imagem = '$imagem' WHERE id = '$idProduto'";
    $query = $conn->query($query);

    if($query){
        echo "Produto Editado !";
        header("location: EditarProduto.php");
    }else{
        echo "Erro!";
    }


}

?>

