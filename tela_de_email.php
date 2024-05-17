<?php
session_start();
require('db.php');

// Verificar se o usuário está logado
if (!isset($_SESSION['username'])) {
    echo "Por favor, faça login para visualizar seus pedidos.";
    exit;
}

// Preparar a consulta SQL
$query = $conn->prepare("SELECT id FROM usuariosetec WHERE usuario = ?");
$query->bind_param('s', $_SESSION['username']); // Vincular o parâmetro
$query->execute(); // Executar a consulta
$result = $query->get_result(); // Obter o resultado

// Verificar se o usuário foi encontrado
if ($row = $result->fetch_assoc()) {
    $usuarioId = $row['id'];
} else {
    echo "Usuário não encontrado.";
    exit;
}

// Fechar o statement e a conexão
$query->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Envie sua mensagem</title>
    <link rel="stylesheet" href="email1.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="menu" style="text-align: center;">
        <a id="item_menu" href="tela.inicial.php">HOME</a>
        <a id='item_menu' href="fale_conosco">VOLTAR</a>
    </div>

    <div style="text-align: center;">
        <form action="tela_de_email.php" method="post">
            <h1>Envie sua mensagem</h1>
            <input type="hidden" name="id" value="<?php echo $usuarioId; ?>">
            <input class="input_msg" type="text" id="assunto" name="assunto" placeholder="Assunto" required><br>
            <textarea class="input_msg" id="mensagem" name="mensagem" placeholder="Qual o problema?" style="height: 30vh;" required></textarea><br>
            <a href="fale_conosco.php"><img style="width: 40px; height: 40px;" src="https://sistemas.itajai.sc.gov.br/portal/conselho/img/voltar.png" alt="Voltar"></a>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
</body>

<footer><br><br>
    <div><img src="imagem/logo.png" alt="" style="width: 5%;"></div>
   

    <style>
        footer {
    background-image: linear-gradient(to bottom, #c22a2a,var(--cor3));
    bottom: 0;
    position: fixed;
    width: 100vw;
    height: 100px;
    padding: 1px 0px 5px 0px;
    text-align: center;
    color: white;
    text-shadow: 10px 5px 10px rgba(0, 0, 0, 0.301);
    margin: 15px 0 0 0;
}
    </style>

</html>

<?php
// Processar o formulário após o envio
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require('db.php');

    $id = $_POST["id"];
    $assunto = $_POST["assunto"];
    $mensagem = $_POST['mensagem'];

    if (!empty($id) && !empty($assunto) && !empty($mensagem)) {
        // Preparar e executar a consulta para inserir a mensagem
        $stmt = $conn->prepare("INSERT INTO mensagens (idUsuario, titulo, texto) VALUES (?, ?, ?)");
        $stmt->bind_param('iss', $id, $assunto, $mensagem);
        
        if ($stmt->execute()) {
            echo "Mensagem enviada com sucesso!";
            // Redirecionar para uma página de confirmação após o envio
            header("Location: fale_conosco.php");
            exit;
        } else {
            echo "Erro ao enviar a mensagem: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "Todos os campos são obrigatórios!";
    }
}
?>
