<?php
require 'config.php';
$lista = $pdo->query("SELECT * FROM obreiros ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lista de Obreiros</title>
    <style>
        table { width: 100%; border-collapse: collapse; font-family: Arial; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background: #000080; color: white; }
        .btn-editar { background: orange; padding: 5px; text-decoration: none; color: black; border-radius: 3px; }
    </style>
</head>
<body>
    <h1>Obreiros Cadastrados</h1>
    <a href="formulario.php" style="display:inline-block; margin-bottom:20px; padding:10px; background:blue; color:white; text-decoration:none;">+ Novo Cadastro</a>
    
    <table>
        <tr>
            <th>Foto</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Ações</th>
        </tr>
        <?php foreach($lista as $item): ?>
        <tr>
            <td><img src="<?= $item['foto'] ?>" width="40"></td>
            <td><?= $item['nome'] ?></td>
            <td><?= $item['cpf'] ?></td>
            <td>
                <a href="formulario.php?editar=<?= $item['id'] ?>" class="btn-editar">Editar / Imprimir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>