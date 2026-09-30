<?php
// Conexão (mesmos dados acima)
$conn = new mysqli('localhost', 'root', '', 'reuniao');
$result = $conn->query("SELECT nome, setor FROM participantes ORDER BY nome ASC");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista para Impressão</title>
    <style>
        
         body { font-family: Arial, sans-serif; font-size: 30px; text-align: center; margin-top: 10px; }
        
        /* Ajustei o tamanho do logo para não empurrar muito o form para baixo */
        .logo { max-width: 400px; height: auto; margin-bottom: 10px; }
        
        h1 { margin-top: 0; margin-bottom: 15px; }
        form { display: inline-block; text-align: left; }
        input { display: block; margin-bottom: 10px; width: 500px; padding: 8px; }
        button { width: 100%; padding: 10px; cursor: pointer; background-color: #2c3e50; color: white; border: none; }
        
        .link-footer { display: block; margin-top: 15px; }
        .header { text-align: center; margin-bottom: 20px; }
        
        /* Grid de 4 colunas */
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

        @media print {
            .btn-print { display: none; }
            body { margin: 1cm; }
        }
    </style>
</head>
<body>
<img src="img/horizontal_portugues.png" alt="Logo" class="logo">
    <div class="header">
        <h1>LISTA DE PRESENÇA</h1>
        <p>Data: <?php echo date('d/m/Y'); ?> | Local: Brasília, DF</p>
        <button class="btn-print" onclick="window.print()">Imprimir PDF/Papel</button>
    </div>

    <div class="grid-container">
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="box">
                <span class="nome"><?php echo $row['nome']; ?></span>
                <span class="setor"><?php echo $row['setor']; ?></span>
            </div>
        <?php endwhile; ?>
    </div>

</body>
</html>