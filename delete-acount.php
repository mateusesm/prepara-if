<?php

    require_once 'authentication.php';

    if (isset($_POST['password-popup'])) {

        $senha_popup = addslashes($_POST['password-popup']);

        if (!empty($senha_popup)) {

            $select = $pdo->prepare("SELECT senha FROM usuarios WHERE id_usuario = :id");
            $select->bindValue(":id", $_SESSION['id_usuario']);
            $select->execute();
                                                
            if ($select->rowCount() > 0) {

                $data = $select->fetch();

                $senha_usuario = $data['senha'];

                if ($senha_usuario == md5($senha_popup)) {

                    $delete = $pdo->prepare("DELETE FROM usuarios WHERE id_usuario = :id");
                    $delete->bindValue(":id",$_SESSION['id_usuario']);
                    $delete->execute();
            
                    if ($delete->execute()) {

                        $_SESSION['msg'] = "<div id='msg-sucesso'>Você excluiu sua conta com sucesso. Sentiremos sua falta... Pode se cadastrar novamente a qualquer momento!</div>";

                        header("Location: login.php");

                    } else {

                        $_SESSION['msg-delete-acount'] = "<div id='msg-erro'>Erro! Tente novamente</div>";

                        header("Location: edit-profile.php");

                    }
                } else {

                    $_SESSION['msg-delete-acount'] = "<div id='msg-erro'>Senha incorreta!</div>";

                    header("Location: edit-profile.php");

                }
            } else {

                $_SESSION['msg'] = "<div id='msg-erro'>Erro ao efetuar consulta. Cadastro não encontrado!</div>";

                header("Location: login.php");

            }
        } else {

            $_SESSION['msg-delete-acount'] = "<div id='msg-erro'>Informe sua senha para excluir sua conta!</div>";

            header("Location: edit-profile.php");

        }

    } else {

        $_SESSION['msg-delete-acount'] = "<div id='msg-erro'>Informe sua senha para excluir sua conta 1!</div>";
        header("Location: edit-profile.php");

    }

?>