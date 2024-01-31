<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="../../../user/assets/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../assets/css/general_styles.css" >  

    <link rel="stylesheet" href="../../../user/assets/css/modal1.css" >
    <link href='../../../user/assets/css/prof_course.css' rel='stylesheet'>


</head>
<body class = "slideup">
    <!--navbar-->
    <nav class="navbar navbar-expand-lg">
  <div class="container-fluid" style="display: flex; flex-direction: row; align-items: center;">
    <button class="navbar-toggler ms-auto align-middle order-2" type="button" id="navbarToggleBtn" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation" >
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand me-auto order-1 slide-from-left" href="#">
      <img src="../../../assets/img/BIT TYP LOGO.png" alt="Logo" width="18%" height="18%" class="d-inline-block align-text-middle me-2">
    </a>
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




<!--content-->
<div class="container-fluid">
  <div class="row align-items-center">

  <div class="col-lg-8" style="padding-bottom: 27px;">
  <div class="card shadow-sm">
    <div class="card-body">
      <h2 class="card-title font-bold mb-4">Course Description:</h2>
      <p class="font-med card-text text-justify" style="font-size: 100%;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos illo dolorum modi in, molestiae ullam ipsum quibusdam vel earum iusto adipisci voluptate maxime sunt neque illum laboriosam magnam quisquam fuga.</p>
    </div>
  </div>
  <div class="card shadow-sm mt-4" style="overflow-x: auto; height: 20%;">
    <div class="card-body">
      <h2 class="card-title font-bold mb-4">Curriculum:</h2>
      <ul class="font-med list-group list-group-flush">
        <li class="list-group-item d-flex justify-content-between align-items-center">1 Lecture Introduction <img src="../../../user/assets/img/book.png" alt="Image" class="ml-2" style="width: 40px; height: 40px;"></li>
        <li class="list-group-item d-flex justify-content-between align-items-center">2 Quos illo dolorum modi in, molestiae ullam ipsum quibusdam vel earum iusto <img src="../../../user/assets/img/book.png" alt="Image" class="ml-2" style="width: 40px; height: 40px;"></li>
        <li class="list-group-item d-flex justify-content-between align-items-center">3 Lecture Introduction <img src="../../../user/assets/img/book.png" alt="Image" class="ml-2" style="width: 40px; height: 40px;"></li>
        <li class="list-group-item d-flex justify-content-between align-items-center">1 Lecture Introduction <img src="../../../user/assets/img/book.png" alt="Image" class="ml-2" style="width: 40px; height: 40px;"></li>
        <li class="list-group-item d-flex justify-content-between align-items-center">1 Lecture Introduction <img src="../../../user/assets/img/book.png" alt="Image" class="ml-2" style="width: 40px; height: 40px;"></li>
        <li class="list-group-item d-flex justify-content-between align-items-center">1 Lecture Introduction <img src="../../../user/assets/img/book.png" alt="Image" class="ml-2" style="width: 40px; height: 40px;"></li>
      </ul>
    </div>
  </div>
</div>



    <div class="col-4 text-center" style="padding-bottom: 210px;" >
      <div class="card mb-5 card-expanded shadow slideup1" style="height: 60%; width: 85%;padding-top: 20px; background-color: #F7F1F0;  ">
        <img id="image2" src="../../../assets/img/image-removebg-preview.png" alt="Image" class="card-img-top"><br><br>
        <div class="card-body">
          <h2 class="card-title mb-0 font-weight-bold font-bold" style="font-size: 200%;">Microsoft Word</h2>
          <h5 class ="font-med"> Total numbers of Lessons: 10</h5>
          <h5 class ="font-med"> Total numbers of activities: 10</h5>
          <h5 class ="font-med"> Enrolled Students: 10</h5>
          <button id="myButton" class="btn-word font-bold" onclick="playSoundAndRedirect()" style="align-self: center;">
      <a href="#" style="color:white; font-size: 130%; text-decoration: none;">Enroll</a>
      <audio id="myAudio" src="../../../assets/audios/pen1.wav"></audio>
    </button>
        </div>
      </div>
    </div>
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
<script src="../../../user/assets/js/prof_course.js"></script>
<script src="../../../assets/bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
</body>
</html>