<?php

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once 'db_config.php';

echo "--- Iniciando processa_cadastro.php ---<br>";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Método POST detectado. Dados recebidos:<br>";
    print_r($_POST);
    echo "<hr>";


    $nome = htmlspecialchars(trim($_POST['nome'] ?? ''));
    $email = htmlspecialchars(trim($_POST['email'] ?? ''));
    $senha = $_POST['senha'] ?? '';
    $confirmar_senha = $_POST['confirmar_senha'] ?? '';

    $erros = [];

    echo "Iniciando validação...<br>";

    if (empty($nome)) {
        $erros[] = "O campo Nome é obrigatório.";
    }

    if (empty($email)) {
        $erros[] = "O campo E-mail é obrigatório.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = "O E-mail inserido não é válido.";
    } else {

        try {
            echo "Verificando se o e-mail '$email' já existe...<br>";
            $stmt_check_email = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE email = ?");
            $stmt_check_email->execute([$email]);
            if ($stmt_check_email->fetchColumn() > 0) {
                $erros[] = "Este e-mail já está cadastrado.";
            } else {
                echo "E-mail '$email' disponível.<br>";
            }
        } catch (PDOException $e) {
            $erros[] = "Erro ao verificar e-mail no DB: " . $e->getMessage();
            echo "ERRO: " . $e->getMessage() . "<br>";
        }
    }

    if (empty($senha)) {
        $erros[] = "O campo Senha é obrigatório.";
    } elseif (strlen($senha) < 6) {
        $erros[] = "A senha deve ter no mínimo 6 caracteres.";
    }

    if ($senha !== $confirmar_senha) {
        $erros[] = "As senhas não coincidem.";
    }

    echo "Validação concluída.<br>";


    if (empty($erros)) {
        echo "Nenhum erro de validação encontrado. Tentando inserir no DB...<br>";
        try {

            $senha_hashed = password_hash($senha, PASSWORD_DEFAULT);
            echo "Senha Hashed: " . $senha_hashed . "<br>";


            $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
            echo "SQL para inserção: " . $sql . "<br>";
            $stmt = $pdo->prepare($sql);


            if ($stmt === false) {
                echo "ERRO FATAL: Falha na preparação da query. Detalhes: " . print_r($pdo->errorInfo(), true) . "<br>";
                die("Processamento interrompido devido a falha na preparação da query.");
            }


            $params = [$nome, $email, $senha_hashed];
            echo "Parâmetros para execução: " . implode(", ", $params) . "<br>";


            $stmt->execute($params);

            echo "Usuário '$nome' inserido com sucesso no banco de dados!<br>";
            $_SESSION['mensagem_cadastro'] = ['tipo' => 'success', 'texto' => "Usuário '$nome' cadastrado com sucesso!"];
        } catch (PDOException $e) {
            echo "ERRO PDO durante a inserção: " . $e->getMessage() . "<br>";
            if ($e->getCode() == 23000) {
                $_SESSION['mensagem_cadastro'] = ['tipo' => 'error', 'texto' => "Este e-mail já está cadastrado. Por favor, use outro."];
            } else {
                $_SESSION['mensagem_cadastro'] = ['tipo' => 'error', 'texto' => "Erro ao cadastrar usuário: " . $e->getMessage()];
            }
        }
    } else {
        echo "Erros de validação encontrados:<br>";
        foreach ($erros as $erro) {
            echo "- $erro<br>";
        }
        $_SESSION['mensagem_cadastro'] = ['tipo' => 'error', 'texto' => implode("<br>", $erros)];

        $_SESSION['dados_formulario_anteriores'] = $_POST;
    }

    echo "--- Fim do processa_cadastro.php ---<br>";
} else {
    echo "Requisição não é POST. Acessado diretamente?<br>";
}
