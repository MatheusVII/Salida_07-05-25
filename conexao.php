<?php
// conexao.php

$host = 'localhost';
$user = 'root';
$password = ''; // Insira a senha do seu banco de dados, se houver
$dbname = 'sas';

// Criando a conexão
$conexao = new mysqli($host, $user, $password, $dbname);

// Verificando a conexão
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}


?>