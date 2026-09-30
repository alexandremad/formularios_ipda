<?php
session_start(); 


if (!isset($_SESSION['usuario_id'])) {
    
    $_SESSION['mensagem_login'] = ['tipo' => 'error', 'texto' => "Você precisa estar logado para acessar esta página."];
    header("Location: login.php"); 
    exit(); 
}


$nome_usuario = $_SESSION['usuario_nome'] ?? 'Usuário';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Visualizar Membro</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="form">
        <img src="./img/logo_reviver.png" width="110" height="110">
        <h1>Detalhes do Membro</h1>
        <hr>

        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "cadastro_de_membros";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Erro na conexão com o banco de dados: " . $conn->connect_error);
        }

        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            echo "<p>ID inválido.</p>";
            exit;
        }

         $id = (int)$_GET['id'];

        $sql = "SELECT id, nome, nascimento, email, tipo_membro, foto_path, tel, ender, batismo, setor, cargo FROM membros WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            echo "<p><img src='" . htmlspecialchars($row["foto_path"]) . "' alt='" . htmlspecialchars($row["nome"]) . "' width='200'></p>";
            echo "<p><strong>Nome:</strong> " . htmlspecialchars($row["nome"]) . " <strong>Nascimento:</strong> " . htmlspecialchars($row["nascimento"]) . "</p>";
            echo "<p><strong>Email:</strong> " . htmlspecialchars($row["email"]) . "</p>";
            echo "<p><strong>Tel:</strong> " . htmlspecialchars($row["tel"]) . "</p>";
            echo "<p><strong>Endereço:</strong> " . htmlspecialchars($row["ender"]) . "</p>";
            echo "<p><strong>Tipo de Membro:</strong> " . htmlspecialchars($row["tipo_membro"]) . " <strong>Batismo:</strong> " . htmlspecialchars($row["batismo"]) . "</p>";
            echo "<p><strong>Setor:</strong> " . htmlspecialchars($row["setor"]) . "</p>";
            echo "<p><strong>Cargo:</strong> " . htmlspecialchars($row["cargo"]) . "</p>";

            echo "<hr>";

            echo "<div style='margin-top: 20px;'>";
            echo "<form method='get' action='home.php' style='display:inline-block;'>";
            echo "<button type='submit'>Home</button>";
            echo "</form>";

            echo "<form method='get' action='lista_reviver.php' style='display:inline-block;'>";
            echo "<button type='submit'>Lista REVIVER</button>";
            echo "</form>";

            // NOVO BOTÃO PARA VISUALIZAR CRACHÁ
            echo "<form method='get' action='cracha.php' style='display:inline-block;'>";
            echo "<input type='hidden' name='id' value='" . htmlspecialchars($row["id"]) . "'>";
            echo "<button type='submit'>Visualizar Crachá</button>";
            echo "</form>";
            echo "</div>";
        } else {
            echo "<p>Membro não encontrado.</p>";
        }
        $conn->close();
        ?>


        
    </div>
</body>

</html>