<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APP Food</title>
    <link rel="stylesheet" href="login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <header>
        <h1>BEM-VINDO</h1>
    </header>

    <main>
        <div class="container" id="media">
            <div class="sombra" id="container-a">
                <div id="login">

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style='width: 100% '>
                        <select name="tipo" class="btn btn-outline-dark dropdown-toggle btn-sm text-start">
                            <option value="ALUNO">ALUNO</option>
                            <option value="administrador">adiministrador</option>
                        </select><br><br>
                        <input type="text" class="form-control" name="rm" placeholder="RM:" ><br>
                        <input type="text" class="form-control" name="username" placeholder="Email:"><br>
                        <input type="password" class="form-control" name="password" placeholder="Senha:"><br>
                        <button type="submit" class="btn btn-dark" style='width:100%'>ENTRAR</button>

                        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        session_start();
        require_once('db.php');

        $tipo = $_POST['tipo'];
        $username = $_POST['username'];
        $rm = $_POST['rm'];
        $password = $_POST['password'];

        $query = "SELECT * FROM usuariosetec WHERE tipo = '$tipo' AND usuario = '$username' AND senha = '$password' AND rm = '$rm'";
        $result = $conn->query($query);

        if ($result->num_rows === 1) {
            $_SESSION['username'] = $username;
            if ($tipo === "administrador") {
                header("Location: adiministrador.php");
            } else {
                header("Location: tela.inicial.php");
            }
        } else {
           
            echo "Usuario ou senha inválidos.";
            echo "<a href='./changePassword.php'>Esqueci a senha</a>";
        }
    }
    ?>
                    </form>
                    <br>
              

                </div>
            </div>

            <div id="container-b">
                <h5 style="position: absolute; top: 462px; left: 52%;" id="criarConta">Não possui conta? <a style="color: red;" href="./criarConta.php">Clique aqui</a> </h6>
            </div>
        </div>
    </main>

    <footer>

        <p>@copyright2023 <img src="imagens/@copyright2023.png" alt="@copyright2023"></p>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>

  
</body>

</html>
