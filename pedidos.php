<?php
require_once('db.php');
session_start();



if(!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin'){
    header('location: index.php');
}



$query = "SELECT pedidos.id AS idPedido, 
                 usuariosetec.nome AS nomeUsuario, 
                 pedidos.dataDaCompra, 
                 itens.precoUnitario, 
                 itens.mensagem, 
                 produtos.nome AS nomeProduto,
                 itens.statusItem,
                 itens.id AS idItem
          FROM pedidos 
          INNER JOIN usuariosetec ON pedidos.IdUsuarios = usuariosetec.id 
          LEFT JOIN itens ON pedidos.id = itens.idPedido 
          INNER JOIN produtos ON itens.IdProduto = produtos.id 
          ORDER BY pedidos.dataDaCompra DESC";

$result = $conn->query($query);

if (!$result) {
    die('Erro ao executar a consulta: ' . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração de Pedidos</title>
    <link rel="stylesheet" href="./adm.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        

        th, td {
            border: 1px solid #dddddd;
            background-color:gray;
            color:white;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: orangered;
            color: white;
        }

      

    
    </style>
</head>

<body>
    <div class="menu">
        <div>
            <a id="item_menu" href="adiministrador.php">HOME</a>
        </div>
        <div>
            <p id="bem_vindo" style="font-size: 1.4em;">Pedidos</p>
        </div>
    </div>

    <div class="center-table" style="margin-top: 10%; padding-left: 5px;">
    <table border="1">
        <thead>
            <tr>
                <th>ID do Pedido</th>
                <th>Nome do Usuário</th>
                <th>Data da Compra</th>
                <th>Valor Unitário do Produto</th>
                <th>Mensagem do Pedido</th>
                <th>Nome do Produto</th>
                <th>Status</th>
                <th>Ações</th>
                <th>Finalizar</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row['idPedido']; ?></td>
                <td ><?php echo $row['nomeUsuario']; ?></td>
                <td><?php echo $row['dataDaCompra']; ?></td>
                <td><?php echo number_format($row['precoUnitario'], 2, ',', '.'); ?></td>
                <td><?php echo $row['mensagem']; ?></td>
                <td><?php echo $row['nomeProduto']; ?></td>
                <td><?php echo $row['statusItem']; ?></td>
                <td>
                    <form action="atualizar_status.php" method="post">
                        <input type="hidden" name="item_id" value="<?php echo $row['idItem']; ?>">
                        <button type="submit" name="rejeitar" class='btn btn-danger'>Rejeitar</button>
                        <button type="submit" name="aceitar" id='aceitar' class='btn btn-success'>Aceitar</button>
                    </form>
                </td>
                <td><button class='btn btn-light'>Finalizar Pedido</button></td>
            </tr>
        <?php endwhile; ?>
    </div>
    </table>

    <footer><br><br>
    <div><img src="imagem/logo.png" alt="" style="width: 4%;"></div>
   

    <style>
        footer {
            background-image:linear-gradient(to left,black, #3a3939, black);
    bottom: 0;
    position: fixed;
    width: 100vw;
    height: 100px;
    padding: 0px 0px 50px 0px;
    text-align: center;
    color: white;
    text-shadow: 10px 5px 10px rgba(0, 0, 0, 0.301);
    margin: 15px 0 0 0;
}

footer img{

    margin-bottom:10px;

}
    </style>
</body>

</html>


<?php
$conn->close();
?>
