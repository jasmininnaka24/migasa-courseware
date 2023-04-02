<?php

ob_start();
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
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../../assets/bootstrap-5.1.3-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../assets/css/general_styles.css">
  <link rel="stylesheet" href="../../assets/icons/fontawesome/css/all.css">

  <!-- LAGAY MO DITO ANG LINKS IF MERON MAN -->
</head>
<body>
  