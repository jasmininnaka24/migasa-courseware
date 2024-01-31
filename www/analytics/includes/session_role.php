<?php
  if($_SESSION['role'] !== 'Admin'){
    header("Location: ../hero_section.php");
  }
?>
