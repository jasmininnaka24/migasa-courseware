<?php
  if($_SESSION['role'] !== 'Super Admin'){
    header("Location:../../../hero_section.php");
  }
?>
