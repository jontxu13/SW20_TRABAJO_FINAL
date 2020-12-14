function verifyVIP() {
    email = $('#dirCorreo').val();
        $.ajax({
            type: "POST",
            url: 'ClientVerifyEnrollment.php',
            data: {"Email": email},
            cache: false,
            success: function(respuesta) {
                if(respuesta=="SI"){
                $("#vip").html("<td style=color:green aling='center'>" + respuesta + " eres VIP</td>");
                }else{
                $("#vip").html("<td style=color:red aling='center'>" + respuesta + " eres VIP</td>");
                }
            }
        });
}