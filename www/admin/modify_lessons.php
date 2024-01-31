<?php 
  ob_start();
  session_start();
  include './includes/database.php';
  include './includes/session_role.php';
  include './category_includes/video_folder/processingVideoFunctionality.php';
  include './includes/admin_header.php';

  if(isset($_POST['discard_process'])){

    echo "
    <script>
      let title = document.getElementById('title');
      title.removeAttribute('required');
    </script>
    ";

    header("Location: ./choose.php");
    
  }
  ?>

  <!-- NAVIGATION -->



  <!-- MAIN -->
  <main style="min-height: 90%;" class="w-100 vh-100 d-flex align-items-center justify-content-center flex-column anim-to-top-slow">

  <form action="" method="POST">
   
    <button onClick="return confirm('Changes not saved. Are you sure?')" class="position-absolute bg-transparent" style="font-size: 30px; top: 5%; right: 5%; border: none" name="discard_process">
      &times;
    </button>
  </form>

    <div class="display-5 font-med my-3">Modify a Lesson</div>
    <div class="container">
      <div class="row">
        <div class="col-8 d-flex align-items-center justify-content-center mx-auto ">

          <!-- SELECT LANGUAGE -->
          <?php
            if(isset($_GET['language'])){ 
              
              // video title form functionality
              if(isset($_POST['select_lang'])){
                $language_selected = $_POST['language_selected'];
    
                if($language_selected != ''){
                  
                  header("Location: ./modify_lessons.php?languagee=$language_selected&course");
                } else {
                  echo "<h3 class='txt-red-light font-med text-center position-absolute w-100 d-flex align-items-center justify-content-center' style='top:10%; margin-left: 0%'>The field is empty</h3>";
                }
              }


              if(isset($_POST['go_back'])){
                header("Location: ./choose.php");
              }
              ?>
 
              <!-- video title form ui -->
              <form action="" method="POST" enctype="multipart/form-data">
                <!-- file upload -->
                <div class="mx-auto text-center h3 m-0" style="margin-bottom: 2rem; color: #555">
                  Please choose a course language in order to see the available courses 
                </div>
                <p style="color: #777; font-size: 19px; margin-bottom: 2rem; " class="text-center mt-4">The language selection will determine the course category for lessons</p>

                <!-- file upload -->
                <div class="form-group mb-4">
                  <select name="language_selected" id="" class="form-control">
                  <option value="">Select a language🔻</option>
                    <?php
                      $select_language = $conn->prepare("SELECT * FROM language_table");
                      $select_language->execute();

                      while($lang_row = $select_language->fetch(PDO::FETCH_ASSOC)){
                        $language_id = $lang_row['id'];
                        $language = $lang_row['language'];
                        echo "<option value='$language_id'>$language</option>";
                      }
                    ?>                    
                  </select>

                </div>
                <div class="d-flex justify-content-between mb-1" style="margin-top: 2rem;">
                  <button name="go_back" class="btn bgc-red-light rounded-pill" style="font-size: 18px;">
                    Go back
                  </button>
                  <button name="select_lang" class="preventReload btn bgc-red-light rounded-pill" style="font-size: 18px;">
                    Proceed to next step
                  </button>
                </div>
              </form>              
              <?php 
            }

          ?>

          
          <!-- SELECT COURSE -->
          <?php
            if(isset($_GET['course']) && isset($_GET['languagee'])){ 
              $course_lang = $_GET['course'];
              $language_id = $_GET['languagee'];

              // video title form functionality
              
              if(isset($_POST['course_selected'])){
                $course_id = $_POST['course_selected'];
                if($course_id != ''){
                  header("Location: ./modify_lessons.php?course_id_uploadvid=$course_id&select_lesson_title");
                } else {
                  echo "<h3 class='txt-red-light font-med text-center position-absolute w-100 d-flex align-items-center justify-content-center' style='top:10%; margin-left: 0%'>The field is empty</h3>";
                }         
              }


              if(isset($_POST['go_back'])){
                header("Location: ./modify_lessons.php?language");
              }

              $select_language = $conn->prepare("SELECT language FROM language_table WHERE id = :id");
              $select_language->bindParam(":id", $language_id);
              $select_language->execute();
              $lang_row = $select_language->fetch(PDO::FETCH_ASSOC);
              $language = $lang_row['language'];

              ?>
              <!-- video title form ui -->
              <form action="" method="POST" enctype="multipart/form-data">
                <!-- file upload -->
                <div class="mx-auto text-center h3 m-0" style="margin-bottom: 2rem; color: #555">
                To modify a lesson, you need to choose a course within the <?php echo $language; ?> language category 
                </div>
                <p style="color: #777; font-size: 15px; margin-bottom: 2rem; " class="text-center mt-4">The lessons are organized based on the course you will select</p>

                <!-- file upload -->
                <div class="form-group mb-4">
                  <select name="course_selected" id="" class="form-control">
                  <option value="">Select a course🔻</option>
                    <?php
                      $select_lang_course = $conn->prepare("SELECT * FROM course_table WHERE course_lang_id = :course_lang_id");
                      $select_lang_course->bindParam(":course_lang_id", $language_id);
                      $select_lang_course->execute();

                      while($course_row = $select_lang_course->fetch(PDO::FETCH_ASSOC)){
                        $course_id = $course_row['id'];
                        $course_title = $course_row['course_title'];
                        echo "<option value='$course_id'>$course_title</option>";
                      }
                    ?>                    
                  </select>

                </div>
                <div class="d-flex justify-content-between mb-1" style="margin-top: 2rem;">
                  <button name="go_back" class="btn bgc-red-light rounded-pill" style="font-size: 18px;">
                    Go back
                  </button>
                  <button name="select_lang" class="preventReload btn bgc-red-light rounded-pill" style="font-size: 18px;">
                    Proceed to next step
                  </button>
                </div>
              </form>              


              <?php 
            }

          ?>

          
          <!-- SELECT COURSE -->
          <?php
            if(isset($_GET['course_id_uploadvid']) && isset($_GET['select_lesson_title'])){ 
              $course_id = $_GET['course_id_uploadvid'];
              $select_lesson = $_GET['select_lesson_title'];

              $select_course_id = $conn->prepare("SELECT * FROM course_table WHERE id = :course_id");
              $select_course_id->bindParam(":course_id", $course_id);
              $select_course_id->execute();
              $fetch_course_title = $select_course_id->fetch(PDO::FETCH_ASSOC);
              $course_title = $fetch_course_title['course_title'];

              // video title form functionality
              if(isset($_POST['select_lesson_title'])){
                $lesson_id = $_POST['selected_lesson_title'];
                if($lesson_id != ''){
                  header("Location: ./read/activity/updateActivityUI.php?update_course_id=$course_id&update_video_activity=$lesson_id&listOfAllActivities&selly");
                } else {
                  echo "<h3 class='txt-red-light font-med text-center position-absolute w-100 d-flex align-items-center justify-content-center' style='top:10%; margin-left: 0%'>The field is empty</h3>";
                }
              }

              if(isset($_POST['go_back'])){
                header("Location: ./modify_lessons.php?language");
              }
              ?>
              <!-- video title form ui -->
              <form action="" method="POST" enctype="multipart/form-data">
                <!-- file upload -->
                <div class="mx-auto text-center h3 m-0" style="margin-bottom: 2rem; color: #555">
                  Select the lesson title you would like to modify under <?php echo $course_title; ?> course 
                </div>
                <p style="color: #777; font-size: 15px; margin-bottom: 2rem; " class="text-center mt-4"></p>

                <!-- file upload -->
                <div class="form-group mb-4">
                  <select name="selected_lesson_title" id="" class="form-control">
                  <option value="">Select a lesson title🔻</option>
                    <?php
                      $select_lesson_title = $conn->prepare("SELECT * FROM videos_table WHERE course_id = :course_id");
                      $select_lesson_title->bindParam(":course_id", $course_id);
                      $select_lesson_title->execute();

                      while($video_row = $select_lesson_title->fetch(PDO::FETCH_ASSOC)){
                        $video_id = $video_row['id'];
                        $video_title = $video_row['video_title'];
                        echo "<option value='$video_id'>$video_title</option>";
                      }
                    ?>                    
                  </select>

                </div>
                <div class="d-flex justify-content-between mb-1" style="margin-top: 2rem;">
                  <button name="go_back" class="btn bgc-red-light rounded-pill" style="font-size: 18px;">
                    Go back
                  </button>
                  <button name="select_lesson_title" class="preventReload btn bgc-red-light rounded-pill" style="font-size: 18px;">
                    Proceed to next step
                  </button>
                </div>
              </form>              


              <?php 
            }

          ?>
        





          <?php

            // getting the course id
            if(isset($_GET['course_id_uploadvid'])){
              $course_id = $_GET['course_id_uploadvid'];
              $select_course = $conn->prepare("SELECT * FROM course_table WHERE id = :course_id");
              $select_course->bindParam(":course_id", $course_id);
              $select_course->execute();
              $fetch_course = $select_course->fetch(PDO::FETCH_ASSOC);
              $course_title = $fetch_course['course_title'];
            }

          ?>
        </div>        
      </div>        
    </div>
  </main>
</section>


<div class="overlay hidden"></div>
    
<?php include './includes/admin_footer.php'; ?>

