<?php
require_once('db.php');

// Consulta para obter todas as mensagens
$sql = "SELECT mensagens.*, usuariosetec.nome, usuariosetec.usuario FROM mensagens INNER JOIN usuariosetec ON mensagens.idUsuario = usuariosetec.id";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Mensagens</title>
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

        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<div class="menu">
    <a href="adiministrador.php">HOME</a>
    <p>Visualizar Mensagens</p>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Usuário</th>
                        <th>Título</th>
                        <th>Texto</th>
                        <th>E-mail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once('db.php');

                    $sql = "SELECT mensagens.*, usuariosetec.nome, usuariosetec.usuario FROM mensagens INNER JOIN usuariosetec ON mensagens.idUsuario = usuariosetec.id";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>".$row["id"]."</td>";
                            echo "<td>".$row["nome"]."</td>";
                            echo "<td>".$row["titulo"]."</td>";
                            echo "<td>".$row["texto"]."</td>";
                            echo "<td><button onclick=\"window.location.href='mailto:".$row["usuario"]."';\" class='btn btn-dark'>Enviar E-mail</button></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Nenhuma mensagem encontrada</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
