<!DOCTYPE html>
<html>

<head>
	<?php include '../html/Head.html'?>
	<style>
		.table_Credits{
			margin: auto;
		}
		td {
  			width: 25%;
		}
		.autores {
  			width: 150px;
  			height: 150px;
		}
		h2 {
			color: darkblue;
		}
	</style>
</head>

<body>
	<?php include '../php/Menus.php' ?>
	<section class="main" id="s1">
		<div>
			<table class="table_Credits">
				<tr><th colspan="2"><h2>DATOS DEL AUTOR/AUTORES</h2><br/></th ></tr>
				<tr>
					<td>Jon Da Silva Jauregui</td>
					<td>Iván Garoña Leza</td>
				</tr>
				<tr>
					<td>Ingerería de Software</td>
					<td>Ingerería de Software</td>
				</tr>
				<tr>
					<td><a href="mailto:jdasilva002@ikasle.ehu.es">jdasilva002@ikasle.ehu.eus</a></td>
					<td><a href="mailto:igarona003@ikasle.ehu.es">igarona003@ikasle.ehu.eus</a></td>
				</tr>
			</table>

			<br><p>Agradecimientos a Konstantin Todorov Andreev y a Daniel Ruskov Vangelov por ceder el código.</p></br>
		</div>
	</section>
	<?php include '../html/Footer.html' ?>
</body>

</html>