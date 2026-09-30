<?php
session_start(); 

session_unset();   
session_destroy(); 

$_SESSION['mensagem_login'] = ['tipo' => 'success', 'texto' => "Você foi desconectado com sucesso."];

header("Location: login.php"); 
exit();
?>