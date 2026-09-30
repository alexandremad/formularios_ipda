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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crachá Funcional</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }

        .cracha-container {
            width: 320px;
            height: 500px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);

            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            box-sizing: border-box;
            text-align: center;
            position: relative;
            overflow: hidden;
            margin-bottom: 20px;
            background-image: url('img/logo_reviver2.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-position: -200px 100%;
            background-size: 150px 200px;

            background-size: 150%;
        }

        .cracha-header {
            width: 100%;
            display: flex;
            justify-content: center;
            margin-bottom: 15px;
        }

        .cracha-header img {
            max-width: 100px;
            height: auto;
        }

        .cracha-foto {
            width: 113px;
            height: 151px;
            border-radius: 10%;
            object-fit: cover;
            margin-top: -07px;
            border: 3px solidrgb(183, 186, 189);
        }

        .cracha-nome {
            font-size: 1.8em;
            font-weight: bold;
            color: #333;
            margin-top: 07px;

        }

        .cracha-cargo {
            font-size: 1.2em;
            color: #555;
            margin-bottom: 15px;
            padding: 5px 10px;
            background-color: #e9ecef;
            border-radius: 5px;
        }

        .cracha-info {
            font-size: 0.9em;
            color: #666;
            margin-bottom: 8px;
            text-align: left;
            width: 90%;
            word-wrap: break-word;
        }

        .cracha-info strong {
            color: #333;

        }

        .cracha-footer {
            margin-top: auto;
            width: 100%;
            font-size: 0.8em;
            color: #888;
            border-top: 1px dashed #eee;
            padding-top: 10px;
        }

        .back-button {
            padding: 10px 20px;
            background-color: #6c757d;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 1em;
        }

        .back-button:hover {
            background-color: #5a6268;
        }
    </style>
</head>

<body>
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
        echo "<div class='cracha-container'><p>ID inválido.</p></div>";
        echo "<a href='#' onclick='history.back()' class='back-button'>Voltar</a>";
        exit;
    }

    $id = (int)$_GET['id'];

    $sql = "SELECT id, nome, nascimento, email, tipo_membro, foto_path, tel, ender, batismo, cargo, setor FROM membros WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
    ?>
        <div class="cracha-container">
            <div class="cracha-header">
                <img src="./img/logo_reviver.png" alt="Logo da Organização">
            </div>
            <img src="<?php echo htmlspecialchars($row["foto_path"]); ?>" alt="Foto do Membro" class="cracha-foto">
            <div class="cracha-nome"><?php echo htmlspecialchars($row["nome"]); ?></div>
            <div class="cracha-cargo"><?php echo htmlspecialchars($row["cargo"]); ?></div>

            <div class="cracha-footer">
                ID: <?php echo htmlspecialchars($row["id"]); ?>
            </div>
        </div>
    <?php
    } else {
        echo "<div class='cracha-container'><p>Membro não encontrado.</p></div>";
    }

    $conn->close();
    ?>
    <a href="#" onclick="history.back()" class="back-button">Voltar</a>
</body>

</html>