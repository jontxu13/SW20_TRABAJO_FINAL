<?php
include '../php/antiSQL.php';
header("Cache-Control: no-store");
          $questions = simplexml_load_file('../xml/Questions.xml');
          $logInMail = test_input($_POST['logInMail']);
          $cuantos = 0;
          $mios = 0;
          foreach ($questions->xpath('//assessmentItem') as $question) {
            $cuantos = $cuantos + 1;
            if($question['author']==$logInMail){
              $mios = $mios + 1;
            }
          }
          echo $mios . "/" . $cuantos;
?>