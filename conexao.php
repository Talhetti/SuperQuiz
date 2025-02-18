<?php
$hostname = "Localhost";
$user = "root";
$password = "";
$dbname = "db-genioquiz";

$pdo = new mysqli($hostname, $user, $password, $dbname);

if($pdo->connect_error){
    die("Falha na conexão: " . $pdo->connect_error);
}
// echo "Conexão bem-sucedida!";