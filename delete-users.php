<?php

    require_once 'authentication_adm.php';

    $id_del_user = $_GET['del_user'];

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

                    $select = $pdo->prepare("SELECT nome FROM usuarios WHERE md5(id_usuario) = :id");
                    $select->bindValue(":id",$id_del_user);
                    $select->execute();

                    if ($select->rowCount() > 0) {

                        $usuario = $select->fetch();
                        $nomeUsuario = $usuario['nome'];

                        $delete = $pdo->prepare("DELETE FROM usuarios WHERE md5(id_usuario) = :id");
                        $delete->bindValue(":id",$id_del_user);
                        $delete->execute();
            
                        if ($delete->execute()) {

                            $_SESSION['msg-delete-user'] = "<div id='msg-sucesso'>Você excluiu o usuário $nomeUsuario com sucesso!</div>";

                            header("Location: delete-users_adm.php");

                        } else {

                            $_SESSION['msg-delete-user'] = "<div id='msg-erro'>Erro! Tente novamente</div>";

                            header("Location: delete-users_adm.php");

                        }

                    } else {

                        $_SESSION['msg-delete-user'] = "<div id='msg-erro'>Erro! Nenhum usuário cadastrado</div>";

                        header("Location: delete-users_adm.php");

                    }

                } else {

                    $_SESSION['msg-delete-user'] = "<div id='msg-erro'>Senha incorreta!</div>";

                    header("Location: delete-users_adm.php");

                }
            } else {

                $_SESSION['msg'] = "<div id='msg-erro'>Erro ao efetuar consulta. Cadastro não encontrado!</div>";

                header("Location: login.php");

            }
        } else {

            $_SESSION['msg-delete-user'] = "<div id='msg-erro'>Informe sua senha para excluir o usuário!</div>";

            header("Location: delete-users_adm.php");

        }

    } else {

        $_SESSION['msg-delete-user'] = "<div id='msg-erro'>Informe sua senha para excluir o usuário 1!</div>";
        header("Location: delete-users_adm.php");

    }

?>