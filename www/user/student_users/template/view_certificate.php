<?php
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
    <?php 
      if(isset($_GET['view_cert'])){
        $cert_id = $_GET['view_cert'];

        $select_width_height = $conn->prepare("SELECT width, height FROM certificate_template WHERE id = :cert_id");
        $select_width_height->bindParam(":cert_id", $cert_id);
        $select_width_height->execute();

        $fetch_width_height = $select_width_height->fetch(PDO::FETCH_ASSOC);
        $width = $fetch_width_height['width'];
        $height = $fetch_width_height['height'];
      }
    ?>
    <style>
      .certificate {
        width: <?php echo $width . 'in'; ?>;
        height: <?php echo $height . 'in'; ?>;
        border: 2px solid #999;
        object-fit: cover;
      }
    </style>
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


<?php
    if(isset($_GET['view_cert'])){
      $cert_id = $_GET['view_cert'];

      $select_template_styles = $conn->prepare("SELECT * FROM certificate_styles_table WHERE cert_id = :cert_id");
      $select_template_styles->bindParam(":cert_id", $cert_id);
      $select_template_styles->execute();
      $fetch_template_styles = $select_template_styles->fetch(PDO::FETCH_ASSOC);


      $name_pos_left = $fetch_template_styles['name_pos_left'];
      $name_pos_top = $fetch_template_styles['name_pos_top'];
      $name_pos_size = $fetch_template_styles['name_pos_size'];

      $course_pos_left = $fetch_template_styles['course_pos_left'];
      $course_pos_top = $fetch_template_styles['course_pos_top'];
      $course_pos_size = $fetch_template_styles['course_pos_size'];

      $date_pos_left = $fetch_template_styles['date_pos_left'];
      $date_pos_top = $fetch_template_styles['date_pos_top'];
      $date_pos_size = $fetch_template_styles['date_pos_size'];
      
      $ave_pos_left = $fetch_template_styles['ave_pos_left'];
      $ave_pos_top = $fetch_template_styles['ave_pos_top'];
      $ave_pos_size = $fetch_template_styles['ave_pos_size'];

      $select_template = $conn->prepare("SELECT cert_img FROM certificate_template WHERE id = :cert_id");
      $select_template->bindParam(":cert_id", $cert_id);
      $select_template->execute();

      $fetch_template_db = $select_template->fetch(PDO::FETCH_ASSOC);
      $template_img = $fetch_template_db['cert_img'];

        ?>

        <div class="d-flex align-items-center justify-content-center flex-column w-100" style="min-height: 100vh;">
          <div class="certificate position-relative" id="printableArea">
            <p class="lead font-med position-absolute" style="left: <?php echo $name_pos_left; ?>%; top: <?php echo $name_pos_top; ?>%; font-size: <?php echo $name_pos_size; ?>px">Anthony Rodriquez</p>

            
            <p class="lead font-med position-absolute" style="left: <?php echo $course_pos_left; ?>%; top: <?php echo $course_pos_top; ?>%; font-size: <?php echo $course_pos_size; ?>px">Microsoft Office Powerpoint</p>
            
            <p class="lead font-med position-absolute" style="left: <?php echo $date_pos_left; ?>%; top: <?php echo $date_pos_top; ?>%; font-size: <?php echo $date_pos_size; ?>px">2023-04-18</p>

            <p class="lead font-med position-absolute" style="left: <?php echo $ave_pos_left; ?>%; top: <?php echo $ave_pos_top; ?>%; font-size: <?php echo $ave_pos_size; ?>px">90%</p>

            
            <img src="../../../backend_storage/uploaded_certificate_templates/<?php echo $template_img; ?>" width="100%" height="100%" alt="">
          </div>
          
          <div class="my-5 d-flex align-items-center justify-content-center">
            <div onclick="printDiv('printableArea')" class="px-4 mx-3 rounded-pill btn bg-danger text-light" style="font-size: 18px;">Download</div>
            <a href="./certificate.php" class="text-decoration-none text-dark">
              <div class="lead font-med rounded-pill bg-light btn px-4 mx-3" style="border: 1px solid #444; font-size: 18px;">Done</div>
            </a>
          </div>
        </div>
          <!-- <script src="../../../admin/assets/html2canvas/dist/html2canvas.min.js"></script>
          <script>
            document.getElementById('download-this').onclick = function() {
              const screenshotTarget = document.getElementById('main-page');
              
              html2canvas(screenshotTarget).then((canvas) => {
                const base64image = canvas.toDataURL("image/png");
                var anchor = document.createElement('a');
                anchor.setAttribute('href', base64image);
                anchor.setAttribute('download', 'certificate.png');
                anchor.click();
                anchor.remove();
              });
            };
          </script> -->
          <script>
          function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
          }
        </script>
        <?php
      }
    ?>




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