<?php
session_start();
include("conexao.php");

// Verifica se o usuário já está logado
if (isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["email"], $_POST["senha"]) && !empty($_POST["email"]) && !empty($_POST["senha"])) {
        $email = $conn->real_escape_string($_POST["email"]);
        $senha = $_POST["senha"]; // Não escapar a senha para verificação
        
        // Usando prepared statement para maior segurança
        $stmt = $conn->prepare("SELECT id, senha FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $usuario = $result->fetch_assoc();
            
            // Verifica a senha com o hash armazenado
            if (password_verify($senha, $usuario['senha'])) {
                // Autenticação bem-sucedida
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_email'] = $email;
                
                // Regenera o ID da sessão para prevenir fixation
                session_regenerate_id(true);
                
                header("Location: index.php");
                exit();
            } else {
                $erro = "Credenciais inválidas!";
            }
        } else {
            $erro = "Credenciais inválidas!";
        }
        
        $stmt->close();
    } else {
        $erro = "Por favor, preencha todos os campos!";
    }
}
?>



<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div id="login">

        <div class="caixa">
            <img src="img/pngtree-book-clipart-vector-png-image_6653535.png" alt="">
            <h1>LOGIN</h1>
        <form method="POST" action="">
            <div class="email">
                <input type="email" name="email" placeholder="E-mail" required>
            </div>
            <div class="senha">
                <input type="password" name="senha" placeholder="Senha" required>
            </div>
            <div class="entrar">
                <p>Ainda não tem uma conta? <a href="cadastro.php">Crie uma.</a></p>
            <button type="submit">Entrar</button>
    </div>
</form>

        </div>
    </div>
</body>
