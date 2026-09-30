<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


define('DB_HOST', 'localhost');
define('DB_NAME', 'usuarios'); 
define('DB_USER', 'root');     
define('DB_PASS', '');         

try {
    
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

    
    echo "Conexão com o banco de dados **" . DB_NAME . "** estabelecida com sucesso!<br>";

} catch (PDOException $e) {
    
    die("Erro de Conexão com o Banco de Dados: " . $e->getMessage() . "<br>" .
        "Verifique suas credenciais (`DB_USER`, `DB_PASS`), o nome do banco de dados (`DB_NAME`) e se o MySQL está rodando.");
}
?>