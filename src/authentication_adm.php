<?php

    session_start();

    if (!isset($_SESSION['id_usuario']) && $_SESSION['nivel'] != 2) {

        header('HTTP/1.0 403 Forbidden');
        exit;

    }
    
?>