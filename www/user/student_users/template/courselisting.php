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
<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="../../assets/css/general_styles.css" />
   <link rel="stylesheet" href="../../assets/css/responsive_style.css" >
   <link rel="stylesheet" href="../../assets/css/modal1.css" >
    <title>MIGASA - Main Menu</title>
    <link rel="stylesheet" type="text/css" href="../../assets/bootstrap-5.1.3-dist/bootstrap.min.css">
</head>


<audio autoplay>
  <source src="../../assets/audios/menu_select.wav" >
  Your browser does not support the audio element.
</audio>
  <body>
  <!--<a href="#" onclick="changeImage()">
  <img id="sleeping-image" src="../../assets/img/MIGASA LOGO TYPE 3.png" alt="Sleeping Image">
</a>-->
<nav class="navbar navbar-expand-lg">
  <div class="container-fluid" style="display: flex; flex-direction: row; align-items: center;">
    <button class="navbar-toggler ms-auto align-middle order-2" type="button" id="navbarToggleBtn" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation" >
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand me-auto order-1 slide-from-left" href="#">
      <img src="../../assets/img/BIT TYP LOGO.png" alt="Logo" width="18%" height="18%" class="d-inline-block align-text-middle me-2">
    </a>
    <div class="scale">
    <div class="help-container " style="position: absolute; top: 40px; right: 200px;">
  <a class="nav-link" href="#" data-toggle="modal" data-target="#helpModal">
    <img src="../../assets/img/user1.png" width="30" height="30" alt="Manual">
    <span class="font-med" style="color: black;">User</span>
  </a>
</div>
    </div>
    <div class="exit-container " style="position: absolute; top: 40px; right: 120px;">
    <a class="nav-link" href="#">
            <img src="../../assets/img/manual.png" width="30" height="30" alt="Exit">
            <span class="font-med" style="color: black;"> Help</span>
          </a>
    </div>
    <div class="exit-container " style="position: absolute; top: 40px; right: 50px;">
    <a class="nav-link" href="../../student_users/template/pick_language.php">
            <img src="../../assets/img/cancel.png" width="30" height="30" alt="Exit">
            <span class="font-reg" style="color: black;"> Exit</span>
          </a>
    </div>
  </div>
  </div>
</nav>



<!--DESIGN-->
<div class="image-behind-text_small fade-in-1">
  <img src="../../assets/img/BITBee HAPPY_1.png" width="350" alt="">
</div>


<!--DESCRIPTION-->
<div class="container" >
  <div class="row">
    <div class="col ">
    </div>
    <div class="col-6">
    <h1 style="text-align:center;  position:relative; font-size: 300%;" class="font-bold fade-in"><b>Let's learn!</b></h1>
    </div>
    <div class="col ">
    </div>
  </div>
</div>


<!--COURSES-->

<div class="container" >
  <div class="row">











<?php
  $courses_db = $conn->prepare('SELECT * FROM course_table');
  $courses_db->execute();

  while($course_row = $courses_db->fetch(PDO::FETCH_ASSOC)){ 
    $course_title = $course_row['course_title'];
    $course_desc = $course_row['course_desc'];
    $course_icon = $course_row['course_icon'];
    ?>

    <div class="col-md-3 slideup">
      <div class="card border-0  mb-5 card-expanded shadow slideup" style="border-radius: 40px; ">
      <img src="../../../backend_storage/uploaded_icons/<?php echo $course_icon; ?>" alt="Image" class="card-img-top fade-in-1">
      <div class="card-body" style="display: flex; flex-direction: column; justify-content: space-between;">
        <div>
          <h5 class="card-title mb-0 font-weight-bold font-bold"><?php echo $course_title; ?></h5>
          <br>
          <p class="card-text font-med"style = "padding-bottom: 20px;"><?php echo $course_desc; ?></p>
        </div>
        <button id="myButton" class="btn-word font-bold" onclick="playSoundAndRedirect()" style="align-self: center;">
          <a href="#" style="color:white; font-size: 130%; text-decoration: none;">Click Here!</a>
          <audio id="myAudio" src="../../assets/audios/pen1.wav"></audio>
          </button>
        </div>
      </div>
    </div>

  <?php
  }
?>










  </div>
</div>




   <!-- modal -->
   <div class="modal fade" id="helpModal" tabindex="-1" role="dialog" aria-labelledby="helpModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-bold" id="helpModalLabel">User Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body font-med">
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" class="form-control" id="username" placeholder="Anvi_hacker69" readonly>
        </div>
        <div class="form-group">
          <label for="firstName">First Name:</label>
          <input type="text" class="form-control" id="firstName" placeholder="Anvi" readonly>
        </div>
        <div class="form-group">
          <label for="lastName">Last Name:</label>
          <input type="text" class="form-control" id="lastName" placeholder="Hacker" readonly>
        </div>
        <div class="form-group">
          <label for="userType">User Type:</label>
          <input type="text" class="form-control" id="userType" placeholder="Professional" readonly>
        </div>
      </div>
      <div class="modal-footer">
      <a href="#" style="text-decoration:none; position: relative;">
  <img src="../../assets/img/certifi.png" width="35" height="35" alt="certificate">
  <span class="certificate-text font-bold">Certificate</span>
</a>
     

        <button type="button" class="btn btn-danger font-med" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


  </body>

 
  <script src="../../assets/js/modal3.js"></script>
  <script src="../../assets/js/modal1.js"></script>
           <script src = "../../assets/js/sound.js"></script>
            <script src="../../assets/bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
</html>