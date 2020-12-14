<?php 
session_start();
if(!isset($_SESSION["usuario"])) {
    header("location:LogIn.php");
} else {
?>
<?php
require '../lib/nusoap.php';

$soapclient = new nusoap_client('http://localhost/sw20/php/GetQuestionWS.php?wsdl');

?>
<!DOCTYPE html>
<html>

<head>
    <?php include '../html/Head.html' ?>
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/ShowImageInForm.js"></script>
    <script src="../js/ClientGetQuestion.js"></script>

    <style>
        .table_fregister {
            margin: auto;
            text-align: center;
        }

        sup {
            color: red;
        }

        h2 {
            color: darkblue;
        }

        .error {
            color: darkred;
        }

        .success {
            color: darkgreen;
        }
    </style>
</head>

<body>
    <?php include '../php/Menus.php' ?>
    <?php include '../php/DbConfig.php' ?>
    <section class="main" id="s1">
        <div>
        <?php echo "<form id='fidpregunta' name='fidpregunta' method='POST' enctype='multipart/form-data' action='ClientGetQuestion.php'>"; ?>
                <table class="table_fregister">
                    <td>Id de la pregunta a buscar: <input type="number" id="idQuestion" name="idQuestion"></td>
                    </tr>
                    <tr>
                        <td><input type="submit" id="buscar" value="Buscar pregunta"></td>
                    </tr>
                </table>
            </form>
        </div>
        <div>
        <?php
                 	if(isset($_POST['idQuestion']))
                     {
                         $response = $soapclient->call('getQuestion',array("x"=>$_POST['idQuestion']));
                             echo $response;
                     }
        ?>
        </div>
    </section>
    <?php include '../html/Footer.html' ?>
</body>
</html>
<?php
}
?>