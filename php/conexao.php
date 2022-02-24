<?php

    //include '../css/login.css';

    try {

        $host = 'localhost';
        $dbname = 'prepara_if';
        $username = 'root';
        $password = '';

        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username,$password);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch(PDOException $e) {

        echo '<div id="msg-erro">ERRO COM BANCO DE DADOS: ' . $e->getMessage() . '</div>';

    } catch(Exception $e) {

        echo '<div id="msg-erro">ERRO GENÉRICO: ' . $e->getMessage() . '</div>';

    }
?> 
 