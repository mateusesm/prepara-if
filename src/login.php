<?php

    session_start();

    require 'error.php';

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/book.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/login.css">
    <title>Login</title>
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

                    <h1>Faça Login</h1>

                    <p><label for="mail"></label>

                    <i class="fas fa-envelope"></i>

                    <input class="box" id="mail" type="text" name="mail" maxlength="50" placeholder="E-mail"></p>

                    <p><label for="password"></label>

                    <i class="fas fa-lock"></i>

                    <input class="box" id="password" type="password" name="password" maxlength="20" placeholder="Senha"></p>

                    <input class="button" type="submit" value="Entrar" name="entrar">

                    <div class="sub-text"><p><a href="recover-password.php" id="log">Esqueceu a senha? Clique aqui!</a></p></div>

                    <div class="sub-text"><p>Não tem uma conta?<a href="registration.php" id="log">Cadastre-se!</a></p></div>

                    <?php

                        if (!empty($_POST['entrar'])) {

                            $email = addslashes($_POST['mail']);
                            $senha = addslashes($_POST['password']);

                            require_once '../classes/Usuario.php';

                            $u = new Usuario();

                            $div = $u->logar($email,$senha);

                            if ($div) {

                                header('location: main.php');

                            }else{

                                if (isset($_SESSION['erro-login'])) {

                                    echo $_SESSION['erro-login'];
                                    unset($_SESSION['erro-login']);
                                }
        

                            }

                        }

                        if (isset($_SESSION['msg'])) {

                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
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
    <script src="../js/toggle-menu.js"></script>
</body>
</html>