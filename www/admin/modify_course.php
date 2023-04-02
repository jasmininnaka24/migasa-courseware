<?php 
  ob_start();
  session_start();
  include './includes/database.php';
  include './includes/session_role.php';
  include './category_includes/video_folder/processingVideoFunctionality.php';
  include './includes/admin_header.php';

  if(isset($_POST['discard_process'])){
    $_SESSION['language_selected'] = null;
    $videoCaptionFileName = $_SESSION['add_video_caption'];


    echo "
    <script>
      let title = document.getElementById('title');
      title.removeAttribute('required');
    </script>
    ";

  
    $file_path = "../../../backend_storage/uploaded_subtitle/$videoCaptionFileName";

    if (unlink($file_path)) {
      echo '';
    } 

    $_SESSION['add_video_caption'] = null;


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

    <div class="display-5 font-med my-3">Updating a course</div>


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
                  
                  header("Location: ./modify_course.php?languagee=$language_selected&course");
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
                <div class="mx-auto text-center h3" style="margin-bottom: 0rem; color: #555">
                  Please choose a course language in order to see the available courses
                </div>
                <p style="color: #777; font-size: 19px; margin-bottom: 2rem; " class="text-center mt-4">The language selection will determine the course category</p>

                <!-- file upload -->
                <div class="form-group mb-4">
                  <select name="language_selected" id="" class="form-control">
                    <option value="">Select a language🔻</option>
                    <?php
                      $select_language = $conn->prepare("SELECT * FROM language_table");
                      $select_language->execute();

                      while($lang_row = $select_language->fetch(PDO::FETCH_ASSOC)){
                        $language = $lang_row['language'];
                        echo "<option value='$language'>$language</option>";
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
              $language = $_GET['languagee'];
              // video title form functionality
              if(isset($_POST['course_selected'])){
                $course_id = $_POST['course_selected'];
                  
                header("Location: ./read/course/updateCourseUI.php?update_course_id=$course_id");
                
              }


              if(isset($_POST['go_back'])){
                header("Location: ./modify_course.php?language");
              }
              ?>
              <!-- video title form ui -->
              <form action="" method="POST" enctype="multipart/form-data">
                <!-- file upload -->
                <div class="mx-auto text-center h3 m-0" style="margin-bottom: 2rem; color: #555">
                  Choose the course you would like to modify
                </div>
                <p style="color: #777; font-size: 19px; margin-bottom: 2rem; " class="text-center mt-4"></p>

                <!-- file upload -->
                <div class="form-group mb-4">
                  <select name="course_selected" id="" class="form-control">
                    <option value="">Select a course🔻</option>
                    <?php
                      $select_lang_course = $conn->prepare("SELECT * FROM course_table WHERE course_lang = :course_language");
                      $select_lang_course->bindParam(":course_language", $language);
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

