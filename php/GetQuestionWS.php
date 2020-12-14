<?php
session_start();
if (!isset($_SESSION["usuario"]) || $_SESSION["tipo"]==1) {
  header("location:LogIn.php");
} else {
//incluimos la clase nusoap.php
require_once('../lib/nusoap.php');
require_once('../lib/class.wsdlcache.php');
//creamos el objeto de tipo soap_server
$server = new soap_server;
$server->configureWSDL('getQuestion', "urn:getQuestion");
//registramos la función que vamos a implementar
$server->register(
    'getQuestion',
    array('x' => 'xsd:int'),
    array('z' => 'xsd:string')
);
//implementamos la función
function getQuestion($x)
{
    include 'DbConfig.php';
    $mysqli = mysqli_connect($server, $user, $pass, $basededatos);
    if (!$mysqli) {
        die("Fallo al conectar a MySQL: " . mysqli_connect_error());
        echo "<span><a href='javascript:history.back()'>Volver al formulario</a></span>";
    }
    $sql="SELECT * FROM preguntas WHERE clave=\"".$x."\";";
    $row = mysqli_fetch_array(mysqli_query($mysqli, $sql));
    if($row==""){
        return "<label style=color:red text-align: center>Id: </label> <label>" . $x . "</label><br>
        <label style=color:red text-align: center>Enunciado: </label><br>
        <label style=color:red text-align: center>Respuesta correcta: </label><br>
        <label style=color:red text-align: center>Autor: </label>
    ";
    }else{
        return "<label style=color:red text-align: center>Id: </label> <label>" . $x . "</label><br>
        <label style=color:red text-align: center>Enunciado: </label> <label>" . $row['enunciado'] . "</label><br>
        <label style=color:red text-align: center>Respuesta correcta: </label> <label>" . $row['respuestac'] . "</label><br>
        <label style=color:red text-align: center>Autor: </label> <label>". $row['email'] . "</label>
    ";
    }
    mysqli_close($mysqli);
}
//llamamos al método service de la clase nusoap antes obtenemos los valores de los parámetros
if (!isset($HTTP_RAW_POST_DATA)) {
    $HTTP_RAW_POST_DATA = file_get_contents('php://input');
}
$server->service($HTTP_RAW_POST_DATA);
}