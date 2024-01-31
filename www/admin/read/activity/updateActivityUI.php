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
    <style>
      .hover_btns{
        background: #eaeae5;
        color: #222;
        border: #444 1px solid;
      }
      .hover_btns:hover{
        color: #fff;
        background: #f20e0e;
        transition: all .2s ease-in-out;
      }
      .hover_btns:focus{
        color: #fff;
        background: #f20e0e;
        transition: all .2s ease-in-out;
      }
    </style>
  </head>

  <body class="">
  </head>

  <body class="">
   
<!-- LIST OF QUESTIONS AND CHOICES -->
<main class="">
<!-- LIST OF QUESTIONS AND CHOICES -->
<?php 
  if(isset($_GET['update_course_id']) && isset($_GET['update_video_activity'])){
    $course_id = $_GET['update_course_id'];
    $video_id = $_GET['update_video_activity'];

    $select_course_video = $conn->prepare("SELECT * FROM videos_table WHERE course_id = :course_id AND id = :video_id");
    $select_course_video->bindParam(":course_id", $course_id);
    $select_course_video->bindParam(":video_id", $video_id);
    $select_course_video->execute();
    $fetch_data = $select_course_video->fetch(PDO::FETCH_ASSOC);
    $video_title = $fetch_data['video_title'];
    
    $course_title_db = $conn->prepare("SELECT course_title FROM course_table WHERE id = :course_id");
    $course_title_db->bindParam(":course_id", $course_id);
    $course_title_db->execute();
    $fetch_course_title = $course_title_db->fetch(PDO::FETCH_ASSOC);
    $course_title = $fetch_course_title['course_title'];


  }
?>

<section class="container-fluid">
      <div class="d-flex align-items-center justify-content-between">
        <div></div>
        <div class="d-flex align-items-center">
          <a href="../../choose.php" class="text-decoration-none">
            <button
            class="btn mt-3 d-flex align-items-center justify-content-center"
            style="height: 2.5rem"
            name="admin_logout"
            >
            <p
            style="margin-right: 0.4rem; font-size: 18px"
            class="font-med pb-1"
            >
            Home
          </p>
          <div class="pb-2">
              <img
              src="../../assets/img/exit 2.png"
              style="width: 20px; height: 16px; margin-top: -20px"
              width="100%"
              alt=""
              />
            </div>
          </button>
        </a>
          <a href="../../videos_display.php?course_id_display=<?php echo $course_id; ?>" class="text-decoration-none">
            <button
            class="btn mt-3 d-flex align-items-center justify-content-center"
            style="height: 2.5rem"
            name="admin_logout"
            >
            <p
            style="margin-right: 0.4rem; font-size: 18px"
            class="font-med pb-1"
            >
            Video listing
          </p>
          <div class="pb-2">
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
      </div>

    </section>




<div class="d-flex align-items-center justify-content-center" style="margin-top: 2rem;">
  <a href="./updateActivityUI.php?update_course_id=<?php echo $course_id; ?>&update_video_activity=<?php echo $video_id; ?>&listOfAllActivities">
    <button 
    class="btn rounded-pill mx-3 px-3"
      style="font-size: 18px;
        <?php 
          if(isset($_GET['listOfAllActivities'])){
            echo "border: 2px solid #222; color: #222; font-weight: 600;";
          } else {
            echo "border: 1px solid #848e91; color: #848e91";
          }
        ?>
      " 
    >
    List of all activities
    </button>
  </a>
  <a href="./updateActivityUI.php?update_course_id=<?php echo $course_id; ?>&update_video_activity=<?php echo $video_id; ?>&listOfSelectedActivites">
  <button 
    class="btn rounded-pill mx-3 px-3"
      style="font-size: 18px;
        <?php 
          if(isset($_GET['listOfSelectedActivites'])){
            echo "border: 2px solid #222; color: #222; font-weight: 600;";
          } else {
            echo "border: 1px solid #848e91; color: #848e91";
          }
        ?>
      " 
    >
    List of selected activities</button>
  </a>
</div>
<div class="col-10 mx-auto">
  <hr>
</div>

  <?php include '../../category_includes/activity_folder/edit_activity/updateListDisplay.php'; ?>

</main>
<!-- 
<a href="#make_act" class="position-fixed smooth-scroll" style="bottom: 5%; right: 5%">
  <i class="fa-solid fa-circle-arrow-down text-dark" style="font-size: 25px;"></i>
</a> -->
<script src="../../assets/js/activities_crud.js"></script>
<script src="../../assets/js/activities_list.js"></script>

<?php include '../a_includes/admin_footer.php'; ?>
