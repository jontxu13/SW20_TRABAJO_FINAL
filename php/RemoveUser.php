<?php
include '../php/DbConfig.php';
include '../php/antiSQL.php';
//Creamos la conexion con la BD.
$link = mysqli_connect($server, $user, $pass, $basededatos);
if (!$link) {
    die("Fallo al conectar con la base de datos: " . mysqli_connect_error());
}
// Operar con la BD
$email = test_input($_POST['email']);
$tipo = test_input($_POST['tipo']);
$sql = "SELECT * FROM usuarios WHERE email='$email';";
$resul = mysqli_query($link, $sql);
$row = mysqli_fetch_array($resul);
if ($tipo == 3) {
    echo "error";
} else {
        $changeEstado = "DELETE FROM usuarios
            WHERE email='$email';";
        mysqli_query($link, $changeEstado);
        echo "correcto";
}
mysqli_close($link);
