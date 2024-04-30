<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
</head>
<body>
    
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
    <h2>Editar Produto</h2>
    <input type="text" name="nameProduto" id="nameProduto" placeholder="Digite o nome do produto" required>
    <input type="text" name="DescricaoProduto" id="DescricaoProduto" placeholder="Digite a descrição do produto" required>
    <select name="categoriaProduto" class="btn btn-outline-dark dropdown-toggle btn-sm text-start">
        <option value="Lanches">Lanches</option>
        <option value="Pasteis">Pateis</option>
        <option value="Batatas">Batatas</option>
        <option value="Doces">Doces</option>
        <option value="Salgados">Salgados</option>
    </select>
    <input type="text" name="precoProduto" id="precoProduto"  placeholder="Digite o preço do produto" required>
    <input type="submit" value="Atualizar Produto">
</form>

<?php 
session_start();
require_once('db.php');

// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os dados do formulário
    $nome = $_POST['nameProduto'];
    $descricao = $_POST['DescricaoProduto'];
    $categoria = $_POST['categoriaProduto'];
    $preco = $_POST['precoProduto'];

    // Prepara a consulta SQL para atualizar o produto no banco de dados usando declaração preparada
    $query = "UPDATE produtos SET nome = ?, categoria = ?, descricao = ?, preco = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    
    // Define o ID do produto a ser atualizado - esse ID deve ser obtido de alguma forma, talvez por meio de um parâmetro na URL
    $id = 1; // Substitua 1 pelo ID do produto que você deseja atualizar

    // Vincula os parâmetros e executa a consulta
    $stmt->bind_param("ssssi", $nome, $categoria, $descricao, $preco, $id);
    if ($stmt->execute()) {
        echo "Produto atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar o produto.";
    }
    // Fecha a declaração
    $stmt->close();
}
?>
</body>
</html>
