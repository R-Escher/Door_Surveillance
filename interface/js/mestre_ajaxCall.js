setInterval(function(f){ 
    
    var request = 'request_regs=1';
    $.ajax({
        type: "POST",
        url: 'ajax/verificaMestre_ajax.php',
        async: true,
        data: request,
        success: function (response) {
            $registros = response;
            if ($registros != false){
                if (confirm('Voce quer cadastrar a tagID ' + $registros + ' ?')) {
                    $.redirect('/Door_Surveillance/interface/index.php', {'tagId': $registros});
                } else {
                    $.redirect('/Door_Surveillance/interface/ajax/deletaMestre_ajax.php', {'tagId': $registros});
                }
            }
        },
        error: function (response) {
        },
    });    
}, 1500);