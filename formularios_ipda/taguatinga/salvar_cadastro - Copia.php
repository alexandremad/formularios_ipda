<?php
session_start();

// Redireciona se o usuário não estiver logado
if (!isset($_SESSION['usuario_id'])) {
    $_SESSION['mensagem_login'] = ['tipo' => 'error', 'texto' => "Você precisa estar logado para acessar esta página."];
    header("Location: login.php");
    exit();
}

$nome_usuario = $_SESSION['usuario_nome'] ?? 'Usuário';

// --- Conexão com o Banco de Dados (Melhor seria incluir um arquivo 'db.php' aqui) ---
// Para fins de demonstração completa, incluí a conexão aqui, mas o ideal é ter um arquivo separado.
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'cadastro_de_membros'; // Confirme que este é o nome CORRETO do seu banco de dados

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Opcional: Definir o charset para UTF-8 para evitar problemas de caracteres
$conn->set_charset("utf8mb4");

// --- Validação e Coleta de Dados do POST ---
// Use isset() e empty() para verificar se os dados foram enviados
$nome = $_POST['nome'] ?? '';
$nascimento = $_POST['nascimento'] ?? '';
$email = $_POST['email'] ?? '';
$tel = $_POST['tel'] ?? '';
$ender = $_POST['ender'] ?? '';
$tipo_membro = $_POST['tipo_membro'] ?? '';
$batismo = $_POST['batismo'] ?? '';
$cargo = $_POST['cargo'] ?? '';

// Validação básica (adicione mais validação conforme necessário)
if (empty($nome) || empty($email)) {
    die("Nome e E-mail são campos obrigatórios.");
}

// --- Tratamento do Upload da Foto ---
$foto_nome = ''; // Inicializa como vazio
$foto_destino = null; // Inicializa como null para o banco de dados

if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $foto_nome = uniqid() . "_" . basename($_FILES['foto']['name']); // Nome único para evitar sobrescrever
    $target_dir = "uploads/";
    $foto_destino = $target_dir . $foto_nome;

    // Cria a pasta 'uploads' se ela não existir
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    // Move o arquivo temporário para o destino final
    if (!move_uploaded_file($_FILES['foto']['tmp_name'], $foto_destino)) {
        echo "Erro ao fazer o upload da foto. Verifique as permissões da pasta 'uploads'.";
        // Você pode optar por parar a execução aqui ou continuar sem a foto
        $foto_destino = null; // Garante que nenhum caminho inválido seja salvo
    }
} else {
    // Se não houve upload ou houve erro, a foto_destino permanece null
    // echo "Nenhuma foto enviada ou erro no upload. O cadastro prosseguirá sem foto.";
}

// --- INSERÇÃO NO BANCO DE DADOS USANDO PREPARED STATEMENTS ---
// Esta é a forma SEGURA de inserir dados para prevenir SQL Injection.

// Sua query agora tem a vírgula corrigida entre '$cargo' e '$foto_destino'
$sql = "INSERT INTO membros (nome, nascimento, email, tel, ender, tipo_membro, batismo, cargo, foto_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Prepara a instrução SQL
$stmt = $conn->prepare($sql);

if ($stmt === FALSE) {
    die("Erro ao preparar a instrução SQL: " . $conn->error);
}

// Vincula os parâmetros aos marcadores de interrogação na query
// 'sssssssss' indica o tipo de cada parâmetro: s = string
$stmt->bind_param("sssssssss", $nome, $nascimento, $email, $tel, $ender, $tipo_membro, $batismo, $cargo, $foto_destino);

// Executa a instrução preparada
if ($stmt->execute()) {
    echo "Cadastro realizado com sucesso!";
    echo "<p><a href='cadastro.php'>Cadastrar novo membros</a></p>";
    echo "<p><a href='lista.php'>Ver lista de membros</a></p>";
} else {
    echo "Erro ao cadastrar: " . $stmt->error;
}


$stmt->close();
$conn->close();
?>