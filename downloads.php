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
    <title>Downloads</title>
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
                <h1>Downloads</h1>
                <h2>Logo abaixo temos cards que direcionam para provas de anos anteriores do Integrado e do Subsequente, faça sua escolha e baixe!</h2>
            </div>
 
            <div class="image-right" id="img-r-downloads">
                <img src="images/prova.png" alt="Homem Jovem estudando" id="img-downloads">
            </div>

        </section>

        <section class="second" id="section-downloads-2">

            <div class="cards" id="icards-downloads">

                <div class="card" id="ic-int">
                    <a  class="link-int-sub" id="int" href="downloads-integrado.php">

                        <p id="int-sub">Quero ver as  provas do Integrado</p>

                    </a>
                    
                </div>

                <div class="card" id="ic-sub">
                    <a class="link-int-sub" id="sub" href="downloads-subsequente.php">
                        <p id="int-sub">Quero ver as  provas do Subsequente</p>
                    </a>
                </div>

            </div>

        </section>

    </main>

    <footer class="footer">
        &copy; 2021 Alguns direitos reservados
    </footer>

    <script src="js/toggle-menu.js"></script>

</body>
</html>