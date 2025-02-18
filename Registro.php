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

        <form action="" method="POST" class="Form-User">
            <div class="form-group">
                <label for="">Nome: </label>
                <input type="text">
            </div>
            <div class="form-group">
                <label for="">Email: </label>
                <input type="text">
            </div>

            <div class="form-group">
                <label for="Senha">Senha: </label>
                <div class="InputSenha">
                    <input type="password" id="Password">
                    <span class="VerSenha" onclick="VerSenha()">🙈</span>
                </div>

            </div>
            <div class="botao">
                <button type="Submit">Enviar</button>
            </div>
        </form>


    </div>

    <script src="js/Registro.js"></script>
</body>

</html>