<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <style>
		.table_Questions {
			margin: auto;
      border-collapse: collapse;
      text-align: center;
    }
    td, th {
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
</head>
<body>
  <?php include '../php/Menus.php'?>
  <?php include '../php/DbConfig.php'?>
  <section class="main" id="s1">
    <div id = "div1">
      <?php
          echo '<table border="1px" class="table_Questions"><tr><th>Email</th><th>Enunciado</th><th>Respuesta Correcta</tr>';
          $questions = simplexml_load_file('../xml/Questions.xml');
          foreach ($questions->xpath('//assessmentItem') as $question) {
            $enun = $question->itemBody;
            $resp = $question->correctResponse;
            echo "<tr><td><a href=\"mailto:" . "$question[author]" . "\">" . "$question[author]" . "</a></td><td>" . "$enun->p" . "</td><td>" . "$resp->response" . "</td></tr>";
          }
          echo "</table>";
    ?>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
