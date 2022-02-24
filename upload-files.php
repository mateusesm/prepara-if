<?php

    session_start();

    if (!isset($_SESSION['id_usuario']) && $_SESSION['nivel'] != 2) {

        header('HTTP/1.0 403 Forbidden');
        exit;

    } else {

        include 'php/conexao.php';

    }

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
    <title>Upload de Arquivos</title>
</head>
<body>

    <header class="header">
            <div class="container-menu">
                <a href="main.php"><h1 class="logo">Prepara IF</h1></a>

               <nav id="menu">

                    <button aria-label="Abrir Menu" class="botao-mobile" aria-haspopup="true" aria-controls="menu-section" aria-expanded="false">

                        <div class="hamburguer"></div>

                    </button>

                    <ul class="menu-section" role="menu">
    
                        <li><a href="#">Ajuda</a></li>
                        <li><a href="#">Fale conosco</a></li>
                        <?php

                            if ($_SESSION['nivel'] == 2) {

                            ?>

                                <li><a href="upload-files.php">Adicionar provas e gabaritos</a></li>
                                <li><a href="reg_adm.php">Novo Administrador</a></li>
                                <li><a href="#" id="del">Excluir Usuário</a></li>

                            <?php

                            }

                        ?>
                        <li><a href="get-out.php" id="sair">Sair</a></li>

                    </ul>
                </nav>
            </div>
    </header>


    <main class="main">
            
        <section class="login">
            
            <form class="form_login" method="POST" action="upload-files.php" enctype="multipart/form-data">

                <h1>Envie seu arquivo PDF para o servidor</h1>

                <p><label for="file-prova">Insira a prova:</label>

                <i class="fas fa-file"></i>

                <input class="box" id="file" type="file" name="file-prova" maxlength="50"></p>

                <p><label for="file-gabarito">Insira o gabarito:</label>

                <i class="fas fa-file"></i>

                <input class="box" id="file" type="file" name="file-gabarito" maxlength="50"></p>


                <p><label for="modalidade">Escolha a modalidade:</label></p>

                <i class="fas fa-check"></i>


                <select name="modalidade">

                    <option>Integrado</option>
                    <option>Subsequente</option>

                </select>


                <p><label for="ano">Insira o ano:</label>

                <i class="fas fa-pen"></i>

                <input class="box" id="ano" type="text" name="ano" placeholder="Ano da prova" maxlength="50"></p>


                <input class="button" type="submit" value="Enviar" name="enviar">

                <?php
                    if(isset($_POST['enviar'])) {

                        $formatoPermitido = 'pdf';
                        $extensaoProva = pathinfo($_FILES['file-prova']['name'], PATHINFO_EXTENSION);
                        $extensaoGabarito = pathinfo($_FILES['file-gabarito']['name'], PATHINFO_EXTENSION);

                        if (($extensaoProva && $extensaoGabarito) == $formatoPermitido) {

                            $ano = $_POST['ano'];
                            $modalidade = $_POST['modalidade'];
                            
                            $temporarioProva = $_FILES['file-prova']['tmp_name'];
                            $temporarioGabarito = $_FILES['file-gabarito']['tmp_name'];
                
                            $nomeProva = $_FILES['file-prova']['name'];
                            $nomeGabarito = $_FILES['file-gabarito']['name'];

                            $selectProva = $pdo->prepare("SELECT id_prova FROM provas WHERE prova = :p");
                            $selectProva->bindValue(":p",$nomeProva);
                            $selectProva->execute();

                            $selectGabarito = $pdo->prepare("SELECT id_gabarito FROM gabaritos WHERE gabarito = :g");
                            $selectGabarito->bindValue(":g",$nomeGabarito);
                            $selectGabarito->execute();

                            if ($selectProva->rowCount() > 0 || $selectGabarito->rowCount() > 0) {

                                ?>

                                <div id="msg-erro">Prova e gabarito já estão cadastrados!</div>

                                <?php
                                
                            } else {

                              
                                if ($modalidade == "Integrado") {
                    
                                    $pastaProvas = "pdfs/integrado/provas/";
                                    $pastaGabaritos = "pdfs/integrado/gabaritos/";
                        
                                    if ((move_uploaded_file($temporarioProva, $pastaProvas.$nomeProva)) && (move_uploaded_file($temporarioGabarito, $pastaGabaritos.$nomeGabarito))) {
                                        
                                        $insert = $pdo->prepare("INSERT INTO gabaritos(gabarito, modalidade, ano) VALUES (:g, :m, :a)");
    
                                        $insert->bindValue(":g",$nomeGabarito);
                                        $insert->bindValue(":m",$modalidade);
                                        $insert->bindValue(":a",$ano);
                                        $insert->execute();
    
                                        $select = $pdo->prepare("SELECT id_gabarito FROM gabaritos WHERE ano = :a");
                                        $select->bindValue(":a",$ano);
                                        $select->execute();
    
                                        $id = $select->fetch();
                                        $id_gabarito = $id['id_gabarito'];
    
                                        $insert = $pdo->prepare("INSERT INTO provas(prova, modalidade, ano, id_gabarito) VALUES (:p, :m, :a, :ig)");
    
                                        $insert->bindValue(":p",$nomeProva);
                                        $insert->bindValue(":m",$modalidade);
                                        $insert->bindValue(":a",$ano);
                                        $insert->bindValue(":ig",$id_gabarito);
                                        $insert->execute();
    
                                        echo "<div id='msg-sucesso'>Upload feito com sucesso!</div>";
                        
                                    } else {
                                        echo "<div id='msg-erro'>Não foi possível fazer o upload.</div>";
                                    }
                        
                                } else if ($modalidade == "Subsequente") {
                        
                                    $pastaProvas = "pdfs/subsequente/provas/";
                                    $pastaGabaritos = "pdfs/subsequente/gabaritos/";
                        
                                    if ((move_uploaded_file($temporarioProva, $pastaProvas.$nomeProva)) && (move_uploaded_file($temporarioGabarito, $pastaGabaritos.$nomeGabarito))) {
                        
                                        $insert = $pdo->prepare("INSERT INTO gabaritos(gabarito, modalidade, ano) VALUES (:g, :m, :a)");
    
                                        $insert->bindValue(":g",$nomeGabarito);
                                        $insert->bindValue(":m",$modalidade);
                                        $insert->bindValue(":a",$ano);
                                        $insert->execute();
    
                                        $select = $pdo->prepare("SELECT id_gabarito FROM gabaritos WHERE ano = :a");
                                        $select->bindValue(":a",$ano);
                                        $select->execute();
    
                                        $id = $select->fetch();
                                        $id_gabarito = $id['id_gabarito'];
    
                                        $insert = $pdo->prepare("INSERT INTO provas(prova, modalidade, ano, id_gabarito) VALUES (:p, :m, :a, :ig)");
    
                                        $insert->bindValue(":p",$nomeProva);
                                        $insert->bindValue(":m",$modalidade);
                                        $insert->bindValue(":a",$ano);
                                        $insert->bindValue(":ig",$id_gabarito);
                                        $insert->execute();
    
                                        echo "<div id='msg-sucesso'>Upload feito com sucesso!</div>";
                        
                                    } else {
                                        echo "<div id='msg-erro'>Não foi possível fazer o upload.</div>";
                                    }
                        
                                }
                            }

                        } else {
                            echo "<div id='msg-erro'>Formato inválido.</div>";
                        }

                    } 
               
                ?>

            </form>

        </section>
    </main>
        
    <footer class="footer">
        &copy; Alguns direitos reservados
    </footer>

    <script src="https://kit.fontawesome.com/00d3e5c25f.js" crossorigin="anonymous"></script>
    <script src="js/toggle-menu.js"></script>
</body>
</html>