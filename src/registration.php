<?php

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
    <title>Cadastre-se</title>
</head>
<body>

    <div class="container-content">

        <?php
            require_once 'header-index.php';
        ?>

        <main class="main">

            <section class="login">
                <h1 class="title">Prepara IF!</h1>
        
                <form action="registration.php" class="form_login" method="POST">

                    <h1>Cadastre-se</h1>

                    <p><label for="name"></label>

                    <i class="fas fa-user"></i>

                    <input class="box" id="name" type="text" name="name" maxlength="50" placeholder="Seu nome completo"></p>

                    <p><label for="mail"></label>

                    <i class="fas fa-envelope"></i>

                    <input class="box" id="mail" type="email" name="mail" maxlength="50" placeholder="Seu melhor email"></p>

                    <p><label for="password"></label>

                    <i class="fas fa-lock"></i>

                    <input class="box" id="password" type="password" name="password" maxlength="20" placeholder="Senha"></p>

                    <p><label for="cPassword"></label>

                    <i class="fas fa-lock" id="confirm"></i>

                    <input class="box" id="cPassword" type="password" name="cPassword" maxlength="20" placeholder="Confirmar senha"></p>

                    <input class="button" type="submit" value="Cadastrar" name="cadastrar">

                    <div class="sub-text"><p>Já tem uma conta?<a href="login.php" id="log">Faça login!</a></p></div>

                    <?php

                        if (!empty($_POST['cadastrar'])) {

                            $nome = addslashes($_POST['name']);
                            $email = addslashes($_POST['mail']);
                            $senha = addslashes($_POST['password']);
                            $confSenha = addslashes($_POST['cPassword']);

                            require_once '../classes/Usuario.php';

                            $u = new Usuario();

                            $div = $u->cadastrar($nome,$email,$senha,$confSenha);

                            if ($div) {

                                if (isset($_SESSION['sucesso-cadastro'])) {

                                    echo $_SESSION['sucesso-cadastro'];
                                    unset($_SESSION['sucesso-cadastro']);
                                }

                            }else {

                                if (isset($_SESSION['erro-cadastro'])) {

                                    echo $_SESSION['erro-cadastro'];
                                    unset($_SESSION['erro-cadastro']);
                                }

                            }

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