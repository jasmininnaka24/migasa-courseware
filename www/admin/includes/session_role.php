<?php
  if($_SESSION['role'] !== 'Admin'){
    header("Location: ../../admin_home.php");
  }
?>
