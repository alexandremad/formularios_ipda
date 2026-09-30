<?php
// Conexão
$conn = new mysqli('localhost', 'root', '', 'reuniao');

// Captura a data enviada via GET ou usa a data atual como padrão
$data_filtro = isset($_GET['data']) ? $_GET['data'] : date('Y-m-d');

// Consulta preparada para evitar SQL Injection e filtrar pela data selecionada
$stmt = $conn->prepare("SELECT nome, setor FROM participantes WHERE DATE(data_cadastro) = ? ORDER BY nome ASC");
$stmt->bind_param("s", $data_filtro);
$stmt->execute();
$result = $stmt->get_result();

// Formata a data para exibição no cabeçalho (ex: 02/09/2026)
$data_exibicao = date('d/m/Y', strtotime($data_filtro));
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista para Impressão</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 30px; text-align: center; margin-top: 10px; }
        .logo { max-width: 400px; height: auto; margin-bottom: 10px; }
        h1 { margin-top: 0; margin-bottom: 15px; }
        
        .header { text-align: center; margin-bottom: 20px; }
        
        /* Estilização do filtro de data */
        .filtro-form {
            display: inline-flex;
            gap: 10px;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }
        .filtro-form input[type="date"] {
            padding: 8px;
            font-size: 16px;
            width: auto;
            margin-bottom: 0;
        }
        .filtro-form button {
            padding: 8px 15px;
            font-size: 16px;
            cursor: pointer;
            background-color: #2c3e50;
            color: white;
            border: none;
            width: auto;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 5px;
        }

        .box {
            border: 1px solid #000;
            padding: 5px;
            font-size: 11px;
            min-height: 40px;
        }

        .nome { font-weight: bold; display: block; text-transform: uppercase; }
        .setor { font-size: 9px; color: #444; }

        /* Oculta os botões e o formulário de filtro na impressão */
        @media print {
            .btn-print, .filtro-form { display: none !important; }
            body { margin: 1cm; }
        }
    </style>
</head>
<body>
<img src="img/horizontal_portugues.png" alt="Logo" class="logo">
    <div class="header">
        <h1>LISTA DE PRESENÇA</h1>
        
        <!-- Formulário para seleção da data -->
        <form method="GET" action="" class="filtro-form">
            <label for="data" style="font-size: 16px;">Filtrar Data:</label>
            <input type="date" id="data" name="data" value="<?php echo $data_filtro; ?>">
            <button type="submit">Buscar</button>
        </form>

        <p>Data: <?php echo $data_exibicao; ?> | Local: Brasília, DF</p>
        <button class="btn-print" onclick="window.print()">Imprimir PDF/Papel</button>
    </div>

    <div class="grid-container">
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="box">
                <span class="nome"><?php echo htmlspecialchars($row['nome']); ?></span>
                <span class="setor"><?php echo htmlspecialchars($row['setor']); ?></span>
            </div>
        <?php endwhile; ?>
    </div>

</body>
</html>