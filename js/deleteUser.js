function deleteUser(email, tipo, id) {
    $.ajax({
        type: "POST",
        url: 'RemoveUser.php',
        data: {"email" : email , "tipo" : tipo} ,
        cache: false,
        success: function(resultado) {
            if(resultado=="error"){
                alert("No te puedes borrarte a ti mismo!");
            }
            if(resultado=="correcto"){
                alert("Usuario borrado correctamente.");
                $("#" + id).remove();
            }
        }
    });
}