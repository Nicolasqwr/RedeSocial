<?php  
namespace DankiCode\Controllers;

class ComunidadeController{


    public function index(){
        if(isset($_SESSION['login'])){

            if(isset($_GET['solicitarAmizade'])){
                $idPara = (int) $_GET['solicitarAmizade'];
                if(\DankiCode\Models\UsuariosModel::solicitarAmizade($idPara)){
                    \DankiCode\Utilidades::alerta('Pedido Enviado');
                    \DankiCode\Utilidades::redirect(INCLUDE_PATH."comunidade");
                }else{
                    \DankiCode\Utilidades::alerta('Erro ao enviar');
                    \DankiCode\Utilidades::redirect(INCLUDE_PATH."comunidade");
                }
            }

            \DankiCode\Views\MainView::render('comunidade');

        }else{
            \DankiCode\Utilidades::redirect('home');
        }
    }


}


?>