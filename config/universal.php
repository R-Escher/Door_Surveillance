<?php
    $raiz = $_SERVER['DOCUMENT_ROOT'].'/Door_Surveillance';

    include_once $raiz.'/database/database.php';
    include_once 'tableRows.php';

    $universal = new universal;

    class universal{

        // variaveis estaticas devem ser acessadas com self::$variavel !
        public static $DB;
        public static $database;

        public function __construct(){
            self::$DB = new DB;
            self::$database = DB::_conectaDB();
        }

        public function mostraUsuariosCadastrados(){
            /*
             * RETORNA ROWS DE USUARIOS CADASTRADOS NO BANCO DE DADOS
             * EM TAGS <TR><TD>...<TD></TR>
            */

            $stmt = self::$database->prepare("SELECT id, tagId, nome, data FROM cadastros");
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
            
            $stmt = self::$database->prepare("SELECT nome,tagId,estado,data FROM registros");
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

            foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
                echo $v;
            }
        }
    }

?>