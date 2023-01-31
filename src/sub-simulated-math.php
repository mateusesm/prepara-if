<?php
    require_once 'authentication.php';
    require_once '../classes/Simulado.php';
    require 'error.php';
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
    <link rel="stylesheet" href="../css/simulated.css">
    <title>Simulado Matemática</title>
</head>
<body>
    
    <div class="container-content">

        <?php
            require_once 'header.php';
        ?>


        <main class="main" >

            <section class="initial" id="section-main">

                <div class="info" id="div-text-downloads">
                    <h1>Simulado de Matemática</h1>
                    <h2>Logo abaixo temos um simulado baseado nas questões de provas anteriores de Matemática do Subsequente. Vai encarar?</h2>
                </div>
    
                <div class="image-right" id="img-r-main">
                    <img src="../images/simulado.png" alt="Imagem prova com questão certa" id="img-main">
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

                    <h3>Simulado de Matemática</h3>

                    <form action="analyze-questions.php?modalidade=subsequente-matematica" method="POST">

                          <?php

                                $modalidade = 'Subsequente';
                                $materia = 'Matematica';

                                $s = new Simulado();

                                $questions = $s->buscarQuestoes($modalidade,$materia);

                                if ($questions > 0) {

                                    $num = 0;

                                    for ($q = 0; $q < count($questions); $q++) {

                                        $alts = $s->buscarAlternativas($questions[$q]['id_questao']);

                                        if ($alts > 0) {
                                        
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

                                            ?>
                        
                                                </div>
                                            
                                            </fieldset>

                                            <?php

                                        }
                                            
                                    }

                                    ?>

                                    <input id='submit-questions' type='submit' value='Enviar' name='submit-simulated'>

                                    <?php

                                } else {

                                    ?>

                                    <fieldset>

                                        <legend>Nada encontrado</legend>
                                    
                                        <div class='questions'>

                                            <p>É possível que as questões e suas respectivas alternativas ainda não foram cadastradas para este simulado.</p>
                
                                        </div>
                                
                                    </fieldset>

                                    <?php

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

    <script src="../js/toggle-menu.js"></script>

</body>
</html>