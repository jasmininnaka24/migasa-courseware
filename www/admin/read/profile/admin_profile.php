<?php
  ob_start();
  session_start();
  include '../database.php';
  include '../../includes/session_role.php';
  include '../../category_includes/activity_folder/processingActivityFunctionality.php';
  include '../../category_includes/scoring_folder/processingScoringFunctionality.php';
  include '../../category_includes/admin_profile/processingAdminFunctionality.php';

  // include '../a_includes/admin_header.php';
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
    <link rel="stylesheet" href="../../assets/icons/fontawesome/css/all.css" />
    <link rel="stylesheet" href="../../assets/icons/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="../../assets/css/add_course.css">
    <link rel="stylesheet" href="../../assets/css/general_styles.css" />
    <link rel="stylesheet" href="../../assets/css/add_video.css">
    <link rel="stylesheet" href="../../assets/css/admin_home.css">
    <link rel="stylesheet" href="../../assets/css/course_display.css">
    <link rel="stylesheet" href="../../assets/css/sidebar.css">    
    <link rel="stylesheet" href = "../../assets/css/manual_style.css">
    <link rel="stylesheet" href = "../../assets/css/verification.css">


    <title>Document</title>
  </head>

  <?php include '../a_includes/admin_sidebar.php'; ?>
  <?php include '../a_includes/admin_sidebar_section_header.php'; ?>

  <body class="">
    <main style="height: 90%;" class="w-100 d-flex align-items-center justify-content-center flex-column anim-to-top-slow">
    <div class="col-10">
      <div class="display-3 font-med mb-1">Admin Profile</div>
      <?php include "../../category_includes/admin_profile/adminDetailsFormProvider.php"; ?>
    </div>
  </main>
  </section>

<?php include '../a_includes/admin_footer.php'; ?>
