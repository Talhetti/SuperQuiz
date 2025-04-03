<?php
session_start();
require("conexao.php");
$erros = "";

if (isset($_POST['Submit'])) {
    $Email = trim($_POST['Email']);
    $Senha = trim($_POST['Senha']);

    if (empty($Email) || empty($Senha)) {
        $erros = "Preencha todos os campos";
    } else {
        $sqlSelect = "SELECT * FROM usuario WHERE email = ?";
        $stmt = $conn->prepare($sqlSelect);
        if (!$stmt) {
            die("Erro na query: " . $conn->error);
        }

        $stmt->bind_param("s", $Email);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $usuario = $resultado->fetch_assoc();

            if (password_verify($Senha, $usuario['senha'])) {
                $_SESSION['Nome'] = $usuario['nome'];
                $_SESSION['Email'] = $usuario['email'];
                $_SESSION['Id_Usuario'] = $usuario['usuario_id'];
                $_SESSION['Pontuacao'] = 0;
                header('Location: TelaInicial.php');
                exit();
            } else {
                $erros = "Email ou senha incorretos";
            }
        } else {
            $erros = "Email ou senha incorretos";
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