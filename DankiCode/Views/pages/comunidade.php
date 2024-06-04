<!DOCTYPE html>
<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b807da4028.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem vindo, <?php echo $_SESSION['nome']; ?></title>
    <link href="<?php echo INCLUDE_PATH_STATIC ?>estilos/comunidade.css" rel="stylesheet">
    <link href="<?php echo INCLUDE_PATH_STATIC ?>estilos/feed.css" rel="stylesheet">
</head>
<body>
    <section class="main-feed">
        <?php include('includes/sidebar.php'); ?>
        <div class="feed">
            <div class="comunidade">
                <div class="container-comunidade">
                    <h4>Amigos</h4>
                    <div class="container-comunidade-wraper">
                        <?php for ($i = 0; $i < 6; $i++) { ?>
                        <div class="container-comunidade-single">
                            <div class="img-comunidade-user-single">
                                <img src="<?php echo INCLUDE_PATH_STATIC ?>images/avatar.jpg" />
                            </div>
                            <div class="info-comunidade-user-single">
                                <h2>Guilherme Grillo</h2>
                                <p>guilherme@gmail.com</p>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <br/>
                <div class="container-comunidade">
                    <h4>Comunidade</h4>
                    <div class="container-comunidade-wraper">
                        <?php 
                        $comunidade = \DankiCode\Models\UsuariosModel::listarComunidade();
                        foreach ($comunidade as $key => $value) {
                            if($value['id'] == $_SESSION['id']){
                                continue;
                            }
                        ?>
                        <div class="container-comunidade-single">
                            <div class="img-comunidade-user-single">
                                <img src="<?php echo INCLUDE_PATH_STATIC ?>images/avatar.jpg" />
                            </div>
                            <div class="info-comunidade-user-single">
                                <h2><?php echo $value['nome'] ?></h2>
                                <p><?php echo $value['email'] ?></p>
                                <div class="btn-solicitar-amizade">
                                    <?php
                                    if (\DankiCode\Models\UsuariosModel::existePedidoAmizade($value['id'])) {
                                    ?>
                                        <a href="javascript:void(0)" style="color:red; border: none; text-decoration: none; display: inline-block;">Pedido pendente</a>
                                    <?php } else { ?>
                                        <a href="<?php echo INCLUDE_PATH ?>comunidade?solicitarAmizade=<?php echo $value['id']; ?>" style="color:#006400; border: 2px solid #006400; padding: 5px 10px; text-decoration: none; display: inline-block;">Pedir amizade</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php  } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
