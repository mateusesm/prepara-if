<?php
    require_once 'authentication.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/book.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/downloads.css">
    <title>Redações</title>
</head>
<body>

    <div class="container-content">

        <?php
            require_once 'header.php';
        ?>

        <main class="main" >

            <section class="initial" id="section-main">

                <div class="info" id="div-text-downloads">
                    <h1>Redações</h1>
                    <h2>Logo abaixo temos cards que direcionam para temas de redações de anos anteriores. Dê uma olhada!</h2>
                </div>
    
                <div class="image-right" id="img-r-main">
                    <img src="../images/redacao.png" alt="Homem com lápis" id="img-main">
                </div>

            </section>

            <section class="second" id="section-downloads-2">

                <div class="cards" id="icards-downloads">

                    <div class="card" id="ic-downloads">
                        <a href="#">
                            <p>Temas de redações anteriores</p>
                        </a>
                    </div>

                    <div class="card" id="ic-downloads">
                        <a href="#">
                            <p>Temas de redações anteriores</p>
                        </a>
                    </div>

                    <div class="card" id="ic-downloads">
                        <a href="#">
                            <p>Temas de redações anteriores</p>
                        </a>
                    </div>

                    <div class="card" id="ic-downloads">
                        <a href="#">
                            <p>Temas de redações anteriores</p>
                        </a>
                    </div>

                    <div class="card" id="ic-downloads">
                        <a href="#">
                            <p>Temas de redações anteriores</p>
                        </a>
                    </div>

                    <div class="card" id="ic-downloads">
                        <a href="#">
                            <p>Temas de redações anteriores</p>
                        </a>
                    </div>

                </div>

            </section>

        </main>

        <?php
            require_once 'footer.php';
        ?>
        
    </div>

    <script src="../js/toggle-menu.js"></script>

</body>
</html>