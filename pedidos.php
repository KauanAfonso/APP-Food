<?php
// Conexão com o banco de dados
require_once('db.php');

$query = "SELECT pedidos.id AS idPedido, usuariosetec.nome AS nomeUsuario, pedidos.dataDaCompra, pedidos.valorTotalDoPedido, detalhePedidoEVenda.mensagemDoPedido, produtos.nome AS nomeProduto 
          FROM pedidos 
          INNER JOIN usuariosetec ON pedidos.IdUsuarios = usuariosetec.id 
          INNER JOIN detalhePedidoEVenda ON pedidos.id = detalhePedidoEVenda.idPedido 
          INNER JOIN produtos ON detalhePedidoEVenda.IdProdutos = produtos.id 
          ORDER BY pedidos.dataDaCompra DESC";

$result = $conn->query($query);

if (!$result) {
    die('Erro ao executar a consulta: ' . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração de Pedidos</title>
</head>
<body>
    <h1>Pedidos</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID do Pedido</th>
                <th>Nome do Usuário</th>
                <th>Data da Compra</th>
                <th>Valor Total do Pedido</th>
                <th>Mensagem do Pedido</th>
                <th>Nome do Produto</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row['idPedido']; ?></td>
                <td><?php echo $row['nomeUsuario']; ?></td>
                <td><?php echo $row['dataDaCompra']; ?></td>
                <td><?php echo $row['valorTotalDoPedido']; ?></td>
                <td><?php echo $row['mensagemDoPedido']; ?></td>
                <td><?php echo $row['nomeProduto']; ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>

<?php
// Fechar a conexão com o banco de dados
$conn->close();
?>
