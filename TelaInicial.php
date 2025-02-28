<?php
session_start();

if (!isset($_SESSION['Nome'])) {
    header('Location: login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/TelaInicial.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Inicial - Projeto Genio Quiz</title>
</head>

<body>
    <div id="User-comprimento">

        <h2>Olá, <?php echo htmlspecialchars($_SESSION['Nome']) ?></h2>
        <p>Vamos Começar?</p>

    </div>

    <div id="container-menu">

        <div id="container-menu">
            <form action="processador.php" method="POST" class="menu">
                <button type="submit" name="Inciar">Iniciar</button>
                <button type="submit" name="Ranking">Ranking</button>
                <button type="submit" name="Sair">Sair</button>
            </form>
        </div>



    </div>
</body>

</html>