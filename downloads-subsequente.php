<?php
    require_once 'authentication.php';
    require_once 'classes/Documento.php';
    require 'error.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <link rel="shortcut icon" href="images/book.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/downloads.css">
    <title>Provas do Subsequente</title>
</head>
<body>
    
    <div class="container-content">

        <?php
            require_once 'header.php';
        ?>

        <main class="main" >

            <section class="initial" id="section-main">

                <div class="info" id="div-text-downloads">
                    <h1>Provas do Subsequente</h1>
                    <h2>Logo abaixo temos cards que direcionam para provas de anos anteriores do Subsequente! Clique para baixar!</h2>
                </div>
    
                <div class="image-right" id="img-r-main">
                    <img src="images/prova.png" alt="Homem Jovem estudando" id="img-main">
                </div>

            </section>

            <section class="second" id="section-downloads-2">


                <?php


                    if (isset($_SESSION['msg-delete-documents'])) {

                        echo $_SESSION['msg-delete-documents'];
                        unset($_SESSION['msg-delete-documents']);
                    }

                    if (isset($_SESSION['div-delete-documents'])) {

                        echo $_SESSION['div-delete-documents'];
                        unset($_SESSION['div-delete-documents']);
                        
                    }

                ?>

                <div class="cards" id="icards-downloads">

                    <?php

                        $d = new Documento();

                        $modalidade = 'Subsequente';

                        $documentos = $d->buscarDocumentos($modalidade);

                        if ($documentos > 0) {

                            $documents = $select->fetchAll(PDO::FETCH_ASSOC);

                                for ($c = 0; $c < count($documentos); $c++) {

                                    echo "<div class='card' id='ic-downloads'>
                                            
                                            <img src='images/pdf.png' alt='PDF'/>

                                            <a href='pdfs/subsequente/provas/" . $documentos[$c]['prova'] . "'target='_blank'>

                                                <p id='prova'>

                                                    <span>Baixe já:</span>
                                                    <span>" . $documentos[$c]['prova'] . "</span>

                                                </p>

                                            </a>

                                            <a href='pdfs/subsequente/gabaritos/" . $documentos[$c]['gabarito'] . "' target='_blank'>

                                                <p id='gabarito'>

                                                    <span>Baixe já:</span>
                                                    <span>" . $documentos[$c]['gabarito'] . "</span>

                                                </p>

                                            </a>";

                                            if ($_SESSION['nivel'] == 2) {

                                                $num = array();

                                                $num = $documentos[$c]['id_gabarito'];

                                                $num_cripto = md5($num);

                                                echo "<div class='button-delete-documents'>

                                                <a id='excluir_documento' href='delete-popup-documents.php?modalidade=Subsequente&document=$num_cripto'>Excluir</a>

                                                </div>";

                                            }
                                            
                                        echo "</div>";
                                }

                        } else {

                        ?>

                            <div class='card' id='ic-downloads'>
                                    
                                <img  id='sad-face' src='images/sad-face.jpg' alt='Sad face'/>

                                    <a>

                                        <p id='unavailable'>

                                            <span>Nenhuma prova ou gabarito disponíveis</span>

                                        </p>

                                    </a>
                            </div>";

                        <?php
                            
                        }

                    ?>

                </div>

            </section>

        </main>

        <?php
            require_once 'footer.php';
        ?>

    </div>

    <script src="js/toggle-menu.js"></script>

</body>
</html>