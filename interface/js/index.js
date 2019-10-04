
// diferencia janelas de login entre os usuarios
$("#cadastro-login").show(); $("#registros-login").hide(); $("#cadastros-login").hide();
$("#cadastro-toggle").click(function(f) {
    $("#cadastro-login").show();
    $("#registros-login").hide();
    $("#cadastros-login").hide();
    $("#wrapper").toggleClass("toggled");
    
});
$("#registros-toggle").click(function(f) {
    $("#cadastro-login").hide();
    $("#registros-login").show();
    $("#cadastros-login").hide();
    $("#wrapper").toggleClass("toggled");
});
$("#cadastros-toggle").click(function(f) {
    $("#cadastro-login").hide();
    $("#registros-login").hide();
    $("#cadastros-login").show();
    $("#wrapper").toggleClass("toggled");
});