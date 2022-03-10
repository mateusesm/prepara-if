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
    <link rel="stylesheet" href="css/downloads.css">
    <title>Downloads</title>
</head>
<body>
    
    <?php
        require_once 'header.php';
    ?>

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

   
    <?php
        require_once 'footer.php';
    ?>

    <script src="js/toggle-menu.js"></script>

</body>
</html>