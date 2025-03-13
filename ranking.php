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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Ranking.css">
    <title>Ranking</title>
</head>

<body>
    <div class="ranking">
        <a href="TelaInicial.php">Voltar</a>
    </div>

    <div class="containerTable">
        <h2 style="margin-top: 10px;">Ranking de Jogadores</h2>
        <?php
        $QueryRanking = "SELECT u.nome, r.pontuacao 
                            FROM ranking r
                            JOIN usuario u ON r.usuario_id = u.id_usuario
                            ORDER BY r.pontuacao DESC LIMIT 10";

        $ResultadoRanking = mysqli_query($pdo, $QueryRanking);

        if ($ResultadoRanking && mysqli_num_rows($ResultadoRanking) > 0) {
            echo "<ol>";
            while ($Jogador = mysqli_fetch_assoc($ResultadoRanking)) {
                echo "<li>{$Jogador['nome']} - {$Jogador['pontuacao']} pontos</li>";
            }
            echo "</ol>";
        } else {
            echo "<p>Nenhum jogador no ranking ainda.</p>";
        }
        ?>
    </div>
</body>

</html>