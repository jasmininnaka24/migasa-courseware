<?php
  ob_start();
  session_start();
  include '../database.php';
  include '../../includes/session_role.php';
  include '../../category_includes/activity_folder/processingActivityFunctionality.php';
  include '../../category_includes/scoring_folder/processingScoringFunctionality.php';
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
    
    <script src="../../assets/js/jquery-3.5.1.min.js"></script>
    <link
      rel="stylesheet"
      href="../../assets/summernote/summernote-lite.min.css"
      /> 
    <script src="../../assets/summernote/summernote-lite.js"></script> 
    <title>Document</title>
  </head>

  <body class="">
  </head>

  <body class="">
<!-- ADDING ACTIVITY AND CHOICES FORM -->
<main class="anim-to-top-slow">

<?php include '../../category_includes/activity_folder/edit_activity/edit_activity_details.php'; ?>

</main>
<?php include '../a_includes/admin_footer.php'; ?>
