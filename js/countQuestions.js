function updateQuestions(logInMail) {
    $.ajax({
        type: "POST",
        url: 'updateQuestionsXML.php',
        data: {"logInMail" : logInMail} ,
        cache: false,
        success: function(preguntas) {
            $("#preguntas").html("Mis preguntas/Todas las preguntas: " + preguntas);
        }
    });
}