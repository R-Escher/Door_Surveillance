
// diferencia janelas de login entre os usuarios
$("#cadastro-login").show(); $("#registros-login").hide(); $("#userCadastrados-login").hide();
$("#cadastro-toggle").click(function(f) {
    $("#cadastro-login").show();
    $("#registros-login").hide();
    $("#userCadastrados-login").hide();
    $("#wrapper").toggleClass("toggled");
    
});
$("#registros-toggle").click(function(f) {
    $("#cadastro-login").hide();
    $("#registros-login").show();
    $("#userCadastrados-login").hide();
    $("#wrapper").toggleClass("toggled");
});
$("#userCadastrados-toggle").click(function(f) {
    $("#cadastro-login").hide();
    $("#registros-login").hide();
    $("#userCadastrados-login").show();
    $("#wrapper").toggleClass("toggled");
});