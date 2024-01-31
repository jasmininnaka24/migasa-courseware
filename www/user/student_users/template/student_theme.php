
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link
      rel="stylesheet"
      href="../../assets/bootstrap-5.1.3-dist/css/bootstrap.min.css"
    >
    <link rel="stylesheet" href="../../assets/css/general_styles.css"  >
    <link rel="stylesheet" href="../../assets/css/pick_language.css"  >


<h3 class="text-center">ETO NA UNG <strong class="text-primary">STUDENT THEME</strong> OBSERVE MO UNG <strong class="text-primary">URL</strong> SA TAAS KADA MAG CLICK KA NG <strong class="text-primary">LINK</strong></h3>

<div class="text-center">
  <a class="fw-bold" href="./student_theme.php?home">Click mo to</a>
</div>

<?php


  if(isset($_GET['pick_language'])){ ?>
      <div class="col-12 col-sm-6 col-md-6 mb-5" >
    <div class="card border-0 shadow-lg mb-5 card-expanded shadow slideup1" style="height: 400px;  ">
      <img id="image" src="../../assets/img/pinoyflag.png" alt="Image" class="card-img-top first-image"><br><br>
      <div class="card-body text-center">
        <h2 class="card-title mb-0 font-weight-bold font-bold" style="font-size: 40px;">Filipino</h2>
        <button class="btn btn-primary font-reg mt-3">
          <a href="#" class="font-bold" style="color:white; text-decoration: none;">Matuto rito!</a>
        </button>
      </div>
    </div>
  </div>
  <? }


if(isset($_GET['home'])){ ?>

    <a href="./student_theme.php?pick_language">pick language</a>

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
<script src = "../../assets/js/background_music.js"></script>
      <script src = "../../assets/js/pick_language.js"></script>
      <script src = "../../assets/js/language_sound.js"></script> 
<?php include '../a_includes/footer.php'; ?>

  
