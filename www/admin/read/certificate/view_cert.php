<?php 
  ob_start();
  session_start();
  include '../database.php';

  if($_SESSION['role'] !== 'Super Admin'){
    header("Location: ../hero_section.php");
  }


?>
   <?php
      if(isset($_POST['try_style'])){
        $_SESSION['name_pos_left'] = $_POST['name_pos_left'];
        $_SESSION['name_pos_top'] = $_POST['name_pos_top'];
        $_SESSION['name_pos_size'] = $_POST['name_pos_size'];

        $_SESSION['course_pos_left'] = $_POST['course_pos_left'];
        $_SESSION['course_pos_top'] = $_POST['course_pos_top'];
        $_SESSION['course_pos_size'] = $_POST['course_pos_size'];

        $_SESSION['date_pos_left'] = $_POST['date_pos_left'];
        $_SESSION['date_pos_top'] = $_POST['date_pos_top'];
        $_SESSION['date_pos_size'] = $_POST['date_pos_size'];
        
        $_SESSION['ave_pos_left'] = $_POST['ave_pos_left'];
        $_SESSION['ave_pos_top'] = $_POST['ave_pos_top'];
        $_SESSION['ave_pos_size'] = $_POST['ave_pos_size'];
        

      }

      if(isset($_POST['save_template'])){

        if(isset($_GET['cert_id'])){
          $cert_id = $_GET['cert_id'];
        }

        $name_pos_left = $_POST['name_pos_left'];
        $name_pos_top = $_POST['name_pos_top'];
        $name_pos_size = $_POST['name_pos_size'];

        $course_pos_left = $_POST['course_pos_left'];
        $course_pos_top = $_POST['course_pos_top'];
        $course_pos_size = $_POST['course_pos_size'];

        $date_pos_left = $_POST['date_pos_left'];
        $date_pos_top = $_POST['date_pos_top'];
        $date_pos_size = $_POST['date_pos_size'];
        
        $ave_pos_left = $_POST['ave_pos_left'];
        $ave_pos_top = $_POST['ave_pos_top'];
        $ave_pos_size = $_POST['ave_pos_size'];

        $insert_styles = $conn->prepare("INSERT INTO certificate_styles_table (cert_id, name_pos_left, name_pos_top, name_pos_size, course_pos_left, course_pos_top, course_pos_size, date_pos_left, date_pos_top, date_pos_size, ave_pos_left, ave_pos_top, ave_pos_size) VALUES (:cert_id, :name_pos_left, :name_pos_top, :name_pos_size, :course_pos_left, :course_pos_top, :course_pos_size, :date_pos_left, :date_pos_top, :date_pos_size, :ave_pos_left, :ave_pos_top, :ave_pos_size)");

        $insert_styles->bindParam(":cert_id", $cert_id);

        $insert_styles->bindParam(":name_pos_left", $name_pos_left);
        $insert_styles->bindParam(":name_pos_top", $name_pos_top);
        $insert_styles->bindParam(":name_pos_size", $name_pos_size);

        $insert_styles->bindParam(":course_pos_left", $course_pos_left);
        $insert_styles->bindParam(":course_pos_top", $course_pos_top);
        $insert_styles->bindParam(":course_pos_size", $course_pos_size);

        $insert_styles->bindParam(":date_pos_left", $date_pos_left);
        $insert_styles->bindParam(":date_pos_top", $date_pos_top);
        $insert_styles->bindParam(":date_pos_size", $date_pos_size);

        $insert_styles->bindParam(":ave_pos_left", $ave_pos_left);
        $insert_styles->bindParam(":ave_pos_top", $ave_pos_top);
        $insert_styles->bindParam(":ave_pos_size", $ave_pos_size);
        $insert_styles->execute();

        $_SESSION['name_pos_left'] = null;
        $_SESSION['name_pos_top'] = null;
        $_SESSION['name_pos_size'] = null;

        $_SESSION['course_pos_left'] = null;
        $_SESSION['course_pos_top'] = null;
        $_SESSION['course_pos_size'] = null;

        $_SESSION['date_pos_left'] = null;
        $_SESSION['date_pos_top'] = null;
        $_SESSION['date_pos_size'] = null;
        
        $_SESSION['ave_pos_left'] = null;
        $_SESSION['ave_pos_top'] = null;
        $_SESSION['ave_pos_size'] = null;

        header("Location: ./view_cert.php?save_cert=$cert_id");


      }
    ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="../../assets/bootstrap-5.1.3-dist/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="../../assets/css/general_styles.css" />
    <link rel="stylesheet" href="../../assets/icons/fontawesome/css/all.css" />
    <link rel="stylesheet" href="../../assets/icons/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="../../assets/css/sidebar.css">
    <link rel="stylesheet" href="../../assets/css/admin_home.css">

    <title>Document</title>
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
        /* object-fit: cover; */
      }
    </style>
  </head>
  <body>
  <div class="sidebar close">
    <div class="logo-details">
      <a href="../../choose.php">
        <div class="img">
          <img src="../../assets/img/BIT TYP LOGO.png" width="100%" alt="">
        </div>
      </a>
    </div>
    <ul class="nav-links mt-2">
      <li class="list">
        <div class="icon-link list">
          <a href="#">
            <div class="img">
              <img src="../../assets/img/see.png" width="100%" alt="">
            </div>
            <span class="link_name">View</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">View Category</a></li>
          <li><a href="../../courses_display.php?language=all_languages"><i class="fa-solid fa-folder-open" style="font-size: 1rem;margin: -1rem -1.6rem;"></i> View Courses</a></li>
          <li><a href="../../view_lessons.php?language"><i class="fa-solid fa-video" style="font-size: 1rem;margin: -1rem -1.6rem;"></i> View Lessons</a></li>
        </ul>
      </li>

      <li>
        <div class="icon-link list">
          <a href="#">
            <div class="img">
              <img src="../../assets/img/create.png" width="100%" alt="">
            </div>
            <span class="link_name">Add</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li class="link_name">Add Category</a></li>
          <li><a href="../../read/course/adminCreateCourseUI.php?add_icon"><i class="fa-solid fa-folder-open" style="font-size: 1rem;margin: -1rem -1.6rem;"></i> Add Courses</a></li>
          <li><a href="../../read/videos/adminUploadVideoUI.php?language"><i class="fa-solid fa-video" style="font-size: 1rem;margin: -1rem -1.6rem;"></i> Add Lessons</a></li>
        </ul>
      </li>
      <li>
        <div class="icon-link list">
          <a href="#">
            <div class="img">
              <img src="../../assets/img/edit 2.png" width="100%" alt="">
            </div>
            <span class="link_name">Modify</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Modify Categories</a></li>
          <li><a href="../../modify_course.php?language"><i class="fa-solid fa-folder-open" style="font-size: 1rem;margin: -1rem -1.6rem;"></i> Modify Courses</a></li>
          <li><a href="../../modify_lessons.php?language"><i class="fa-solid fa-video" style="font-size: 1rem;margin: -1rem -1.6rem;"></i> Modify Lessons</a></li>
        </ul>
      </li>
      <li>
        <div class="icon-link list">
          <a href="#">
            <div class="img">
              <img src="../../assets/img/view.png" width="100%" alt="">
            </div>
            <span class="link_name">Settings</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Settings</a></li>
          <li><a href="../languages/language_home.php"><i class="fa-solid fa-globe" style="font-size: 1rem;margin: -1rem -1.6rem;"></i> Language Settings</a></li>
          <li><a href="../manual/admin_manual.php"><i class="fa-solid fa-book" style="font-size: 1rem;margin: -1rem -1.6rem;"></i> Manual Settings</a></li>
          <li><a href="../certificate/add_cert.php"><i class="fa-solid fa-book" style="font-size: 1rem;margin: -1rem -1.6rem;"></i> Certificate Settings</a></li>
        </ul>
      </li>
     
    <div class="profile-details ">
      <a href="../profile/admin_profile.php" class="d-flex align-items-center text-decoration-none hover_admin w-100">
        <div class="profile-content">
          <img src="../../assets/img/user.png" alt="profileImg">
        </div>
        <div class="name-job">
          <div class="profile_name font-bold" style="font-size:20px;">ADMIN PROFILE</div>
        </div>
      </a>
    </div>
  </li>
</ul>
</div>






<section class="home-section">
    <div class="d-flex align-items-center justify-content-between">
      <i class='bx bx-menu-alt-left' style="font-size: 38px; cursor: pointer;"></i>
      <i class="fa-regular fa-circle-xmark hidden" style="font-size: 30px; cursor: pointer;"></i>
      <a href="../../choose.php" class="text-decoration-none">
        <button
          class="btn mt-2 mt-2 d-flex align-items-center justify-content-center"
          style="height: 2.5rem"
          name="admin_logout"
        >
          <p
            style="margin-right: 0.4rem; font-size: 18px"
            class="font-med"
            >
            Home
          </p>
          <div>
            <img
            src="../../assets/img/exit 2.png"
            style="width: 20px; height: 16px; margin-top: -20px"
            width="100%"
            alt=""
            />
          </div>
        </button>
      </a>
    </div>


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

        <div class="mt-5 d-flex align-items-center justify-content-center flex-column w-100" style="min-height: 100vh;">
          <div class="position-relative" style="top: 0; left: 0;" id="printableArea">
            <p class="lead font-med position-absolute" style="left: <?php echo $name_pos_left; ?>%; top: <?php echo $name_pos_top; ?>%; font-size: <?php echo $name_pos_size; ?>px">Anthony Rodriquez</p>

            
            <p class="lead font-med position-absolute" style="left: <?php echo $course_pos_left; ?>%; top: <?php echo $course_pos_top; ?>%; font-size: <?php echo $course_pos_size; ?>px">Microsoft Office Powerpoint</p>
            
            <p class="lead font-med position-absolute" style="left: <?php echo $date_pos_left; ?>%; top: <?php echo $date_pos_top; ?>%; font-size: <?php echo $date_pos_size; ?>px">2023-04-18</p>

            <p class="lead font-med position-absolute" style="left: <?php echo $ave_pos_left; ?>%; top: <?php echo $ave_pos_top; ?>%; font-size: <?php echo $ave_pos_size; ?>px">90%</p>

            <div class="certificate">
              <img src="../../../backend_storage/uploaded_certificate_templates/<?php echo $template_img; ?>" width="100%" height="100%" alt="">
            </div>
          </div>
          
        </div>
          <div class="my-5 d-flex align-items-center justify-content-center">
            <div onclick="printDiv('printableArea')" class="px-4 mx-3 rounded-pill btn bgc-red-light" style="font-size: 18px;">Print</div>
            <a href="./add_cert.php" class="text-decoration-none text-dark">
              <div class="lead font-med rounded-pill bgc-gray-light btn px-4 mx-3" style="border: 1px solid #444; font-size: 18px;">Done</div>
            </a>
          </div>

          <!-- <script src="../../assets/html2canvas/dist/html2canvas.min.js"></script>
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


 

      <br>

  </section>


  <script src="../../assets/bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
  <script src="../../assets/icons/boxicons/dist/boxicons.js"></script>
  <script src="../../assets/js/modal.js"></script>
  <script src="../../assets/js/admin_sidebar.js"></script>
  <script src="../../assets/js/guide.js"></script>
  <script src="../../assets/js/activities_crudd.js"></script>
  <script src="../../assets/js/activities_list.js"></script>

  </body>
</html>