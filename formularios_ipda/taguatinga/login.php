<?php
session_start(); 

$mensagem = '';
$tipo_mensagem = '';


if (isset($_SESSION['mensagem_login'])) {
    $mensagem = $_SESSION['mensagem_login']['texto'];
    $tipo_mensagem = $_SESSION['mensagem_login']['tipo'];
    unset($_SESSION['mensagem_login']); 
}


if (isset($_SESSION['usuario_id'])) {
    header("Location: dashboard.php"); 
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Usuário</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
   

    <div class="form">
    <img src="./img/logo.png" width="110" height="110">
    <h1>Login</h1>
    <div class="form">
        <h2>Login</h2>

        <?php if ($mensagem): ?>
            <div class="mensagem <?php echo $tipo_mensagem; ?>">
                <?php echo $mensagem; ?>
            </div>
        <?php endif; ?>

        <form action="processa_login.php" method="POST">
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            <button type="submit">Entrar</button>
        </form>
        
    </div>
    </div>
    <button onclick="window.location.href='./index.html'">Home</button>
</body>

</html>