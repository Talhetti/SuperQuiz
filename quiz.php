<?php
session_start();
include('conexao.php');

if (!isset($_SESSION['Id_Usuario'])) {
    header('Location: login.php');
    exit();
}

$QueryPergunta = "SELECT * FROM perguntas ORDER BY RAND() LIMIT 1";
$ResultadoPergunta = mysqli_query($pdo, $QueryPergunta);
$Pergunta = mysqli_fetch_assoc($ResultadoPergunta);

$QueryRespostas = "SELECT * FROM respostas WHERE id_pergunta = " . $Pergunta['id_pergunta'];
$ResultadoRespostas = mysqli_query($pdo, $QueryRespostas);


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
        <p><?php echo $Pergunta['enunciado']; ?></p>
    </section>

    <section class="respostas">
        <form action="quiz.php" method="POST">
            <input type="hidden" name="id_pergunta" value="<?php echo $Pergunta['id_pergunta']; ?>">

            <?php
            if ($ResultadoRespostas) {
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