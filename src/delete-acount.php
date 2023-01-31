<?php

    require_once 'authentication.php';
    require_once '../classes/Usuario.php';
    require 'error.php';

    if (!empty($_POST['delete-acount'])) {

        $senha_popup = addslashes($_POST['password-popup']);

        $u = new Usuario();

        $header = $u->deletarConta($senha_popup);

        header($header);

    }

?>