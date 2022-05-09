<?php

    session_start();

    if (!isset($_SESSION['id_usuario'])) {

        header('HTTP/1.0 403 Forbidden');
        exit;

    }

?>