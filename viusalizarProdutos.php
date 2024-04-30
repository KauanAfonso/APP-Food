<?php

session_start();
require('carrinho.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<table>
    <tr>
        <th>Produto</th>
        <th>Mensagem</th>
        <th>Preço Unitário</th>
        <th>Status</th>
        <th>Cancelar</th>
    </tr>
    <?php
    // Iterar sobre os produtos e exibir os detalhes na tabela
    foreach ($novoProdutoIds as $i => $id) {
        // Verificar se o índice existe nos arrays de mensagens e nomes
        $produto = isset($nomes[$i]) ? $nomes[$i] : '';
        $mensagem = isset($mensagensProdutos[$i]) ? $mensagensProdutos[$i] : '';
        // Você pode adicionar mais lógica aqui conforme necessário
        $status = 'Pendente'; // Exemplo de status, você pode ajustar isso conforme necessário
        echo "<tr>";
        echo "<td>{$produto}</td>";
        echo "<td>{$mensagem}</td>";
        echo "<td>{$precoUnitario}</td>";
        echo "<td>{$status}</td>";
        echo "<td><button>Cancelar</button></td>";
        echo "</tr>";
    }
    ?>
</table>

<h2>Preço : <?php echo $totalCompra; ?></h2>

    
</body>
</html>