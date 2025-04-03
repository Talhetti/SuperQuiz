<?php
$hostname = "localhost";
$user = "root";
$password = "";
$dbname = "bancoGenioQuiz";

$conn = new mysqli($hostname, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$conn->set_charset("utf8");
