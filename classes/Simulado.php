<?php

    require_once 'Conexao.php';
    require 'error.php';

    Class Simulado {

        private $con;


        public function __construct(){

            $this->con = Conexao::conectar();
            
        }

        public function buscarQuestoes($modalidade,$materia) {

            $selectQuestions = $this->con->prepare("SELECT questoes.id_questao, questoes.questao FROM questoes WHERE questoes.modalidade = :mo AND questoes.assunto = :ma order by RAND()");
            $selectQuestions->bindValue(":mo", $modalidade);
            $selectQuestions->bindValue(":ma", $materia);
            $selectQuestions->execute();

            if ($selectQuestions->rowCount() > 0) {

                $questions = $selectQuestions->fetchAll(PDO::FETCH_ASSOC);

                $_SESSION['questions'] = count($questions);

                return $questions;

            }else {

                $questions = "";
                return $questions;

            }
        }

        public function buscarAlternativas($id_questao) {

            $selectAlt = $this->con->prepare("SELECT alternativas.alternativa FROM alternativas WHERE alternativas.id_questao = :id_questao order by RAND()");
            $selectAlt->bindValue(":id_questao", $id_questao);
            $selectAlt->execute();

            if ($selectAlt->rowCount() > 0) {

                $alts = $selectAlt->fetchAll(PDO::FETCH_ASSOC);
                return $alts;

            } else {

                $alts = "";
                return $alts;

            }

        }

        public function analisarQuestoes($res) {

            $select = $this->con->prepare("SELECT alternativa FROM alternativas WHERE alternativa = :alt AND correta = 1");
            $select->bindValue(":alt", $res);
            $select->execute();

            if($select->rowCount() > 0) {

                $_SESSION['certas'] += 1;


            } else {

                $_SESSION['erradas'] += 1;

            }

        }

    }

?>