<?php

session_start();


if (!isset($_SESSION['usuario_id'])) {

    $_SESSION['mensagem_login'] = ['tipo' => 'error', 'texto' => "Você precisa estar logado para acessar esta página."];

    header("Location: login.php");

    exit();
}


$nome_usuario = $_SESSION['usuario_nome'] ?? 'Usuário';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Controle - Ficha de Cadastro</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="form">
        <img src="./img/logo.png" alt="Logotipo da aplicação" width="110" height="110">
        <h1>Bem-vindo(a), <?php echo htmlspecialchars($nome_usuario); ?>!</h1>
        <h2>Ficha de Cadastro de Membros</h2>
        <div class="form-group">
            <button onclick="window.location.href='cadastro.php'">Cadastrar Novo Membro</button>
            <button onclick="window.location.href='lista.php'">Listar Membros</button>
            <button onclick="window.location.href='lista_expansao.php'">Listar Membros Expansão</button>
            <button onclick="window.location.href='lista_reviver.php'">Listar Membros REVIVER</button>
            <button onclick="window.location.href='logout.php'">Sair</button>
        </div>
    </div>
</body>

</html>