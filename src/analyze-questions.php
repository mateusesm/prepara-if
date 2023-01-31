<?php

    require_once 'authentication.php';
    require_once '../classes/Simulado.php';
    require 'error.php';

    $res = array();

    $_SESSION['certas'] = 0;
    $_SESSION['erradas'] = 0;

    $num = 0;

    for ($c = 0; $c < $_SESSION['questions']; $c++) {

        $num += 1;

        if (!empty($_POST['submit-simulated']) && !empty($_POST['alt-'.$num])) {
        
            $res[$c] = $_POST['alt-'.$num];

            $s = new Simulado();

            $s->analisarQuestoes($res[$c]);

        } else {

            $_SESSION['msg'] = "<div id='msg-erro'>Marque todas as alternativas para enviar o simulado!</div>";

            if ($_GET['modalidade'] == 'integrado-matematica') {

                header("location: int-simulated-math.php");
        
            } else if ($_GET['modalidade'] == 'integrado-portugues') {
        
                header("location: int-simulated-portuguese.php");
        
            } else if ($_GET['modalidade'] == 'subsequente-matematica') {
        
                header("location: sub-simulated-math.php");
        
            } else if ($_GET['modalidade'] == 'subsequente-portugues') {
        
                header("location: sub-simulated-portuguese.php");
        
            }

        }

    }

    if (($_SESSION['certas'] > $_SESSION['erradas']) && ($_SESSION['certas'] > 0)) {

        $_SESSION['msg'] = "<div id='msg-sucesso'>Parabéns! Você acertou {$_SESSION['certas']} / {$_SESSION['questions']}</div>";

    } else if (($_SESSION['certas'] == $_SESSION['erradas']) && ($_SESSION['certas'] && $_SESSION['erradas'] != 0)) {

        $_SESSION['msg'] = "<div id='msg-normal'>Nada mal, mas fique esperto! Você acertou {$_SESSION['certas']} / {$_SESSION['questions']}</div>";

    } else if (($_SESSION['certas'] < $_SESSION['erradas']) && ($_SESSION['erradas'] > 0)) {

        $_SESSION['msg'] = "<div id='msg-erro'>Alerta vermelho! Vá estudar agora! Você acertou {$_SESSION['certas']} / {$_SESSION['questions']}</div>";

    }

    if ($_GET['modalidade'] == 'integrado-matematica') {

        header("location: int-simulated-math.php");

    } else if ($_GET['modalidade'] == 'integrado-portugues') {

        header("location: int-simulated-portuguese.php");

    } else if ($_GET['modalidade'] == 'subsequente-matematica') {

        header("location: sub-simulated-math.php");

    } else if ($_GET['modalidade'] == 'subsequente-portugues') {

        header("location: sub-simulated-portuguese.php");

    }    

?>