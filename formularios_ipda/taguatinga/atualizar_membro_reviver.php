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
    $id_para_atualizar = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $nascimento = $_POST['nascimento'];
    $tel = $_POST['tel'];
    $ender = $_POST['ender'];
    $tipo_membro = $_POST['tipo_membro'];
    $batismo = $_POST['batismo'];
    $cargo= $_POST['cargo'];
    $setor= $_POST['setor'];

    $foto_path = null;

    
    if (!empty($_FILES['nova_foto']['name'])) {
        $foto_nome = $_FILES['nova_foto']['name'];
        $foto_temp = $_FILES['nova_foto']['tmp_name'];
        $foto_destino = "uploads/" . basename($foto_nome); 

        
        if (!is_dir('uploads')) {
            mkdir('uploads', 0755, true);
        }

        if (move_uploaded_file($foto_temp, $foto_destino)) {
            
            $sql_select_foto_antiga = "SELECT foto_path FROM membros WHERE id = ?";
            $stmt_select_foto_antiga = $conn->prepare($sql_select_foto_antiga);
            $stmt_select_foto_antiga->bind_param("i", $id_para_atualizar);
            $stmt_select_foto_antiga->execute();
            $result_foto_antiga = $stmt_select_foto_antiga->get_result();
            if ($result_foto_antiga->num_rows == 1) {
                $row_foto_antiga = $result_foto_antiga->fetch_assoc();
                if (!empty($row_foto_antiga['foto_path']) && file_exists($row_foto_antiga['foto_path'])) {
                    unlink($row_foto_antiga['foto_path']);
                }
            }
            $stmt_select_foto_antiga->close();
            $foto_path = $foto_destino;
        } else {
            echo "<p style='color:red;'>Erro ao fazer o upload da nova foto.</p>";
            echo "<p><a href='listar_membros_expansao.php'>Voltar para a lista de membros</a></p>";
            $conn->close();
            exit;
        }
    } else {
        
        $sql_select_foto_existente = "SELECT foto_path FROM membros WHERE id = ?";
        $stmt_select_foto_existente = $conn->prepare($sql_select_foto_existente);
        $stmt_select_foto_existente->bind_param("i", $id_para_atualizar);
        $stmt_select_foto_existente->execute();
        $result_foto_existente = $stmt_select_foto_existente->get_result();
        if ($result_foto_existente->num_rows == 1) {
            $row_foto_existente = $result_foto_existente->fetch_assoc();
            $foto_path = $row_foto_existente['foto_path'];
        }
        $stmt_select_foto_existente->close();
    }

    
    $sql_update = "UPDATE membros SET nome = ?, email = ?, nascimento = ?, tel = ?, ender = ?, tipo_membro = ?, batismo = ?, cargo = ?, setor = ?, foto_path = ? WHERE id = ?";
    $stmt_update = $conn->prepare($sql_update);

    
    $stmt_update->bind_param("ssssssssssi", $nome, $email, $nascimento, $tel, $ender, $tipo_membro, $batismo, $cargo, $setor, $foto_path, $id_para_atualizar);

    if ($stmt_update->execute()) {
        echo "<p style='color:green;'>Dados do membro atualizados com sucesso!</p>";
    } else {
        echo "<p style='color:red;'>Erro ao atualizar os dados do membro: " . $conn->error . "</p>";
    }
    $stmt_update->close();
} else {
    echo "<p style='color:red;'>ID do membro não fornecido.</p>";
    
}

$conn->close();
echo "<p><a href='lista_reviver.php'>Voltar para a lista de membros REVIVER</a></p>";

?>