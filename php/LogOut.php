<html>

<head>
  <?php include '../html/Head.html' ?>
  <style>
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
  <section class="main" id="s1">
    <div>
      <?php
      echo "<script> alert(\"¡Hasta pronto!\"); document.location.href='Layout.php'; </script>";
      session_start();
      unset($_SESSION['session_username']);
      session_destroy();
      ?>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>

</html>