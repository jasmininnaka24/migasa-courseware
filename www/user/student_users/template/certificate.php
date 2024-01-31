<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
    <link rel="stylesheet" type="text/css" href="../../assets/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/general_styles.css"  >
    <link rel="stylesheet" href="../../assets/css/modal1.css" >
    <link rel="stylesheet" href="../../assets/css/certificate.css" >

    <body class = "slideup">



    <nav class="navbar navbar-expand-lg">
  <div class="container-fluid" style="display: flex; flex-direction: row; align-items: center;">
    <button class="navbar-toggler ms-auto align-middle order-2" type="button" id="navbarToggleBtn" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand me-auto order-1 slide-from-left" href="#">
      <img src="../../assets/img/BIT TYP LOGO.png" alt="Logo" width="15%" height="15%" class="d-inline-block align-text-middle me-2">
    </a>
    <div class="progress" style="width: 50%; height: 30px; position: absolute; left: 24%;">
  <div class="progress-bar bg-danger font-bold"  role="progressbar" style="width: 50%; " aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
</div>

   <!--menu-->
   <div class="dropdown" style="position: absolute; top: 40px; right: 140px; text-decoration: none;">
  <button class="dropdown-button font-med">Menu &#9660;</button>
  <div class="dropdown-content font-med">
    <a href="#"  class="nav-link" href="#" data-toggle="modal" data-target="#helpModal">
      <img src="../../assets/img/user1.png" alt="User Icon">
      <span>User</span>
</a>
    <a href="../../student_users/template/courselisting.php" class="nav-link">
    <img src="../../assets/img/courses1.png" alt="Help Icon">  
    <span>All Courses </span> 
  </a>
    <a href="../../student_users/template/courselisting.php" class="nav-link">
    <img src="../../assets/img/courses.png" alt="Help Icon">  
      <span>Enrolled Courses</span>
    </a>
    <a href="#" class="nav-link">
      <img src="../../assets/img/manual.png" alt="Help Icon">
      <span>Help</span>
    </a>
    <a href="../../student_users/template/certificate.php" class="nav-link">
    <img src="../../assets/img/certifi.png" alt="Help Icon">
    <span>Certificates</span>
    </a>
  </div>
</div>

      <div class="exit-container " style="position: absolute;  top: 30px; right: 50px;">
        <a class="nav-link" href="../../student_users/template/course_vid.php">
          <img src="../../assets/img/cancel.png" width="30" height="30" alt="Exit">
          <span class="font-reg" style="color: black;"> Exit</span>
        </a>
      </div>
    </div>
  </div>
</nav>



<!--certificate-->

<form action="#">
  <div class="container">
    <div class="card" style="border: 3px solid; position: relative;">
      <img class="card-img-left btn-prev" src="../../assets/img/left.png" style="position: absolute; top: 50%; left: 0; transform: translate(-100%, -50%); height: 30px; width: 30px;" alt="Previous">
      <a href="./view_certificate.php?view_cert=<?php echo 43; ?>">
        <img class="card-img-top text-center" src="logo.png" style="width: 100%; height: 100%; padding: 10%;" alt="Bit Typ Logo">
      </a>
      <img class="card-img-right btn-next" src="../../assets/img/right.png" style="position: absolute; top: 50%; right: 0; transform: translate(100%, -50%); height: 30px; width: 30px;" alt="Next">
    </div>
    <a id="download-link" class="btn btn-danger mt-3" download="logo.png">Download</a>
  </div>
</form>





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

<script src="../../assets/js/certificate.js"></script>
    <script src="../../assets/js/modal3.js"></script>
<script src="../../assets/js/dropdown.js"></script>
  <script src="../../assets/js/modal1.js"></script>
</body>

</html>