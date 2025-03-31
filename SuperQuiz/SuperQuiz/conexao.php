<?php
$hostname = "localhost";
$user = "root";
$password = "Tajetti08";
$dbname = "bancoGenioQuiz";

$pdo = new mysqli($hostname, $user, $password, $dbname);

if ($pdo->connect_error) {
    die("Falha na conexão: " . $pdo->connect_error);
}
