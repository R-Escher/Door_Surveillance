<?php

    include_once '../../config/universal.php';
    
    $universal->deletaMestre();

    header('Location: '.'/Door_Surveillance/interface/registros.php');
?>