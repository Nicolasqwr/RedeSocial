<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="<?php echo INCLUDE_PATH_STATIC ?>estilos/style.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login SocialWave</title>
</head>
<body>

    <div class="sidebar"></div>

    <div class="form-container-login">

        <div class="logo-login">
            <img class="logoo" src="<?php echo INCLUDE_PATH_STATIC ?>images/lgo.png">
            <p>Navegue pelas ondas da amizade e conecte-se com o mundo no SocialWave!</p>
        </div><!--div da logo-->

        <div class="form-login">
            <form method='post'>
                <input type="text" name="email" placeholder="E-mail">

                <input type="password" name="senha" placeholder="Senha">

                <input type="submit" name="acao" value="Entrar">

                <input type="hidden" name ="login">

            </form>

            <p><a href="<?php echo INCLUDE_PATH ?>registrar">Criar conta</a></p>
        </div><!--Formulario para login-->

    </div>

</body>
</html>