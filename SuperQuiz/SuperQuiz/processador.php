<?php
session_start();
include('conexao.php');
$id_usuario = $_SESSION['Id_Usuario'];
$pontuacao = $_SESSION['pontuacao'];

if (isset($_POST['Inciar'])) {
    header('Location: quiz.php');
    exit();
} else if (isset($_POST['Recomecar'])) {
    $_SESSION['perguntas_respondidas'] = [];
    $_SESSION['pontuacao'] = 0;
    header('Location: quiz.php');
    exit();
} else if (isset($_POST['Ranking'])) {
    header('Location: ranking.php');
    exit();
} else if (isset($_POST['Sair'])) {
    session_destroy();
    header('Location: login.php');
    exit();
}
