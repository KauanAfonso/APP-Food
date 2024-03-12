<?php
session_start();
require_once('db.php');

header('Location: tela.inicial.php');
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

    // Obter o ID do usuário
    $usuarioIdQuery = "SELECT id FROM usuariosetec WHERE username = '{$_SESSION['username']}'";
    $result = $conn->query($usuarioIdQuery);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $idUsuario = $row['id'];
    } else {
        echo "Erro ao obter o ID do usuário.";
        exit; // Saia do script se não for possível obter o ID do usuário
    }

    // Inserir o pedido na tabela pedidos
    $insertUsuario = $conn->prepare("INSERT INTO pedidos (idUsuarios, dataDaCompra, ValorTotalDoPedido) VALUES (?, ?, ?)");
    $insertUsuario->bind_param("iss", $idUsuario, $dataHoraPedido, $totalCompra);
    $insertUsuario->execute();

    // Obter o ID do pedido inserido
    $idPedido = $conn->insert_id;

    // Itere sobre os produtos e adicione-os ao banco de dados
    foreach ($produtoIds as $i => $idDoProduto) {
        $nomeDoProduto = $produtoNomes[$i];

        // Inserir os detalhes do pedido na tabela detalhepedidoevenda
        $insertDetalhesPedidos = $conn->prepare("INSERT INTO detalhepedidoevenda (mensagemDoPedido, idPedido, idProdutos) VALUES (?, ?, ?)");
        $insertDetalhesPedidos->bind_param("sii", $mensagem, $idPedido, $idDoProduto);
        $insertDetalhesPedidos->execute();
    }

    echo 'Pedido(s) adicionado(s) com sucesso!';
} else {
    echo 'Erro: Dados não recebidos corretamente.';
}


    ?>



</body>
</html>
