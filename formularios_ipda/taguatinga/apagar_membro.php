<?php

session_start(); 

if (!isset($_SESSION['usuario_id'])) {
    $_SESSION['mensagem_login'] = ['tipo' => 'error', 'texto' => "Você precisa estar logado para acessar esta página."];
    header("Location: login.php"); 
    exit(); 
}

$nome_usuario = $_SESSION['usuario_nome'] ?? 'Usuário';

$servername = "localhost";
$username = "root"; 
$password = "";     
$dbname = "cadastro_de_membros"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id_para_apagar = $_POST['id'];

    $sql_select_foto = "SELECT foto_path FROM membros WHERE id = ?";
    $stmt_select_foto = $conn->prepare($sql_select_foto);
    $stmt_select_foto->bind_param("i", $id_para_apagar);
    $stmt_select_foto->execute();
    $result_foto = $stmt_select_foto->get_result();

    if ($result_foto->num_rows == 1) {
        $row_foto = $result_foto->fetch_assoc();
        $foto_path = $row_foto['foto_path'];

        $sql_delete = "DELETE FROM membros WHERE id = ?";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bind_param("i", $id_para_apagar);

        if ($stmt_delete->execute()) {
            if (!empty($foto_path) && file_exists($foto_path)) {
                unlink($foto_path);
            }
            // Sucesso: exibe alerta e redireciona para lista.php
            echo "<script>alert('Membro apagado com sucesso!'); window.location.href='lista.php';</script>";
        } else {
            // Erro: exibe alerta e redireciona para a página de cadastro
            echo "<script>alert('Erro ao apagar o membro: " . $conn->error . "'); window.location.href='cadastro.php';</script>";
        }
        $stmt_delete->close();
    } else {
        // Membro não encontrado: exibe alerta e redireciona para a página de cadastro
        echo "<script>alert('Membro não encontrado.'); window.location.href='cadastro.php';</script>";
    }
    $stmt_select_foto->close();
} else {
    // ID não fornecido: exibe alerta e redireciona para a página de cadastro
    echo "<script>alert('ID do membro não fornecido.'); window.location.href='cadastro.php';</script>";
}

$conn->close();
// Como o JavaScript já redireciona, não precisamos de mais HTML aqui.
// O 'exit()' é importante para garantir que nenhuma outra saída PHP seja enviada após o script.
exit(); 
?>