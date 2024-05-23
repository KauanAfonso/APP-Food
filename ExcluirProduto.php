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
    <title>Excluir Produto</title>
    <!-- Integração do Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>

        *{
            margin: 0;
            padding:0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        /* Estilo para a tabela */
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            
        }

        img{
            width: 300px;
        }
        th {
            background-color: #343a40; /* Preto */
            color: #fff; /* Texto branco */
        }
       
        /* Estilo para os botões */
        .btn-excluir {
            background-color: #dc3545; /* Vermelho */
            color: #fff; /* Texto branco */
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .btn-excluir:hover {
            background-color: #c82333; /* Vermelho mais escuro no hover */
        }

            
        .menu {
            background: linear-gradient(to left, black, #3a3939, black);
            color: white;
            padding: 15px;
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
    </style>
</head>
<body>

<div class="menu">
    <a href="adiministrador.php">HOME</a>
    <p>Excluir Produto</p>
</div>


<div class="container">
    <h2>Lista de Produtos</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Imagem</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM produtos";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['id']}</td>";
                    echo "<td><img src='{$row['imagem']}'></td>";
                    echo "<td>{$row['nome']}</td>";
                    echo "<td>{$row['categoria']}</td>";
                    echo "<td>{$row['descricao']}</td>";
                    echo "<td>{$row['preco']}</td>";
                    echo "<td>
                            <form action='ExcluirProduto.php' method='POST'>
                                <input type='hidden' name='idProdutoExcluir' value='{$row['id']}'>
                                <button type='submit' class='btn btn-excluir' onclick='return confirmarExclusao();'>Excluir</button>
                            </form>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Nenhum produto encontrado</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script>
    function confirmarExclusao() {
        return confirm("Tem certeza que deseja excluir este produto?");
    }
</script>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['idProdutoExcluir'])) {
        // Utilize instruções preparadas para evitar injeção de SQL
        $idProdutoExcluir = $_POST['idProdutoExcluir'];
        $query2 = $conn->prepare("DELETE FROM produtos WHERE id = ?");
        $query2->bind_param("i", $idProdutoExcluir);

        // Execute a instrução preparada
        $delete = $query2->execute();

        if ($delete === true) {
            if ($conn->affected_rows > 0) {
                echo "<script>window.location.reload();</script>";
            } else {
                echo "Nenhum produto encontrado com o ID especificado";
            }
        } else {
            echo "Erro ao excluir produto";
        }

        // Feche a instrução preparada
        $query2->close();
    } else {
        echo "Os IDs dos produtos não foram fornecidos";
    }
}

// Feche a conexão com o banco de dados
$conn->close();
?>

</body>
</html>
