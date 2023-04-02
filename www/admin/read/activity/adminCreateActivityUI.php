<?php
  ob_start();
  session_start();
  include '../database.php';
  include '../../includes/session_role.php';
  include '../../category_includes/activity_folder/processingActivityFunctionality.php';
  include '../../category_includes/scoring_folder/processingScoringFunctionality.php';

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
    <link
      rel="stylesheet"
      href="../../assets/summernote/summernote-lite.min.css"
      />

    <title>Document</title>
  </head>

  <body class="">
    <a href="../../../root_filassets/s"></a>



<main class="anim-to-top-slow">
<!-- LIST OF QUESTIONS AND CHOICES -->
<?php 
  if(isset($_GET['course_id_createAct']) && isset($_GET['video_id_createAct'])){
    $course_id = $_GET['course_id_createAct'];
    $video_id = $_GET['video_id_createAct'];

    $select_course_video = $conn->prepare("SELECT * FROM videos_table WHERE course_id = :course_id AND id = :video_id");
    $select_course_video->bindParam(":course_id", $course_id);
    $select_course_video->bindParam(":video_id", $video_id);
    $select_course_video->execute();
    $fetch_data = $select_course_video->fetch(PDO::FETCH_ASSOC);
    $course_title = $fetch_data['course_title'];
    $video_title = $fetch_data['video_title'];
  }
?>
<div class="col-10 mx-auto text-center h4 mt-5 mb-4" style="margin-bottom: 2rem; color: #777">
  Make an activity under <span class="font-bold" style="color: #444"><?php echo $course_title; ?></span> course and lesson <span class="font-bold" style="color: #444"><?php echo $video_title; ?></span>.
</div>
<?php 
  include '../../category_includes/activity_folder/add_activity/activityListDisplayFunctionality.php'; 
?>

<!-- ADDING ACTIVITY AND CHOICES FORM -->
<div id="make_act">
  <?php include '../../category_includes/activity_folder/add_activity/activityDetailsFormProvider.php'; ?>
</div>
</main>

<a href="#make_act" class="position-fixed smooth-scroll " style="bottom: 5%; right: 5%">
  <i class="fa-solid fa-circle-arrow-down text-dark" style="font-size: 25px;"></i>
</a>
<script>
  let delete_this = (e) => {
    document.querySelector('.modals').classList.remove('hidden');
    document.querySelector('.overlay').classList.remove('hidden');
    document.querySelector('.hide_act_modal').classList.add('hidden');
    e.preventDefault();
  }
</script>
<?php include '../a_includes/admin_footer.php'; ?>
