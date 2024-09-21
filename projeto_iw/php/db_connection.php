<?php
$host = 'localhost';
$user = 'root'; // Seu usuário do banco de dados
$password = ''; // Sua senha do banco de dados
$database = 'IPI_2'; // Nome do banco de dados

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}
