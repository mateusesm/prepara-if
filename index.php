<?php
    include 'php/conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <link rel="shortcut icon" href="images/book.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <title>Prepara IF</title>
</head>
<body>

    <div class="container-content">
        
        <?php
            require_once 'header-index.php';
        ?>

        <main class="main" >

            <section class="initial">

                <div class="info" >
                    <h1>Bem-vindo ao Prepara IF</h1>
                    <h2>Desenvolvido por estudantes do IFRN para quem quer se tornar estudante do IFRN</h2>
                    
                    <a href="registration.php" id="button">
                        <div>
                            Cadastre-se
                        </div>
                    </a>

                    <div class="sub-text"><p>Já tem uma conta? <a href="login.php" id="log">Faça login</a> </p></div>
                </div>
                
                <div class="image-right" >
                    <img src="images/devices2.png" alt="Dispositivos" id="img-index">
                </div>

            </section>

            <section class="second">
            <div class="cards">
                <div class="card" id="prova">
                    <img src="images/prova.png" alt="Prova">
                    <p>Downloads de provas anteriores</p>
                </div>

                <div class="card" id="redacao">
                    <img src="images/redacao.png" alt="Redação">
                    <p>Temas de redações anteriores</p>
                </div>

                <div class="card" id="simulado">
                    <img src="images/simulado.png" alt="Simulado">
                    <p>Simulados</p>
                </div>

                <div class="card" id="dica">
                    <img src="images/dica.png" alt="Dica">
                    <p>Dicas de estudo</p>
                </div>
            </div>   
            </section>

            <section class="third">
                <article class="about">
                    <h1>Um pouco sobre nós</h1>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;Somos alunos do IFRN campus Mossoró, e idealizamos esta aplicação web para o projeto da disciplina de desenvolvimento de software. O objetivo do site é ajudar pessoas que querem ingressar no IFRN, mas que estão perdidos nos estudos para a prova, nosso intuito é ajudar disponibilizando provas anteriores, temas de redações anteriores, pequenos simulados de questões que já caíram em prova e dicas de estudo.</p>
                </article>
            </section>

        </main>
        
        <footer class="footer">
            &copy; 2021 Alguns direitos reservados
        </footer>

    </div>

    <script src="js/toggle-menu.js"></script>
</body>
</html>