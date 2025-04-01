<?php
session_start();
include('conexao.php');

if (!isset($_SESSION['Id_Usuario'])) {
    header('Location: login.php');
    exit();
}

if (!isset($_SESSION['pontuacao'])) {
    $_SESSION['pontuacao'] = 0;
}

if (!isset($_SESSION['perguntas_respondidas'])) {
    $_SESSION['perguntas_respondidas'] = [];
}

$QueryTotalPerguntas = "SELECT COUNT(*) AS total FROM perguntas";
$ResultadoTotal = mysqli_query($pdo, $QueryTotalPerguntas);
$TotalPerguntas = mysqli_fetch_assoc($ResultadoTotal)['total'];

if (count($_SESSION['perguntas_respondidas']) >= $TotalPerguntas) {
    echo "<p style='text-align: center; font-size: 30px; position: relative; top: 30%;' >Parabéns! Você respondeu todas as perguntas. <br> Voltando para tela inicial automaticamente...</p>";
    header('Refresh: 1; URL=TelaInicial.php'); // Redireciona após 2 segundos
    exit();
}

do {
    $QueryPergunta = "SELECT * FROM perguntas ORDER BY RAND() LIMIT 1";
    $ResultadoPergunta = mysqli_query($pdo, $QueryPergunta);
    $Pergunta = mysqli_fetch_assoc($ResultadoPergunta);
} while (in_array($Pergunta['id_pergunta'], $_SESSION['perguntas_respondidas']));

array_push($_SESSION['perguntas_respondidas'], $Pergunta['id_pergunta']);

$QueryRespostas = "SELECT * FROM respostas WHERE id_pergunta = " . $Pergunta['id_pergunta'];
$ResultadoRespostas = mysqli_query($pdo, $QueryRespostas);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_pergunta = $_POST['id_pergunta'];
    $id_resposta = $_POST['resposta'];

    $QueryCorreta = "SELECT id_resposta FROM respostas WHERE id_pergunta = $id_pergunta AND is_correta = 1";
    $ResultadoCorreta = mysqli_query($pdo, $QueryCorreta);
    $RespostaCorreta = mysqli_fetch_assoc($ResultadoCorreta)['id_resposta'];

    if ($id_resposta == $RespostaCorreta) {
        echo "<script>alert('Resposta correta! Parabéns!');</script>";
        $_SESSION['pontuacao'] += 1;
        $id_usuario = $_SESSION['Id_Usuario'];
        $VerificaRanking = "SELECT * FROM ranking WHERE usuario_id = $id_usuario";
        $ResultadoVerifica = mysqli_query($pdo, $VerificaRanking);

        if (mysqli_num_rows($ResultadoVerifica) > 0) {
            $AtualizaPontuacao = "UPDATE ranking SET pontuacao = pontuacao + 1 WHERE usuario_id = $id_usuario";
            mysqli_query($pdo, $AtualizaPontuacao);
        } else {
            $InsereRanking = "INSERT INTO ranking (usuario_id, pontuacao, posicao) VALUES ($id_usuario, 1, 0)";
            mysqli_query($pdo, $InsereRanking);
        }
    } else {
        echo "<script>alert('Resposta incorreta. Tente novamente!');</script>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/Quiz.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz | Projeto GenioQuiz</title>
    <script>
        function desabilitarBotoes() {
            const botoes = document.querySelectorAll('button');
            botoes.forEach(botao => botao.disabled = true);
        }
    </script>
</head>

<body>

    <section class="pergunta">
        <p><?php echo $Pergunta['enunciado']; ?></p>
    </section>

    <section class="respostas">
        <form action="quiz.php" method="POST">
            <input type="hidden" name="id_pergunta" value="<?php echo $Pergunta['id_pergunta']; ?>">

            <?php
            if ($ResultadoRespostas && mysqli_num_rows($ResultadoRespostas) > 0) {
                while ($alternativa = mysqli_fetch_assoc($ResultadoRespostas)) { ?>
                    <button type="submit" name="resposta" value="<?php echo $alternativa['id_resposta']; ?>">
                        <?php echo $alternativa['resposta_texto']; ?>
                    </button>
            <?php }
            } else {
                echo "<p>Erro ao carregar as respostas.</p>";
            }
            ?>
        </form>
    </section>

</body>

</html>