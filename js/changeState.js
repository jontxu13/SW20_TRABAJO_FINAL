function updateState(email, tipo, id) {
    $.ajax({
        type: "POST",
        url: 'ChangeUserState.php',
        data: {"email" : email , "tipo" : tipo} ,
        cache: false,
        success: function(resultado) {
            if(resultado=="error"){
                alert("No te puedes bloquear a ti mismo!");
            }
            if(resultado=="bloqueado"){
                alert("Usuario bloqueado correctamente.");
                $("#" + id).html("Bloqueado");
            }
            if(resultado=="activado"){
                alert("Usuario activado correctamente.");
                document.location.href='HandlingAccounts.php';
                $("#" + id).html("Activo");   
            }
        }
    });
}