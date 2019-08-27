<?php
    $raiz = $_SERVER['DOCUMENT_ROOT'].'/Door_Surveillance';
    include_once $raiz.'/config/universal.php';
    
    if(isset($_POST['request_users'])){
        echo $universal->mostraUsuariosCadastrados();
    }else{
        echo false;
    }

?>