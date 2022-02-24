<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/book.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
</head>
<body>

    <main class="main" >
            
        <section class="login">
            
            <h1 class="title">Prepara IF!</h1>
            
        
            <form class="form_login" method="POST">

                <h1>Faça Login</h1>

                <p><label for="mail"></label>

                <i class="fas fa-user"></i>

                <input class="box" id="mail" type="text" name="mail" maxlength="50" placeholder="Seu email"></p>

                <p><label for="password"></label>

                <i class="fas fa-lock"></i>

                <input class="box" id="password" type="password" name="password" maxlength="20" placeholder="Sua senha"></p>

                <input class="button" type="submit" value="Entrar">

                <div class="sub-text"><p>Não tem uma conta?<a href="registration.php" id="log">Cadastre-se!</a></p></div>

                <?php

                    if (isset($_POST['mail'])) {

                        $_SESSION['logado'] = addslashes($_POST['mail']);

                        $email = addslashes($_POST['mail']);
                        $senha = addslashes($_POST['password']);

                        if (!empty($email) && !empty($senha)) {

                            include 'php/conexao.php';

                            $select = $pdo->prepare("SELECT id_usuario, nivel FROM usuarios WHERE email = :e AND senha = :s");

                            $select->bindValue(":e",$email);
                            $select->bindValue(":s",md5($senha));
                            $select->execute();

                            if ($select->rowCount() > 0) {

                                $data = $select->fetch();

                                $_SESSION['id_usuario'] = $data['id_usuario'];
                                $_SESSION['nivel'] = $data['nivel'];

                                header('location: main.php');

                            } else {

                                ?>

                                <div id="msg-erro">E-mail e/ou senha estão incoretos!</div>

                                <?php

                            }


                        } else {

                            ?>

                            <div id="msg-erro">Preencha todos os campos!</div>

                            <?php

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