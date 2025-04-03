<?php
session_start();

if (!isset($_SESSION['Nome']) || !isset($_SESSION['Email']) || !isset($_SESSION['Id_Usuario'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/TelaInicial.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Inicial - Gênio Quiz</title>
</head>

<body>
    <div id="User-comprimento">
        <h2>Olá, <?php echo htmlspecialchars($_SESSION['Nome']); ?></h2>
        <p>Vamos Começar?</p>
    </div>

    <div id="container-menu">
        <form action="processador.php" method="POST">
            <button type="submit" name="Iniciar">Iniciar</button>
            <button type="submit" name="Ranking">Ranking</button>
            <button type="submit" name="Recomecar">Recomeçar</button>
            <button type="submit" name="Sair">Sair</button>
        </form>
    </div>
</body>

</html>
