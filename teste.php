<?php
    ###
    # ARQUIVO TESTE PARA EXEMPLIFICAR
    # FUNÇÕES DO BANCO DE DADOS
    ###

    include_once 'database/database.php'; // inclui objeto classe DB e objeto sql database

    #                  #
    # CADASTRA USUARIO #
    #                  #
    $err = $DB->cadastra('12345','rafael');
    # FUNCAO cadastra RETORNA TRUE, SE USUARIO FOI CADASTRADO, OU FALSE SE JÁ EXISTE
    if ($err == true){
        # TRATAMENTO CASO USUARIO EXISTA. ex: echo 'usuario cadastrado';
    } else{
        # TRATAMENTO CASO USUARIO NAO EXISTA. ex: echo 'usuario já existe';
    }
    #


    #                            #
    # VERIFICA SE USUARIO EXISTE #
    #                            #
    $teste = $DB->verifica('123456');
    #
    # FUNCAO RETORNA NOME (STRING) CASO EXISTA
    #
    if ($teste == null){
        # TRATAMENTO CASO USUÁRIO NAO EXISTA
    } else {
        # TRATAMENTO CASO USUARIO EXISTA
    }
    #


    #                            #
    # REGISTRA USUARIO EXISTENTE #
    #    NA TABELA REGISTROS     #
    #                            #
    $teste = $DB->registra('123456');
    if ($teste == true){
        # REGISTRO EFETUADO CORRETAMENTE
    } else {
        # USUARIO NAO EXISTE
    }

?>