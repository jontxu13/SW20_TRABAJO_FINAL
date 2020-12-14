<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <script src="../js/ShowImageInForm.js"></script>
  <style>
		.table_QuestionForm{
			margin: auto;
		}
		sup {
			color: red;
		}
	</style>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>

    <!--Añadir el formulario y los scripts necesarios para que el usuario<br>pueda introducir los datos de una pregunta sin imagen.-->
	<!--<form id='fquestion' name='fquestion' action=’AddQuestion.php’> POST porque envia imagen-->
	<form id='fquestion' name='fquestion' method='POST' enctype='multipart/form-data' action='prueba.php'>
		<table class="table_QuestionForm">
			<tr><th><h2>Insertar pregunta</h2><br/></th></tr>
			<tr>
				<td>
					Direccion de correo<sup>*</sup>
					<input type="text" size="50" id="dirCorreo" name="dirCorreo" pattern="(^[a-zA-Z]+(\.[a-zA-Z]+@ehu\.(eus|es)|@ehu\.(eus|es))$|^[a-zA-Z]+(([0-9]{3})+@ikasle\.ehu\.(eus|es))$)" required>
				</td>
			</tr>
			<tr><td>Enunciado de la pregunta<sup>*</sup><input type="text" size="75" id="pregunta" name="pregunta" required></td></tr>
			<tr><td>Respuesta correcta<sup>*</sup><input type="text" size="75" id="respuestaCorrecta" name="respuestaCorrecta" required></td></tr>
			<tr><td>Respuesta Incorrecta 1<sup>*</sup><input type="text" size="75" id="respuestaIncorrecta1" name="respuestaIncorrecta1" required></td></tr>
			<tr><td>Respuesta Incorrecta 2<sup>*</sup><input type="text" size="75" id="respuestaIncorrecta2" name="respuestaIncorrecta2" required></td></tr>
			<tr><td>Respuesta Incorrecta 3<sup>*</sup><input type="text" size="75" id="respuestaIncorrecta3" name="respuestaIncorrecta3" required></td></tr>
			<tr><td>Tema*<input type="text" size="50" id="tema" name="tema" required></td></tr>
			<tr>
				<td>
					Complejidad<sup>*</sup>
					<select id="complejidad" name="complejidad" >
						<option value="1">Baja</option>
						<option value="2" selected>Media</option>
						<option value="3">Alta</option>
					</select>
				</td>
			</tr>
			<tr><td><input type="file" id="file" accept="image/*" name="file"><div id="imgDynamica"></div></td></tr>
			<tr><td><input type="submit" id="submit" value="Enviar"> <input type="reset" id="reset" value="Limpiar"></td></tr>
		</table>
	</form>

    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
