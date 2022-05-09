<?php

    require_once 'Conexao.php';

    Class Documento {

        private $con;


        public function __construct(){

            $this->con = Conexao::conectar();
            
        }

        public function buscarDocumentos($modalidade) {

            $select = $this->con->prepare("SELECT provas.prova, gabaritos.gabarito, provas.id_gabarito FROM provas JOIN gabaritos ON gabaritos.id_gabarito = provas.id_gabarito WHERE provas.modalidade = :m ORDER BY provas.prova DESC");

            $select->bindValue(":m",$modalidade);

            $select->execute();
                    
            if ($select->rowCount() > 0) {

                $documentos = $select->fetchAll(PDO::FETCH_ASSOC);

                return $documentos;

            }else {

                $documentos = "";

                return $documentos;

            }

        }

        public function verificarSeDocumentoEstaCadastrado($nomeProva,$nomeGabarito) {

            $selectProva = $this->con->prepare("SELECT id_prova FROM provas WHERE prova = :p");
            $selectProva->bindValue(":p",$nomeProva);
            $selectProva->execute();

            $selectGabarito = $this->con->prepare("SELECT id_gabarito FROM gabaritos WHERE gabarito = :g");
            $selectGabarito->bindValue(":g",$nomeGabarito);
            $selectGabarito->execute();

            if ($selectProva->rowCount() > 0 || $selectGabarito->rowCount() > 0) {

                return true;

            }else {

                return false;

            }

        }

        public function addDocumento($modalidade,$temporarioProva,$temporarioGabarito,$nomeProva,$nomeGabarito,$ano) {

            if ($modalidade == "Integrado") {
                        
                $pastaProvas = "pdfs/integrado/provas/";
                $pastaGabaritos = "pdfs/integrado/gabaritos/";
    
                if ((move_uploaded_file($temporarioProva, $pastaProvas.$nomeProva)) && (move_uploaded_file($temporarioGabarito, $pastaGabaritos.$nomeGabarito))) {
                    
                    $insert = $this->con->prepare("INSERT INTO gabaritos(gabarito, modalidade, ano) VALUES (:g, :m, :a)");

                    $insert->bindValue(":g",$nomeGabarito);
                    $insert->bindValue(":m",$modalidade);
                    $insert->bindValue(":a",$ano);
                    $insert->execute();

                    $select = $this->con->prepare("SELECT id_gabarito FROM gabaritos WHERE ano = :a");
                    $select->bindValue(":a",$ano);
                    $select->execute();

                    $id = $select->fetch();
                    $id_gabarito = $id['id_gabarito'];

                    $insert = $this->con->prepare("INSERT INTO provas(prova, modalidade, ano, id_gabarito) VALUES (:p, :m, :a, :ig)");

                    $insert->bindValue(":p",$nomeProva);
                    $insert->bindValue(":m",$modalidade);
                    $insert->bindValue(":a",$ano);
                    $insert->bindValue(":ig",$id_gabarito);
                    $insert->execute();

                    return true;
    
                } else {

                    return false;
                   
                }
    
            } else if ($modalidade == "Subsequente") {
    
                $pastaProvas = "pdfs/subsequente/provas/";
                $pastaGabaritos = "pdfs/subsequente/gabaritos/";
    
                if ((move_uploaded_file($temporarioProva, $pastaProvas.$nomeProva)) && (move_uploaded_file($temporarioGabarito, $pastaGabaritos.$nomeGabarito))) {
    
                    $insert = $this->con->prepare("INSERT INTO gabaritos(gabarito, modalidade, ano) VALUES (:g, :m, :a)");

                    $insert->bindValue(":g",$nomeGabarito);
                    $insert->bindValue(":m",$modalidade);
                    $insert->bindValue(":a",$ano);
                    $insert->execute();

                    $select = $this->con->prepare("SELECT id_gabarito FROM gabaritos WHERE ano = :a");
                    $select->bindValue(":a",$ano);
                    $select->execute();

                    $id = $select->fetch();
                    $id_gabarito = $id['id_gabarito'];

                    $insert = $this->con->prepare("INSERT INTO provas(prova, modalidade, ano, id_gabarito) VALUES (:p, :m, :a, :ig)");

                    $insert->bindValue(":p",$nomeProva);
                    $insert->bindValue(":m",$modalidade);
                    $insert->bindValue(":a",$ano);
                    $insert->bindValue(":ig",$id_gabarito);
                    $insert->execute();

                    return true;

                } else {

                    return false;
            
                }
    
            }

        }

        public function deletarDocumento($id_documento,$modalidade_get) {

            $select = $this->con->prepare("SELECT provas.prova, gabaritos.gabarito, provas.id_gabarito, provas.modalidade FROM provas JOIN gabaritos ON gabaritos.id_gabarito = provas.id_gabarito WHERE md5(provas.id_gabarito) = :id");

            $select->bindValue(":id", $id_documento);
            $select->execute();

            if ($select->rowCount() > 0) {

                $dados = $select->fetch();

                $nomeProva = $dados['prova'];
                $nomeGabarito = $dados['gabarito'];
                $modalidade = $dados['modalidade'];
                $id_gabarito = $dados['id_gabarito'];

                $deleteProva = $this->con->prepare("DELETE FROM provas WHERE id_gabarito = :id");
                $deleteProva->bindValue(":id",$id_gabarito);
                $deleteProva->execute();

                $deleteGabarito = $this->con->prepare("DELETE FROM gabaritos WHERE id_gabarito = :id");
                $deleteGabarito->bindValue(":id",$id_gabarito);
                $deleteGabarito->execute();

                if ($deleteProva->execute() && $deleteGabarito->execute()) {

                    if ($modalidade == 'Integrado') {

                        $prova = "pdfs/integrado/provas/$nomeProva";
                        $gabarito = "pdfs/integrado/gabaritos/$nomeGabarito";

                        unlink($prova);
                        unlink($gabarito);

                        $_SESSION['msg-delete-documents'] = "<div id='msg-sucesso'>Arquivos excluídos com sucesso!</div>";

                        $header = ("Location: downloads-integrado.php");

                    } else if ($modalidade == 'Subsequente') {

                        $prova = "pdfs/subsequente/provas/$nomeProva";
                        $gabarito = "pdfs/subsequente/gabaritos/$nomeGabarito";

                        unlink($prova);
                        unlink($gabarito);

                        $_SESSION['msg-delete-documents'] = "<div id='msg-sucesso'>Arquivos excluídos com sucesso!</div>";

                        $header = ("Location: downloads-subsequente.php");

                    }

                } else {

                    $_SESSION['msg-delete-documents'] = "<div id='msg-erro'>ERRO! Tente novamente</div>";

                    if ($modalidade == 'Integrado') {

                        $header = ("Location: downloads-integrado.php");

                    } else if ($modalidade == 'Subsequente') {

                        $header = ("Location: downloads-subsequente.php");

                    }

                }

            } else {


                $_SESSION['msg-delete-documents'] = "<div id='msg-erro'>ERRO! Arquivos não encontrados no banco de dados</div>";

                if ($modalidade_get == 'Integrado') {

                    $header = ("Location: downloads-integrado.php");


                } else if ($modalidade_get == 'Subsequente') {

                    $header = ("Location: downloads-subsequente.php");

                }

            }

            return $header;

        }
    }

?>