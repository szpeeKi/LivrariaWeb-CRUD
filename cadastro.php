<?php
include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (
        isset($_POST["email"], $_POST["senha"], $_POST["confirmar_senha"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["senha"]) &&
        !empty($_POST["confirmar_senha"])
    ) {
        $email = $conn->real_escape_string($_POST["email"]);
        $senha = $_POST["senha"];
        $confirmar = $_POST["confirmar_senha"];

        if ($senha !== $confirmar) {
            echo "As senhas não coincidem.";
            die();
        }

        // Verificar se já existe o e-mail
        $sql_verifica = "SELECT id FROM usuarios WHERE email = '$email'";
        $res = $conn->query($sql_verifica);

        if ($res->num_rows > 0) {
            echo "E-mail já cadastrado!";
        } else {
            // Cria o hash da senha antes de armazenar
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
            $sql = "INSERT INTO usuarios (email, senha) VALUES ('$email', '$senha_hash')";
            if ($conn->query($sql)) {
                echo "Cadastro realizado com sucesso!";
                header("Location: login.php");
                exit();
            } else {
                echo "Erro ao cadastrar: " . $conn->error;
            }
        }
    } else {
        echo "Preencha todos os campos!";
    }
}
?>



<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div id="login">

        <div class="caixa">
            <img src="img/pngtree-book-clipart-vector-png-image_6653535.png" alt="">
            <h1>CADASTRO</h1>

            <form method="POST" action="cadastro.php">
                <div class="name">
                    <input type="text" name="nome" placeholder="Seu nome" required>
                </div>
                <div class="email">
                    <input type="email" name="email" placeholder="E-mail" required>
                </div>
                <div class="senha">
                    <input type="password" name="senha" placeholder="Senha" required>
                </div>
                <div class="senha">
                    <input type="password" name="confirmar_senha" placeholder="Confirme sua senha" required>
                </div>
                <div class="entrar">
                    <p>Já tem uma conta?<a href="login.php"> Entre aqui.</a></p>
                    <button type="submit">Enviar</button>
                </div>
            </form>


        </div>
    </div>
</body>
</html>