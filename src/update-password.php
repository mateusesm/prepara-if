<?php
    session_start();

    require_once '../classes/Usuario.php';
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

                    $key = addslashes($_GET['key']);

                    if (isset($_POST['password']) && !empty($_POST['update'])) {

                        $novaSenha = addslashes($_POST['password']);
                        $confSenha = addslashes($_POST['cPassword']);

                        $u = new Usuario();

                        $header = $u->mudarSenha($key,$novaSenha,$confSenha);

                        header($header);

                        if (isset($_SESSION['msg-rec-senha'])) {

                            echo $_SESSION['msg-rec-senha'];
                            unset($_SESSION['msg-rec-senha']);
                            
                        }

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