function verifyPass() {
    pass = $('#pass1').val();
        $.ajax({
            type: "POST",
            url: 'ClientVerifyPass.php',
            data: {"Pass": pass},
            cache: false,
            success: function(respuesta) {
                if(respuesta=="VALIDA"){
                $("#pass").html("<td style=color:green aling='center'>" + respuesta + "</td>");
                }else{
                $("#pass").html("<td style=color:red aling='center'>" + respuesta + "</td>");
                }
            }
        });
}