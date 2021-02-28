<?php 

try {
    // Definindo conexão ao banco de dados MySQL
    $db_host = 'localhost';
    $db_name = 'paginacao_php';
    $db_user = 'root';
    $db_pass = '';

    // Criação da classe do PDO para consultas
    $pdo = new PDO("mysql:dbname=".$db_name.";host=".$db_host, $db_user, $db_pass);
} catch ( PDOException $e ) {
    // Exibir mensagem relacionada a erro ao conectar ao banco
    die($e->getMessage());
}