<?php

    require_once 'authentication.php';

    $num_cripto = addslashes($_GET['document']);

    $modalidade_get = addslashes($_GET['modalidade']);

    $_SESSION['div-delete-documents'] = "<div class='container-ic-delete'>
    
    
    <div class='ic-delete'>

        <img  id='sad-face-delete' src='images/sad-face.jpg' alt='Sad face'/>

            <p id='delete-sad'>

                Tem certeza que deseja excluir os arquivos?

            </p>

            <div class='buttons-delete'>

                <div class='button-yes-delete'>
                    <a href='delete-documents.php?modalidade=$modalidade_get&document=$num_cripto'>Sim</a>
                </div>

                <div class='button-no-delete'>
                    <a href='downloads-integrado.php'>Não</a>
                </div>

            </div>

        </form>

    </div>
    
</div>";

    if ($modalidade_get == 'Integrado') {

        header("Location: downloads-integrado.php");


    } else if ($modalidade_get == 'Subsequente') {

        header("Location: downloads-subsequente.php");

    }

?>