<?php  
namespace DankiCode\Controllers;

class ComunidadeController{


    public function index(){
        if(isset($_SESSION['login'])){

            if(isset($_GET['solicitarAmizade'])){
                $idPara = (int) $_GET['solicitarAmizade'];
                if(\DankiCode\Models\UsuariosModel::solicitarAmizade($idPara)){
                    \DankiCode\Utilidades::alerta('Pedido Enviado');
                }else{
                    \DankiCode\Utilidades::alerta('Erro ao enviar');
                }
            }

            \DankiCode\Views\MainView::render('comunidade');

        }else{
            \DankiCode\Utilidades::redirect('home');
        }
    }


}


?>