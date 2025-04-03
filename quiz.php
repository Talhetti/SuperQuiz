<?php
session_start();
include('conexao.php');

if (!isset($_SESSION['Id_Usuario'])) {
    header('Location: login.php');
    exit();
}

$id_usuario = $_SESSION['Id_Usuario'];

// Inicializa perguntas respondidas
if (!isset($_SESSION['perguntas_respondidas'])) {
    $_SESSION['perguntas_respondidas'] = [];
}

// Conta total de perguntas no banco
$QueryTotalPerguntas = "SELECT COUNT(*) AS total FROM perguntas";
$ResultadoTotal = mysqli_query($conn, $QueryTotalPerguntas);
$TotalPerguntas = mysqli_fetch_assoc($ResultadoTotal)['total'];

if (count($_SESSION['perguntas_respondidas']) >= $TotalPerguntas) {
    echo "<p style='text-align: center; font-size: 30px; position: relative; top: 30%;' >
            <span style='color: green;'>Parabéns!</span> Você respondeu todas as perguntas.<br>Voltando para tela inicial automaticamente...
          </p>";
    header('Refresh: 2; URL=TelaInicial.php');
    exit();
}

// Seleciona uma pergunta aleatória que ainda não foi respondida
do {
    $QueryPergunta = "SELECT * FROM perguntas ORDER BY RAND() LIMIT 1";
    $ResultadoPergunta = mysqli_query($conn, $QueryPergunta);
    $Pergunta = mysqli_fetch_assoc($ResultadoPergunta);
} while (in_array($Pergunta['pergunta_id'], $_SESSION['perguntas_respondidas']));

$_SESSION['perguntas_respondidas'][] = $Pergunta['pergunta_id'];

// Busca alternativas da pergunta selecionada
$QueryAlternativas = "SELECT * FROM alternativas WHERE pergunta_id = " . $Pergunta['pergunta_id'];
$ResultadoAlternativas = mysqli_query($conn, $QueryAlternativas);

// Verifica resposta
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pergunta_id = $_POST['pergunta_id'];
    $alternativa_id = $_POST['alternativa'];

    $QueryCorreta = "SELECT correta FROM alternativas WHERE alternativa_id = $alternativa_id";
    $ResultadoCorreta = mysqli_query($conn, $QueryCorreta);
    $Correta = mysqli_fetch_assoc($ResultadoCorreta)['correta'];

    if ($Correta) {
        $_SESSION['pontuacao'] += 1;

        $VerificaRanking = "SELECT * FROM ranking WHERE usuario_id = $id_usuario";
        $ResultadoVerifica = mysqli_query($conn, $VerificaRanking);

        if (mysqli_num_rows($ResultadoVerifica) > 0) {
            $AtualizaPontuacao = "UPDATE ranking SET pontuacao = pontuacao + 1 WHERE usuario_id = $id_usuario";
            mysqli_query($conn, $AtualizaPontuacao);
        } else {
            $InsereRanking = "INSERT INTO ranking (usuario_id, pontuacao, posicao) VALUES ($id_usuario, 1, 0)";
            mysqli_query($conn, $InsereRanking);
        }

        echo "<script>alert('Resposta correta! Parabéns!'); window.location.href='quiz.php';</script>";
    } else {
        echo "<script>alert('Resposta incorreta. Tente novamente!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/Quiz.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz de Matemática</title>
</head>

<body>
    <section class="pergunta">
        <p><?php echo $Pergunta['pergunta_texto']; ?></p>
    </section>

    <section class="respostas">
        <form action="quiz.php" method="POST">
            <input type="hidden" name="pergunta_id" value="<?php echo $Pergunta['pergunta_id']; ?>">

            <?php
            if ($ResultadoAlternativas && mysqli_num_rows($ResultadoAlternativas) > 0) {
                while ($alternativa = mysqli_fetch_assoc($ResultadoAlternativas)) { ?>
                    <button type="submit" name="alternativa" value="<?php echo $alternativa['alternativa_id']; ?>">
                        <?php echo "{$alternativa['alternativa_letra']}) {$alternativa['alternativa_texto']}"; ?>
                    </button>
            <?php }
            } else {
                echo "<p>Erro ao carregar as alternativas.</p>";
            }
            ?>
        </form>
    </section>

</body>

</html>