<?php

namespace Dankicode\Controllers;

class HomeController {
    public function index() {
        // Iniciar a sessão
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_GET['loggout'])) {
            session_unset();
            session_destroy();
            \DankiCode\Utilidades::redirect('home');
        }

        if (isset($_SESSION['login'])) {
            // Renderiza a Home do usuário

            //Existe pedido de amizade?

            if(isset($_GET['recusarAmizade'])){
                $idEnviou = (int) $_GET['recusarAmizade']; // Corrigido para $_GET
                \DankiCode\Models\UsuariosModel::atualizarPeididoAmizade($idEnviou, 0);
            
                \DankiCode\Utilidades::alerta('Amizade recusada :(');
                \DankiCode\Utilidades::redirect(INCLUDE_PATH);
            
            } else if(isset($_GET['aceitarAmizade'])){
                $idEnviou = (int) $_GET['aceitarAmizade']; // Corrigido para $_GET
                if(\DankiCode\Models\UsuariosModel::atualizarPeididoAmizade($idEnviou, 1)){
                    \DankiCode\Utilidades::alerta('Amizade aceita :)');
                    \DankiCode\Utilidades::redirect(INCLUDE_PATH);

                }else{
                    \DankiCode\Utilidades::alerta('ocorreu um erro :(');
                    \DankiCode\Utilidades::redirect(INCLUDE_PATH);
                }
            
            }

            //existe postagem no feed?
            
            if(isset($_POST['post_feed'])){
                \DankiCode\Models\HomeModel::postFeed($_POST['post_content']);

                if($_POST['post_content'] == ''){
                    \DankiCode\Utilidades::alerta('Voce precisa digitar algo pra postar');
                    \DankiCode\Utilidades::redirect(INCLUDE_PATH);
                }

                \DankiCode\Utilidades::alerta('Post feito com sucesso!');
                \DankiCode\Utilidades::redirect(INCLUDE_PATH);
            }






            \DankiCode\Views\MainView::render('home');
        } else {
            // Renderiza a página de login
            if (isset($_POST['login'])) {
                $login = $_POST['email'];
                $senha = $_POST['senha'];

                $verifica = \DankiCode\MySql::connect()->prepare("SELECT * FROM usuarios WHERE email = ?");
                $verifica->execute(array($login));

                if ($verifica->rowCount() == 0) {
                    // Usuário não existe
                    \DankiCode\Utilidades::alerta('Este usuário não existe no nosso banco de dados!');
                    \DankiCode\Utilidades::redirect(INCLUDE_PATH);
                } else {
                    // Usuário existe, verificar senha
                    $usuario = $verifica->fetch();
                    $senhaBanco = $usuario['senha'];
                    if (\DankiCode\Bcrypt::check($senha, $senhaBanco)) {
                        // Senha correta, usuário logado com sucesso
                        $_SESSION['login'] = $usuario['email'];
                        $_SESSION['id'] = $usuario['id'];
                        $_SESSION['nome'] = $usuario['nome'];
                        \DankiCode\Utilidades::alerta('Logado com sucesso');
                        \DankiCode\Utilidades::redirect(INCLUDE_PATH);
                    } else {
                        // Senha incorreta
                        \DankiCode\Utilidades::alerta('Senha incorreta');
                        \DankiCode\Utilidades::redirect(INCLUDE_PATH);
                    }
                }
            }

            \DankiCode\Views\MainView::render('login');
        }
    }
}
?>