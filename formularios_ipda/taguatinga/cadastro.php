<?php
session_start(); 

// Redireciona se o usuário não estiver logado
if (!isset($_SESSION['usuario_id'])) {
    $_SESSION['mensagem_login'] = ['tipo' => 'error', 'texto' => "Você precisa estar logado para acessar esta página."];
    header("Location: login.php"); 
    exit(); 
}

$nome_usuario = $_SESSION['usuario_nome'] ?? 'Usuário';


if (isset($_SESSION['mensagem_cadastro'])) {
    $mensagem = $_SESSION['mensagem_cadastro'];
    $tipo = $mensagem['tipo']; 
    $texto = $mensagem['texto'];

    echo "<script>";
    
    echo "alert('" . addslashes($texto) . "');"; 
    echo "</script>";

    
    unset($_SESSION['mensagem_cadastro']);
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Cadastro de Membros</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="form">
        <img src="./img/logo.png" width="110" height="110">
        <h1>Cadastro de Membro</h1>
        <div class="form">
            <form action="salvar_cadastro.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" id="nome" required>
                </div>

                <div class="form-group">
                    <label for="nascimento">Data de Nascimento:</label>
                    <input type="text" name="nascimento" id="nascimento" placeholder="DD/MM/AAAA" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" required>
                </div>

                <div class="form-group">
                    <label for="tel">Telefone:</label>
                    <input type="text" name="tel" id="tel" placeholder="(DDD) XXXXX-XXXX">
                </div>

                <div class="form-group">
                    <label for="ender">Endereço:</label>
                    <input type="text" name="ender" id="ender">
                </div>

                <div class="form-group">
                    <label for="tipo_membro">Tipo de Membro:</label>
                    <select id="tipo_membro" name="tipo_membro" required>
                        <option value="Membro">Membro</option>
                        <option value="Cooperador(a)">Cooperador(a)</option>
                        <option value="Diácono">Diácono</option>
                        <option value="Presbitéro">Presbitéro</option>
                        <option value="Pastor">Pastor</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="setor">Departamento:</label>
                    <select id="setor" name="setor" required>
                        <option value="-----">-----</option>
                        <option value="Reviver">REVIVER</option>
                        <option value="Expansão">Expansão</option>
                        <option value="Senhoras">Senhoras</option>
                    </select>

                <div class="form-group">
                    <label for="batismo">Data de Batismo:</label>
                    <input type="text" name="batismo" id="batismo" placeholder="DD/MM/AAAA">
                </div>

                <div class="form-group">
                    <label for="cargo">Cargo/Função:</label>
                    <input type="text" name="cargo" id="cargo">
                </div>

                <div class="form-group">
                    <label for="foto">Foto:</label>
                    <input type="file" name="foto" id="foto" accept="image/*" required>
                </div>

                <hr> 
                <input type="submit" value="Cadastrar">
                <button type="button" onclick="window.location.href='./home.php'">Home</button>
            </form>
        </div>
    </div>
</body>

</html>