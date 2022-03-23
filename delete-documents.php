<?php

    require_once 'authentication_adm.php';

    $id = sprintf($_GET['document']);

    print_r($id);

    $modalidade_get = addslashes($_GET['modalidade']);

    $select = $pdo->prepare("SELECT provas.prova, gabaritos.gabarito, provas.id_gabarito, provas.modalidade FROM provas JOIN gabaritos ON gabaritos.id_gabarito = provas.id_gabarito WHERE md5(provas.id_gabarito) = :id");

    $select->bindValue(":id", $id);
    $select->execute();

    if ($select->rowCount() > 0) {

        $dados = $select->fetch();

        $nomeProva = $dados['prova'];
        $nomeGabarito = $dados['gabarito'];
        $modalidade = $dados['modalidade'];
        $id_gabarito = $dados['id_gabarito'];

        $deleteProva = $pdo->prepare("DELETE FROM provas WHERE id_gabarito = :id");
        $deleteProva->bindValue(":id",$id_gabarito);
        $deleteProva->execute();

        $deleteGabarito = $pdo->prepare("DELETE FROM gabaritos WHERE id_gabarito = :id");
        $deleteGabarito->bindValue(":id",$id_gabarito);
        $deleteGabarito->execute();

        if ($deleteProva->execute() && $deleteGabarito->execute()) {

            if ($modalidade == 'Integrado') {

                $prova = "pdfs/integrado/provas/$nomeProva";
                $gabarito = "pdfs/integrado/gabaritos/$nomeGabarito";

                unlink($prova);
                unlink($gabarito);

                $_SESSION['msg-delete-documents'] = "<div id='msg-sucesso'>Arquivos excluídos com sucesso!</div>";

                header("Location: downloads-integrado.php");

            } else if ($modalidade == 'Subsequente') {

                $prova = "pdfs/subsequente/provas/$nomeProva";
                $gabarito = "pdfs/subsequente/gabaritos/$nomeGabarito";

                unlink($prova);
                unlink($gabarito);

                $_SESSION['msg-delete-documents'] = "<div id='msg-sucesso'>Arquivos excluídos com sucesso!</div>";

                header("Location: downloads-subsequente.php");

            }

        } else {

            $_SESSION['msg-delete-documents'] = "<div id='msg-erro'>ERRO! Tente novamente</div>";

            if ($modalidade == 'Integrado') {

                header("Location: downloads-integrado.php");


            } else if ($modalidade == 'Subsequente') {

                header("Location: downloads-subsequente.php");

            }

        }

    } else {


        $_SESSION['msg-delete-documents'] = "<div id='msg-erro'>ERRO! Arquivos não encontrados no banco de dados</div>";

        if ($modalidade_get == 'Integrado') {

            header("Location: downloads-integrado.php");


        } else if ($modalidade_get == 'Subsequente') {

            header("Location: downloads-subsequente.php");

        }

    }

?>