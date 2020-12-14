<!DOCTYPE html>
<html>

<head>
    <?php include '../html/Head.html' ?>
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/ShowImageInForm.js"></script>
    <script src="../js/ClientVerifyEmail.js"></script>
    <script src="../js/ClientVerifyPass.js"></script>
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
    <?php include '../php/antiSQL.php' ?>
    <section class="main" id="s1">
        <div>
            <form id="fregister" name="fregister" method="POST" enctype="multipart/form-data" action="SignUp.php">
                <table class="table_fregister">
                    <tr>
                        <th>
                            <h2>Registro de nuevo usuario</h2><br />
                        </th>
                    </tr>
                    <tr>
                        <td>Tipo de usuario<sup>*</sup>
                            <select id="tipoUsu" name="tipoUsu">
                                <option value="1" selected>Alumno</option>
                                <option value="2">Profesor</option>
                            </select>
                    </tr>
                    <tr>
                        <td>Dirección de correo<sup>*</sup> <input type="email" size="75" id="dirCorreo" name="dirCorreo" onchange="verifyVIP()"></td>
                        <td id="vip"></td>
                    </tr>
                    <tr>
                        <td>Nombre y apellido(s)<sup>*</sup> <input type="text" size="75" id="nAp" name="nAp"></td>
                    </tr>
                    <tr>
                        <td>Contraseña (long>5)<sup>*</sup> <input type="password" size="75" id="pass1" name="pass1" onchange="verifyPass()"></td>
                        <td id="pass"></td>
                    </tr>
                    <tr>
                        <td>Repite la contraseña<sup>*</sup> <input type="password" size="75" id="pass2" name="pass2"></td>
                    </tr>
                    <tr>
                        <td>Foto de perfil (opc) <input type="file" id="file" accept="image/*" name="file">
                            <div id="imgDynamica"></div>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="submit" id="submit" value="Enviar"> <input type="reset" id="reset" value="Limpiar"></td>
                    </tr>
                </table>
            </form>
        </div>
        <div>
            <?php
            if (isset($_REQUEST['dirCorreo'])) {
                $exprMail = "/((^[a-zA-Z]+(([0-9]{3})+@ikasle\.ehu\.(eus|es))$)|^[a-zA-Z]+(\.[a-zA-Z]+@ehu\.(eus|es)|@ehu\.(eus|es))$)/";
                $exprMailAlu = "/^[a-zA-Z]+(([0-9]{3})+@ikasle\.ehu\.(eus|es))$/";
                $exprMailProf = "/^[a-zA-Z]+(\.[a-zA-Z]+@ehu\.(eus|es)|@ehu\.(eus|es))$/";
                $exprPass = "/^.{6,}$/";
                $exprNAP = "/(\w.+\s).+/";
                $tipo = $_REQUEST['tipoUsu'];
                $mail = test_input($_REQUEST['dirCorreo']);
                $nAp = test_input($_REQUEST['nAp']);
                $pass1 = test_input($_REQUEST['pass1']);
                $pass2 = test_input($_REQUEST['pass2']);
                $imagen = test_input($_FILES['file']['tmp_name']);
                /* debugger
                        echo $tipo, $mail, $nAp, $pass1, $pass2, $imagen;
                        if(!isset($tipo)) echo "tipo ";
                        if(!isset($mail)) echo "mail ";
                        if(!isset($nAp)) echo "nAp ";
                        if(!isset($pass1)) echo "pass1 ";
                        if(!isset($pass2)) echo "pass2 ";
                        */
                if (!isset($tipo, $mail, $nAp, $pass1, $pass2)) {
                    echo "<p class=\"error\">PHP error: variables indefinidas. Rellene bien el formulario<p><br/>";
                    // echo "<span><a href='javascript:history.back()'>Volver al formulario</a></span>";
                } else if (empty($tipo) || empty($mail) || empty($nAp) || empty($pass1) || empty($pass2)) {
                    echo "<p class=\"error\">¡Complete todos los campos obligatorios (*)!<p><br/>";
                    // echo "<span><a href='javascript:history.back()'>Volver al formulario</a></span>";
                } else if (!preg_match($exprMail, $mail)) {
                    echo "<p class=\"error\">¡Formato de correo electronico invalido!<p><br/>";
                    // echo "<span><a href='javascript:history.back()'>Volver al formulario</a></span>";
                } else if ((preg_match($exprMailAlu, $mail) && $tipo != "1") || (preg_match($exprMailProf, $mail) && $tipo != "2")) {
                    echo "<p class=\"error\">¡Formato de correo incorrecto para el tipo de usuario seleccionado!<p><br/>";
                    // echo "<span><a href='javascript:history.back()'>Volver al formulario</a></span>";
                } else if (!preg_match($exprNAP, $nAp)) {
                    echo "<p class=\"error\">¡Debe insertar minimo un nombre y un apellido!<p><br/>";
                    // echo "<span><a href='javascript:history.back()'>Volver al formulario</a></span>";
                } else if (!preg_match($exprPass, $pass1) || !preg_match($exprPass, $pass2)) {
                    echo "<p class=\"error\">¡Longitud minima de la contraseña debe ser de 6 caracteres!<p><br/>";
                    // echo "<span><a href='javascript:history.back()'>Volver al formulario</a></span>";
                } else if ($pass1 != $pass2) {
                    echo "<p class=\"error\">¡Las contraseñas no coinciden!<p><br/>";
                    // echo "<span><a href='javascript:history.back()'>Volver al formulario</a></span>";
                } else {
                    $mysqli = mysqli_connect($server, $user, $pass, $basededatos);
                    if (!$mysqli) {
                        die("Fallo al conectar a MySQL: " . mysqli_connect_error());
                        echo "<span><a href='javascript:history.back()'>Volver al formulario</a></span>";
                    }
                    $pass = crypt($pass1, './0-9A-Za-z');
                    if ($imagen == "") {
                        $imagen = "../images/anonimo.jpg";
                    }
                    $imagen_b64 = base64_encode(file_get_contents($imagen));
                    $sql = "INSERT INTO usuarios(tipousu, email, nomap, pass, imagen, estado) VALUES ('$tipo', '$mail', '$nAp', '$pass', '$imagen_b64' , 1);";
                    if (!mysqli_query($mysqli, $sql)) {
                        die("Fallo al insertar en la BD: " . mysqli_error($mysqli));
                        echo "<span><a href='javascript:history.back()'>Volver al formulario</a></span>";
                    } else {
                        // echo "<p class=\"success\">Registrado correctamente<p><br/>";
                        // echo "<span><a href='LogIn.php'>Log In</a></span>";
                        echo "<script> alert(\"Registrado correctamente\"); document.location.href='LogIn.php'; </script>";
                    }
                    // Cerrar conexión
                    mysqli_close($mysqli);
                    // echo "Close OK.";
                }
            }
            ?>
        </div>
    </section>
    <?php include '../html/Footer.html' ?>
</body>

</html>