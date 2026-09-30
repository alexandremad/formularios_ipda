
<?php
session_start(); 


if (!isset($_SESSION['usuario_id'])) {
    
    $_SESSION['mensagem_login'] = ['tipo' => 'error', 'texto' => "Você precisa estar logado para acessar esta página."];
    header("Location: login.php"); 
    exit(); 
}


$nome_usuario = $_SESSION['usuario_nome'] ?? 'Usuário';
?><!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="form">
    <img src="./img/logo.png" width="110" height="110">
    <h1>Cadastro de Usuário</h1>
    <div class="form">
        <h2>Cadastro de Usuário</h2>
        <form action="processa_cadastro.php" method="POST">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            <div class="form-group">
                <label for="confirmar_senha">Confirmar Senha:</label>
                <input type="password" id="confirmar_senha" name="confirmar_senha" required>
            </div>
            <input type="submit" value="Cadastrar">
            
        </form>
    </div>
    
    <button type="button" onclick="window.location.href='./home.php'">Home</button>
    <button onclick="window.location.href='./logout.php'">Sair</button>
    
</body>

</html>