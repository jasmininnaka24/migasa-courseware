<?php
  date_default_timezone_set('Asia/Manila');

  try {
      $conn = new PDO("sqlite:../../../database.db");
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch(PDOException $e) {
      echo 'Exception -> ';
      var_dump($e->getMessage());
  }



?>