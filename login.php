<?php
session_start();
include('conexao.php');
$erros = "";

if (isset($_POST['Submit'])) {
    $Email = $_POST['Email'];
    $Senha = $_POST['Senha'];

    if (empty($Email) || empty($Senha)) {
        $erros = "Preencha todos os campos";
    } else {
        $sqlSelect = "SELECT * FROM usuario WHERE email = '$Email' AND senha = '$Senha'";
        $ResultadoSelect = mysqli_query($pdo, $sqlSelect);

        if ($ResultadoSelect) {
            $resultado = mysqli_fetch_assoc($ResultadoSelect);

            if ($resultado) {
                $_SESSION['Nome'] = $resultado['nome'];
                header('Location: TelaInicial.php');
                exit();
            } else {
                $erros = "Email ou senha incorretos";
            }
        } else {
            $erros = "Erro ao logar";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Login - Genio Quiz</title>
    <meta charset="UTF-8">
    <script src="js/main.js"></script>
    <link rel="stylesheet" href="css/Login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="containerPrincipal">
        <div class="imagem-logo">
            <img src="img/Logo.png" alt="">
        </div>
        <div class="Titulo">
            <h1>LOGAR</h1>
        </div>

        <form action="login.php" method="POST" class="Form-User">

            <div class="form-group">
                <label for="Email">Email: </label>
                <input type="text" name="Email">
            </div>

            <div class="form-group">
                <label for="Senha">Senha: </label>
                <div class="InputSenha">
                    <input type="password" id="Password" name="Senha">
                    <span class="VerSenha" onclick="VerSenha()">🙈</span>
                </div>

            </div>

            <div class="botao">
                <button type="Submit" name="Submit">Enviar</button>
            </div>
            <p style="
            margin-top: 15px; text-align: center;">Não possui um login?<a href=" Registro.php">Registre-se</a></p>
            <?php echo "<p style='text-align: center; color: red;'>$erros</p>" ?>
        </form>

    </div>
</body>

</html>