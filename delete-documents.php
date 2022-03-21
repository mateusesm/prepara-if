<?php

    require_once 'authentication_adm.php';

    $id = sprintf($_GET['document']);

    $select = $pdo->prepare("SELECT id_gabarito FROM provas");
    $select->execute();

    if ($select->rowCount() > 0) {

        $ids = $select->fetchAll();

        for ($c = 0; $c <= count($ids); $c++) {

            if ($id == md5($ids[$c]['id_gabarito'])) {

                $deleteProva->prepare("DELETE FROM provas WHERE md5(id_gabarito) = :id");
                $deleteProva->bindValue(":id",$id);
                $deleteProva->execute();

                $deleteGabarito->prepare("DELETE FROM gabaritos WHERE md5(id_gabarito) = :id");
                $deleteGabarito->bindValue(":id",$id);
                $deleteGabarito->execute();

                if ($deleteProva->execute() && $deleteGabarito->execute()) {

                    $_SESSION['msg-delete-documents'] = "<div id='msg-sucesso'>Arquivos excluídos com sucesso!</div>";

                    header("Location: downloads-integrado.php");

                } else {

                    $_SESSION['msg-delete-documents'] = "<div id='msg-erro'>ERRO! Tente novamente</div>";

                    header("Location: downloads-integrado.php");

                }

            }

        }

    } else {

        $_SESSION['msg-delete-documents'] = "<div id='msg-erro'>ERRO! Arquivos não encontrados no banco de dados</div>";

        header("Location: downloads-integrado.php");

    }

?>