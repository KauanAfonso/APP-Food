<?php
session_start();
require_once('db.php');




if(!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin'){
    header('location: index.php');
}



// Verifica se o ID do produto foi passado na URL
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $idProduto = $_GET['id'];
 

    // Consulta SQL para obter os detalhes do produto com base no ID fornecido
    $query = "SELECT * FROM produtos WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $idProduto);
    $stmt->execute();
    $result = $stmt->get_result();
    

    if ($result->num_rows > 0) {
        $produto = $result->fetch_assoc();
    } else {
        echo "Produto não encontrado";
        exit;
    }

    // Fecha a declaração
    $stmt->close();
} else {
    echo "ID do produto não fornecido";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <!-- Integração do Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
         
        .menu {
            background: linear-gradient(to left, black, #3a3939, black);
            color: white;
            padding: 15px;
            margin-bottom: 20px;
            text-align: center;
        }

        form{
            background:black !important;
            border:solid 2px black;
            color:white;
            padding:50px;
            border-radius:20px
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
    <p>Editar Produto</p>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
   
            <form action="validacao.php" method="GET">
                <input type="hidden" name="idProduto" value="<?php echo $produto['id']; ?>">
                <div class="form-group">
                    <label for="nameProduto">Nome do Produto:</label>
                    <input type="text" class="form-control" name="nameProduto" id="nameProduto" placeholder="Digite o nome do produto" value="<?php echo $produto['nome']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="DescricaoProduto">Descrição do Produto:</label>
                    <input type="text" class="form-control" name="DescricaoProduto" id="DescricaoProduto" placeholder="Digite a descrição do produto" value="<?php echo $produto['descricao']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="categoriaProduto">Categoria do Produto:</label>
                    <select class="form-control" name="categoriaProduto" id="categoriaProduto">
                        <option value="Lanches" <?php if ($produto['categoria'] == 'Lanches') echo 'selected'; ?>>Lanches</option>
                        <option value="Pasteis" <?php if ($produto['categoria'] == 'Pasteis') echo 'selected'; ?>>Pasteis</option>
                        <option value="Batatas" <?php if ($produto['categoria'] == 'Batatas') echo 'selected'; ?>>Batatas</option>
                        <option value="Doces" <?php if ($produto['categoria'] == 'Doces') echo 'selected'; ?>>Doces</option>
                        <option value="Salgados" <?php if ($produto['categoria'] == 'Salgados') echo 'selected'; ?>>Salgados</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="precoProduto">Preço do Produto:</label>
                    <input type="text" class="form-control" name="precoProduto" id="precoProduto"  placeholder="Digite o preço do produto" value="<?php echo $produto['preco']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="imagem">Imagem do Produto:</label>
                    <input type="text" class="form-control" name="imagem" id="imagem" placeholder="Coloque o link da imagem" value="<?php echo $produto['imagem'] ; ?>" required>
                </div>
                <button type="submit" class="btn btn-dark btn-block">Atualizar Produto</button>
            </form>
        </div>
    </div>
</div>
<div class="footer">
    <p>&copy; 2024 APP_FOOD</p>
</div>

</body>

</html>



