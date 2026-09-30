<?php
session_start();

// Redireciona se o usuário não estiver logado
if (!isset($_SESSION['usuario_id'])) {
    $_SESSION['mensagem_login'] = ['tipo' => 'error', 'texto' => "Você precisa estar logado para acessar esta página."];
    header("Location: login.php");
    exit();
}

$nome_usuario = $_SESSION['usuario_nome'] ?? 'Usuário';

// --- Conexão com o Banco de Dados ---
// Para fins de demonstração, incluí a conexão aqui, mas o ideal é ter um arquivo separado.
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
$nome = $_POST['nome'] ?? '';
$nascimento = $_POST['nascimento'] ?? '';
$email = $_POST['email'] ?? '';
$tel = $_POST['tel'] ?? '';
$ender = $_POST['ender'] ?? '';
$tipo_membro = $_POST['tipo_membro'] ?? '';
$setor = $_POST['setor'] ?? '';
$batismo = $_POST['batismo'] ?? '';
$cargo = $_POST['cargo'] ?? '';

// Validação básica (adicione mais validação conforme necessário)
if (empty($nome) || empty($email)) {
    // Em vez de die(), defina uma mensagem de sessão e redirecione
    $_SESSION['mensagem_cadastro'] = ['tipo' => 'error', 'texto' => "Nome e E-mail são campos obrigatórios."];
    header("Location: cadastro.php");
    exit();
}

// --- Tratamento do Upload da Foto ---
$foto_destino = null;

if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $foto_nome = uniqid() . "_" . basename($_FILES['foto']['name']);
    $target_dir = "uploads/";
    $foto_destino = $target_dir . $foto_nome;

    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    if (!move_uploaded_file($_FILES['foto']['tmp_name'], $foto_destino)) {
        // Lida com o erro de upload, mas ainda tenta prosseguir com o registro
        $_SESSION['mensagem_cadastro'] = ['tipo' => 'warning', 'texto' => "Erro ao fazer o upload da foto. O cadastro prosseguirá sem foto."];
        $foto_destino = null;
    }
}

// --- INSERÇÃO NO BANCO DE DADOS USANDO PREPARED STATEMENTS ---
$sql = "INSERT INTO membros (nome, nascimento, email, tel, ender, tipo_membro, setor, batismo, cargo, foto_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if ($stmt === FALSE) {
    $_SESSION['mensagem_cadastro'] = ['tipo' => 'error', 'texto' => "Erro ao preparar a instrução SQL: " . $conn->error];
    header("Location: cadastro.php");
    exit();
}

$stmt->bind_param("ssssssssss", $nome, $nascimento, $email, $tel, $ender, $tipo_membro, $setor, $batismo, $cargo, $foto_destino);

if ($stmt->execute()) {
    // Define uma mensagem de sucesso na sessão
    $_SESSION['mensagem_cadastro'] = ['tipo' => 'success', 'texto' => "Cadastro realizado com sucesso!"];
} else {
    // Define uma mensagem de erro na sessão
    $_SESSION['mensagem_cadastro'] = ['tipo' => 'error', 'texto' => "Erro ao cadastrar: " . $stmt->error];
}

$stmt->close();
$conn->close();

// Redireciona de volta para a página cadastro.php
header("Location: cadastro.php");
exit();
?>