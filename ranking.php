<?php
session_start();
include('conexao.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['Id_Usuario'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Ranking.css">
    <title>Ranking - Gênio Quiz</title>
</head>

<body>

    <div class="containerTable">
        <a href="TelaInicial.php">Voltar</a>
        <h2 style="margin-top: 10px;">🏆 Ranking de Jogadores 🏆</h2>

        <?php
        $QueryRanking = "SELECT u.nome, r.pontuacao 
        FROM ranking r
        JOIN usuario u ON r.usuario_id = u.usuario_id
        ORDER BY r.pontuacao DESC 
        LIMIT 10";


        $ResultadoRanking = mysqli_query($conn, $QueryRanking);

        if ($ResultadoRanking && mysqli_num_rows($ResultadoRanking) > 0) {
            echo "<table border='1'>";
            echo "<tr><th>Posição</th><th>Nome</th><th>Pontuação</th></tr>";

            $posicao = 1;
            while ($Jogador = mysqli_fetch_assoc($ResultadoRanking)) {
                echo "<tr>";
                echo "<td>{$posicao}°</td>";
                echo "<td>" . htmlspecialchars($Jogador['nome']) . "</td>";
                echo "<td>{$Jogador['pontuacao']} pontos</td>";
                echo "</tr>";
                $posicao++;
            }
            echo "</table>";
        } else {
            echo "<p>Nenhum jogador no ranking ainda.</p>";
        }
        ?>
    </div>

</body>

</html>