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
    
<form action="CriarProdutos.php" method="POST">
    <h2>Cadastrar Novo Produto</h2>
    <input type="text" name='nameProduto' id='nameProduto' placeholder='Digite o nome do produto'>
    <input type="text" name='DescricaoProduto' id='DescricaoProduto' placeholder='Digite a descricao do produto'>
    <input type="text" name='categoriaProduto' id='categoriaProduto' placeholder='Digite a categoria do produto'>
    <input type="text" name='FotoProduto' id='fotoProduto' placeholder='Digite a foto do produto'>
    <input type="text" name='precoProduto' id='precoProduto' placeholder='Digite a preco do produto'>
    <input type="submit">

</form>


<?php 



if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $nome = $_POST['nameProduto'];
    $descricao = $_POST['DescricaoProduto'];
    $categoria = $_POST['categoriaProduto'];
    $foto = $_POST['FotoProduto'];
    $preco = $_POST['precoProduto'];



    $query = "INSERT INTO produtos (nome, categoria, descricao, preco, imagem) VALUES ('$nome' , '$categoria', '$descricao', '$preco' , '$foto')";

    $insert = $conn->query($query);

   if($insert === true){
    if($conn-> affected_rows > 0){
        echo "Produto Cadastrado";
    }else{
        echo "erro";
    }
   }
}

?>


</body>
</html>


