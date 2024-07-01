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
    <?php 
			include('includes/sidebar.php'); 
		?>
<div class="feed">
			<div class="feed-wraper">
				
                <div class="feed-form">
					<form method="post">
						<textarea require="" name="post_content" placeholder="O que está passando na sua cachola?"></textarea>
						<input type="hidden" name="post_feed" value="1">
						<input class="butao" type="submit" name="acao" value="Postar">
					</form>
                </div><!--feed form-->

				<?php 
				
				$retrievePost = \DankiCode\Models\HomeModel::retriveFriends();

				foreach ($retrievePost as $key => $value){
				
				?>

			<div class="feed-single-post">
				<div class="feed-single-post-author">
					<div class="img-single-post-author">
						<?php

						if(!isset($value['me']) && $value['img'] == ''){
					?>
						<img src="<?php echo INCLUDE_PATH_STATIC ?>images/avatar.jpg" />

					<?php }else if(!isset($value['me'])){ ?>
						<img src="<?php echo INCLUDE_PATH ?>uploads/<?php echo $value['img'] ?>" />
					<?php } ?>
					<?php
						if(isset($value['me']) && $_SESSION['img'] == ''){
					?>

						<img src="<?php echo INCLUDE_PATH_STATIC ?>images/avatar.jpg" />
					<?php }else if(isset($value['me'])){ ?>
						<img src="<?php echo INCLUDE_PATH ?>uploads/<?php echo $_SESSION['img'] ?>" />
					<?php } ?>
						
					</div>
					<div class="feed-single-post-author-info">
						<?php if(isset($value['me'])){?>
							<h3><?php echo $_SESSION['nome']; ?></h3>
						<?php }else{ ?>
							<h3><?php echo $value['usuario']; ?></h3>

						<?php } ?>
						<p><?php echo date('d/m/y H:i',strtotime($value['data'])) ?></p>
					</div>
				</div>
				<div class="feed-single-post-content">
					<?php echo $value['conteudo'] ?>
				</div>
			</div>
			<?php } ?>
			</div>
			<div class="friends-request-feed">
				<h4>Solicitações de amizade</h4>
				<?php 
                
                    foreach(\DankiCode\Models\UsuariosModel::listarAmizadePendente() as $key=>$value){

                        $usuarioInfo = \DankiCode\Models\UsuariosModel::getUsuarioById($value['enviou'])
                
                ?>
                <div class="friend-request-single">
                    <img src="<?php echo INCLUDE_PATH_STATIC ?>images/perfil-placeholder.jpeg" alt="">
                    <div class="friend-request-single-info">
                        
                        <h3><?php echo $usuarioInfo['nome'] ?></h3>
                        <p><a href="<?php echo INCLUDE_PATH ?>?aceitarAmizade=<?php echo $usuarioInfo['id'] ?>">Aceitar</a> | <a href="<?php echo INCLUDE_PATH ?>?recusarAmizade=<?php echo $usuarioInfo['id'] ?>">Recusar</a></p>
                    </div>
                </div><!--Friend single request-->
                    <?php  
                        };
                    ?>
            </div>
			</div>

            
		</div><!--feed-->

    </section><!--section main feed-->

</body>
</html>