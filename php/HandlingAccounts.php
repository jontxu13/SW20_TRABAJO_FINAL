<?php
session_start();
if (!isset($_SESSION["usuario"]) || $_SESSION["tipo"]==1 || $_SESSION["tipo"]==2) {
  header("location:LogIn.php");
} else {
?>
  <!DOCTYPE html>
  <html>

  <head>
    <?php include '../html/Head.html' ?>
    <style>
      .table_Questions {
        margin: auto;
        border-collapse: collapse;
      }

      td,
      th {
        padding: 5px;
      }

      th {
        background-color: #dbd2c3;
      }

      #div1 {
        overflow: scroll;
        height: 100%;
        width: 100%;
      }

      #div1 table {
        width: 95%;
        background-color: lightgray;
      }
    </style>
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/changeState.js"></script>
    <script src="../js/deleteUser.js"></script>
  </head>

  <body>
    <?php include '../php/Menus.php' ?>
    <?php include '../php/DbConfig.php' ?>
    <section class="main" id="s1">
      <div id="div1">
        <!--Código PHP para mostrar una tabla con las preguntas de la BD.<br>
      La tabla no incluye las imágenes-->
        <?php
        //Creamos la conexion con la BD.
        $link = mysqli_connect($server, $user, $pass, $basededatos);
        if (!$link) {
          die("Fallo al conectar con la base de datos: " . mysqli_connect_error());
        }
        // Operar con la BD
        $sql = "SELECT * FROM usuarios;";
        $resul = mysqli_query($link, $sql);
        echo '<table border="1px" class="table_Questions"><tr><th>Email</th><th>Nombre Apellidos</th><th>Contraseña</th><th>Foto</th><th>Estado</th><th>Borrar</th></tr>';
        $i=1;
        while ($row = mysqli_fetch_array($resul)) {
          if ($row['estado'] == 1) {
            $estado = "Activo";
          } else {
            $estado = "Bloqueado";
          }
          echo "<tr id='fila" . $i . "'><td><a href=\"mailto:" . $row['email'] . "\">" . $row['email'] . "</a></td><td>" . $row['nomap'] . "</td><td>" . $row['pass'] . "</td><td><img width=\"150\" height=\"150\" src=\"data:image/*;base64, " . $row['imagen'] . "\" alt=\"Sin imagen relacionada\"/></td><td id='estado" . $i . "'>" . $estado . " <input type='button' onclick='updateState(\"" . $row['email'] . "\" , " . $row['tipousu'] . ", \"" . "estado" . $i . "\")' value='Cambiar'/></td><td><input type='button' onclick='deleteUser(\"" . $row['email'] . "\" , " . $row['tipousu'] . ", \"" . "fila" . $i . "\")' value='Borrar'/></td></tr>";
          $i = $i +1;
        }
        echo "</table>";
        mysqli_close($link);
        ?>
      </div>
    </section>
    <?php include '../html/Footer.html' ?>
  </body>

  </html>
<?php
}
?>