<?php
//incluimos la clase nusoap.php
require_once('../lib/nusoap.php');
require_once('../lib/class.wsdlcache.php');
//creamos el objeto de tipo soap_server
$server = new soap_server;
$server->configureWSDL('verifyPass', "urn:verifyPass");
//registramos la función que vamos a implementar
$server->register(
    'verifyPass',
    array('x' => 'xsd:string', 'y' => 'xsd:int'),
    array('z' => 'xsd:string')
);
//implementamos la función
function verifyPass($x, $y)
{
    if ($y == 1010) {
        $pagina = file_get_contents('../txt/toppasswords.txt');
        $encontrado = strpos($pagina, $x);
        if ($encontrado) {
            return "INVALIDA";
        } else {
            return "VALIDA";
        }
    } else {
        return "SIN SERVICIO";
    }
}
//llamamos al método service de la clase nusoap antes obtenemos los valores de los parámetros
if (!isset($HTTP_RAW_POST_DATA)) {
    $HTTP_RAW_POST_DATA = file_get_contents('php://input');
}
$server->service($HTTP_RAW_POST_DATA);
