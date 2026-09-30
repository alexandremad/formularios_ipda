<?php
// Define o fuso horário para o Brasil (Brasília)
date_default_timezone_set('America/Sao_Paulo');

$host = 'localhost';
$db   = 'reuniao';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome         = $_POST['nome'];
    $setor        = $_POST['setor'];
    // Pega a data atual automaticamente no formato ANO-MÊS-DIA
    $data_cadastro = date('Y-m-d'); 
    
    $stmt = $conn->prepare("INSERT INTO participantes (nome, setor, data_cadastro) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $setor, $data_cadastro);
    
    if ($stmt->execute()) {
        $msg = "Participante cadastrado com sucesso!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Participantes</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 30px; text-align: center; margin-top: 10px; }
        .logo { max-width: 400px; height: auto; margin-bottom: 10px; }
        h2 { margin-top: 0; margin-bottom: 15px; }
        form { display: inline-block; text-align: left; }
        input, select { 
            display: block; 
            margin-bottom: 10px; 
            width: 520px; 
            padding: 8px; 
            font-size: 20px;
            box-sizing: border-box;
        }
        button { width: 100%; padding: 10px; cursor: pointer; background-color: #2c3e50; color: white; border: none; font-size: 20px; }
        .link-footer { display: block; margin-top: 15px; font-size: 20px; }
        .msg { color: green; font-size: 22px; margin-bottom: 10px; }
    </style>
</head>
<body>

    <img src="img/horizontal_portugues.png" alt="Logo" class="logo">
  
    <h2>Cadastrar Participante</h2>
    
    <?php if (isset($msg)) echo "<p class='msg'>$msg</p>"; ?>

    <form method="POST">
        <input type="text" name="nome" placeholder="Nome Completo" required>
        
        <select name="setor" required>
            <option value="" disabled selected>Selecione a Região</option>
            <option value="Aguas Lindas-Santa Coimbra">Aguas Lindas-Santa Coimbra</option>
            <option value="Areal">Areal</option>
            <option value="Brazlandia-Incra 08 Centro">Brazlandia-Incra 08 Centro</option>
            <option value="Ceilandia-Setor O">Ceilandia-Setor O</option>
            <option value="Conic">Conic</option>
            <option value="Gama-Setor Sul">Gama-Setor Sul</option>
            <option value="Guara">Guara</option>
            <option value="Taguatinga-Norte">Taguatinga-Norte</option>
            <!-- Mantenha a lista com as demais opções -->
        </select>

        <button type="submit">Salvar Presença</button>
    </form>
    <br><br>

    <a href="impressao.php" class="link-footer">Ir para Lista de Impressão</a>

</body>
</html>