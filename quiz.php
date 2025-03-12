<?php
session_start();
include('conexao.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['Id_Usuario'])) {
    header('Location: login.php');
    exit();
}

//**** PEGANDO PERGUNTA DO BANCO DE DADOS ****//

// Array de perguntas respondidas
if (!isset($_SESSION['perguntas_respondidas'])) {
    $_SESSION['perguntas_respondidas'] = [];
}

// Conta quantas perguntas existem no banco
$QueryTotalPerguntas = "SELECT COUNT(*) AS total FROM perguntas";
$ResultadoTotal = mysqli_query($pdo, $QueryTotalPerguntas);
$TotalPerguntas = mysqli_fetch_assoc($ResultadoTotal)['total'];

// Verifica se todas as perguntas já foram respondidas
if (count($_SESSION['perguntas_respondidas']) >= $TotalPerguntas) {
    echo "<p>Parabéns! Você respondeu todas as perguntas.</p>";
    header('Refresh: 2; URL=TelaInicial.php'); // Redireciona após 2 segundos
    exit();
}

// Loop até encontrar uma pergunta não respondida
do {
    $QueryPergunta = "SELECT * FROM perguntas ORDER BY RAND() LIMIT 1";
    $ResultadoPergunta = mysqli_query($pdo, $QueryPergunta);
    $Pergunta = mysqli_fetch_assoc($ResultadoPergunta);
} while (in_array($Pergunta['id_pergunta'], $_SESSION['perguntas_respondidas']));

// Adiciona a pergunta ao array de respondidas
array_push($_SESSION['perguntas_respondidas'], $Pergunta['id_pergunta']);

// Pega as respostas dessa pergunta
$QueryRespostas = "SELECT * FROM respostas WHERE id_pergunta = " . $Pergunta['id_pergunta'];
$ResultadoRespostas = mysqli_query($pdo, $QueryRespostas);

//****** VERIFICANDO RESPOSTA DA PERGUNTA E RETORNANDO CORRETO AO USUÁRIO 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_pergunta = $_POST['id_pergunta'];
    $id_resposta = $_POST['resposta'];

    // Pega a resposta correta
    $QueryCorreta = "SELECT id_resposta FROM respostas WHERE id_pergunta = $id_pergunta AND is_correta = 1";
    $ResultadoCorreta = mysqli_query($pdo, $QueryCorreta);
    $RespostaCorreta = mysqli_fetch_assoc($ResultadoCorreta)['id_resposta'];

    if ($id_resposta == $RespostaCorreta) {
        echo "<script>alert('Resposta correta! Parabéns!');</script>";
    } else {
        echo "<script>alert('Resposta incorreta. Tente novamente!');</script>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/quiz.css">
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