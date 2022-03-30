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
    <link rel="stylesheet" href="css/simulated.css">
    <title>Simulado Língua Portuguesa</title>
</head>
<body>
    
    <div class="container-content">

        <?php
            require_once 'header.php';
        ?>


        <main class="main" >

            <section class="initial" id="section-main">

                <div class="info" id="div-text-downloads">
                    <h1>Simulado de Língua Portuguesa</h1>
                    <h2>Logo abaixo temos um simulado baseado nas questões de provas anteriores de Língua Portuguesa do Subsequente. Vai encarar?</h2>
                </div>
    
                <div class="image-right" id="img-r-main">
                    <img src="images/simulado.png" alt="Imagem prova com questão certa" id="img-main">
                </div>

            </section>

            <section class="second" id="id-container-simulated">

                <div class="container-simulated">

                    <?php

                        if (isset($_SESSION['msg'])) {

                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                        }

                    ?>

                    <h3>Simulado de Língua Portuguesa</h3>

                    <form action="analyze-questions.php?modalidade=subsequente-portugues" method="POST">

                        <?php

                            $selectQuestions = $pdo->prepare("SELECT questoes.id_questao, questoes.questao FROM questoes WHERE questoes.modalidade = 'Subsequente' AND questoes.assunto = 'Portugues' order by RAND()");

                            $selectQuestions->execute();

                            if ($selectQuestions->rowCount()) {

                                $questions = $selectQuestions->fetchAll(PDO::FETCH_ASSOC);

                                $_SESSION['questions'] = count($questions);

                                for ($c = 0; $c < count($questions); $c++) {

                                    $selectAlt = $pdo->prepare("SELECT alternativas.alternativa FROM alternativas WHERE alternativas.id_questao = :id_questao order by RAND()");
                                    $selectAlt->bindValue(":id_questao", $questions[$c]['id_questao']);
                                    $selectAlt->execute();

                                    if ($selectAlt->rowCount()) {

                                        $alts = $selectAlt->fetchAll(PDO::FETCH_ASSOC);
                                    
                                        $num += 1;

                                        echo "<fieldset>

                                            <legend>Questão 0$num</legend>
                                            
                                            <div class='questions'>

                                                <p>{$questions[$q]['questao']}:</p>

                                                <p>Marque a alternativa correta:</p>";


                                            for ($a = 0; $a < count($alts); $a++) {
                    
                                                switch ($a) {

                                                    case 0:
                                                        $l = 'A';
                                                        break;

                                                    case 1:
                                                        $l = 'B';
                                                        break;

                                                    case 2:
                                                        $l = 'C';
                                                        break;

                                                    case 3:
                                                        $l = 'D';
                                                        break;

                                                }

                                               echo "<label>$l. <input type='radio' value='{$alts[$a]['alternativa']}' name='alt-$num' id='a'> {$alts[$a]['alternativa']}</label>";

                                            }
                    
                                        echo "</div>
                                        
                                        </fieldset>";

                                    }

                                }

                                echo "<input id='submit-questions' type='submit' value='Enviar' name='submit-simulated'>";

                            } else {

                                echo "<fieldset>

                                <legend>Nada encontrado</legend>
                                
                                <div class='questions'>

                                    <p>É possível que as questões e suas respectivas alternativas ainda não foram cadastradas para este simulado.</p>

                                </div>

                                </fieldset>";

                            }

                        ?>
                        
                    </form>

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