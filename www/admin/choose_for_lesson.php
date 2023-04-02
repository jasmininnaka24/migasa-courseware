<?php 
  ob_start();
  session_start();

  include './includes/database.php';
  include './includes/session_role.php';
  include './category_includes/video_folder/processingVideoFunctionality.php';
  include './includes/admin_header.php';


  if(isset($_POST['admin_logout'])){
    $_SESSION['admin_password'] = null;
    $_SESSION['admin_username'] = null;
    $_SESSION['role'] = null;
    
    header("Location: ../pick_language.php");
  }

?>

<?php include './includes/admin_sidebar.php'; ?>
<?php include './includes/admin_sidebar_section_header.php'; ?>
<?php 
  if(isset($_GET['course_id_display'])){
    $course_id = $_GET['course_id_display'];

    $select_course_video = $conn->prepare("SELECT * FROM videos_table WHERE course_id = :course_id");
    $select_course_video->bindParam(":course_id", $course_id);
    $select_course_video->execute();
    $fetch_data = $select_course_video->fetch(PDO::FETCH_ASSOC);
    $course_title = $fetch_data['course_title'];
  }
?>

<main style="min-height: 90%;" class="w-100 anim-to-top-slow">
    <div class="col-10 mx-auto text-center h4 mt-5" style="color: #777">
      Make a lesson or view existing lessons under <span class="font-bold" style="color: #444"><?php echo $course_title; ?></span></span> course.
    </div>
    <div class="d-lg-flex justify-content-center align-items-center">
      <div style="height: 50%; border: #333 1px solid;" class="col-lg-5 col-md-6 col-sm-8 col-10  bgc-gray-light my-4 mx-auto rounded-3 d-flex flex-column align-items-center justify-content-center px-4">
        <div style="width: 60px;" class="mt-5 mb-3">
          <img src="./assets/img/create_lesson.png" width="100%" alt="">
        </div>
        <div style="line-height: 2rem;" class="text-center font-med">
          To create another lesson, kindly click on the button provided below
        </div>
        <a href="./read/videos/video_title.php?course_id_uploadvid=<?php echo $course_id; ?>" class="d-flex align-items-center justify-content-center text-decoration-none mt-3 mb-5">
          <button class="btn bgc-red-light " style="font-size: 18px; bottom: 15%; border: 1px solid #444;">
            Create New Lesson
          </button>
        </a>
      </div>

      <?php
        $select_courses = $conn->prepare("SELECT * FROM course_table");
        $select_courses->execute();
        
        $course_count = 0;
        while($select_courses->fetch(PDO::FETCH_ASSOC)){
          $course_count += 1;
        }

        if($course_count > 0) { ?>
          <div style="height: 50%; border: #333 1px solid;" class="col-lg-5 col-md-6 col-sm-8 col-10  bgc-gray-light my-4 mx-auto rounded-3 d-flex flex-column align-items-center justify-content-center px-4">

            <div style="width: 65px;" class="mt-5 mb-3">
              <img src="./assets/img/modify_lesson.png" width="100%" alt="">
            </div>
            <div style="line-height: 2rem;" class="text-center font-med">
              To view or modify lessons, kindly click on the button provided below
            </div>
            <a href="./videos_display.php?course_id_display=<?php echo $course_id;?>" class="d-flex align-items-center justify-content-center text-decoration-none mt-3 mb-5">
              <button class="btn bgc-red-light " style="font-size: 18px; bottom: 15%; border: 1px solid #444;">
                View Existing Lessons</button>
            </a>
          </div>
        <?php }
      ?>      
    </div>
  </main>
</section>





    
  <div class="assistant_show hidden" style="z-index: 200; position: absolute; width: 15rem; right: 5%; bottom: 10%;">
    <img src="./assets/img/assistant.png" width="100%">
  </div>

  <div class="overlay hidden" style="z-index: 100;"></div>
<?php include './includes/admin_footer.php';?>
