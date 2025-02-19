<?php
require("conexao.php");
$erros = "";

if (isset($_POST['Submit'])) {
    $Nome = trim($_POST['Nome']);
    $Email = trim($_POST['Email']);
    $Senha = trim($_POST['Senha']);

    if (empty($Nome) || empty($Email) || empty($Senha)) {
        $erros = "Preencha todos os campos";
    } else {
        $EmailCheck = "SELECT * FROM Usuario WHERE Email_Usuario = '$Email'";
        $EmailCheckResult = mysqli_query($pdo, $EmailCheck);
        $resultadoSelect = mysqli_fetch_assoc($EmailCheckResult);

        if ($resultadoSelect) {
            $erros = "Email já cadastrado";
        } else {
            $SQLInsert = "INSERT INTO Usuario (Nome_Usuario, Email_Usuario, Senha_Usuario) 
                          VALUES ('$Nome', '$Email', '$Senha')";
            $resultadoInsert = mysqli_query($pdo, $SQLInsert);

            if ($resultadoInsert) {
                header('Location: login.php');
                exit();
            } else {
                $erros = "Erro ao cadastrar usuário.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Registro - Super Quiz</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/Registro.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="containerPrincipal">
        <div class="imagem-logo">
            <img src="img/Logo.png" alt="">
        </div>
        <div class="Titulo">
            <h1>REGISTRE-SE</h1>
        </div>

        <form action="registro.php" method="POST" class="Form-User">
            <div class="form-group">
                <label for="Nome">Nome: </label>
                <input type="text" name="Nome" required>
            </div>
            <div class="form-group">
                <label for="Email">Email: </label>
                <input type="text" name="Email" required>
            </div>

            <div class="form-group">
                <label for="Senha">Senha: </label>
                <div class="InputSenha">
                    <input type="password" id="Password" name="Senha" required>
                    <span class="VerSenha" onclick="VerSenha()">🙈</span>
                </div>

            </div>

            <div class="botao">
                <button type="Submit" name="Submit">Enviar</button>
            </div>
            <div class="paragrafo">
                <p style="margin-top: 10px; font-size: 18px; text-align: center;">Já tem login?<a href="login.php">Login</a></p>
            </div>
            <?php echo "<p style='text-align: center; color: red; font-size: 18px;'>$erros</p>" ?>
        </form>

    </div>

    <script src="js/main.js"></script>
</body>

</html>