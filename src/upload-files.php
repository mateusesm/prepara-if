<?php
    require_once 'authentication_adm.php';
    require_once '../classes/Documento.php';
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
    <title>Upload de Arquivos</title>
</head>
<body>

    <div class="container-content">

        <?php
            require_once 'header.php';
        ?>

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

                                $d = new Documento();

                                $cadastrado = $d->verificarSeDocumentoEstaCadastrado($nomeProva,$nomeGabarito);

                                if ($cadastrado) {

                                ?>

                                    <div id="msg-erro">Prova e gabarito já estão cadastrados!</div>

                                <?php
                                    
                                } else {

                                    $addDocumento = $d->addDocumento($modalidade,$temporarioProva,$temporarioGabarito,$nomeProva,$nomeGabarito,$ano);
                                
                                    if ($addDocumento) {

                                    ?>
        
                                        <div id='msg-sucesso'>Upload feito com sucesso!</div>

                                    <?php
                            
                                    } else {

                                    ?>
                                        <div id='msg-erro'>Não foi possível fazer o upload.</div>

                                    <?php

                                    }
                                }

                            } else {

                            ?>
                                <div id='msg-erro'>Formato inválido.</div>

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

    </div>

    <script src="https://kit.fontawesome.com/00d3e5c25f.js" crossorigin="anonymous"></script>
    <script src="../js/toggle-menu.js"></script>
</body>
</html>