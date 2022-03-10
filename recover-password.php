<?php
    session_start();

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'lib/vendor/autoload.php';

    $mail = new PHPMailer(true);


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
    <title>Recuperar senha</title>
</head>
<body>

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
                        
                        include 'php/conexao.php';

                        if (!empty($email)) {

                            $select = $pdo->prepare("SELECT id_usuario, nome FROM usuarios WHERE email = :e");
                            $select->bindValue(":e",$email);
                            $select->execute();
                                    
                            if ($select->rowCount() > 0) {

                                $user = $select->fetch();
                                $id_usuario = $user['id_usuario'];
                                $nome_usuario = $user['nome'];


                                $key_recover_password = md5($id_usuario);
                                    
                                $update = $pdo->prepare("UPDATE usuarios SET chave_recuperar_senha = :k WHERE id_usuario = :id LIMIT 1");
                                $update->bindValue(":k",$key_recover_password);
                                $update->bindValue(":id",$id_usuario);
                                $update->execute();

                                if ($update->execute()) {

                                    $link = "http://localhost/prepara-if/update-password.php?key=$key_recover_password";

                                    try {

                                        $mail->CharSet = 'UTF-8';
                                        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                                        $mail->isSMTP();                                            //Send using SMTP
                                        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                                        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                                        $mail->Username   = 'prepara.ifrn@gmail.com';                     //SMTP username
                                        $mail->Password   = 'preparapropreparaif';                               //SMTP password
                                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
                                        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                                    
                                        $mail->setFrom('prepara.ifrn@gmail.com', 'Prepara IF');
                                        $mail->addAddress($email, $nome);     //Add a recipient

                                        $mail->isHTML(true);                                  //Set email format to HTML
                                        $mail->Subject = "RECUPERAR SENHA PREPARA IF";


                                        $mail->Body    = "Prezado (a) $nome_usuario. <br/><br/>
                                                            Você solicitou alteração de senha.<br/><br/>
                                                            Para continuar o processo de recuperação de sua senha, clique no link abaixo ou cole o endereço no seu navegador:<br/><br/>
                                                            <a href='$link'>$link</a> <br/><br/>
                                                            Se você não solicitou essa alteração, nenhuma ação é necessária. Sua senha permanecerá a mesma até que você solicite mudança.<br/><br/>";


                                        $mail->AltBody = "Prezado (a) $nome_usuario. \n\n 
                                                            Você solicitou alteração de senha. \n\n
                                                            Para continuar o processo de recuperação de sua senha, clique no link abaixo ou cole o endereço no seu navegador:\n\n
                                                            $link \n\n
                                                            Se você não solicitou essa alteração, nenhuma ação é necessária. Sua senha permanecerá a mesma até que você solicite mudança. \n\n";

                                        
                                        $mail->send();

                                        $_SESSION['msg'] = "<div id='msg-sucesso'>Enviamos um e-mail com instruções de como recuperar sua senha. Acesse sua caixa de e-mails para recuperá-la.</div>";

                                        header('location: login.php');


                                    }catch (Exception $e){

                                        echo "<div id='msg-erro'>Email não enviado. ERRO: {$mail->ErrorInfo}</div>";
                                        
                                    }

                                } else {

                                    echo "<div id='msg-erro'>Erro! Tente novamente</div>";

                                }
                                        
                            } else {

                                echo "<div id='msg-erro'>Não há cadastro no site para o email digitado</div>";

                            }

                        } else {
                                
                            echo "<div id='msg-erro'>Preencha todos os campos!</div>";
                                    
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

    <script src="https://kit.fontawesome.com/00d3e5c25f.js" crossorigin="anonymous"></script>
    <script src="js/toggle-menu.js"></script>
</html>