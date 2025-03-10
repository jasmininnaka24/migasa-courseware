<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
    <link rel="stylesheet" type="text/css" href="../../../user/assets/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../user/assets/css/general_styles.css"  >
    <link rel="stylesheet" href="../../../user/assets/css/prof_desc.css" >
    <link rel="stylesheet" href="../../../user/assets/css/w3.css" >
    <link rel="stylesheet" href="../../../user/assets/css/modal1.css" >
<body class = "slideup">

<!--<audio id="autoA" autoplay>
  <source src="../assets/audios/happy.wav">
  Your browser does not support the audio element.
</audio>-->

<!--navbar-->
<nav class="navbar navbar-expand-lg">
  <div class="container-fluid" style="display: flex; flex-direction: row; align-items: center;">
    <button class="navbar-toggler ms-auto align-middle order-2" type="button" id="navbarToggleBtn" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand me-auto order-1 slide-from-left" href="#">
      <img src="../../../assets/img/BIT TYP LOGO.png" alt="Logo" width="18%" height="18%" class="d-inline-block align-text-middle me-2">
    </a>
    <div class="progress" style="width: 50%; height: 30px; position: absolute; left: 25%;">
  <div class="progress-bar bg-danger font-bold"  role="progressbar" style="width: 50%; " aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
</div>

 <!--menu-->
 <div class="dropdown" style="position: absolute; top: 40px; right: 130px; text-decoration: none;">
  <button class="dropdown-button font-med">Menu &#9660;</button>
  <div class="dropdown-content font-med">
    <a href="#"  class="nav-link" href="#" data-toggle="modal" data-target="#helpModal">
      <img src="../../../user/assets/img/user1.png" alt="User Icon">
      <span>User</span>
</a>
    <a href="../../../user/professional_users/template/prof_listing.php" class="nav-link">
    <img src="../../../user/assets/img/courses1.png" alt="Help Icon">  
    <span>All Courses </span> 
  </a>
    <a href="../../../user/professional_users/template/prof_listing.php" class="nav-link">
    <img src="../../../user/assets/img/courses.png" alt="Help Icon">  
      <span>Enrolled Courses</span>
    </a>
    <a href="#"class="nav-link">
      <img src="../../../assets/img/manual.png" alt="Help Icon">
      <span>Help</span>
    </a>
    <a href="../../../user/professional_users/template/prof_certificates.php" class="nav-link">
    <img src="../../../user/assets/img/certifi.png" alt="Help Icon">
    <span>Certificates</span>
    </a>
  </div>
</div>
    <div class="exit-container " style="position: absolute; top: 31px; right: 50px;">
    <a class="nav-link" href="../../../user/professional_users/template/prof_listing.php">
            <img src="../../../assets/img/cancel.png" width="30" height="30" alt="Exit">
            <span class="font-med" style="color: black;"> Exit</span>
          </a>
    </div>
  </div>
  </div>
</nav>

<!--designs-->

<div class="image-behind-text_small fade-in-1">
  <img src="../../../assets/img/bee_bg.png" width="330" alt="">
</div>
<div class="image-behind-text_big fade-in-1">
  <img id="image2" src="../../../assets/img/canva_1.png" width="200" alt="">
</div>

<!--Description-->
<div class="container-fluid">
  <div class="row align-items-center">
    <div class="col-1 ">
    </div>
    <div class="col-10 text-center">
      <h3 class="font-bold display-4"> Microsoft Word </h3>
      <h5 ><p class="font-reg fade-in"> In this course, Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum fugit cupiditate amet adipisci, non obcaecati distinctio odit quasi minima laborum alias autem labore tempore eaque! Provident repellendus ut quod quasi!</p></h5> 
    </div>
    <div class="col-1"></div>
  </div>
</div>



<!--lessons-->

<div class="container" style="padding-right: 30%;">
  <div class="row ">
    <div class="col-md-6 mb-4">
      <div class="card" style="padding-bottom: 5%;">
        <a href="#" class="card-link">
          <div class="card-video">
            <img src="../../../assets/img/BIT TYP LOGO.png" width="100%" alt="">
          </div>
          <div class="card-content">
            <h3 class="font-med">Lesson 1: Understanding the Internet</h3>
          </div>
        </a>
        <button id="myButton" class="btn-word font-bold" onclick="playSoundAndRedirect()" style="align-self: center;">
          <a href="#" style="color:white; font-size: 130%; text-decoration: none;">Click Here!</a>
          <audio id="myAudio" src="../../../assets/audios/pen1.wav"></audio>
        </button>
      </div>
    </div>
    <div class="col-md-6 mb-4">
      <div class="card" style="padding-bottom: 5%;">
        <a href="#" class="card-link">
          <div class="card-video">
            <img src="../../../assets/img/BIT TYP LOGO.png" width="100%" alt="">
          </div>
          <div class="card-content">
            <h3 class="font-med">Lesson 1: Understanding the Internet</h3>
          </div>
        </a>
        <button id="myButton" class="btn-word font-bold" onclick="playSoundAndRedirect()" style="align-self: center;">
          <a href="#" style="color:white; font-size: 130%; text-decoration: none;">Click Here!</a>
          <audio id="myAudio" src="../../../assets/audios/pen1.wav"></audio>
        </button>
      </div>
    </div>
    <div class="col-md-6 mb-4">
      <div class="card" style="padding-bottom: 5%;">
        <a href="#" class="card-link">
          <div class="card-video">
            <img src="../../../assets/img/BIT TYP LOGO.png" width="100%" alt="">
          </div>
          <div class="card-content">
            <h3 class="font-med">Lesson 1: Understanding the Internet</h3>
          </div>
        </a>
        <button id="myButton" class="btn-word font-bold" onclick="playSoundAndRedirect()" style="align-self: center;">
          <a href="#" style="color:white; font-size: 130%; text-decoration: none;">Click Here!</a>
          <audio id="myAudio" src="../../../assets/audios/pen1.wav"></audio>
        </button>
      </div>
    </div>
  </div>
</div>


<div class="children-friendly position-fixed" style="bottom: 5%; left: 95%;" >
  <div class="volume-container">
    <input type="range" min="0" max="1" step="0.1" value="1" id="volume-slider">
  </div>
  <img src="../../../assets/img/volume.png" alt="Mute" id="mute-btn">
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
      <a href="../../../user/professional_users/template/prof_certificates.php" style="text-decoration:none; position: relative;">
  <img src="../../../user/assets/img/certifi.png" width="35" height="35" alt="certificate">
  <span class="certificate-text font-bold">Certificate</span>
</a>
     

        <button type="button" class="btn btn-danger font-med" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script src="../../../user/assets/js/modal3.js"></script>
<script src="../../../user/assets/js/dropdown.js"></script>
  <script src="../../../user/assets/js/modal1.js"></script>
            <script src = "../../../user/assets/js/prof_desc.js"></script>
            <script src = "../../../user/assets/js/prof_sound1.js"></script>
            <script src = "../../../user/assets/js/mute_desc.js"></script>
           

</body>

</html>