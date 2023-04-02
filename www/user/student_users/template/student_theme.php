

<!-- ANG DATABABASE NAKA INCLUDE NA UN DUN SA HEADER  -->


<?php //include '../functionality/dito nio na ilagay kung ano man un filename'; ?>

<?php include '../a_includes/header.php'; ?>

<h3 class="text-center">ETO NA UNG <strong class="text-primary">STUDENT THEME</strong> OBSERVE MO UNG <strong class="text-primary">URL</strong> SA TAAS KADA MAG CLICK KA NG <strong class="text-primary">LINK</strong></h3>

<div class="text-center">
  <a class="fw-bold" href="./student_theme.php?home">Click mo to</a>
</div>

<?php




  if(isset($_GET['home'])){ ?>

    <h2 class="mt-5">ETO LALABAS FOR MAIN MENU</h2>
    <a href="./student_theme.php?courses">click mo to another</a>

    <div class="display-3">MAIN MENU</div>
    <?php 
  }




  if(isset($_GET['courses'])){ ?>

    <h2 class="mt-5">ETO LALABAS FOR LIST OF COURSES</h2>
    <a href="./student_theme.php?profile">click mo to </a>

    <div class="display-3"> LIST OF COURSES</div>

    <?php 
  }



  if(isset($_GET['profile'])){ ?>

    <h2 class="mt-5">ETO LALABAS FOR PROFILE AND SUCH</h2>
    <div class="display-3">USER PROFILE</div>

    <a href="../../../hero_section.php">Balik ka na uli sa una hahaha</a>

    <?php 
  }

?>

<!-- CHECK MO YAN MGA INCLUDES FOLDER AND FILE PARA MAKITA MO -->
<?php include '../a_includes/footer.php'; ?>

  
