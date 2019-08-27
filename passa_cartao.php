<?php

    /*
     * ESTE ARQUIVO DEVE RECEBER O ID DO CARTAO VIA POST
     * ENVIADO PELO ESP8266 E RECEBIDO PELO IP.
     * 
     * ESTE ARQUIVO FUNCIONA PARA UM RECEBIMENTO VIA SESSION.
    */

    session_start();
    include_once 'database/database.php';

    if(isset($_POST['TagID'])){
        $TagID =  $_POST['TagID'];

        $err =$DB->registra($TagID);
        if ($err == false){
            echo "cartão invalido";
        } else {
            //echo "$TagID passou"; 
        }
    } else {
        echo "erro em passa_cartao.php - TagID não passado via POST.";
    }

?>