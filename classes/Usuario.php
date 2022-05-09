<?php

    require_once 'Conexao.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'lib/vendor/autoload.php';

    Class Usuario {

        private $con;
        public $logado = false;


        public function __construct(){

            $this->con = Conexao::conectar();
            
        }

        public function bemVindo() {

            if (!empty($_SESSION['logado'])) {

                $select = $this->con->prepare("SELECT nome FROM usuarios WHERE id_usuario = :id");

                $select->bindValue(":id",$_SESSION['id_usuario']);
                $select->execute();

                if ($select->rowCount() > 0) {

                    $nome = $select->fetch();

                    $nome_usuario = $nome['nome'];

                    if ($_SESSION['nivel'] == 1) {

                        $user = "Que bom ter você aqui, " . $nome_usuario . " !";

                    } else if ($_SESSION['nivel'] == 2) {

                        $user = "Bem-vindo (a), ADM " . $nome_usuario . " !";

                    }

                }
            }

            return $user;

        }

        public function buscarDadosUsuario($email = "") {

            if($this->logado) {

                $select = $this->con->prepare("SELECT nome, email, senha FROM usuarios WHERE id_usuario = :id");
                $select->bindValue(":id",$_SESSION['id_usuario']);
                $select->execute();
            
                if ($select->execute()) {
            
                    if ($select->rowCount() > 0) {

                        $dadosUsuario = $select->fetch();
            
                    } else {

                        $dadosUsuario = "";
            
                        $_SESSION['erro-buscar-dados'] = "<div id='msg-erro'>Erro ao carregar suas informações de login! Recarregue a página para tentar novamente</div>";
            
                    }
                } else {

                    $dadosUsuario = "";
            
                    $_SESSION['erro-buscar-dados'] = "<div id='msg-erro'>Erro ao carregar suas informações de login! Recarregue a página para tentar novamente</div>";
            
                }
            }else {

                $select = $this->con->prepare("SELECT id_usuario, nome FROM usuarios WHERE email = :e");
                $select->bindValue(":e",$email);
                $select->execute();
                                        
                if ($select->rowCount() > 0) {

                    $dadosUsuario = $select->fetch();
                  
                }else {

                    $dadosUsuario = "";

                }

            }

            return $dadosUsuario;

        }

        public function cadastrar($nome,$email,$senha,$confSenha) {

            if ((!empty($nome) && !empty($email) && !empty($senha) && !empty($confSenha))) {

                if ($senha == $confSenha) {

                    $select = $this->con->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
                    $select->bindValue(":e",$email);
                    $select->execute();
                    
                    if ($select->rowCount() > 0) {       

                        $_SESSION['erro-cadastro'] = "<div id='msg-erro'>Email já cadastrado!</div>";

                        return false;
                        
                    } else {

                        $insert = $this->con->prepare("INSERT INTO usuarios(nome, email, senha) VALUES (:n, :e, :s)");

                        $insert->bindValue(":n",$nome);
                        $insert->bindValue(":e",$email);
                        $insert->bindValue(":s",md5($senha));
                        $insert->execute();              

                        $_SESSION['sucesso-cadastro'] = "<div id='msg-sucesso'>Cadastro realizado com sucesso!</div>";

                        return true;

                    }

                } else {

                    $_SESSION['erro-cadastro'] = "<div id='msg-erro'>Senha e Confirmar Senha não correspondem!</div>";

                    return false;

                }

            } else {
       
                $_SESSION['erro-cadastro'] = "<div id='msg-erro'>Preencha todos os campos!</div>";

                return false;
                    
            }

        }

        public function logar($email,$senha) {

            if (!empty($email) && !empty($senha)) {

                $_SESSION['logado'] = $email;

                $select = $this->con->prepare("SELECT id_usuario, nivel FROM usuarios WHERE email = :e AND senha = :s");

                $select->bindValue(":e",$email);
                $select->bindValue(":s",md5($senha));
                $select->execute();

                if ($select->rowCount() > 0) {

                    $dados = $select->fetch();

                    $_SESSION['id_usuario'] = $dados['id_usuario'];
                    $_SESSION['nivel'] = $dados['nivel'];
                    $this->logado = true;

                    return true;

                } else {

                    $_SESSION['erro-login'] = "<div id='msg-erro'>E-mail e/ou senha estão incoretos!</div>";

                    return false;

                }


            } else { 

                $_SESSION['erro-login'] = "<div id='msg-erro'>Preencha todos os campos!</div>";

                return false;

            }

        }

        public function editarUsuario($nome,$email) {

            if (!empty($nome) && !empty($email)) {

                $update = $this->con->prepare("UPDATE usuarios SET nome = :n, email = :e WHERE id_usuario = :id");
                $update->bindValue(":n",$nome);
                $update->bindValue(":e",$email);
                $update->bindValue(":id",$_SESSION['id_usuario']);
                $update->execute();

                if ($update->execute()) {

                    return true;

                } else {
                    
                    return false;
                }
            }

        }

        public function editarSenhaUsuario($senha,$novaSenha,$cNovaSenha) {

            $dados = $this->buscarDadosUsuario();

            if (!empty($senha) && !empty($novaSenha) && !empty($cNovaSenha)) {

                if ($dados['senha'] == md5($senha)) {

                    if ($novaSenha == $cNovaSenha) {

                        $update = $this->con->prepare("UPDATE usuarios SET senha = :ns WHERE id_usuario = :id");
                        $update->bindValue(":ns",md5($novaSenha));
                        $update->bindValue(":id",$_SESSION['id_usuario']);
                        $update->execute();

                        if ($update->execute()) {

                            $_SESSION['sucesso-editar-senha'] = "<div id='msg-sucesso'>Senha atualizada com sucesso!</div>";

                            return true;
    
                        } else {

                            $_SESSION['erro-editar-senha'] = "<div id='msg-erro'>ERRO! Tente novamente</div>";

                            return false;

                        }

                    } else {

                        $_SESSION['erro-editar-senha'] = "<div id='msg-erro'>Nova senha e Confirmar nova senha não correspondem!</div>";

                        return false;

                    }

                } else {

                    $_SESSION['erro-editar-senha'] = "<div id='msg-erro'>Erro! Senha atual incorreta</div>";

                    return false;

                }

            }else {

                $_SESSION['erro-editar-senha'] = "<div id='msg-erro'>Preencha todos os campos!</div>";

                return false;

            }

        }

        public function deletarConta($senha_popup) {

            if (!empty($senha_popup)){

                $select = $this->con->prepare("SELECT senha FROM usuarios WHERE id_usuario = :id");
                $select->bindValue(":id", $_SESSION['id_usuario']);
                $select->execute();
                                                
                if ($select->rowCount() > 0) {

                    $dados = $select->fetch();

                    $senha_usuario = $dados['senha'];

                    if ($senha_usuario == md5($senha_popup)) {

                        $delete = $this->con->prepare("DELETE FROM usuarios WHERE id_usuario = :id");
                        $delete->bindValue(":id",$_SESSION['id_usuario']);
                        $delete->execute();
                
                        if ($delete->execute()) {

                            $_SESSION['msg'] = "<div id='msg-sucesso'>Você excluiu sua conta com sucesso. Sentiremos sua falta... Pode se cadastrar novamente a qualquer momento!</div>";

                            $header = ("Location: login.php");


                        } else {

                            $_SESSION['msg-delete-acount'] = "<div id='msg-erro'>Erro! Tente novamente</div>";

                            $header = ("Location: edit-profile.php");

                        }
                    } else {

                        $_SESSION['msg-delete-acount'] = "<div id='msg-erro'>Senha incorreta!</div>";

                        $header = ("Location: edit-profile.php");

                    }
                } else {

                    $_SESSION['msg'] = "<div id='msg-erro'>Erro ao efetuar consulta. Cadastro não encontrado!</div>";

                    $header = ("Location: login.php");

                }

            }else {


                $_SESSION['msg-delete-acount'] = "<div id='msg-erro'>Informe sua senha para excluir sua conta!</div>";
                $header = ("Location: edit-profile.php");


            }

            return $header;

        }

        public function cadastrarAdm($nome,$email,$senha,$confSenha,$nivel){

            if ((!empty($nome) && !empty($email) && !empty($senha) && !empty($nivel))) {

                if ($senha == $confSenha) {

                    $select = $this->con->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
                    $select->bindValue(":e",$email);
                    $select->execute();
                    
                    if ($select->rowCount() > 0) {

                        $_SESSION['erro-cadastro'] = "<div id='msg-erro'>Email já cadastrado!</div>";

                        return false;
                        
                    } else {

                        $insert = $this->con->prepare("INSERT INTO usuarios(nome, email, senha, nivel) VALUES (:n, :e, :s, :ni)");

                        $insert->bindValue(":n",$nome);
                        $insert->bindValue(":e",$email);
                        $insert->bindValue(":s",md5($senha));
                        $insert->bindValue(":ni",$nivel);
                        $insert->execute();

                        $_SESSION['sucesso-cadastro'] = "<div id='msg-sucesso'>Cadastro realizado com sucesso!</div>";

                        return true;

                    }

                } else {

                    $_SESSION['erro-cadastro'] = "<div id='msg-erro'>Senha e Confirmar Senha não correspondem!</div>";

                    return false;

                }

            } else {
                
                $_SESSION['erro-cadastro'] = "<div id='msg-erro'>Preencha todos os campos!</div>";

                return false;
                    
            }

        }

        public function relacaoUsuarios(){

            $select = $this->con->prepare("SELECT id_usuario, nome, email FROM usuarios WHERE nivel != 2");

            $select->execute();

            if ($select->rowCount() > 0) {

                $usuario = $select->fetchAll();

                return $usuario;

            } else {

                $usuario = "";

                return $usuario;
                
            }
        }

        public function deletarUsuario($senha_popup,$id_del_user){

            if (!empty($senha_popup)) {

                $select = $this->con->prepare("SELECT senha FROM usuarios WHERE id_usuario = :id");
                $select->bindValue(":id", $_SESSION['id_usuario']);
                $select->execute();
                                                    
                if ($select->rowCount() > 0) {
    
                    $dados = $select->fetch();
    
                    $senha_usuario = $dados['senha'];
    
                    if ($senha_usuario == md5($senha_popup)) {
    
                        $select = $this->con->prepare("SELECT nome FROM usuarios WHERE md5(id_usuario) = :id");
                        $select->bindValue(":id",$id_del_user);
                        $select->execute();
    
                        if ($select->rowCount() > 0) {
    
                            $usuario = $select->fetch();
                            $nomeUsuario = $usuario['nome'];
    
                            $delete = $this->con->prepare("DELETE FROM usuarios WHERE md5(id_usuario) = :id");
                            $delete->bindValue(":id",$id_del_user);
                            $delete->execute();
                
                            if ($delete->execute()) {
    
                                $_SESSION['msg-delete-user'] = "<div id='msg-sucesso'>Você excluiu o usuário $nomeUsuario com sucesso!</div>";
    
                                $header = ("Location: delete-users_adm.php");
    
                            } else {
    
                                $_SESSION['msg-delete-user'] = "<div id='msg-erro'>Erro! Tente novamente</div>";
    
                                $header = ("Location: delete-users_adm.php");
    
                            }
    
                        } else {
    
                            $_SESSION['msg-delete-user'] = "<div id='msg-erro'>Erro! Nenhum usuário cadastrado</div>";
    
                            $header = ("Location: delete-users_adm.php");
    
                        }
    
                    } else {
    
                        $_SESSION['msg-delete-user'] = "<div id='msg-erro'>Senha incorreta!</div>";
    
                        $header = ("Location: delete-users_adm.php");
    
                    }
                } else {
    
                    $_SESSION['msg'] = "<div id='msg-erro'>Erro ao efetuar consulta. Cadastro não encontrado!</div>";
    
                    $header = ("Location: login.php");
    
                }
            } else {
    
                $_SESSION['msg-delete-user'] = "<div id='msg-erro'>Informe sua senha para excluir o usuário!</div>";
    
                $header = ("Location: delete-users_adm.php");
    
            }

            return $header;

        }

        public function enviarEmailRecuperacao($key_recover_password,$id_usuario,$nome_usuario,$email) {

            $update = $this->con->prepare("UPDATE usuarios SET chave_recuperar_senha = :k WHERE id_usuario = :id LIMIT 1");
            $update->bindValue(":k",$key_recover_password);
            $update->bindValue(":id",$id_usuario);
            $update->execute();

            if ($update->execute()) {

                $link = "http://localhost/prepara-if/update-password.php?key=$key_recover_password";

                $mail = new PHPMailer(true);

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
                    $mail->addAddress($email, $nome_usuario);     //Add a recipient

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

                    $retorno['trueOrfalse'] = true;
                    $retorno['header'] = ('location: login.php');

                }catch (Exception $e){

                    $retorno['trueOrfalse'] = false;
                    $retorno['header'] = "<div id='msg-erro'>Email não enviado. ERRO: {$mail->ErrorInfo}</div>";
                    
                }

            } else {

                $retorno['trueOrfalse'] = false;
                $retorno['header'] = "<div id='msg-erro'>Erro! Tente novamente</div>";

            }

            return $retorno;

        }

        public function mudarSenha($key,$novaSenha,$confSenha) {

            if (!empty($key)) {

                $select = $this->con->prepare("SELECT id_usuario FROM usuarios WHERE chave_recuperar_senha = :ch");
                $select->bindValue(":ch",$key);
                $select->execute();
                
                if ($select->rowCount() > 0) {

                    $id = $select->fetch();
                    $id_usuario = $id['id_usuario'];

                    $key  = 'NULL';

                    if (!empty($novaSenha) && !empty($confSenha)) {

                        if ($novaSenha == $confSenha) {

                            $update = $this->con->prepare("UPDATE usuarios SET senha = :ns, chave_recuperar_senha = :ch WHERE id_usuario = :iu");
                            $update->bindValue(":ns",md5($novaSenha));
                            $update->bindValue(":ch",$key);
                            $update->bindValue(":iu",$id_usuario);
                            $update->execute();

                            if ($update->execute()) {

                                $_SESSION['msg'] = "<div id='msg-sucesso'>Senha atualizada com sucesso!</div>";
                                $header = ('location: login.php');

                            } else {


                                $_SESSION['msg-rec-senha'] = "<div id='msg-erro'>ERRO! Tente novamente</div>";
                                $header = ('location: update-password.php');


                            }

                        } else {
                        
                            $_SESSION['msg-rec-senha'] = "<div id='msg-erro'>Senha e Confirmar Senha não correspondem!</div>";
                            $header = ('location: update-password.php');

                        }
                    } else {
                          

                        $_SESSION['msg-rec-senha'] = "<div id='msg-erro'>Preencha todos os campos!</div>";
                        $header = ('location: update-password.php');

    
                    }

                } else {

                    $_SESSION['msg-rec-senha'] = "<div id='msg-erro'>Link inválido! Digite email novamente para que um novo link possa ser gerado</div>";
                    $header = ('location: recover-password.php');

                }

            } else {

                $_SESSION['msg-rec-senha'] = "<div id='msg-erro'>Link inválido! Digite email novamente para que um novo link possa ser gerado</div>";
                $header = ('location: recover-password.php');

            }

            return $header;

        }

    }

?>