<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_edit = $_POST['id_edit'] ?? null;
    $dados = $_POST;
    unset($dados['id_edit'], $dados['foto_atual']);

    // Processamento da Foto
    $foto_nome = $_POST['foto_atual'] ?? '';
    if (!empty($_FILES['foto']['name'])) {
        $pasta = 'uploads/';
        if (!is_dir($pasta)) mkdir($pasta, 0777, true);
        $foto_nome = $pasta . time() . '_' . $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], $foto_nome);
    }
    $dados['foto'] = $foto_nome;

    if ($id_edit) {
        $campos = "";
        foreach ($dados as $key => $val) { $campos .= "$key=:$key, "; }
        $campos = rtrim($campos, ", ");
        $sql = $pdo->prepare("UPDATE obreiros SET $campos WHERE id = :id_vinculo");
        $dados['id_vinculo'] = $id_edit;
    } else {
        $colunas = implode(", ", array_keys($dados));
        $valores = ":" . implode(", :", array_keys($dados));
        $sql = $pdo->prepare("INSERT INTO obreiros ($colunas) VALUES ($valores)");
    }

    try {
        $sql->execute($dados);
        header("Location: index.php?sucesso=1");
    } catch (Exception $e) {
        die("Erro Crítico: " . $e->getMessage());
    }
}