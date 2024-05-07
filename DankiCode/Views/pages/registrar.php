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
            <h3 style="text-align: center; color: #7b19ca">Crie sua conta!</h3>
            <form method="post">
                <input class="nom" type="text" placeholder="Coloque seu nome" name="nome">

                <input type="text" placeholder="Coloque seu email" name="email">

                <input type="password" name="senha" placeholder="Coloque sua senha">

                <input type="submit" name="acao" value="Criar Conta">

                <input type="hidden" name="registrar" value="registrar" />

            </form>

        </div><!--Formulario para login-->

    </div>

</body>
</html>