<?php
    require_once 'authentication.php';

    $id_usuario = $_SESSION['id_usuario'];

    $select = $pdo->prepare("SELECT nome, email, senha FROM usuarios WHERE id_usuario = :iu");
    $select->bindValue(":iu",$id_usuario);
    $select->execute();

    if ($select->execute()) {

        if ($select->rowCount() > 0) {

            $data = $select->fetch();

            $nome_usuario = $data['nome'];

            $email_usuario = $data['email'];

            $senha_usuario = $data['senha'];

        } else {

            $nome_usuario = "";

            $email_usuario = "";

            $erro = "<div id='msg-erro'>Erro ao carregar suas informações de login! Recarregue a página para tentar novamente</div>";

        }
    } else {

        $nome_usuario = "";

        $email_usuario = "";

        $erro = "<div id='msg-erro'>Erro ao carregar suas informações de login! Recarregue a página para tentar novamente</div>";

    }
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
    <title>Editar Perfil</title>
</head>
<body>

    <div class="container-content">

        <?php
            require_once 'header.php';
        ?>

        <main class="main">

            <section class="login">
        
                <form action="" class="form_login" method="POST">

                    <h1>Edite suas informações de cadastro!</h1>

                        <fieldset>

                            <legend><span>Editar Usuário</span></legend>

                            <p><label for="name"></label>

                            <i class="fas fa-user"></i>
                            
                            <input value="<?= $nome_usuario; ?>" class="box" id="name" type="text" name="name" maxlength="50"></p>

                            <p><label for="mail"></label>

                            <i class="fas fa-envelope"></i>

                            <input value="<?= $email_usuario; ?>" class="box" id="mail" type="email" name="mail" maxlength="50"></p>

                            <input class="button" type="submit" value="Atualizar usuário" name="update-user">

                            <?php

                                if (!empty($_POST['name']) && !empty($_POST['mail']) && !empty($_POST['update-user'])) {

                                    $nome_usuario = addslashes($_POST['name']);
                                    $email_usuario = addslashes($_POST['mail']);

                                    $update = $pdo->prepare("UPDATE usuarios SET nome = :n, email = :e WHERE id_usuario = :iu");
                                    $update->bindValue(":n",$nome_usuario);
                                    $update->bindValue(":e",$email_usuario);
                                    $update->bindValue(":iu",$id_usuario);
                                    $update->execute();

                                    if ($update->execute()) {

                                        echo "<div id='msg-sucesso'>Dados atualizados com sucesso!</div>";

                                    } else {

                                        echo "<div id='msg-erro'>ERRO! Tente novamente</div>";

                                    }

            
                                } else {

                                    echo $erro;

                                }

                            ?>

                        </fieldset>

                        <fieldset>

                            <legend><span>Editar Senha</span></legend>

                            <p><label for="password"></label>

                            <i class="fas fa-lock"></i>

                            <input class="box" id="password" type="password" name="password" maxlength="20" placeholder="Senha atual"></p>

                            <p><label for="password"></label>

                            <i class="fas fa-lock"></i>

                            <input class="box" id="password" type="password" name="new-password" maxlength="20" placeholder="Nova senha"></p>

                            <p><label for="cPassword"></label>

                            <i class="fas fa-lock" id="confirm"></i>

                            <input class="box" id="cPassword" type="password" name="c-new-password" maxlength="20" placeholder="Confirmar nova senha"></p>

                            <input class="button" type="submit" value="Atualizar senha" name="update-password">

                            <?php

                                if (!empty($_POST['password']) && !empty($_POST['new-password']) && !empty($_POST['c-new-password']) && !empty($_POST['update-password'])) {

                                    $senha = addslashes($_POST['password']);
                                    $novaSenha = addslashes($_POST['new-password']);
                                    $cNovaSenha = addslashes($_POST['c-new-password']);

                                    if ($senha_usuario == md5($senha)) {

                                        if ($novaSenha == $cNovaSenha) {

                                            $update = $pdo->prepare("UPDATE usuarios SET senha = :ns WHERE id_usuario = :iu");
                                            $update->bindValue(":ns",md5($novaSenha));
                                            $update->bindValue(":iu",$id_usuario);
                                            $update->execute();

                                            if ($update->execute()) {

                                                echo "<div id='msg-sucesso'>Dados atualizados com sucesso!</div>";
            
                                            } else {
            
                                                echo "<div id='msg-erro'>ERRO! Tente novamente</div>";
            
                                            }

                                        } else {

                                            echo "<div id='msg-erro'>Nova senha e Confirmar nova senha não correspondem!</div>";

                                        }

                                    } else {

                                        echo "<div id='msg-erro'>Erro! Senha atual incorreta</div>";

                                    }

                                }

                            ?>

                        </fieldset>
                        
                        <div class="sub-text" id="delete-acount"><p><a href="delete-popup-acount.php">Quer excluir sua conta?</a></p></div>

                        <?php

                            if (isset($_SESSION['msg-delete-acount'])) {

                                echo $_SESSION['msg-delete-acount'];
                                unset($_SESSION['msg-delete-acount']);

                            }

                        ?>
                    
                </form>

                <?php

                    if (isset($_SESSION['div-delete'])) {

                        echo $_SESSION['div-delete'];
                        unset($_SESSION['div-delete']);
                        
                    }

                    if (isset($_SESSION['msg-delete-acount'])) {

                        echo $_SESSION['msg-delete-acount'];
                        unset($_SESSION['msg-delete-acount']);
                        
                    }

                ?>

            </section>
            
        </main>

        <?php
            require_once 'footer.php';
        ?>

    </div>

    <script src="https://kit.fontawesome.com/00d3e5c25f.js" crossorigin="anonymous"></script>
    <script src="js/toggle-menu.js"></script>
</body>
</html>