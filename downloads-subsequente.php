<?php
    require_once 'authentication.php';
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

                <div class="cards" id="icards-downloads">

                    <?php

                        $select = $pdo->prepare("SELECT provas.prova, gabaritos.gabarito FROM provas JOIN gabaritos ON gabaritos.id_gabarito = provas.id_gabarito WHERE provas.modalidade = 'Subsequente' ORDER BY provas.prova DESC;");

                        $select->execute();

                        if ($select->rowCount() > 0) {

                            $documents = $select->fetchAll(PDO::FETCH_ASSOC);

                                for ($c = 0; $c < count($documents); $c++) {

                                    echo "<div class='card' id='ic-downloads'>
                                            
                                            <img src='images/pdf.png' alt='PDF'/>

                                            <a href='pdfs/subsequente/provas/" . $documents[$c]['prova'] . "'target='_blank'>

                                                <p id='prova'>

                                                    <span>Baixe já:</span>
                                                    <span>" . $documents[$c]['prova'] . "</span>

                                                </p>

                                            </a>

                                            <a href='pdfs/subsequente/gabaritos/" . $documents[$c]['gabarito'] . "' target='_blank'>

                                                <p id='gabarito'>

                                                    <span>Baixe já:</span>
                                                    <span>" . $documents[$c]['gabarito'] . "</span>

                                                </p>

                                            </a>";

                                            if ($_SESSION['nivel'] == 2) {

                                                echo "<div class='button-delete-documents'>

                                                <a href='delete-documents.php'>Excluir</a>

                                                </div>";

                                            }
                                            
                                        echo "</div>";
                                }

                        } else {

                            echo "<div class='card' id='ic-downloads'>
                                    
                                            <img  id='sad-face' src='images/sad-face.jpg' alt='Sad face'/>

                                            <a>

                                                <p id='unavailable'>

                                                    <span>Nenhuma prova ou gabarito disponíveis</span>

                                                </p>

                                            </a>
                                    </div>";
                            
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