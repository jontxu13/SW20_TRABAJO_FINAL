<!DOCTYPE html>
<html>

<head>
    <?php include '../html/Head.html' ?>
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/ShowImageInForm.js"></script>
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
            <form id="fregister" name="fregister" method="POST" enctype="multipart/form-data" action="recuperarContrasenaCodigo.php">
                <table class="table_fregister">
                    <tr>
                        <th>
                            <h2>Restablecimiento de contraseña</h2><br />
                        </th>
                    </tr>
                    <tr>
                        <td>Dirección de correo:<sup>*</sup> <input type="email" size="75" id="dirCorreo" name="dirCorreo" value="<?php echo $email ?>" readonly></td>
                        <td id="vip"></td>
                    </tr>
                    <tr>
                        <td>Nueva Contraseña (long>5):<sup>*</sup> <input type="password" size="75" id="pass1" name="pass1" onchange="verifyPass()"></td>
                        <td id="pass"></td>
                    </tr>
                    <tr>
                        <td>Repite la contraseña:<sup>*</sup> <input type="password" size="75" id="pass2" name="pass2"></td>
                    </tr>
                    <tr>
                        <td>Código de recuperación:<sup>*</sup> <input type="text" size="75" id="cod" name="cod"></td>
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
                $exprPass = "/^.{6,}$/";
                $exprNAP = "/(\w.+\s).+/";
                $tipo = $_REQUEST['tipoUsu'];
                $mail = test_input($_REQUEST['dirCorreo']);
                $pass1 = test_input($_REQUEST['pass1']);
                $pass2 = test_input($_REQUEST['pass2']);
                $cod = test_input($_REQUEST['cod']);
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
                    }
                    $pass = crypt($pass1, './0-9A-Za-z');
                    $sql = "UPDATE usuarios SET pass='$pass1' WHERE email='$email';";
                    if (!mysqli_query($mysqli, $sql)) {
                        die("Fallo al insertar en la BD: " . mysqli_error($mysqli));
                    } else {
                        // echo "<p class=\"success\">Registrado correctamente<p><br/>";
                        // echo "<span><a href='LogIn.php'>Log In</a></span>";
                        $sql2 = "SELECT * FROM recuperacioncontraseña WHERE Email='$email';";
                        $resul = mysqli_query($mysqli, $sql2);
                        $row = mysqli_fetch_array($resul);
                        if ($cod == $row['código']) {
                            echo "<script> alert(\"Contraseña modificada correctamente\"); document.location.href='LogIn.php'; </script>";
                            $sql3="DELETE FROM recuperacioncontraseña WHERE Email='$email';";
                        } else {
                            echo "Código incorrecto";
                            header("refresh");
                        }
                    }
                }
                // Cerrar conexión
                mysqli_close($mysqli);
                // echo "Close OK.";
            }

            ?>
        </div>
    </section>
    <?php include '../html/Footer.html' ?>
</body>

</html>