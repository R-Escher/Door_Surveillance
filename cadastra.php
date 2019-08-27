<?php

    /**
     * ESTE ARQUIVO É CHAMADO PELO FORM
     * DO INDEX.PHP, E APENAS CADASTRA UM NOVO
     * USUARIO NO BANCO DE DADOS.
    */

    session_start();
    include_once 'database/database.php';

    if(isset($_POST['usuario'])){
        $tagID =  $_POST['TagID'];
        $nome =  $_POST['usuario'];
    
        $err = $DB->cadastra($tagID, $nome);

        if ($err == true){
            echo '<script>alert("Usuário cadastrado")</script>';
            echo '<script>window.location = "interface/index.php"</script>';
        } else {
            echo '<script>alert("Erro - Usuário já cadastrado!")</script>';
            echo '<script>window.location = "interface/index.php"</script>';
        }
    } else {
        echo '<script>alert("Erro em sessao.php - usuario não passado em POST.")</script>';
        echo '<script>window.location = "interface/index.php"</script>';
    }
?>