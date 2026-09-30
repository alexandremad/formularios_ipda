<?php
$host = 'localhost';
$db   = 'reuniao';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// 1. Definir a data primeiro para usar no redirecionamento
$data_selecionada = isset($_GET['data_filtro']) ? $_GET['data_filtro'] : date('Y-m-d');

// 2. Lógica de Inserção CORRIGIDA
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nome'])) {
    $nome = $_POST['nome'];
    $setor = $_POST['setor'];
    
    $stmt = $conn->prepare("INSERT INTO participantes (nome, setor) VALUES (?, ?)");
    $stmt->bind_param("ss", $nome, $setor);
    
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        // Redireciona para evitar reenvio ao atualizar (F5)
        header("Location: index.php?sucesso=1&data_filtro=" . $data_selecionada);
        exit(); 
    }
}

// 3. Lógica de Contagem para a Data Selecionada
$stmt_count = $conn->prepare("SELECT COUNT(*) as total FROM participantes WHERE DATE(data_cadastro) = ?");
$stmt_count->bind_param("s", $data_selecionada);
$stmt_count->execute();
$total_participantes = $stmt_count->get_result()->fetch_assoc()['total'];
$stmt_count->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Participantes</title>
    <?php if (isset($_GET['sucesso'])): ?>
        <script>alert('Participante salvo com sucesso!');</script>
    <?php endif; ?>
    <style>
    
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; text-align: center; margin-top: 10px; background-color: #f4f7f6; }
        .container { background: white; padding: 20px; border-radius: 8px; display: inline-block; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-top: 20px; width: 450px; }
        .logo { max-width: 300px; height: auto; margin-bottom: 50px; }
        h2 { color: #2c3e50; margin-bottom: 5px; }
        .contador { font-size: 16px; color: #7f8c8d; margin-bottom: 20px; }
        form { text-align: left; margin-bottom: 20px; }
        input { display: block; margin-bottom: 15px; width: 100%; padding: 12px; box-sizing: border-box; border: 1px solid #ddd; border-radius: 4px; font-size: 16px; }
        button { width: 100%; padding: 12px; cursor: pointer; background-color: #2c3e50; color: white; border: none; border-radius: 4px; font-weight: bold; font-size: 16px; }
        button:hover { background-color: #34495e; }
        
        hr { border: 0; border-top: 1px solid #eee; margin: 25px 0; }
        
        .print-section { background-color: #f9f9f9; padding: 15px; border-radius: 6px; border: 1px dashed #ccc; text-align: center;}
        .print-section h3 { margin-top: 0; font-size: 16px; color: #333; }
        .print-section input[type="date"] { width: 100%; margin-bottom: 10px; }
        .btn-print { background-color: #3498db; }
        .btn-print:hover { background-color: #2980b9; }
    </style>
</head>
<body>

    <div class="container">
        <img src="img/horizontal_portugues.png" alt="Logo" class="logo">
      
        <h2>Cadastrar Participante</h2>
        <div class="contador">
            Inscritos hoje: <strong><?php echo $total_participantes; ?></strong>
        </div>
        
        <form method="POST">
            <input type="text" name="nome" placeholder="Nome Completo" required>
            <input type="text" name="setor" placeholder="IPDA (Setor)" required>
            <button type="submit">Salvar Registro</button>
        </form>

        <hr>

        <!-- Nova Área para selecionar a data e imprimir -->
        <div class="print-section">
            <h3>📂 Gerar Lista de Impressão</h3>
            <form action="impressao.php" method="GET">
                <input type="date" name="data_reuniao" required value="<?php echo date('Y-m-d'); ?>">
                <button type="submit" class="btn-print">Abrir Lista Desta Data</button>
            </form>
        </div>
    </div>

</body>
</html>