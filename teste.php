<?php
    ###
    # ARQUIVO TESTE PARA EXEMPLIFICAR
    # FUNÇÕES DO BANCO DE DADOS
    ###

    // inclui classe DB contendo os métodos para interação com o BANCO DE DADOS
    // OBRIGATÓRIO O USO DESSE INCLUDE PARA UTILIZAR OS MÉTODOS MOSTRADOS ABAIXO
    include_once 'database/database.php'; 
    //

    #                  #
    # CADASTRA USUARIO #
    #                  #
    $resp = $DB->cadastra('12345','rafael');
    # FUNCAO cadastra RETORNA TRUE, SE USUARIO FOI CADASTRADO, OU FALSE SE JÁ EXISTE
    if ($resp == true){
        # TRATAMENTO CASO USUARIO EXISTA. ex: echo 'usuario cadastrado';
    } else{
        # TRATAMENTO CASO USUARIO NAO EXISTA. ex: echo 'usuario já existe';
    }
    #


    #                            #
    # VERIFICA SE USUARIO EXISTE #
    #                            #
    $resp = $DB->verifica('123456');
    #
    # FUNCAO RETORNA NOME (STRING) CASO EXISTA
    #
    if ($resp == null){
        # TRATAMENTO CASO USUÁRIO NAO EXISTA
    } else {
        # TRATAMENTO CASO USUARIO EXISTA
    }
    #


    #                            #
    # REGISTRA USUARIO EXISTENTE #
    #    NA TABELA REGISTROS     #
    #                            #
    $resp = $DB->registra('123456');
    if ($resp == true){
        # REGISTRO EFETUADO CORRETAMENTE
    } else {
        # USUARIO NAO EXISTE
    }
    #

?>