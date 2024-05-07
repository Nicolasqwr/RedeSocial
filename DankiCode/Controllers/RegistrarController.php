<?php

    namespace DankiCode\ControLLers;

    class RegistrarController{
        public function index(){

            if(isset($_POST['registrar'])){
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $senha = $_POST['senha'];

                if(!filter_var($email,FILTER_VALIDATE_EMAIL)){

                    \DankiCode\Utilidades::alerta('Email inválido!');
                    \DankiCode\Utilidades::redirect(INCLUDE_PATH.'registrar');
                    
                }elseif(strlen($senha) < 8){
                    \DankiCode\Utilidades::alerta('Sua senha tem que ter no minimo 8 cacractetres');
                    \DankiCode\Utilidades::redirect(INCLUDE_PATH.'registrar');

                }elseif(\DankiCode\Models\UsuariosModel::emailExist($email)){
                    \DankiCode\Utilidades::alerta('este email ja existe no nosso banco de dados!');
                    \DankiCode\Utilidades::redirect(INCLUDE_PATH.'registrar');
                }
                else{
                    //registrar usuario
                    $senha = \DankiCode\Bcrypt::hash($senha);
                    $registro = \DankiCode\MySql::connect()->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
                    $registro->execute(array($nome, $email, $senha));

                    \DankiCode\Utilidades::alerta('registrado com sucesso');
                    \DankiCode\Utilidades::redirect(INCLUDE_PATH.'home');
                }
            }

                \DankiCode\Views\MainView::render('registrar');
            }

    }
?>