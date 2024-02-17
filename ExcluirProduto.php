<?php

session_start();

require_once('db.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    



<form action="ExcluirProduto.php" method="POST">
    <h2>Excluir Produto</h2>
    <input type="number" name='idProduto' id='idProduto' placeholder='Digite o id do produto'>
    <input type="number" name='idProduto2' id='idProduto2' placeholder='Digite o id do produto novamente'>
    <input type="submit">

</form>



<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idProduto1 = $_POST['idProduto'];
    $idProduto2 = $_POST['idProduto2'];

    if ($idProduto1 === $idProduto2) {
        // Utilize instruções preparadas para evitar injeção de SQL
        $query2 = $conn->prepare("DELETE FROM produtos WHERE id = ?");
        $query2->bind_param("i", $idProduto2);

        // Execute a instrução preparada
        $delete = $query2->execute();

        if ($delete === true) {
            if ($conn->affected_rows > 0) {
                echo "Produto excluído";
            } else {
                echo "Nenhum produto encontrado com o ID especificado";
            }
        } else {
            echo "Erro ao excluir produto";
        }

        // Feche a instrução preparada
        $query2->close();
    } else {
        echo "Os IDs dos produtos não coincidem";
    }
}

// Feche a conexão com o banco de dados
$conn->close();

?>

</body>
</html>