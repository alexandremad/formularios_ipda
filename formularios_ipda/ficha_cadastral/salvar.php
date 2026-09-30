<?php
// Configurações do Banco de Dados
$host = "localhost";
$user = "root";
$pass = "";
$db   = "sistema_obreiros";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Processamento da Foto
    $nome_foto = "";
    if (isset($_FILES['foto_obreiro']) && $_FILES['foto_obreiro']['error'] === 0) {
        $extensao = pathinfo($_FILES['foto_obreiro']['name'], PATHINFO_EXTENSION);
        $nome_foto = uniqid() . "." . $extensao;
        $caminho_destino = "uploads/" . $nome_foto;
        
        // Cria a pasta uploads se não existir
        if (!is_dir('uploads')) { mkdir('uploads', 0777, true); }
        move_uploaded_file($_FILES['foto_obreiro']['tmp_name'], $caminho_destino);
    }

    // 2. Coleta de Dados do Formulário (Exemplos das principais seções)
    // Dados Pessoais
    $nome = $_POST['nome'] ?? '';
    $cpf = $_POST['cpf'] ?? '';
    $endereco = $_POST['endereco'] ?? '';
    $cidade = $_POST['cidade'] ?? '';
    
    // Dados Familiares
    $conjuge_nome = $_POST['conjuge_nome'] ?? '';
    $conjuge_crente = $_POST['conjuge_crente'] ?? '';
    
    // Dados Ministeriais
    $funcao_atual = $_POST['funcao_atual'] ?? '';
    $dirige_ipda = $_POST['dirige_ipda'] ?? '';
    
    // Histórico de Gestão (Exemplo da primeira linha)
    $gestao_ano_1 = $_POST['gestao_ano_1'] ?? '';
    $gestao_ipda_1 = $_POST['gestao_ipda_1'] ?? '';

    // 3. Preparação do SQL
    // IMPORTANTE: As colunas abaixo devem existir na sua tabela 'cadastro'
    $sql = "INSERT INTO cadastro (
                nome, cpf, endereco, cidade, foto, 
                conjuge_nome, conjuge_crente, 
                funcao_atual, dirige_ipda,
                gestao_ano_1, gestao_ipda_1
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    
    // Vinculação dos parâmetros (s = string)
    $stmt->bind_param("sssssssssss", 
        $nome, $cpf, $endereco, $cidade, $nome_foto, 
        $conjuge_nome, $conjuge_crente, 
        $funcao_atual, $dirige_ipda,
        $gestao_ano_1, $gestao_ipda_1
    );

    if ($stmt->execute()) {
        // O JavaScript abaixo garante que o alerta apareça antes de abrir a impressão
        echo "<script>
                alert('Dados salvos com sucesso!');
                window.location.href='index.php';
              </script>";
    } else {
        echo "Erro ao salvar: " . $stmt->error;
    }
}
?>