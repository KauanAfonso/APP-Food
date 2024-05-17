<?php 
session_start();
require_once('db.php');


if(!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin'){
    header('location: index.php');
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Novo Produto</title>
    <style>


*{
    margin:0;
    padding:0;
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

form {

    background-color: black;
    padding: 90px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    height:500px;
    width: 500px;
    margin: 0 auto;
    color: white;
}

h2 {
    margin-bottom: 20px;
    font-size: 24px;
    color: white;
    text-align: center;
}

input[type="text"], select {
    
    width: 90%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid gray;
    border-radius: 4px;
    font-size: 16px;
    background-color: black;
    color: white;
    
}

select {
    width: 50%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid gray;
    border-radius: 4px;
    font-size: 16px;
    background-color: red;
    color: white;
    
}

input[type="text"]::placeholder, select::placeholder {
    color: #dddddd;
}

input[type="submit"] {
    width: 100%;
    padding: 10px;
    background-color: #28a745;
    border: none;
    border-radius: 4px;
    color: white;
    font-size: 16px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #218838;
}

.btn-outline-dark {
    background-color: white;
    color: #333;
    border: 1px solid #ccc;
}

.btn-outline-dark:hover {
    background-color: #ddd;
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

</style>

</head>
<body>

<div class="menu">
    <a href="adiministrador.php">HOME</a>
    <p>BEM VINDO ADMINISTRADOR!</p>
</div>
    
<form action="" method="POST">
    <h2>Cadastrar Novo Produto</h2>
    <input type="text" name="nameProduto" id="nameProduto" placeholder="Digite o nome do produto">
    <select name="categoriaProduto" class="btn btn-outline-dark dropdown-toggle btn-sm text-start">
        <option value="Lanches">Lanches</option>
        <option value="Pasteis">Pateis</option>
        <option value="Batatas">Batatas</option>
        <option value="Doces">Doces</option>
        <option value="Salgados">Salgados</option>
    </select>
    <input type="text" name="DescricaoProduto" id="DescricaoProduto" placeholder="Digite a descricao do produto">
    <input type="text" name="FotoProduto" id="fotoProduto" placeholder="Digite a URL da foto do produto">
    <input type="text" name="precoProduto" id="precoProduto" placeholder="Digite o preço do produto (12.99)"><br><br>
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
<div class="footer">
    <p>&copy; 2024 APP_FOOD</p>
</div>
</body>
</html>
