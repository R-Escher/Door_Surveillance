<?php

    include_once '../database/database.php';
    include_once 'tableRows.php';

    $universal = new universal;

    class universal{

        public function __construct(){

        }

        public function mostraUsuariosCadastrados(){
            /*
             * RETORNA ROWS DE USUARIOS CADASTRADOS NO BANCO DE DADOS
             * EM TAGS <TR><TD>...<TD></TR>
            */

            $stmt = $database->prepare("SELECT id, tagId, nome, data FROM cadastros");
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

            foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
                echo $v;
            }
        }

        public function mostraRegistros(){
            /**
             * RETORNA REGISTROS DE USUARIOS DO BANCO DE DADOS
             * EM TAGS <TR><TD>...<TD></TR>
            */
            
            $stmt = $database->prepare("SELECT nome,tagId,estado,data FROM registros");
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

            foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
                echo $v;
            }
        }
    }

?>