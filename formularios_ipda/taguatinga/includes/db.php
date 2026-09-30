<?php
// includes/db.php

$host = 'localhost'; // Seu host de banco de dados
$user = 'root';      // Seu usuário do banco de dados
$pass = '';          // Sua senha do banco de dados (deixe em branco se não tiver)
$dbname = 'cadastro_de_membros'; // O nome do banco de dados que você criou

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados:" . $conn->connect_error);
}
// Define o charset para evitar problemas com caracteres especiais
$conn->set_charset("utf8mb4");
?>