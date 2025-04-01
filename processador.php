<?php
session_start();
include('conexao.php');
$id_usuario = $_SESSION['Id_Usuario'];
$pontuacao = $_SESSION['pontuacao'];

if (isset($_POST['Inciar'])) {
    header('Location: quiz.php');
    exit();
} else if (isset($_POST['Recomecar'])) {
    if (isset($_SESSION['Id_Usuario'])) {
        $VerificaRanking = "SELECT * FROM ranking WHERE usuario_id = $id_usuario";
        $ResultadoVerifica = mysqli_query($pdo, $VerificaRanking);

        if (mysqli_num_rows($ResultadoVerifica) > 0) {
            $AtualizaPontuacao = "UPDATE ranking SET pontuacao = 0 WHERE usuario_id = $id_usuario";
            mysqli_query($pdo, $AtualizaPontuacao);
        } else {
            $InsereRanking = "INSERT INTO ranking (usuario_id, pontuacao, posicao) VALUES ($id_usuario, 0, 0)";
            mysqli_query($pdo, $InsereRanking);
        }
    }

    $_SESSION['perguntas_respondidas'] = [];
    $_SESSION['pontuacao'] -= $_SESSION['pontuacao'];
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
