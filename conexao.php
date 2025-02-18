<?php
$hostname = "127.0.0.1";
$user = "root";
$password = "";
$dbname = "db-genioquiz";

try{
    $pdo = new PDO("mysql:host=$hostname; dbname=$dbname", $user, $password);
}catch(PDOException $e){
    echo $e->getMessage();
}
