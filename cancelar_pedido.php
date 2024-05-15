<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cancelar_pedido'])) {
    // Verifica se o ID do pedido foi enviado
    if (isset($_POST['pedido_id'])) {
        $pedido_id = $_POST['pedido_id'];

        // Conexão com o banco de dados
        require_once('db.php');

        // Query para excluir a linha na tabela itens
        $query = "DELETE FROM itens WHERE idPedido = ?";
        
        // Preparar e executar a declaração
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $pedido_id);
        
        if ($stmt->execute()) {
            echo "Pedido cancelado com sucesso!";
            header('location: carrinho.php');
        } else {
            echo "Erro ao cancelar o pedido.";
        }

        // Fechar a declaração e a conexão com o banco de dados
        $stmt->close();
        $conn->close();
    } else {
        echo "ID do pedido não fornecido.";
    }
} else {
    echo "Acesso inválido ao script.";
}
?>
