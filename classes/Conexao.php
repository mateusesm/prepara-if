<?php

    Class Conexao {

        private static $instancia;


        public function __construct(){}

        public static function conectar() {

            if (!isset(self::$instancia)) {

                $host = 'localhost';
                $dbname = 'prepara_if';
                $user = 'root';
                $password = '';

                try {

                    self::$instancia = new PDO('mysql:dbname='.$dbname.';host='.$host,$user,$password);
            
                    self::$instancia->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
                } catch(PDOException $e) {
            
                    echo '<div id="msg-erro">ERRO COM BANCO DE DADOS: ' . $e->getMessage() . '</div>';
            
                } catch(Exception $e) {
            
                    echo '<div id="msg-erro">ERRO GENÉRICO: ' . $e->getMessage() . '</div>';
            
                }
            }

            return self::$instancia;

        }

    }

?> 
 