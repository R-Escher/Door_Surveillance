<?php

    /**
     * ESTE ARQUIVO É CHAMADO PELO FORM
     * DO INDEX.PHP, E APENAS CADASTRA UM NOVO
     * USUARIO NO BANCO DE DADOS.
    */

    session_start();
    include_once 'database.php';

    if(isset($_POST['usuario'])){
        $tagID =  $_POST['TagID'];
        $nome =  $_POST['usuario'];
    
        $err = $DB->cadastra($tagID, $nome);

        if ($err == true){
            echo 'Usuário cadastrado';
        } else {
            echo 'deu ruim';
        }
    } else {
        echo "erro em sessao.php - 'usuario' não passado em POST."
    }
?>