setInterval(function(f){ 
    
    var request = 'request_regs=1';
    $.ajax({
        type: "POST",
        url: 'ajax/mostraRegistros_ajax.php',
        async: true,
        data: request,
        success: function (response) {
            $registros = response;
            if ($registros != false){
                $("#mostraRegistros").html($registros);
            }else{
                $("#mostraRegistros").html("Não foram encontrados registros!");
            }
        },
        error: function (response) {
        },
    });    
}, 1500);