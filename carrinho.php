<?php
session_start();
require_once('db.php')
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="tela.inicial.php">link</a>

    <?php
    // Verificar se os dados do formulário foram recebidos corretamente
    if (isset($_POST['produto_id']) && isset($_POST['produto_nome']) && isset($_POST['totalCompras'])) {
        // Obtenha os valores dos campos ocultos diretamente
        $produtoIds = is_array($_POST['produto_id']) ? $_POST['produto_id'] : [];
        $produtoNomes = is_array($_POST['produto_nome']) ? $_POST['produto_nome'] : [];
        $totalCompra = $_POST['totalCompras'];
        $mensagem = isset($_POST['mensagem']) ? $_POST['mensagem'] : '';

        // Inicialize o array do carrinho se não existir
        if (!isset($_SESSION['carrinho_produtos'])) {
            $_SESSION['carrinho_produtos'] = [];
        }

        // Obtenha a data e hora atual
        $dataHoraPedido = date('Y-m-d H:i:s');

        // Itere sobre os produtos e adicione-os ao array de produtos no carrinho
        foreach ($produtoIds as $i => $idDoProduto) {
            $nomeDoProduto = $produtoNomes[$i];

            // Adicione o produto a um novo array no carrinho
            $novoProduto = array(
                'id' => $idDoProduto,
                'nome' => $nomeDoProduto,
                'data_hora_pedido' => $dataHoraPedido,
            );

            // Adicione o novo array ao carrinho
            $_SESSION['carrinho_produtos'][] = $novoProduto;

            // Fazer algo com os valores recebidos
            // Neste exemplo, apenas imprimir os valores para cada produto
            echo 'Mensagem: ' . $mensagem . '<br>';
            echo 'Pedido ' . ($i + 1) . ':<br>';
            echo 'ID=' . $idDoProduto . '<br>';
            echo 'Nome=' . $nomeDoProduto . '<br>';
            echo 'Data e Hora do Pedido=' . $dataHoraPedido . '<br>';
            echo 'Total da Compra=' . $totalCompra . '<br>';
            echo '<br>';
        }


        $usuarioIdQuery = "SELECT id FROM usuariosetec WHERE username = '{$_SESSION['username']}'";
        $result = $conn->query($usuarioIdQuery);
        
        if ($result && $result->num_rows > 0) {

            while($row = $result->fetch_assoc()){
   
            echo $row['id']; //id do usuario

            $idUsuario = $row['id'];
        }
        } else {
            echo "Erro ao obter o ID do usuário.";
        }
    
        
        $insertUsuario = $conn->prepare("INSERT INTO idUsuarios from pedidos values ? ");
        $insertUsuario = execute($idUsuario);
    } else {
        echo 'Erro: Dados não recebidos corretamente.';
    }
    ?>



</body>
</html>
