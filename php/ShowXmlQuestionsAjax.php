<?php
header("Cache-Control: no-store");
          echo '<table border="1px" class="table_Questions"><tr><th>Email</th><th>Enunciado</th><th>Respuesta Correcta</tr>';
          $questions = simplexml_load_file('../xml/Questions.xml');
          foreach ($questions->xpath('//assessmentItem') as $question) {
            $enun = $question->itemBody;
            $resp = $question->correctResponse;
            echo "<tr><td><a href=\"mailto:" . "$question[author]" . "\">" . "$question[author]" . "</a></td><td>" . "$enun->p" . "</td><td>" . "$resp->response" . "</td></tr>";
          }
          echo "</table>";
    ?>