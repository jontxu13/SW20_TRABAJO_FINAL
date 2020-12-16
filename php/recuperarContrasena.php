<html>

<head>
  <?php include '../html/Head.html' ?>
  <?php include '../php/antiSQL.php' ?>
  <style>
    .table_flogin {
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
      <form id="flogin" name="flogin" method="POST" enctype="multipart/form-data" action="recuperarContraseña.php">
        <table class="table_flogin">
          <tr>
            <th>
              <h2>Iniciar sesion</h2><br />
            </th>
          </tr>
          <tr>
            <td>Dirección de correo<sup>*</sup> <input type="email" size="65" id="dirCorreo" name="dirCorreo"></td>
          </tr>
          <tr>
            <td>
              <div id="buttons"><input type="submit" id="submit" value="Enviar"> <input type="reset" id="reset" value="Limpiar"></div>
            </td>
          </tr>
        </table>
      </form>
    </div>

    <div>
      <?php
      if (isset($_REQUEST['dirCorreo'])) {
        $email = test_input($_REQUEST['dirCorreo']);
        $mysqli = mysqli_connect($server, $user, $pass, $basededatos);
        if (!$mysqli) {
          die("Fallo al conectar con Mysql: " . mysqli_connect_error());
          echo "<span><a href='javascript:history.back()'>Volver</a></span>";
        }
        $sql = "SELECT * FROM usuarios WHERE email=\"" . $email . "\";";
        $resultado = mysqli_query($mysqli, $sql, MYSQLI_USE_RESULT);
        if (!$resultado) {
          die("Error: " . mysqli_error($mysqli));
          echo "<span><a href='javascript:history.back()'>Volver</a></span>";
        }
        $row = mysqli_fetch_array($resultado);
        if (!empty($row) && $row['email'] == $email) {
          // echo "<p class=\"success\">Inicio de sesion realizado correctamente<p><br/>";
          // echo "<span><a href='Layout.php'>Ir al inicio</a></span>";
              $to = $email;
              $subject =  "Recuperación contraseña";
              $codigo = rand(10000, 99999);
              $_SESSION['code']=$codigo;
              $_SESSION['email']=$email;

              $message="
              <html>
              <head>
              <title>Recuperación de contraseña</title>
              </head>
              <body>
              <h3>Pasos a realizar para recuperar tu contraseña:</h3>
              <o1>
                <li>Entre en el link proporcionado.</li>
                <li>Introduzca el código ". $codigo . " y la nueva contraseña.</li>
              </o1> 
              <h3>Link a la página de recuperación: </h3>
              <h2><a href='http://localhost/sw20_trabajo_final/php/recuperarContrasenaCodigo.php?email=" . $email . ">CLick aqui'</h2>
              </body>
              </html>
              ";

              $headers ="MIME-Version: 1.0" . "\r\n";
              $headers .= "Content-type:yexy/html:charset=UTF-8" . "\r\n";

              mail($to, $subject, $message, $headers);

              $sql2 = "INSERT INTO recuperacioncontraseña(Email, código) VALUES ('$email', $codigo);";
              mysqli_query($link, $sql2);

              echo"<script>alert(Email enviado correctamente.); document.location.href='LogIn.php';</script>";

        } else {
          echo "<p class=\"error\">Usuario no existente!<p><br/>";
          // echo "<span><a href=\"javascript:history.back()\">Volver</a></span>";
        }
      }
      ?>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>

</html>