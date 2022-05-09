<?php
    session_start();

    require_once 'classes/Usuario.php';
    require 'error.php';

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <link rel="shortcut icon" href="images/book.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
    <title>Recuperar senha</title>
</head>
<body>

    <div class="container-content">

        <?php
            require_once 'header-index.php';
        ?>

        <main class="main" >
                
            <section class="login">
                
                <h1 class="title">Prepara IF!</h1>
                
            
                <form class="form_login" method="POST">

                    <h1>Digite seu e-mail e lhe enviaremos um link para recuperar a senha</h1>

                    <p><label for="mail"></label>

                    <i class="fas fa-envelope"></i>

                    <input class="box" id="mail" type="text" name="mail" maxlength="50" placeholder="Seu email"></p>

                    <input class="button" type="submit" value="Enviar" name="enviar">

                    <div class="sub-text"><p><a href="login.php" id="log">Lembrou a senha? Clique aqui!</a></p></div>

                    <?php

                        if (isset($_POST['mail']) && !empty($_POST['enviar'])) {

                            $email = addslashes($_POST['mail']);

                            if (!empty($email)) {

                                $u = new Usuario();

                                $dadosUsuario = $u->buscarDadosUsuario($email);
                                        
                                if ($dadosUsuario > 0) {

                                    $id_usuario = $dadosUsuario['id_usuario'];
                                    $nome_usuario = $dadosUsuario['nome'];

                                    $key_recover_password = md5($id_usuario);

                                    $retorno = $u->enviarEmailRecuperacao($key_recover_password,$id_usuario,$nome_usuario,$email);

                                    if ($retorno['trueOrfalse']) {

                                        header($retorno['header']);

                                    }else {

                                        echo $retorno['header'];

                                    }
                                            
                                } else {

                                ?>

                                    <div id='msg-erro'>Não há cadastro no site para o email digitado</div>

                                <?php

                                }

                            } else {

                            ?>
                                    
                                <div id='msg-erro'>Preencha todos os campos!</div>

                            <?php
                                        
                            }

                        }

                        if (isset($_SESSION['msg-rec-senha'])) {

                            echo $_SESSION['msg-rec-senha'];
                            unset($_SESSION['msg-rec-senha']);
                            
                        }

                    ?> 

                </form>

            </section>
        </main>
            
        <?php
            require_once 'footer.php';
        ?>

    </div>
    
    <script src="https://kit.fontawesome.com/00d3e5c25f.js" crossorigin="anonymous"></script>
    <script src="js/toggle-menu.js"></script>
</html>