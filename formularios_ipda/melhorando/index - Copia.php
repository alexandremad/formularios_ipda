<?php
$host = 'localhost';
$db   = 'reuniao';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $setor = $_POST['setor'];
    
    $stmt = $conn->prepare("INSERT INTO participantes (nome, setor) VALUES (?, ?)");
    $stmt->bind_param("ss", $nome, $setor);
    $stmt->execute();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Participantes</title>
    <style>
        .logo {
            display: flex;
            justify-content: center; /* Centraliza na tela */
            padding: 20px;
        }

        .logo-personalizado {
            /* O SEGREDO ESTÁ AQUI: */
            width: 50x !important;  /* Troque o 150 pelo tamanho que você quiser (ex: 100, 80) */
            height: auto !important;   /* Mantém a proporção para não achatar */
            display: block;
        }
    </style>

</head>
<body>
  <div class="logo">
        <!-- Cole seu Base64 gigante dentro do src -->
        <img src="img/horizontal_portugues.png" class="logo-personalizado">
    </div>
    <h2>Cadastrar Participante</h2>
    <form method="POST">
        <input type="text" name="nome" placeholder="Nome Completo" required>
        <input type="text" name="setor" placeholder="IPDA" required>
        <button type="submit">Salvar</button>
    </form>
    <br>
    <a href="impressao.php">Ir para Lista de Impressão</a>
</body>
</html>