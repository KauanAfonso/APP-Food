<?php
require_once('db.php');

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
                <th>Valor Unitário do Produto</th>
                <th>Mensagem do Pedido</th>
                <th>Nome do Produto</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row['idPedido']; ?></td>
                <td><?php echo $row['nomeUsuario']; ?></td>
                <td><?php echo $row['dataDaCompra']; ?></td>
                <td><?php echo number_format($row['precoUnitario'], 2, ',', '.'); ?></td>
                <td><?php echo $row['mensagem']; ?></td>
                <td><?php echo $row['nomeProduto']; ?></td>
                <td><?php echo $row['statusItem']; ?></td>
                <td>
                    <form action="atualizar_status.php" method="post">
                        <input type="hidden" name="item_id" value="<?php echo $row['idItem']; ?>">
                        <button type="submit" name="rejeitar">Rejeitar</button>
                        <button type="submit" name="aceitar">Aceitar</button>
                    </form>
                </td>
                <td><button>Finalizar Pedido</button></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>

<?php
$conn->close();
?>
