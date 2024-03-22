<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="<?php echo INCLUDE_PATH_STATIC ?>estilos/feed.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b807da4028.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem vindo, <?php echo $_SESSION['nome']; ?></title>
</head>
<body>
    
    <section class="main-feed">
        <div class="sidebar">
            <div class="logo-sidebar">
            <img class="logoo" src="<?php echo INCLUDE_PATH_STATIC ?>images/lgo.png">
            </div>
            <br/><br/>
            <div class="menu-sidebar">
                <h4>Menu</h4>
                <br/>
                <a href="#"><i class="fa-solid fa-newspaper"></i>   feed</a>
                <a href="#"><i class="fa-solid fa-user"></i>   perfil</a>
                <a href="#"><i class="fa-solid fa-users"></i>   amigos</a>
                <a href="?loggout"><i class="fa-solid fa-right-from-bracket"></i>   Sair</a>

            </div><!--menu do sidebar-->

        </div><!--sidebar-->
        <div class="feed">
            <div class="feed-single-post">
                <div class="feed-single-post-autor">
                    <div class="img-single-post-autor">
                        <!--tdo colocar imagem placeholder-->
                    </div>
                    <h2>Nicolas Barbosa</h2>
                    <span>14:31 22/03/2024</span>
                    <div class="feed-single-post-content">
                        <p>segue a lista dos mais viado de jaguaribe: joão lucas, jader, luis paulo, fabricio neguim
                            deyvid, bruno e pedro lucas e todos nessa lista pegou a mãe de jl
                        </p>
                    </div>
                </div>
            </div>
            <div class="friend-request-feed">
                <h4>solicitções de amizade</h4>
                <div class="friend-request-single">
                    <img src="<?php echo INCLUDE_PATH_STATIC ?>images/perfil-placeholder.jpeg" alt="">
                    <div class="friend-request-single-info">
                        
                        <h3>Otavio da Silva</h3>
                        <p><a href="#">Aceitar</a> | <a href="#">Recusar</a></p>
                    </div>
                </div><!--Friend single request-->

                <div class="friend-request-single">
                    <img src="<?php echo INCLUDE_PATH_STATIC ?>images/perfil-placeholder.jpeg" alt="">
                    <div class="friend-request-single-info">
                        
                        <h3>Otavio da Silva</h3>
                        <p><a href="#">Aceitar</a> | <a href="#">Recusar</a></p>
                    </div>
                </div><!--Friend single request-->

                <div class="friend-request-single">
                    <img src="<?php echo INCLUDE_PATH_STATIC ?>images/perfil-placeholder.jpeg" alt="">
                    <div class="friend-request-single-info">
                        
                        <h3>Otavio da Silva</h3>
                        <p><a href="#">Aceitar</a> | <a href="#">Recusar</a></p>
                    </div>
                </div><!--Friend single request-->
            </div>
        </div><!--feeding-->

    </section><!--section main feed-->

</body>
</html>