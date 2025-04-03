<?php
session_start();
include('conexao.php');

if (!isset($_SESSION['Id_Usuario'])) {
    header('Location: login.php');
    exit();
}

$id_usuario = $_SESSION['Id_Usuario'];

if (isset($_POST['Iniciar'])) {
    header('Location: quiz.php');
    exit();
} elseif (isset($_POST['Recomecar'])) {
    $VerificaRanking = "SELECT * FROM ranking WHERE usuario_id = $id_usuario";
    $ResultadoVerifica = mysqli_query($conn, $VerificaRanking);

    if (mysqli_num_rows($ResultadoVerifica) > 0) {
        $AtualizaPontuacao = "UPDATE ranking SET pontuacao = 0 WHERE usuario_id = $id_usuario";
        mysqli_query($conn, $AtualizaPontuacao);
    } else {
        $InsereRanking = "INSERT INTO ranking (usuario_id, pontuacao, posicao) VALUES ($id_usuario, 0, 0)";
        mysqli_query($conn, $InsereRanking);
    }

    $_SESSION['perguntas_respondidas'] = [];
    $_SESSION['pontuacao'] = 0;

    header('Location: quiz.php');
    exit();
} elseif (isset($_POST['Ranking'])) {
    header('Location: ranking.php');
    exit();
} elseif (isset($_POST['Sair'])) {
    session_destroy();
    header('Location: login.php');
    exit();
} else {
    echo "<script>alert('Erro ao processar a ação.'); window.location.href = 'TelaInicial.php';</script>";
}
?>
