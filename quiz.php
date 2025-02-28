<?php
session_start();
include 'conexao.php';

if (!isset($_SESSION['perguntas_respondidas'])) {
    $_SESSION['perguntas_respondidas'] = [];
}

$sqlQuestao = "SELECT * FROM perguntas";
if (!empty($_SESSION['perguntas_respondidas'])) {
    $sqlQuestao .= " WHERE id_pergunta NOT IN (" . implode(',', $_SESSION['perguntas_respondidas']) . ")";
}

$sqlQuestao .= " ORDER BY RAND() LIMIT 1";
$resultQuestao = mysqli_query($pdo, $sqlQuestao);

if (mysqli_num_rows($resultQuestao) == 0) {
    echo 'Acabaram as perguntas';
    exit;
}

$questao = mysqli_fetch_assoc($resultQuestao);

$_SESSION['perguntas_respondidas'][] = $questao['id_pergunta'];
$_SESSION['pergunta_atual'] = $questao['id_pergunta'];

$SQLRESPOSTA = "SELECT * FROM respostas WHERE id_pergunta = " . $questao['id_pergunta'];
$resultRespostas = mysqli_query($pdo, $SQLRESPOSTA);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/quiz.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz | Projeto GenioQuiz</title>
</head>

<body>

    <section class="pergunta">
        <p><?php echo $questao['enunciado']; ?></p><!--Pergunta-->
    </section>

    <section class="respostas">
        <form class="OrgResposta" action="processadorResposta.php" method="POST">
            <?php while ($resposta = mysqli_fetch_assoc($resultRespostas)): ?>
                <button type="submit" name="resposta" value="<?php echo $resposta['id_resposta']; ?>">
                    <?php echo $resposta['resposta_texto']; ?>
                </button><br>
            <?php endwhile; ?>
        </form>
    </section>

</body>

</html>