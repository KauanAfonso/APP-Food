<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <!-- Integração do Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>


<style>

img{
    width:300px;
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
<body>

<div class="menu">
    <a href="adiministrador.php">HOME</a>
    <p>EDITAR PRODUTO</p>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <table class="table">
                <thead class="thead-dark">
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
                    session_start();
                    require_once('db.php');

                    $query = "SELECT * FROM produtos";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>{$row['id']}</td>";
                            echo "<td><img src='{$row['imagem']}'></img></td>";
                            echo "<td>{$row['nome']}</td>";
                            echo "<td>{$row['categoria']}</td>";
                            echo "<td>{$row['descricao']}</td>";
                            echo "<td>{$row['preco']}</td>";
                            echo "<form action='EditarProdutoForm.php' method='GET'>

                            <input type='hidden' name='id' value='{$row['id']}'>

                            <td><button type='submit' class='btn btn-dark'>Editar</button></td>;

                            </form>";
                        
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>Nenhum produto encontrado</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
