<?php

    $DB = new DB;
    $database = $DB::_conectaDB();

    class DB{   
        public static $database;
        public static $e;

        public static function _conectaDB(){
            try{
                //('mysql:host= IP OU LOCALHOST ;dbname= NOME DB ;charset=utf8mb4','USUARIO','SENHA')
                self::$database = new PDO('mysql:host=localhost;dbname=acesso_db1;charset=utf8mb4','root','');
                self::$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $e = self::$e;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            return self::$database;
        }

        public function verifica($tagId){
            #
            # VERIFICA SE TAG ESTÁ NO DATABASE e RETORNA NOME
            #
            $query = self::$database->prepare("SELECT nome FROM cadastros WHERE tagId = ?");
            $query->bindParam(1, $tagId);
            $query->execute();

            $row = $query->fetch(PDO::FETCH_OBJ);
            if ($row==null){
                return null;
            } else {
                return $row->nome;
            }
            # SE NAO ESTIVER, RETORNA NULL
            #            
        }

        public function cadastra($tagId, $nome){
            #
            # CADASTRA USUARIO NO DATABASE
            #
            if ($this->verifica($tagId) == null){
                $query = self::$database->prepare("INSERT INTO cadastros (tagId, nome) VALUES (:tagId, :nome)");
                $query->execute(array(":tagId" => $tagId, ":nome" => $nome));
                return true; // CADASTRADO
            }
            else{
                return false; // USUARIO JA EXISTE
            }
            
        }

        public function registra($tagId){ //id, tagId, nome, data, estado
            $nome = $this->verifica($tagId);
            if ($nome == null){
                return false;
            }
            date_default_timezone_set('America/Sao_Paulo');
            $data = date("Y-m-d H:i:s");
            
            $query = self::$database->prepare("SELECT estado FROM registros WHERE tagId = ?");
            $query->bindParam(1, $tagId);
            $query->execute();
            $rows = $query->fetchAll(PDO::FETCH_OBJ);
            
            $estado = end($rows);
            if (gettype($estado)!='boolean'){
                $estado = $estado->estado;
            }
            
            if ($estado == 0){ // se não está
                $estado = 1;                            // então vai entrar.
            }else{
                $estado = 0;
                
            }

            $query = self::$database->prepare("INSERT INTO registros (tagId, nome, data, estado) VALUES (:tagId, :nome, :data, :estado)");
            $query->execute(array(":tagId" => $tagId, ":nome" => $nome, ":data" => $data, ":estado" => $estado));

            return true;
        }



    }
?>