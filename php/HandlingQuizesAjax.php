<?php 
session_start();
if(!isset($_SESSION["usuario"])) {
    header("location:LogIn.php");
} else {
?>
<?php header("Cache-Control: no-store"); ?>
<!DOCTYPE html>
<html>
<head>
	<?php include '../html/Head.html' ?>
	<?php include '../php/DbConfig.php' ?>
	<?php include '../php/antiSQL.php' ?>
	<script src="../js/jquery-3.4.1.min.js"></script>
	<script src="../js/ShowImageInForm.js"></script>
	<script src="../js/AddQuestionsAjax.js"></script>
	<script src="../js/ShowQuestionsAjax.js"></script>
	<script src="../js/countQuestions.js"></script>
	<script src="../js/ValidateFieldsQuestion.js"></script>
	<style>
		.table_QuestionForm {
			margin: auto;
			text-align: center;
		}

		.table_Questions {
			margin: auto;
			border-collapse: collapse;
			text-align: center;
		}

		sup {
			color: red;
		}

		h2 {
			color: darkblue;
		}

		.preguntas {
			box-sizing: border-box;
			width: 100%;
			border: solid #000000 2px;
			padding: 2px;
		}
	</style>
</head>

<body>
	<?php include '../php/Menus.php' ?>
	<section class="main" id="s1">
		<div class="preguntas" id="preguntas"></div>
		<div>
			<!--Añadir el formulario y los scripts necesarios para que el usuario<br>pueda introducir los datos de una pregunta sin imagen.-->
			<!--<form id='fquestion' name='fquestion' action=’AddQuestion.php’> POST porque envia imagen-->
			<!--<form id='fquestion' name='fquestion' method='POST' enctype='multipart/form-data' action='AddQuestionWithImage.php'>-->
			<?php echo "<form id='fquestion' name='fquestion' method='POST' enctype='multipart/form-data' action='AddQuestionWithImage.php'>"; ?>
			<table class="table_QuestionForm">
				<tr>
					<th>
						<h2>Insertar pregunta</h2><br />
					</th>
				</tr>
				<tr>
					<td>Direccion de correo<sup>*</sup> <input type="text" size="75" id="dirCorreo" name="Direccion de correo" value="<?php echo $_SESSION['usuario']; ?>" readonly></td>
				</tr>
				<tr>
					<td>Enunciado de pregunta<sup>*</sup> <input type="text" size="75" id="pregunta" name="Pregunta"></td>
				</tr>
				<tr>
					<td>Respuesta correcta<sup>*</sup> <input type="text" size="75" id="respuestaCorrecta" name="Respuesta correcta"></td>
				</tr>
				<tr>
					<td>Respuesta incorrecta 1<sup>*</sup> <input type="text" size="75" id="respuestaIncorrecta1" name="Respuesta incorrecta 1"></td>
				</tr>
				<tr>
					<td>Respuesta incorrecta 2<sup>*</sup> <input type="text" size="75" id="respuestaIncorrecta2" name="Respuesta incorrecta 2"></td>
				</tr>
				<tr>
					<td>Respuesta incorrecta 3<sup>*</sup> <input type="text" size="75" id="respuestaIncorrecta3" name="Respuesta incorrecta 3"></td>
				</tr>
				<tr>
					<td>Tema<sup>*</sup> <input type="text" size="50" id="tema" name="tema"></td>
				</tr>
				<tr>
					<td>
						Complejidad<sup>*</sup>
						<select id="complejidad" name="complejidad">
							<option value="1">Baja</option>
							<option value="2" selected>Media</option>
							<option value="3">Alta</option>
						</select>
					</td>
				</tr>
				<tr>
					<td><input type="file" id="file" accept="image/*" name="file">
						<div id="imgDynamica"></div>
					</td>
				</tr>
				<tr>
					<td><input type="button" id="enviar" value="Insertar pregunta" onclick="addQuestionAjax()"> <input type="button" id="showq" value="Ver preguntas" onclick="showQAjax()"> <input type="reset" id="reset" value="Limpiar"></td>
				</tr>
			</table>
			</form>
			<?php
		//Creamos la conexion con la BD.
		$link = mysqli_connect($server, $user, $pass, $basededatos);
		if (!$link) {
			die("Fallo al conectar con la base de datos: " . mysqli_connect_error());
		}
		$query = "SELECT * FROM preguntas";
		$cuantos = mysqli_num_rows(mysqli_query($link, $query));
		mysqli_close($link);
		?>
		</div>
		<div id="respuesta"></div>
		<div id="txtHint"></div>
	</section>
	<script>
		updateQuestions("<?php echo $_SESSION['usuario']?>");
			setInterval(function(){updateQuestions("<?php echo $_SESSION['usuario']?>");} , 4000);
	</script>
	<?php include '../html/Footer.html' ?>
</body>
</html>
<?php
}
?>