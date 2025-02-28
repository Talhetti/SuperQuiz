<?php
$hostname = "Localhost";
$user = "root";
$password = "Bad16551eb0c";
$dbname = "bancoGenioQuiz";

$pdo = new mysqli($hostname, $user, $password, $dbname);

if ($pdo->connect_error) {
    die("Falha na conexão: " . $pdo->connect_error);
}
