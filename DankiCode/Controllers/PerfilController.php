<?php  
namespace DankiCode\Controllers;

class PerfilController{


    public function index() {
        if (isset($_SESSION['login'])) {
            if (isset($_POST['atualizar'])) {
                $pdo = \DankiCode\Mysql::connect();
                $nome = strip_tags($_POST['nome']);
                $senha = $_POST['senha'];
    
                if ($nome == '' || strlen($nome) < 3) {
                    \DankiCode\Utilidades::alerta('Você precisa colocar um nome válido!');
                    \DankiCode\Utilidades::redirect(INCLUDE_PATH . 'perfil');
                    return;
                }
    
                // Atualiza o nome e a senha (se fornecida)
                if ($senha != '') {
                    $senha = \DankiCode\Bcrypt::hash($senha);
                    $atualizar = $pdo->prepare("UPDATE usuarios SET nome = ?, senha = ? WHERE id = ?");
                    $atualizar->execute([$nome, $senha, $_SESSION['id']]);
                } else {
                    $atualizar = $pdo->prepare("UPDATE usuarios SET nome = ? WHERE id = ?");
                    $atualizar->execute([$nome, $_SESSION['id']]);
                }
    
                $_SESSION['nome'] = $nome;
    
                // Atualiza a imagem de perfil
                if ($_FILES['file']['tmp_name'] != '') {
                    $file = $_FILES['file'];
                    $fileExt = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                    $validExtensions = ['png', 'jpg', 'jpeg'];
    
                    if (in_array($fileExt, $validExtensions)) {
                        $size = intval($file['size'] / 1024); // Tamanho em KB
                        if ($size <= 300) {
                            $uniqid = uniqid() . '.' . $fileExt;
                            $uploadDir = realpath(__DIR__ . '/../../uploads/') . '/';
                            $uploadFile = $uploadDir . $uniqid;
    
                            // Cria o diretório se não existir
                            if (!is_dir($uploadDir)) {
                                mkdir($uploadDir, 0777, true);
                            }
    
                            // Verifica se o arquivo foi movido corretamente
                            if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
                                $atualizaImagem = $pdo->prepare("UPDATE usuarios SET img = ? WHERE id = ?");
                                $atualizaImagem->execute([$uniqid, $_SESSION['id']]);
                                $_SESSION['img'] = $uniqid;
                            } else {
                                \DankiCode\Utilidades::alerta('Erro ao processar seu arquivo!');
                                \DankiCode\Utilidades::redirect(INCLUDE_PATH . 'perfil');
                                return;
                            }
                        } else {
                            \DankiCode\Utilidades::alerta('O tamanho do arquivo excede o limite permitido!');
                            \DankiCode\Utilidades::redirect(INCLUDE_PATH . 'perfil');
                            return;
                        }
                    } else {
                        \DankiCode\Utilidades::alerta('O formato não é compatível!');
                        \DankiCode\Utilidades::redirect(INCLUDE_PATH . 'perfil');
                        return;
                    }
                }
    
                \DankiCode\Utilidades::alerta('Perfil atualizado com sucesso!');
                \DankiCode\Utilidades::redirect(INCLUDE_PATH . 'perfil');
            }
    
            \DankiCode\Views\MainView::render('perfil');
        } else {
            \DankiCode\Utilidades::redirect('home');
        }
    }


}


?>