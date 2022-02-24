<?php
    session_start();

    if (!isset($_SESSION['id_usuario'])) {

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
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/downloads.css">
    <title>Provas do Subsequente</title>
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

    <main class="main" >

        <section class="initial" id="section-downloads">

            <div class="info" id="div-text-downloads">
                <h1>Provas do Subsequente</h1>
                <h2>Logo abaixo temos cards que direcionam para provas de anos anteriores do Subsequente! Clique para baixar!</h2>
            </div>
 
            <div class="image-right" id="img-r-downloads">
                <img src="images/prova.png" alt="Homem Jovem estudando" id="img-downloads">
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

                                        </a>
                                        
                                    </div>";
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

    <footer class="footer">
        &copy; 2021 Alguns direitos reservados
    </footer>

    <script src="js/toggle-menu.js"></script>

</body>
</html>