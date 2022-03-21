<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <link rel="shortcut icon" href="images/book.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
    <title>Atualize sua senha</title>
</head>
<body>

    <main class="main">

        <section class="login">
            <h1 class="title">Prepara IF!</h1>
    
            <form class="form_login" method="POST">

                <h1>Atualize sua senha</h1>

                <p><label for="password"></label>

                <i class="fas fa-lock"></i>

                <input class="box" id="password" type="password" name="password" maxlength="20" placeholder="Sua nova senha"></p>

                <p><label for="cPassword"></label>

                <i class="fas fa-lock" id="confirm"></i>

                <input class="box" id="cPassword" type="password" name="cPassword" maxlength="20" placeholder="Confirmar nova senha"></p>

                <input class="button" type="submit" value="Atualizar" name="update">

                <div class="sub-text"><p><a href="login.php" id="log">Lembrou a senha? Clique aqui!</a></p></div>

                <?php

                    session_start();

                    include 'php/conexao.php';

                    $key = addslashes($_GET['key']);

                    if (!empty($key)) {

                        $select = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE chave_recuperar_senha = :ch");
                        $select->bindValue(":ch",$key);
                        $select->execute();
                        
                        if ($select->rowCount() > 0) {

                            $id = $select->fetch();
                            $id_usuario = $id['id_usuario'];

                            if (isset($_POST['password']) && !empty($_POST['update'])) {

                                $key  = 'NULL';
                                $novaSenha = addslashes($_POST['password']);
                                $confSenha = addslashes($_POST['cPassword']);
        
                                if (!empty($novaSenha) && !empty($confSenha)) {

                                    if ($novaSenha == $confSenha) {
        
                                        $update = $pdo->prepare("UPDATE usuarios SET senha = :ns, chave_recuperar_senha = :ch WHERE id_usuario = :iu");
                                        $update->bindValue(":ns",md5($novaSenha));
                                        $update->bindValue(":ch",$key);
                                        $update->bindValue(":iu",$id_usuario);
                                        $update->execute();

                                        if ($update->execute()) {

                                            $_SESSION['msg'] = "<div id='msg-sucesso'>Senha atualizada com sucesso!</div>";

                                            header('location: login.php');

                                        } else {

                                            ?>

                                            <div id="msg-erro">ERRO! Tente novamente</div>

                                            <?php


                                        }

                                    } else {
                                
                                        ?>
        
                                        <div id="msg-erro">Senha e Confirmar Senha não correspondem!</div>
        
                                        <?php
                                            
                                    }
                                } else {
                                
                                    ?>
    
                                    <div id="msg-erro">Preencha todos os campos!</div>
    
                                    <?php
                                        
                                }
                            }

                        } else {

                            $_SESSION['msg-rec-senha'] = "<div id='msg-erro'>Link inválido! Digite email novamente para que um novo link possa ser gerado</div>";

                            header('location: recover-password.php');

                        }

                    } else {

                        $_SESSION['msg-rec-senha'] = "<div id='msg-erro'>Link inválido! Digite email novamente para que um novo link possa ser gerado</div>";

                        header('location: recover-password.php');

                    }

                ?>  
                
            </form>

        </section>
        
    </main>

    <?php
        require_once 'footer.php';
    ?>

    <script src="https://kit.fontawesome.com/00d3e5c25f.js" crossorigin="anonymous"></script>
</body>
</html>