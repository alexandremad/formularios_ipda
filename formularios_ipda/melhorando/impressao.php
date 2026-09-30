<?php
// Conexão
$conn = new mysqli('localhost', 'root', '', 'reuniao');

// Verifica se uma data foi enviada via GET. Se não, usa a data de hoje.
$data_selecionada = isset($_GET['data_reuniao']) ? $_GET['data_reuniao'] : date('Y-m-d');

// 1. Consulta para buscar os participantes daquela data específica
$stmt = $conn->prepare("SELECT nome, setor FROM participantes WHERE DATE(data_cadastro) = ? ORDER BY data_cadastro DESC");
$stmt->bind_param("s", $data_selecionada);
$stmt->execute();
$result = $stmt->get_result();

// 2. Consulta para contar o total de participantes daquela data
$stmt_count = $conn->prepare("SELECT COUNT(*) as total FROM participantes WHERE DATE(data_cadastro) = ?");
$stmt_count->bind_param("s", $data_selecionada);
$stmt_count->execute();
$res_count = $stmt_count->get_result();
$total_dia = $res_count->fetch_assoc()['total'];

// Formata a data para exibir no cabeçalho
$data_formatada = date('d/m/Y', strtotime($data_selecionada));
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista para Impressão - <?php echo $data_formatada; ?></title>
    <style>
        /* Ajuste no body para começar mais no topo */
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 0; padding-top: 5px; }
        
        /* Logo com margem inferior reduzida */
        .logo { max-width: 400px; height: auto; margin-bottom: 5px; }
        
        /* Header mais compacto */
        .header { 
            text-align: center; 
            margin-bottom: 10px; 
            border-bottom: 2px solid #000; 
            padding-bottom: 10px;
        }
        
        /* Título colado no logo */
        h1 { 
            margin-top: 0; 
            margin-bottom: 0; 
            font-size: 24px; /* Ajuste se achar muito grande */
        }

        /* Parágrafo da data colado no título */
        .header p { 
            margin-top: 2px; 
            margin-bottom: 5px; 
        }

        .total-info {
            font-size: 18px;
            font-weight: bold;
            background-color: #eee;
            display: inline-block;
            padding: 5px 15px;
            border: 1px solid #000;
            margin-top: 2px;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 5px;
            padding: 10px;
        }

        .box {
            border: 1px solid #000;
            padding: 5px;
            font-size: 11px;
            min-height: 45px;
            text-align: left;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .nome { font-weight: bold; display: block; text-transform: uppercase; }
        .setor { font-size: 9px; color: #444; }

        .btn-print { 
            padding: 10px 20px; 
            background: #2c3e50; 
            color: white; 
            border: none; 
            cursor: pointer; 
            margin-bottom: 10px; 
            font-weight: bold;
        }

        @media print {
            .btn-print { display: none; }
            /* Garante que na impressão comece no limite do papel */
            body { margin: 0; padding: 0.2cm; }
            .total-info { background-color: transparent; }
        }
    </style>
    </style>
</head>
<body>

    <img src="img/horizontal_portugues.png" alt="Logo" class="logo">
    
    <div class="header">
        <h1>LISTA DE PRESENÇA</h1>
        <p>Data: <strong><?php echo $data_formatada; ?></strong> | Brasília, DF</p>
        
        <!-- Exibição do Total de Participantes -->
        <div class="total-info">
            TOTAL DE PARTICIPANTES: <?php echo $total_dia; ?>
        </div>
        <br>
        <button class="btn-print" onclick="window.print()">🖨️ Imprimir Agora</button>
    </div>

    <div class="grid-container">
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="box">
                    <span class="nome"><?php echo htmlspecialchars($row['nome']); ?></span>
                    <span class="setor"><?php echo htmlspecialchars($row['setor']); ?></span>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="grid-column: span 4;">Nenhum registro encontrado para esta data.</p>
        <?php endif; ?>
    </div>

</body>
</html>