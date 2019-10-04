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
            /*
            * VERIFICA SE TAG ESTÁ NO DATABASE.
            * RETORNA NOME SE ESTIVER,
            * RETORNA NULL CASO CONTRÁRIO.
            */

            $query = self::$database->prepare("SELECT nome FROM cadastros WHERE tagId = ?");
            $query->bindParam(1, $tagId);
            $query->execute();

            $row = $query->fetch(PDO::FETCH_OBJ);
            if ($row==null){
                return null;
            } else {
                return $row->nome;
            }           
        }
        public function verificaMestre($tagId){
            /*
            * VERIFICA SE TAG ESTÁ NO DATABASE.
            * RETORNA NOME SE ESTIVER,
            * RETORNA NULL CASO CONTRÁRIO.
            */

            $query = self::$database->prepare("SELECT id FROM cadastros WHERE tagId = ? AND nome = 'mestre'");
            $query->bindParam(1, $tagId);
            $query->execute();

            $row = $query->fetch(PDO::FETCH_OBJ);
            if ($row==null){
                return null;
            } else {
                return $row;
            }           
        }

        public function cadastra($tagId, $nome){
            /*
            * CADASTRA USUARIO NO DATABASE.
            * RETORNA TRUE SE CADASTRAR,
            * RETORNA FALSE CASO CONTRARIO.
            */
            if ($this->verificaMestre($tagId) == null){
                return false;
            }else{
                $query = self::$database->prepare("UPDATE cadastros SET nome = ? WHERE tagId = ?");
                $query->bindParam(1, $nome);
                $query->bindParam(2, $tagId);
                $query->execute();
                return true; // CADASTRADO
            }
        }

        public function registra($tagId){ //id, tagId, nome, data, estado
            /*
            * REGISTRA USUARIO EM TABELA DE REGISTROS (LOG).
            * RETORNA FALSE SE 
            * RETORNA TRUE SE
            */

            
            $nomeMestre = $this->verificaMestre($tagId);
            if ($nomeMestre==null){ // se nao existir entrada mestre
                
                // VERIFICA SE TAGID EXISTE NO DB. SE NAO EXISTIR, CRIA UM REGISTRO TEMPORARIO DE NOME 'MESTRE'.
                $nome = $this->verifica($tagId);
                if ($nome == null){
                    $query = self::$database->prepare("INSERT INTO cadastros (tagId, nome) VALUES (:tagId, :nome)");
                    $query->execute(array(":tagId" => $tagId, ":nome" => 'mestre'));
                    return false; // retorna false negando acesso
                    
                }else{
                    date_default_timezone_set('America/Sao_Paulo');
                    $data = date("Y-m-d H:i:s");
                    
                    $query2 = self::$database->prepare("SELECT estado FROM registros WHERE tagId = ?");
                    $query2->bindParam(1, $tagId);
                    $query2->execute();
                    $rows = $query2->fetchAll(PDO::FETCH_OBJ);

                    /*                         # VERIFICAÇÃO NECESSARIA PARA QUANDO NAO HA REGISTROS NA TABELA - IGNORAR.
                        if (gettype($estado)!='string'){
                            $estado = $estado->estado;
                        } */

                    if ($rows == null) { // se nao houver registro anteorior da tagID
                        $estado = "entrou";

                    } else {
                        $estado = end($rows)->estado; # pega a ultima row

                        if ($estado == "saiu"){ // se não está
                            $estado = "entrou";   // então vai entrar.
                        }else{
                            $estado = "saiu";
                        }
                    }

                    $query3 = self::$database->prepare("INSERT INTO registros (tagId, nome, data, estado) VALUES (:tagId, :nome, :data, :estado)");
                    $query3->execute(array(":tagId" => $tagId, ":nome" => $nome, ":data" => $data, ":estado" => $estado));
                    return true; // retorna true autorizando acesso
                }
            } else {
                return false; // se existe registro 'mestre', retorna false negando acesso
            }
        }
    }
?>