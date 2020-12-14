    function addQuestionAjax() {
        if (validarFormulario()) {
            $.ajax({
                type: $('#fquestion').attr('method'),
                url: $('#fquestion').attr('action'),
                data: $('#fquestion').serialize(),
                cache: false,
                success: function (data) {
                    $("#respuesta").html("<p>Pregunta guardada en la BD y XML</p>");
                    showQAjax();
                }
            });
        }
    }