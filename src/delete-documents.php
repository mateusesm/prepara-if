<?php

    require_once 'authentication_adm.php';
    require_once '../classes/Documento.php';
    require 'error.php';

    $id_documento = sprintf($_GET['document']);

    $modalidade_get = addslashes($_GET['modalidade']);

    $d = new Documento();

    $header = $d->deletarDocumento($id_documento,$modalidade_get);

    header($header);

?>