<?php 
    require("conexao.php");
    $erros = "";

    if(isset($_POST['Submit'])){
        $Nome = $_POST['Nome'];
        $Email = $_POST['Email'];
        $Senha = $_POST['Senha'];

        if(empty($Nome) || empty($Email) || empty($Senha))
        { //Verificador de CAMPO VAZIO
            $messageCampoVazio = "<p 
            style='background-color: white; text-align: center; font-size: 15px; margin-top: 10px; color: red;'>
            Preencher todos os campos!<p>";
        }
        else
        {
            $EmailCheck = "SELECT * FROM Usuario WHERE Email_Usuario = '$Email'";
            $resultado = $pdo->query($EmailCheck);

            if ($resultado->rowCount() > 0) { //VERIFICAR DE EMAIL JÁ EXISTENTE
                $erros = "<p style='background-color: white; text-align: center; font-size: 15px; margin-top: 10px; color: red;'>E-mail cadastrado anteriormente!<p>";
            }else{
                $query = "INSERT INTO usuario (Nome_Usuario, Email_Usuario, Senha_Usuario) value ('$nome', '$Email', '$Senha')";
        
                $stmt = $pdo->prepare($query); 
                $stmt->execute(); 
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

        <form action="Registro.php" method="POST" class="Form-User">
            <div class="form-group">
                <label for="">Nome: </label>
                <input type="text" name="Nome">
            </div>
            <div class="form-group">
                <label for="">Email: </label>
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
            <?php echo $erros ?>
        </form>

    </div>

    <script src="js/Registro.js"></script>
</body>

</html>