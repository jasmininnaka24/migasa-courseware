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
    
    header("Location: ../hero_section.php");
  }

?>

<?php include './includes/admin_sidebar.php'; ?>
<section class="home-section">
  <div class="d-flex align-items-center justify-content-between">
    <i class='bx bx-menu-alt-left' style="font-size: 38px; cursor: pointer;"></i>
    <i class="fa-regular fa-circle-xmark hidden" style="font-size: 30px; cursor: pointer;"></i>
    <form action="" method="POST">
      <button
        class="btn mt-2 mt-2 d-flex align-items-center justify-content-center"
        style="height: 2.5rem"
        name="admin_logout"
      >
        <p
          style="margin-right: 0.4rem; font-size: 18px"
          class="font-med"
          >
          Log Out
        </p>
        <div>
          <img
          src="./assets/img/exit 2.png"
          style="width: 20px; height: 16px; margin-top: -20px"
          width="100%"
          alt=""
          />
        </div>
      </button>
    </form>
  </div>

  <main style="height: 90%;" class="w-100 anim-to-top-slow">
    <div class="row">
    
      <div style="height: 18rem; border: #333 1px solid;" class="col-lg-5 col-md-8 col-sm-10  bgc-gray-light my-4 mx-auto rounded-3 d-flex flex-column align-items-center justify-content-center px-4">
        <div style="width: 60px;" class="mt-5 mb-3">
          <img src="./assets/img/create_lesson.png" width="100%" alt="">
        </div>
        <div style="line-height: 2rem;" class="text-center font-med">
          To create a course, kindly click on the button provided below
        </div>
        <a href="./read/course/adminCreateCourseUI.php?add_icon" class="d-flex align-items-center justify-content-center text-decoration-none mt-3 mb-5">
          <button class="btn bgc-red-light " style="font-size: 18px; bottom: 15%; border: 1px solid #444;">
            Create a Course
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
        <div style="height: 18rem; border: #333 1px solid;" class="col-lg-5 col-md-8 col-sm-10  bgc-gray-light my-4 mx-auto rounded-3 d-flex flex-column align-items-center justify-content-center px-4">

          <div style="width: 65px;" class="mt-5 mb-3">
            <img src="./assets/img/modify_lesson.png" width="100%" alt="">
          </div>
          <div style="line-height: 2rem;" class="text-center font-med">
            To view or modify courses, kindly click on the button provided below
          </div>
          <a href="./courses_display.php?language=all_languages" class="d-flex align-items-center justify-content-center text-decoration-none mt-3 mb-5">
            <button class="btn bgc-red-light " style="font-size: 18px; bottom: 15%; border: 1px solid #444;">
              View Existing Courses
            </button>

          </a>
        </div>
      </div>
      <?php }
    ?>
    <div class="row">
    <?php
      $select_courses = $conn->prepare("SELECT * FROM course_table");
      $select_courses->execute();
      
      $course_count = 0;
      while($select_courses->fetch(PDO::FETCH_ASSOC)){
        $course_count += 1;
      }

      if($course_count > 0) { ?>
        <div style="height: 18rem; border: #333 1px solid;" class="col-lg-5 col-md-8 col-sm-10  bgc-gray-light my-4 mx-auto rounded-3 d-flex flex-column align-items-center justify-content-center px-4">
          <div style="width: 60px;" class="mt-5 mb-3">
            <img src="./assets/img/create_lesson.png" width="100%" alt="">
          </div>
          <div style="line-height: 2rem;" class="text-center font-med">
            To create a lesson, kindly click on the button provided below
          </div>
          <a href="./read/videos/adminUploadVideoUI.php?language" class="d-flex align-items-center justify-content-center text-decoration-none mt-3 mb-5">
            <button class="btn bgc-red-light " style="font-size: 18px; bottom: 15%; border: 1px solid #444;">
              Create a Lesson
            </button>
          </a>
        </div>
        <div style="height: 18rem; border: #333 1px solid;" class="col-lg-5 col-md-8 col-sm-10  bgc-gray-light my-4 mx-auto rounded-3 d-flex flex-column align-items-center justify-content-center px-4">

          <div style="width: 65px;" class="mt-5 mb-3">
            <img src="./assets/img/modify_lesson.png" width="100%" alt="">
          </div>
          <div style="line-height: 2rem;" class="text-center font-med">
            To view or modify lessons, kindly click on the button provided below
          </div>
          <a href="./view_lessons.php?language" class="d-flex align-items-center justify-content-center text-decoration-none mt-3 mb-5">
            <button class="btn bgc-red-light " style="font-size: 18px; bottom: 15%; border: 1px solid #444;">
              View Existing Lessons
            </button>

          </a>
        </div>
      </div>
      <?php }
    ?>
    
  </main>
</section>





    
  <div class="assistant_show hidden" style="z-index: 200; position: absolute; width: 15rem; right: 5%; bottom: 10%;">
    <img src="./assets/img/assistant.png" width="100%">
  </div>

  <div class="overlay hidden" style="z-index: 100;"></div>
<?php include './includes/admin_footer.php';?>
