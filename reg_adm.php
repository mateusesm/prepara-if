<?php
    require_once 'authentication_adm.php';
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
    <title>Cadastro de Administradores</title>
</head>
<body>

    <?php
        require_once 'header.php';
    ?>

    <main class="main">

        <section class="login">
    
            <form action="reg_adm.php" class="form_login" method="POST">

                <h1>Cadastre um novo Administrador!</h1>

                <p><label for="name"></label>

                <i class="fas fa-user"></i>

                <input class="box" id="name" type="text" name="name" maxlength="50" placeholder="Seu nome completo"></p>

                <p><label for="mail"></label>

                <i class="fas fa-envelope"></i>

                <input class="box" id="mail" type="email" name="mail" maxlength="50" placeholder="Seu melhor email"></p>

                <p><label for="password"></label>

                <i class="fas fa-lock"></i>

                <input class="box" id="password" type="password" name="password" maxlength="20" placeholder="Sua senha"></p>

                <p><label for="cPassword"></label>

                <i class="fas fa-lock" id="confirm"></i>

                <input class="box" id="cPassword" type="password" name="cPassword" maxlength="20" placeholder="Confirme sua senha"></p>

                <input class="button" type="submit" value="Cadastrar">

                <div class="sub-text"><p>Já tem uma conta?<a href="login.php" id="log">Faça login!</a></p></div>

                <?php

                    if (isset($_POST['name'])) {

                        $nome = addslashes($_POST['name']);
                        $email = addslashes($_POST['mail']);
                        $senha = addslashes($_POST['password']);
                        $confSenha = addslashes($_POST['cPassword']);
                        $nivel = 2;

                        include 'php/conexao.php';

                            if ((!empty($nome) && !empty($email) && !empty($senha) && !empty($nivel))) {

                                if ($senha == $confSenha) {

                                    $select = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
                                    $select->bindValue(":e",$email);
                                    $select->execute();
                                    
                                    if ($select->rowCount() > 0) {

                                        ?>

                                        <div id="msg-erro">Email já cadastrado!</div>

                                        <?php
                                        
                                    } else {

                                        $insert = $pdo->prepare("INSERT INTO usuarios(nome, email, senha, nivel) VALUES (:n, :e, :s, :ni)");
        
                                        $insert->bindValue(":n",$nome);
                                        $insert->bindValue(":e",$email);
                                        $insert->bindValue(":s",md5($senha));
                                        $insert->bindValue(":ni",$nivel);
                                        $insert->execute();

                                        ?>

                                        <div id="msg-sucesso">Cadastro realizado com sucesso!</div>

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
                ?>  
                
            </form>

        </section>
        
    </main>

    <?php
        require_once 'footer.php';
    ?>

    <script src="https://kit.fontawesome.com/00d3e5c25f.js" crossorigin="anonymous"></script>
    <script src="js/toggle-menu.js"></script>
</body>
</html>