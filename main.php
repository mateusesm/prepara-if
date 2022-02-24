<?php
    require_once 'authentication.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/book.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/main.css">
    <title>Prepara IF</title>
</head>
<body>

    <?php
        require_once 'header.php';
    ?>

    <main class="main" >

        <section class="initial" id="section-main">

            <div class="info" id="div-text-main">
                <h1>

                    <?php

                        if (!empty($_SESSION['logado'])) {

                            $select = $pdo->prepare("SELECT nome FROM usuarios WHERE id_usuario = :id");

                            $select->bindValue(":id",$_SESSION['id_usuario']);
                            $select->execute();

                            if ($select->rowCount() > 0) {

                                $nome = $select->fetch();

                                $nome_usuario = $nome['nome'];

                                if ($_SESSION['nivel'] == 1) {

                                    echo "Que bom ter você aqui, " . $nome_usuario . " !";

                                } else if ($_SESSION['nivel'] == 2) {

                                    echo "Bem-vindo (a), ADM " . $nome_usuario . " !";

                                }

                            }  
                        }
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

    <script src="js/toggle-menu.js"></script>
    
</body>
</html>