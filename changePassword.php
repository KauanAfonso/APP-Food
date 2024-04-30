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
                <form action="" method="post">
                <h4>Alterar Senha</h4><br>
                <input type="text" class="form-control" id="username" name="username"  placeholder="Digite seu Email:"><br>
                <input type="password" class="form-control" id="password1" name="password1" placeholder="Digite sua nova senha:"><br>
                <input type="password" class="form-control" id="password2" name="password2" placeholder="Digite sua nova senha novamente:"><br>
                <button type="submit" class="btn btn-dark" style="color: white; style='width:100%'">Alterar senha:</button>
                
                <a href=""></a></form>
                    <?php

                        session_start();
                        require_once('db.php');

                        if($_SERVER['REQUEST_METHOD'] === 'POST'){
                            $username = $_POST['username'];
                            $password1 = $_POST['password1'];
                            $password2 = $_POST['password2'];

                            //esse arquivo não foi configurado com elementos de segurança;
                            //é vunerável a ataques de injeção de sql;
                            $query = "SELECT * FROM usuariosetec WHERE usuario = '$username' ";
                            $result = $conn ->query($query);

                            if($result-> num_rows === 1  && $password1 == $password2){ 
                                $queryAlterarSenha = "UPDATE `usuariosetec` SET `senha` = '$password2' WHERE `usuario` = '$username'";
                                $uptade = $conn->query($queryAlterarSenha);
                                echo "Senha atualizada com sucesso!";
                                echo "<a href='./index.php'>Login</a>";
                            }
                            else{
                                echo "Usuario ou senha inválidos.";
                                echo "<a href='./changePassword.php'>Esqueci a senha</a>";
                            }
                        }

                        ?>
                    <p style="position: absolute; top: 462px; left: 52%;" id="criarConta">Não possui conta? <a style="color: red;" href="./criarConta.php">Clique aqui</a> </p>
                </div>
            </div>
            <div id="container-b">
             
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
