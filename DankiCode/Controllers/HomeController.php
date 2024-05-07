<?php

namespace Dankicode\Controllers;

class HomeController {
    public function index() {

        if(isset($_GET['loggout'])){
            session_unset();
            session_destroy();

            \DankiCode\Utilidades::redirect('home');
        }

        if(isset($_SESSION['login'])) {
            // Renderiza a Home do usuário
            \DankiCode\Views\MainView::render('home');
        }else{
            // Renderiza a página de login

            if(isset($_POST['login'])) {
                $login = $_POST['email'];
                $senha = $_POST['senha'];

                $verifica = \DankiCode\MySql::connect()->prepare("SELECT * FROM usuarios WHERE email = ?");
                $verifica->execute(array($login));

                if($verifica->rowCount() == 0) {
                    // Usuário não existe
                    \DankiCode\Utilidades::alerta('Este usuário não existe no nosso banco de dados!');
                    \DankiCode\Utilidades::redirect(INCLUDE_PATH);
                } else {
                    // Usuário existe, verificar senha
                    $usuario = $verifica->fetch();
                    $senhaBanco = $usuario['senha'];
                    if(\DankiCode\Bcrypt::check($senha, $senhaBanco)) {
                        // Senha correta, usuário logado com sucesso
                        $_SESSION['login'] = $usuario['email'];
                        $_SESSION['id'] = $dados['id'];
                        $_SESSION['nome'] = $dados['nome'];
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