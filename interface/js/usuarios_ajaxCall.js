setInterval(function(f){ 
    
    var request = 'request_users=1';
    $.ajax({
        type: "POST",
        url: 'ajax/mostraUsuariosCadastrados_ajax.php',
        async: true,
        data: request,
        success: function (response) {
            $usuarios = response;
            if ($usuarios != false){
                $("#mostraUsers").html($usuarios);
            }else{
                $("#mostraUsers").html("Não foram encontrados usuários cadastrados!");
            }
        },
        error: function (response) {
        },
    });    
}, 1500);