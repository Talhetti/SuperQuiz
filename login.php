<?php
$erros = "";



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Projeto Genio Quiz</title>
</head>
<body>
<div class="containerPrincipal">
        <div class="imagem-logo">
            <img src="img/Logo.png" alt="">
        </div>
        <div class="Titulo">
            <h1>LOGAR</h1>
        </div>

        <form action="Registro.php" method="POST" class="Form-User">
            <div class="form-group">
                <label for="Nome">Nome: </label>
                <input type="text" name="Nome">
            </div>
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
                <p stlye="font-size: 10px;">Já tem login?<a href="login.php" >Login</a></p>
            </div>
            <?php echo "<p style='text-align: center; color: red;'>$erros</p>"?>
        </form>

    </div>
</body>
</html>