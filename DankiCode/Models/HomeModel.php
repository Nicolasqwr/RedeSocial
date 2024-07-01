<?php

    namespace Dankicode\Models;

    class HomeModel{

        public static function postFeed($post){
            $pdo = \DankiCode\MySql::connect();
            $post = strip_tags($post);

            if(preg_match('/\[imagem=/', $post)){
            $post = preg_replace('/(.*?)\[imagem=(.*?)\]/', '<p>$1</p><img src="$2" />', $post);
            }else{
                $post = '<p>'.$post.'</p>';
            };


            $postFeed = $pdo->prepare("INSERT INTO `posts` VALUES (null,?,?,?)");
            $postFeed->execute(array($_SESSION['id'],$post,date('Y-m-d H:i:s',time())));

            $atualizaUsuario = $pdo->prepare("UPDATE usuarios SET ultimo_post = ? WHERE id = ?");
            $atualizaUsuario->execute(array(date('Y-m-d H:i:s',time()),$_SESSION['id']));
            
        }


        public static function retriveFriends() {
            $pdo = \DankiCode\MySql::connect();
        
            // Busca todas as amizades confirmadas do usuário.
            $amizades = $pdo->prepare("SELECT * FROM amizades WHERE (enviou = ? AND status = 1) OR (recebeu = ? AND status = 1)");
            $amizades->execute(array($_SESSION['id'], $_SESSION['id']));
            $amizades = $amizades->fetchAll();
        
            $amigosConfirmado = array();
            foreach ($amizades as $value) {
                if ($value['enviou'] == $_SESSION['id']) {
                    $amigosConfirmado[] = $value['recebeu'];
                } else {
                    $amigosConfirmado[] = $value['enviou'];
                }
            }
        
            $posts = array();
        
            // Número de posts a serem buscados para cada amigo.
            $numPostsPorAmigo = 3;
        
            foreach ($amigosConfirmado as $amigoId) {
                $amigo = \DankiCode\Models\UsuariosModel::getUsuarioById($amigoId);
                // Concatene o número de posts diretamente na consulta
                $query = "SELECT * FROM posts WHERE usuario_id = ? ORDER BY date DESC LIMIT $numPostsPorAmigo";
                $postsAmigo = $pdo->prepare($query);
                $postsAmigo->execute(array($amigoId));
        
                $postsAmigo = $postsAmigo->fetchAll();
                foreach ($postsAmigo as $postAmigo) {
                    $posts[] = array(
                        'usuario' => $amigo['nome'],
                        'img' => $amigo['img'],  // Adiciona a foto de perfil do amigo
                        'data' => $postAmigo['date'],
                        'conteudo' => $postAmigo['post']
                    );
                }
            }
        
            // Adiciona os próprios posts do usuário.
            $numPostsUsuario = 3;
            $query = "SELECT * FROM posts WHERE usuario_id = ? ORDER BY date DESC LIMIT $numPostsUsuario";
            $meusPosts = $pdo->prepare($query);
            $meusPosts->execute(array($_SESSION['id']));
            $meusPosts = $meusPosts->fetchAll();
            foreach ($meusPosts as $meuPost) {
                $posts[] = array(
                    'usuario' => 'Eu',
                    'img' => $_SESSION['img'],  // Adiciona a própria foto de perfil do usuário
                    'data' => $meuPost['date'],
                    'conteudo' => $meuPost['post'],
                    'me' => true
                );
            }
        
            // Ordena os posts por data, do mais recente para o mais antigo.
            usort($posts, function($a, $b) {
                return strtotime($b['data']) - strtotime($a['data']);
            });
        
            return $posts;



        }

    }