<?php
    require_once 'authentication.php';
    require_once 'classes/Usuario.php';
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
    <title>Bem-vindo ao Prepara IF</title>
</head>
<body>

    <div class="container-content">

        <?php
            require_once 'header.php';
        ?>

        <main class="main" >

            <section class="initial" id="section-main">

                <div class="info" id="div-text-main">
                    <h1>

                        <?php

                            $u = new Usuario();
                            
                            $bemVindo = $u->bemVindo();

                            echo $bemVindo;

                        ?>

                    </h1>

                    <h2>Abaixo temos cards que direcionam para nossos conteúdos, bons estudos!</h2>
                
                </div>
    
                <div class="image-right" id="img-r-main">
                    <img src="images/study-man.jpg" alt="Homem Jovem estudando" id="img-main">
                </div>

            </section>

            <section class="second" id="section-main-2">
                <div class="cards" id="icards-main">

                    <div class="card" id="prova">
                        <a href="downloads.php">
                            <img src="images/prova.png" alt="Prova">
                            <p>Downloads de provas anteriores</p>
                        </a>
                    </div>
            

                    <div class="card" id="redacao">
                        <a href="redaction.php">
                            <img src="images/redacao.png" alt="Redação">
                            <p>Temas de redações anteriores</p>
                        </a>
                    </div>

                    <div class="card" id="simulado">
                        <a href="simulated.php">
                            <img src="images/simulado.png" alt="Simulado">
                            <p>Simulados</p>
                        </a>
                    </div>

                    <div class="card" id="dica">
                        <a href="tips.php">
                            <img src="images/dica.png" alt="Dica">
                            <p>Dicas de estudo</p>
                        </a>
                    </div>
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