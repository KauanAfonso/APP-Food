<?php
// Conexão com o banco de dados
require_once('db.php');
session_start();

// Verificar se os dados do formulário foram recebidos corretamente
if (isset($_POST['produto_id'], $_POST['produto_nome'], $_POST['totalCompras'])) {
    $produtoIds = is_array($_POST['produto_id']) ? $_POST['produto_id'] : [];
    $produtoNomes = is_array($_POST['produto_nome']) ? $_POST['produto_nome'] : [];
    $totalCompra = $_POST['totalCompras'];
    $mensagem = isset($_POST['mensagem']) ? $_POST['mensagem'] : '';
    $precosProdutos = $_POST['preco_produto'];


    print_r($precosProdutos);
    
    // Novo array para armazenar os arrays divididos
    $novoProdutoIds = [];
    
    // Iterar sobre os elementos do array $produtoIds
    foreach ($produtoIds as $id) {
        // Dividir o elemento usando a vírgula como delimitador
        $idsSeparados = explode(',', $id);
        
        // Adicionar os IDs separados ao novo array
        $novoProdutoIds = array_merge($novoProdutoIds, $idsSeparados);
    }
    
    print_r($novoProdutoIds);
    
 

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
    foreach ($novoProdutoIds as $i => $idDoProduto) {
     

        // Inserir os detalhes do pedido na tabela detalhepedidoevenda
        $insertDetalhesPedidos = $conn->prepare("INSERT INTO detalhepedidoevenda (mensagemDoPedido, idPedido, idProdutos) VALUES (?, ?, ?)");
        $insertDetalhesPedidos->bind_param("sii", $mensagem, $idPedido, $idDoProduto);

        // Executar a inserção
        $resultado = $insertDetalhesPedidos->execute();

        echo $mensagem . "<br>";
        echo $idDoProduto . "<br>";
        echo $idPedido . "<br>";


        // Verificar erros na execução da consulta
        if (!$resultado) {
            echo "Erro ao adicionar detalhes do pedido para o produto: <br>";
        }
    }

    echo 'Detalhes do pedido adicionados com sucesso!';
} else {
    echo 'Erro: Dados não recebidos corretamente.';
}
?>
