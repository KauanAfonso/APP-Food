<?php
require_once('db.php');

// Verificar se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar se o botão "rejeitar" foi clicado
    if (isset($_POST['rejeitar'])) {
        // Verificar se o ID do item foi enviado
        if (isset($_POST['item_id'])) {
            // Obter o ID do item do formulário
            $itemId = $_POST['item_id'];

            // Preparar a consulta SQL para atualizar o status do item para "rejeitado"
            $query = "UPDATE itens SET statusItem = 'rejeitado' WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $itemId);

            // Executar a consulta
            if ($stmt->execute()) {
                echo "Status do item atualizado para Rejeitado com sucesso!";
                header('Location:pedidos.php');
            } else {
                echo "Erro ao atualizar o status do item.";
            }
        } else {
            echo "ID do item não recebido.";
        }
    } elseif (isset($_POST['aceitar'])) { // Verificar se o botão "aceitar" foi clicado
        // Verificar se o ID do item foi enviado
        if (isset($_POST['item_id'])) {
            // Obter o ID do item do formulário
            $itemId = $_POST['item_id'];

            // Preparar a consulta SQL para atualizar o status do item para "aceito"
            $query = "UPDATE itens SET statusItem = 'aceito' WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $itemId);

            // Executar a consulta
            if ($stmt->execute()) {
                echo "Status do item atualizado para Aceito com sucesso!";
                header('Location:pedidos.php');
            } else {
                echo "Erro ao atualizar o status do item.";
            }
        } else {
            echo "ID do item não recebido.";
        }
    } else {
        echo "Ação inválida.";
    }
} else {
    echo "Requisição inválida.";
}
?>
