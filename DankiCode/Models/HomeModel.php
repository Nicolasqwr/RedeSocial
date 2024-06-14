<?php

    namespace Dankicode\Models;

    class HomeModel{

        public static function postFeed($post){
            $pdo = \DankiCode\MySql::connect();
            $post = strip_tags($post);

            if(preg_match('/\[imagem/', $post)){
            $post = preg_replace('/(.*?)\[imagem=(.*?)\]/', '<p>$1</p><img src="$2" />', $post);
            }else{
                $post = '.<p>'.$post.'</p>';
            };


            $postFeed = $pdo->prepare("INSERT INTO `posts` VALUES (null,?,?,?)");
            $postFeed->execute(array($_SESSION['id'],$post,date('Y-m-d H:i:s',time())));

            $atualizaUsuario = $pdo->prepare("UPDATE usuarios SET ultimo_post = ? WHERE id = ?");
            $atualizaUsuario->execute(array(date('Y-m-d H:i:s',time()),$_SESSION['id']));
            
        }


        public static function retriveFriends(){

            $pdo = \DankiCode\MySql::connect();

            $amizades = $pdo->prepare("SELECT * FROM amizades WHERE (enviou = ? AND status = 1) OR (recebeu = ? AND status = 1)");
            $amizades->execute(array($_SESSION['id'],$_SESSION['id']));

            $amizades = $amizades->fetchAll();

            $amigosConfirmado = array();
            foreach ($amizades as $key => $value) {
            
                if($value['enviou'] == $_SESSION['id']){
            
                    $amigosConfirmado[] = $value['recebeu'];
                }else{
                    $amigosConfirmado[] = $value['enviou'];
                }
            
            }

            
            
            
            $listaAmigos = array();
            
            foreach ($amigosConfirmado as $key => $value) {

                $listaAmigos[$key]['id'] = \DankiCode\Models\UsuariosModel::getUsuarioById($value)['id'];
                $listaAmigos[$key]['nome'] = \DankiCode\Models\UsuariosModel::getUsuarioById($value)['nome'];
                $listaAmigos[$key]['email'] = \DankiCode\Models\UsuariosModel::getUsuarioById($value)['email'];
                $listaAmigos[$key]['ultimo_post'] = \DankiCode\Models\UsuariosModel::getUsuarioById($value)['ultimo_post'];
            
            }
            
            $posts = [];
                

            foreach ($listaAmigos as $key => $value) {

                $ultimoPost = $pdo->prepare("SELECT * FROM posts WHERE usuario_id = ? ORDER BY date DESC");
            
                $ultimoPost->execute(array($value['id']));
            
                if($ultimoPost->rowCount() >= 1){
                    $ultimoPost = $ultimoPost->fetch();
                    $posts[$key]['usuario'] = $value['nome'];
                    $posts[$key]['data'] = $ultimoPost['date'];
                    $posts[$key]['conteudo'] = $ultimoPost['post'];                  
            
                }
            
            }

                


            return $posts;



        }

    }