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
        <?php include('includes/sidebar.php'); ?>
        <div class="feed">
            <h2>Editar perfil:</h2>

            <div class="editar-perfil">
                <br>
                <?php 
                // Verifique se a imagem está definida na sessão e exiba a imagem correta
                if (isset($_SESSION['img']) && !empty($_SESSION['img'])) {
                    echo '<img style="max-width: 200px; width:100%; border-radius: 50%;" src="' . INCLUDE_PATH . 'uploads/' . $_SESSION['img'] . '" />';
                } else {
                    echo '<img style="max-width: 200px; width:100%; border-radius: 50%;" src="' . INCLUDE_PATH_STATIC . '/images/avatar.jpg" />';
                }
                ?>
                <br/><br/><br/><br/>
                <form method="post" enctype="multipart/form-data">
                    <input type="text" name="nome" value="<?php echo $_SESSION['nome'] ?>">

                    <input type="password" name="senha" placeholder="Sua nova senha">

                    <input type="file" name="file">

                    <input type="hidden" name="atualizar" value="atualizar">

                    <input type="submit" name="acao" value="salvar">
                </form>

                <?php
                // Processar o formulário
                if (isset($_POST['acao']) && $_POST['acao'] == 'salvar') {
                    // Validar e atualizar o nome
                    if (!empty($_POST['nome'])) {
                        $_SESSION['nome'] = $_POST['nome'];
                        // Atualize o nome no banco de dados
                        // Assumindo uma conexão $conn com o banco de dados
                        $sql = "UPDATE usuarios SET nome = :nome WHERE id = :id";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute(['nome' => $_SESSION['nome'], 'id' => $_SESSION['id']]);
                    }

                    // Atualizar a senha se fornecida
                    if (!empty($_POST['senha'])) {
                        $senhaHash = password_hash($_POST['senha'], PASSWORD_DEFAULT);
                        $sql = "UPDATE usuarios SET senha = :senha WHERE id = :id";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute(['senha' => $senhaHash, 'id' => $_SESSION['id']]);
                    }

                    // Processar o upload da imagem
                    if (!empty($_FILES['file']['name'])) {
                        $file = $_FILES['file'];
                        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                        $imgName = md5(uniqid()) . '.' . $ext;
                        $imgPath = 'uploads/' . $imgName;

                        // Verificar e mover o arquivo
                        if (move_uploaded_file($file['tmp_name'], $imgPath)) {
                            // Atualize a sessão com a nova imagem
                            $_SESSION['img'] = $imgName;

                            // Atualize o banco de dados com a nova imagem
                            $sql = "UPDATE usuarios SET img = :img WHERE id = :id";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute(['img' => $imgName, 'id' => $_SESSION['id']]);
                        } else {
                            echo "Erro ao carregar a imagem.";
                        }
                    }
                }
                ?>
            </div><!--editar perfil-->
        </div><!--feed-->
    </section><!--section main feed-->
</body>
</html>