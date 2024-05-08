<?php 
session_start();
require_once('db.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Novo Produto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        form {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            margin: 20px auto;
        }
        input[type="text"] {
            width: calc(100% - 20px);
            margin: 5px 0;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    
<form action="" method="POST">
    <h2>Cadastrar Novo Produto</h2>
    <input type="text" name="nameProduto" id="nameProduto" placeholder="Digite o nome do produto">
    <select name="DescricaoProduto" class="btn btn-outline-dark dropdown-toggle btn-sm text-start">
        <option value="Lanches">Lanches</option>
        <option value="Pasteis">Pateis</option>
        <option value="Batatas">Batatas</option>
        <option value="Doces">Doces</option>
        <option value="Salgados">Salgados</option>
    </select>
    <input type="text" name="categoriaProduto" id="categoriaProduto" placeholder="Digite a categoria do produto">
    <input type="text" name="FotoProduto" id="fotoProduto" placeholder="Digite a URL da foto do produto">
    <input type="text" name="precoProduto" id="precoProduto" placeholder="Digite o preço do produto (12.99)">
    <input type="submit" value="Cadastrar">
</form>

<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nameProduto'];
    $descricao = $_POST['DescricaoProduto'];
    $categoria = $_POST['categoriaProduto'];
    $foto = $_POST['FotoProduto'];
    $preco = $_POST['precoProduto'];

    if ($conn) {
        $query = "INSERT INTO produtos (nome, categoria, descricao, preco, imagem) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssss", $nome, $categoria, $descricao, $preco, $foto);
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {
            echo "Produto Cadastrado";
        } else {
            echo "Erro ao cadastrar o produto";
        }
        $stmt->close();
    } else {
        echo "Erro ao conectar ao banco de dados";
    }
}
?>
</body>
</html>
