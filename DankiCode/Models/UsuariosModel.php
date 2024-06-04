<?php

    namespace Dankicode\Models;

    class UsuariosModel{
        public static function emailExist($email){
            $pdo = \DankiCode\MySql::connect();
            $verificar = $pdo->prepare("SELECT email FROM usuarios WHERE email = ?");
            $verificar->execute(array($email));

            if($verificar->rowCount() == 1){
                //email existe
                return true;
            }else{
                return false;
            }
        }

        public static function listarComunidade(){

            $pdo = \DankiCode\MySql::connect();

            $comunidade = $pdo->prepare("SELECT * FROM  usuarios");

            $comunidade->execute();
            
            return $comunidade->fetchAll();

        }

        public static function solicitarAmizade($idPara) {
            // Iniciar a sessão se ainda não foi iniciada
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
        
            // Verificar se a sessão contém o ID do usuário
            if (!isset($_SESSION['id'])) {
                throw new \Exception("ID do usuário não encontrado na sessão.");
            }
        
            $idDe = $_SESSION['id'];
        
            // Conectar ao banco de dados
            $pdo = \DankiCode\MySql::connect();
        
            // Verificar se já existe uma amizade entre os usuários
            $verificaAmizade = $pdo->prepare(
                "SELECT * FROM amizades WHERE (enviou = ? AND recebeu = ?) OR (enviou = ? AND recebeu = ?)"
            );
            $verificaAmizade->execute(array($idDe, $idPara, $idPara, $idDe));
        
            // Se já existe uma amizade, retornar false
            if ($verificaAmizade->rowCount() > 0) {
                return false;
            } else {
                // Inserir a solicitação de amizade no banco de dados
                $insertAmizade = $pdo->prepare(
                    "INSERT INTO amizades (enviou, recebeu, status) VALUES (?, ?, 0)"
                );
        
                if ($insertAmizade->execute(array($idDe, $idPara))) {
                    return true;
                } else {
                    // Inserção falhou, retornar false
                    return false;
                }
            }
        }

        public static function listarAmizadePendente(){

            $pdo = \DankiCode\Mysql::connect();

            $listarAmizadePendente = $pdo->prepare("SELECT * FROM amizades WHERE recebeu = ? AND status = 0 ");

            $listarAmizadePendente->execute(array($_SESSION['id']));

            return $listarAmizadePendente->fetchAll();

        }

        public static function getUsuarioById($id){

            $pdo = \DankiCode\Mysql::connect();

            $usuario = $pdo->prepare("SELECT * FROM usuarios WHERE id = ? ");

            $usuario->execute(array($id));

            return $usuario->fetch();

        }


        public static function existePedidoAmizade($idPara) {
            // Iniciar a sessão se ainda não foi iniciada
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
    
            // Verificar se a sessão contém o ID do usuário
            if (!isset($_SESSION['id'])) {
                throw new \Exception("ID do usuário não encontrado na sessão.");
            }
    
            $pdo = \DankiCode\MySql::connect();
            
            // Verificar se já existe uma amizade entre os usuários
            $verificaAmizade = $pdo->prepare(
                "SELECT * FROM amizades WHERE (enviou = ? AND recebeu = ?) OR (enviou = ? AND recebeu = ?)"
            );
            $verificaAmizade->execute(array($_SESSION['id'], $idPara, $idPara, $_SESSION['id']));
            
            // Se já existe uma amizade, retornar true
            if ($verificaAmizade->rowCount() > 0) {
                return true;
            } else {
                return false;
            }

        }

        public static function atualizarPeididoAmizade($enviou, $status) {
            $pdo = \DankiCode\MySql::connect();
            
            if($status == 0) {
                // Pedido recusado
                $del = $pdo->prepare("DELETE FROM amizades WHERE enviou = ? AND recebeu = ? AND status = 0");
                $del->execute(array($enviou, $_SESSION['id']));
            } else if($status == 1) {
                // Pedido aceito
                $aceitarPedido = $pdo->prepare('UPDATE amizades SET status = 1 WHERE enviou = ? AND recebeu = ?');
                $aceitarPedido->execute(array($enviou, $_SESSION['id']));
            }
        }
        

    }

?>