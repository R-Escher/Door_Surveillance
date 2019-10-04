<?php

    /*
     * ESTE ARQUIVO DEVE RECEBER O ID DO CARTAO VIA GET
     * ENVIADO PELO ESP8266 E RECEBIDO PELO IP.
     * 
     * ESTE ARQUIVO FUNCIONA PARA UM RECEBIMENTO VIA POST.
    */

    session_start();
    include_once 'database/database.php';

    if(isset($_POST['tagID'])){
        $TagID =  $_POST['tagID'];

        $err =$DB->registra($TagID);
        if ($err == false){
            echo "0";
        } else {
            echo "1"; 
        }
    } else {
        echo "erro em passa_cartao.php - TagID não passado via GET.";
    }

?>