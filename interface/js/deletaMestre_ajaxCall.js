setInterval(function(f){ 
    
    var request = 'request_regs=1';
    $.ajax({
        type: "POST",
        url: 'ajax/deletaMestre_ajax.php',
        async: true,
        data: request,
    });    
}, 60000);