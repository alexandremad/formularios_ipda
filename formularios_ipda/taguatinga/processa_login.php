<?php
session_start(); 

require_once 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $email = htmlspecialchars(trim($_POST['email'] ?? ''));
    $senha_digitada = $_POST['senha'] ?? ''; 

    $erros = []; 

    
    if (empty($email) || empty($senha_digitada)) {
        $erros[] = "Por favor, preencha todos os campos.";
    }

   
    if (empty($erros)) {
        try {
           
            $stmt = $pdo->prepare("SELECT id, nome, email, senha FROM usuarios WHERE email = ?");
            $stmt->execute([$email]);
            $usuario = $stmt->fetch(); 

           
            if ($usuario) {
                
                if (password_verify($senha_digitada, $usuario->senha)) {
                    
                    $_SESSION['usuario_id'] = $usuario->id;
                    $_SESSION['usuario_nome'] = $usuario->nome;
                    $_SESSION['usuario_email'] = $usuario->email;

                    $_SESSION['mensagem_login'] = ['tipo' => 'success', 'texto' => "Login realizado com sucesso! Bem-vindo(a), " . $usuario->nome . "!"];

                    
                    header("Location: home.php");
                    exit();

                } else {
                    
                    $erros[] = "E-mail ou senha incorretos.";
                }
            } else {
                
                $erros[] = "E-mail ou senha incorretos.";
            }

        } catch (PDOException $e) {
            $erros[] = "Erro ao tentar fazer login: " . $e->getMessage();
        }
    }

   
    if (!empty($erros)) {
        $_SESSION['mensagem_login'] = ['tipo' => 'error', 'texto' => implode("<br>", $erros)];
        header("Location: login.php");
        exit();
    }

} else {
    
    header("Location: login.php");
    exit();
}
?>