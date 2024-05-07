

<?php
// Conexão com o banco de dados
require_once('db.php');
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['username'])) {
    echo "Por favor, faça login para visualizar seus pedidos.";
    exit;
}

// Verificar se os dados foram enviados por meio de um formulário POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se os dados do formulário foram recebidos corretamente
    if (!empty($_POST['produto_id']) && !empty($_POST['produto_nome']) && isset($_POST['totalCompras'])) {
        $produtoIds = is_array($_POST['produto_id']) ? $_POST['produto_id'] : [];
        $produtoNomes = is_array($_POST['produto_nome']) ? $_POST['produto_nome'] : [];
        $totalCompra = $_POST['totalCompras'];
        $mensagensProdutos = is_array($_POST['mensagens_produto']) ? $_POST['mensagens_produto'] : ['']; // Recupere as mensagens
        
    
        

    // Novo array para armazenar os arrays divididos
    $novoProdutoIds = [];
    $nomes = [];
    
    // Iterar sobre os elementos do array $produtoIds
    foreach ($produtoIds as $id) {
        // Dividir o elemento usando a vírgula como delimitador
        $idsSeparados = explode(',', $id);
    
        // Adicionar os IDs separados ao novo array
        $novoProdutoIds = array_merge($novoProdutoIds, $idsSeparados);
    }
    
    
    foreach ($produtoNomes as $id) {
        $idsSeparados = explode(',', $id);
        $nomes = array_merge($nomes, $idsSeparados);
    }
    
    
    // Inicialize o array do carrinho se não existir
    if (!isset($_SESSION['carrinho_produtos'])) {
        $_SESSION['carrinho_produtos'] = [];
    }

    // Obtenha a data e hora atual
    $dataHoraPedido = date('Y-m-d H:i:s');

    // Obter o ID do usuário
    $usuarioIdQuery = "SELECT id FROM usuariosetec WHERE usuario = '{$_SESSION['username']}'";
    $result = $conn->query($usuarioIdQuery);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $idUsuario = $row['id'];
    } else {
        echo "Erro ao obter o ID do usuário.";
        exit; // Saia do script se não for possível obter o ID do usuário
    }

    // Inserir o pedido na tabela pedidos
    $insertPedido = $conn->prepare("INSERT INTO pedidos (IdUsuarios, dataDaCompra, valorTotalDoPedido) VALUES (?, ?, ?)");
    $insertPedido->bind_param("iss", $idUsuario, $dataHoraPedido, $totalCompra);
    $insertPedido->execute();

    // Obter o ID do pedido inserido
    $idPedido = $conn->insert_id;

    // Itere sobre os produtos e adicione-os ao banco de dados
    foreach ($novoProdutoIds as $i => $idDoProduto) {
        $mensagem = isset($mensagensProdutos[$i]) ? $mensagensProdutos[$i] : 'Nenhuma';

        // Consulta para obter o preço unitário do produto
        $precoUnitarioQuery = "SELECT preco FROM produtos WHERE id = ?";
        $stmt = $conn->prepare($precoUnitarioQuery);
        $stmt->bind_param("i", $idDoProduto);
        $stmt->execute();
        $result = $stmt->get_result();
        $precoUnitario = 0;
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $precoUnitario = $row['preco'];
        }

        // Inserir os detalhes do pedido na tabela itens
        $insertDetalhesPedido = $conn->prepare("INSERT INTO itens (mensagem, idPedido, IdProduto, precoUnitario, statusItem) VALUES (?, ?, ?, ?, 'Pendente')");
        $insertDetalhesPedido->bind_param("sidi", $mensagem, $idPedido, $idDoProduto, $precoUnitario);
        $insertDetalhesPedido->execute();

        // Verificar erros na execução da consulta
        if ($insertDetalhesPedido->error) {
            echo "Erro ao adicionar detalhes do pedido para o produto: " . $insertDetalhesPedido->error;
        }
    }

  

        // Redirecionar após o processamento do formulário para evitar a reenvio dos dados ao atualizar a página
        header("Location: {$_SERVER['PHP_SELF']}");
        exit;
    } else {
        echo 'Erro: Dados não recebidos corretamente.';
    }
}

// Obter o ID do usuário logado
$usuario = $_SESSION['username'];
$usuarioIdQuery = "SELECT id FROM usuariosetec WHERE usuario = ?";
$stmtUsuarioId = $conn->prepare($usuarioIdQuery);
$stmtUsuarioId->bind_param("s", $usuario);
$stmtUsuarioId->execute();
$resultUsuarioId = $stmtUsuarioId->get_result();

if ($resultUsuarioId && $resultUsuarioId->num_rows > 0) {
    $rowUsuarioId = $resultUsuarioId->fetch_assoc();
    $idUsuario = $rowUsuarioId['id'];

    // Consulta para obter os detalhes do pedido do usuário
    $detalhesPedidoQuery = "SELECT p.id as pedido_id, p.dataDaCompra, p.valorTotalDoPedido, i.mensagem, i.precoUnitario, i.statusItem, pr.nome as produto_nome
                            FROM pedidos p
                            JOIN itens i ON p.id = i.idPedido
                            JOIN produtos pr ON i.IdProduto = pr.id
                            WHERE p.IdUsuarios = ?";
    $stmtDetalhesPedido = $conn->prepare($detalhesPedidoQuery);
    $stmtDetalhesPedido->bind_param("i", $idUsuario);
    $stmtDetalhesPedido->execute();
    $resultDetalhesPedido = $stmtDetalhesPedido->get_result();

    if ($resultDetalhesPedido && $resultDetalhesPedido->num_rows > 0) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seus Pedidos</title>
</head>
<body>
        <table>
            <tr>
            <th>Pedido ID</th>
            <th>Data da Compra</th>
            <th>Produto</th>
            <th>Mensagem</th>
            <th>Preço Unitário</th>
            <th>Status</th>
            <th>Cancelar</th> <!-- Adicionando uma nova coluna para a ação -->
        </tr>
        <?php
            while ($rowDetalhesPedido = $resultDetalhesPedido->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$rowDetalhesPedido['pedido_id']}</td>";
                echo "<td>{$rowDetalhesPedido['dataDaCompra']}</td>";
                echo "<td>{$rowDetalhesPedido['produto_nome']}</td>";
                echo "<td>{$rowDetalhesPedido['mensagem']}</td>";
                echo "<td>{$rowDetalhesPedido['precoUnitario']}</td>";
                echo "<td>{$rowDetalhesPedido['statusItem']}</td>";
                // Adicionando um formulário com um botão de cancelar pedido
                echo "<td>";
                echo "<form action='cancelar_pedido.php' method='POST'>";
                echo "<input type='hidden' name='pedido_id' value='{$rowDetalhesPedido['pedido_id']}'>"; // Envia o ID do pedido via POST
                echo "<button type='submit' name='cancelar_pedido'>Cancelar Pedido</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        ?>

    </table>
    <?php
        // Consulta para obter o valor total dos pedidos do usuário, considerando apenas os itens não rejeitados
        $valorTotalQuery = "SELECT SUM(pedidos.valorTotalDoPedido) AS valorTotal 
        FROM pedidos 
        INNER JOIN itens ON pedidos.id = itens.idPedido
        WHERE pedidos.IdUsuarios = ? AND itens.statusItem = 'aceito'";
        

        $stmtValorTotal = $conn->prepare($valorTotalQuery);
        $stmtValorTotal->bind_param("i", $idUsuario);
        $stmtValorTotal->execute();
        $resultValorTotal = $stmtValorTotal->get_result();


        if ($resultValorTotal && $rowValorTotal = $resultValorTotal->fetch_assoc()) {
            $valorTotal = $rowValorTotal['valorTotal'];
            // Formatar o valor para exibir apenas duas casas decimais após a vírgula
            $valorTotalFormatado = number_format($valorTotal, 2, ',', '.');
            echo "<h3>Valor total: R$ $valorTotalFormatado</h3>";
            
            // Verificar se o valor total é maior que zero (ou qualquer outra condição que desejar)
            if ($valorTotal > 0) {
                // Aqui você coloca o código para o botão
                echo "<button type='button'>Comprar</button>";
            }
        } else {
            echo "Erro ao calcular o valor total dos pedidos.";
        }
        
?>


</body>
</html>
<?php
    } else {
        echo "Nenhum pedido encontrado para este usuário.";
    }
} else {
    echo "Erro ao obter o ID do usuário.";
    exit;
}
?>



