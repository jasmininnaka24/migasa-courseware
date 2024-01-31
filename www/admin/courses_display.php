<?php
ob_start();
session_start();
include './includes/database.php';
include './includes/session_role.php';
include './category_includes/course_folder/processingCourseFunctionality.php';
include './includes/admin_header.php';

?>
<style>
  .hover_course {
    background: #eaeae5;
    color: #222;
  }

  .hover_course:hover {
    color: #fff;
    background: #f20e0e;
    transition: all .2s ease-in-out;
  }

  .hover_course:focus {
    color: #fff;
    background: #f20e0e;
    transition: all .2s ease-in-out;
  }

  table {
    border-collapse: collapse;
    width: 100%;
    margin-bottom: 20px;
    border: 1px solid #ddd;
  }


  .table td {
    text-align: left;
    padding: 10px;
    border: 1px solid #ddd;
  }

  .table th {
    background-color: #f2f2f2;
    /* border-top: 1px solid #ddd;
        border-left: 1px solid #ddd; */
  }

  .table button {
    border: none;
    padding: 8px 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 19px;
    margin-right: 5px;
    border-radius: 4px;
    outline: none;
  }



  .course,
  .video,
  .activity,
  .scoring {
    transition: all .2s linear;
  }

  .course:hover,
  .video:hover,
  .activity:hover,
  .scoring:hover {
    background: #f2f2f2;
  }

  .modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
  }

  .modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 50%;
  }

  .close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }

  .close:hover,
  .close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
  }

</style>


<!-- SIDEBAR NAVIGATION -->
<?php include './includes/admin_sidebar.php'; ?>
<?php include './includes/admin_sidebar_section_header.php'; ?>

<?php
$courseCount = $conn->prepare("SELECT * FROM course_table");
$courseCount->execute();

$count = 0;
while ($courseCount->fetch(PDO::FETCH_ASSOC)) {
  $count += 1;
}

if ($count === 0) {
  echo "
          <div class='text-center font-med display-4 py-5'>NO COURSE HAS BEEN CREATED</div>
          ";
} else {


  if ($count > 0) { ?>
    <div class="d-flex align-items-center justify-content-center mt-3">
      <form action="" id="filter_btn" method="POST">

        <!-- FILTER BUTTONS - FILIPINO AND ENGLISH -->

        <div>
          <a href="./courses_display.php?language=all_languages" class="btn font-med rounded-pill mx-1 px-3" style="<?php
          if (isset($_GET['language']) && $_GET['language'] === 'all_languages') {
            echo "font-size: 16px; border: 2px #222 solid; color: #222";
          } else {
            echo "font-size: 16px; border: 2px #999 solid; color: #999";
          }
          ?>">
            All Courses
          </a>
          <?php
          $fetch_languages = $conn->prepare("SELECT * FROM language_table");
          $fetch_languages->execute();


          while ($language_row = $fetch_languages->fetch(PDO::FETCH_ASSOC)) {
            $language_id = $language_row['id'];
            $language = $language_row['language'];

            ?>

            <a href='./courses_display.php?language=<?php echo $language_id; ?>' class='btn font-med rounded-pill mx-1 px-3'
              style='<?php
              if (isset($_GET['language']) && $_GET['language'] === $language_id) {
                echo "font-size: 16px; border: 2px #222 solid; color: #222";
              } else {
                echo "font-size: 16px; border: 2px #999 solid; color: #999";
              }
              ?>'>
              <?php echo $language; ?> Courses
            </a>


          <?php }
          ?>

        </div>
      </form>
    </div>

    <?php
  }

  ?>
  <hr>

  <?php
  $check_existing_courses = $conn->prepare("SELECT * FROM course_table");
  $check_existing_courses->execute();

  $course_count = 0;
  while ($check_existing_courses->fetch(PDO::FETCH_ASSOC)) {
    $course_count += 1;
  }

  if ($course_count === 0) {
    echo "
            <div class='text-center font-med display-4 py-5'>NO COURSE HAS BEEN CREATED</div>
          ";
  } else { ?>

    <!-- main -->
    <main style="min-height: 90%;" class="w-100 d-flex align-items-center  flex-column ">
      <div class="container">
        <div class="col-12 mx-auto text-center h5 my-4" style="color: #555;">
          Each element in the Video List column is interactive, allowing you to easily <span class="txt-primary">view the
            videos under a certain course</span> by simply <span class="txt-primary">clicking on the "See List of Videos"
            button.</span> Additionally, you can <span class="txt-primary"> edit and delete the course by clicking their
            buttons.</span>
        </div>


        <!-- FILTER -->
        <?php
        if (isset($_GET['language'])) {
          $language = $_GET['language'];

          $course_lang_db = $conn->prepare("SELECT language FROM language_table WHERE id = :language");
          $course_lang_db->bindParam(":language", $language);
          $course_lang_db->execute();
          $fetch_course_lang = $course_lang_db->fetch(PDO::FETCH_ASSOC);
          $course_lang = $fetch_course_lang['language'];

          if ($language === "all_languages") {
            echo "<h4 class='font-bold my-3'>All Language Courses</h4>";
          } else {
            echo "<h4 class='font-bold my-3'>$course_lang Courses</h4>";
          }


        }
        ?>
        <table class="table">
          <thead>
            <tr>
              <th class="text-center"></th>
              <th class="text-center">Course Icon</th>
              <th class="text-center">Course Title</th>
              <th class="text-center">Course Language</th>
              <th class="text-center">List of Lessons</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (isset($_GET['language'])) {
              $language = $_GET['language'];

              if ($language == 'all_languages') {

                $select_all_course = $conn->prepare("SELECT * FROM course_table ORDER BY id DESC");
                $select_all_course->execute();


              } else {

                $select_all_course = $conn->prepare("SELECT * FROM course_table WHERE course_lang_id = '$language'  ORDER BY id DESC");
                $select_all_course->execute();
                $rowcount = $select_all_course->rowCount();
                if ($rowcount > 0) {
                  echo "no";
                } else {
                  echo "";
                }
              }

              $num_count = 1;
              while ($row = $select_all_course->fetch(PDO::FETCH_ASSOC)) {
                $course_id = $row['id'];
                $course_title = $row['course_title'];
                $course_icon = $row['course_icon'];
                $course_lang_id = $row['course_lang_id'];

                $course_lang_db = $conn->prepare("SELECT language FROM language_table WHERE id = :course_lang_id");
                $course_lang_db->bindParam(":course_lang_id", $course_lang_id);
                $course_lang_db->execute();
                $fetch_course_lang = $course_lang_db->fetch(PDO::FETCH_ASSOC);
                $course_lang = $fetch_course_lang['language'];

                
                ?>

                <tr>
                  <td class="text-center font-med course pt-3">
                    <?php echo $course_id; ?>
                  </td>
                  <td class="text-center video">
                    <div class="d-flex align-items-center justify-content-center pt-1">
                      <div style="width: 40px; height: 40px; object-fit: cover;">
                        <img src="../backend_storage/uploaded_icons/<?php echo $course_icon; ?>" width="100%" height="100%"
                          alt="">
                      </div>
                    </div>
                  </td>
                  <td class="text-center font-med course pt-4" style="font-style: 22px;">
                    <?php echo $course_title; ?>
                  </td>
                  <td class="text-center font-med course pt-4" style="font-style: 22px;">
                    <?php echo $course_lang; ?>
                  </td>
                  <td class="text-center font-med course pt-3">
                    <a href="./videos_display.php?course_id_display=<?php echo $course_id; ?>"
                      class="text-decoration-none d-flex align-items-center justify-content-center mt-1">
                      <button class="bgc-gray-light rounded-pill px-4" style="border: #222 1px solid;">List of Lessons</button>
                    </a>
                  </td>

                  <td class="">
                    <div class="d-flex align-items-center justify-content-center">
                      <a href="./read/course/updateCourseUI.php?update_course_id=<?php echo $course_id; ?>"
                        class="text-decoration-none d-flex align-items-center justify-content-center mt-1">
                        <button class="bg-transparent rounded-pill px-4" style="border: #2e6341 1px solid; color: #2e6341;">Edit
                          Course</button>
                      </a>

                      <a href="./courses_display.php?language=all_languages&delete_course=<?php echo $course_id; ?>">
                        <div class="btn rounded-pill bg-transparent" style="border: #cc2b0e 1px solid; color: #cc2b0e;">Delete Course</div>
                      </a>
                    </div>
                  </td>
                </tr>
                <?php
                $num_count += 1;
              }
              ?>

            </tbody>
          </table>
        <?php
            }
            ?>
      </div>
    </main>

    <?php
  }
?>
<?php } ?>



<!-- DELETE -->
<?php 
      if(isset($_GET['delete_course'])){
        $course_id = $_GET['delete_course'];

        $course_title_db = $conn->prepare("SELECT course_title FROM course_table WHERE id = :course_id");
        $course_title_db->bindParam(":course_id", $course_id);
        $course_title_db->execute();

        $fetch_course_title = $course_title_db->fetch(PDO::FETCH_ASSOC);
        $course_title = $fetch_course_title['course_title'];

       ?>

        <!-- modal for delete -->
        <div id="delete-modal" class="" style="max-height: 100%; overflow-y: none; ">
            <div class="modal-content position-absolute" style="top: 0%; left: 25%; min-height: 25vh; z-index: 9999;">
                <h2 class="text-center mt-2" style="color: #333">Delete <?php echo $course_title; ?></h2>
                <br>
                <p class="text-center lead">Input a password to confirm deletion:</p>

                <?php
                  if(isset($_POST['delete_confirmation'])){

                  $superadmin_password = $_SESSION['password'];
                  $password = trim($_POST['password']);
        
                  
                  if($password == ''){
                      echo "<p class='lead font-med text-center txt-red-light'>Password input cannot be empty</p>";
                  } else {
        
                      $salt = "@specialpassworddummyy";
                      $encrypted_password = sha1($password.$salt);
                      $password = $encrypted_password;
        
                      if($password != $superadmin_password){
                          echo "<p class='lead font-med text-center txt-red-light'>Password did not match</p>";
                      } else {
        
                        $delete_icon  = $conn->prepare("SELECT * FROM course_table WHERE id = :course_id");
                        $delete_icon ->bindParam(":course_id", $course_id);
                        $delete_icon ->execute();
                        $fetch_icon = $delete_icon ->fetch(PDO::FETCH_ASSOC); 
                        $course_icon_to_del = $fetch_icon['course_icon'];
                      
                        $icon_del_file_path = "../backend_storage/uploaded_icons/$course_icon_to_del";
                      
                        $delete_videos = $conn->prepare("SELECT video_file_name FROM videos_table WHERE course_id = :course_id");
                        $delete_videos->bindParam(":course_id", $course_id);
                        $delete_videos->execute();
                        $videos = $delete_videos->fetchAll(PDO::FETCH_ASSOC);
                        
                        foreach ($videos as $video) {
                          $vid_file_name_to_del = $video['video_file_name'];
                          $vid_file_name_to_del = str_replace("../../../backend_storage/uploaded_vids/", "../backend_storage/uploaded_vids/", $vid_file_name_to_del);
                      
                          unlink($vid_file_name_to_del);
                          
                        }
                      
                        if($course_icon_to_del != 'BIT TYP LOGO.png'){
                          unlink($icon_del_file_path);
                        }
                        
                        $delete_scoring_row = $conn->prepare("DELETE FROM score_table WHERE course_id = :course_id");
                        $delete_scoring_row->bindParam(":course_id", $course_id);
                        $delete_scoring_row->execute();

                        $delete_choices_row = $conn->prepare("DELETE FROM choices_table WHERE course_id = :course_id");
                        $delete_choices_row->bindParam(":course_id", $course_id);
                        $delete_choices_row->execute();
                      
                        $delete_activity_row = $conn->prepare("DELETE FROM activity_table WHERE course_id = :course_id");
                        $delete_activity_row->bindParam(":course_id", $course_id);
                        $delete_activity_row->execute();
                      
                        $delete_video_row = $conn->prepare("DELETE FROM videos_table WHERE course_id = :course_id");
                        $delete_video_row->bindParam(":course_id", $course_id);
                        $delete_video_row->execute();
                      

                      
        
                            
                        // DELETING USER ACTIVITY/QUIZ SCORE UNDER THIS LANGUAGE AND COURSE
                        $delete_user_act_score = $conn->prepare("DELETE FROM user_act_score WHERE course_id = :course_id");
                        $delete_user_act_score->bindParam(":course_id", $course_id);
                        $delete_user_act_score->execute();
        
                        // SELECTING CAPTIONS THEN UNLINK THEM
                        $unlink_lesson_caption = $conn->prepare("SELECT caption_file_name FROM caption_table WHERE course_id = :course_id");
                        $unlink_lesson_caption->bindParam(":course_id", $course_id);
                        $unlink_lesson_caption->execute();
        
                        while($fetch_caption = $unlink_lesson_caption->fetch(PDO::FETCH_ASSOC)){
                            $lesson_caption = $fetch_caption['caption_file_name'];
                            // ICONS FILE PATH
                            $lesson_caption = "../backend_storage/uploaded_captions/$lesson_caption";
                            unlink($lesson_caption);
                        }  
        
                        // DELETING CAPTIONS UNDER THIS LANGUAGE AND COURSE
                        $delete_captions = $conn->prepare("DELETE FROM caption_table WHERE course_id = :course_id");
                        $delete_captions->bindParam(":course_id", $course_id);
                        $delete_captions->execute();
        
                        // DELETING ENROLLED RECORDS UNDER THIS LANGUAGE AND COURSE
                        $delete_enrolled_rec = $conn->prepare("DELETE FROM enrolled_courses_table WHERE course_id = :course_id");
                        $delete_enrolled_rec->bindParam(":course_id", $course_id);
                        $delete_enrolled_rec->execute();
        
                        // DELETING FINISHED COURSES RECORD UNDER THIS LANGUAGE AND COURSE
                        $delete_finished_rec = $conn->prepare("DELETE FROM finished_courses_table WHERE course_id = :course_id");
                        $delete_finished_rec->bindParam(":course_id", $course_id);
                        $delete_finished_rec->execute();
      
        
                        // DELETING FINISHED COURSES RECORD UNDER THIS LANGUAGE AND COURSE
                        $delete_finished_rec = $conn->prepare("DELETE FROM last_activity_user_table_tracker WHERE course_id = :course_id");
                        $delete_finished_rec->bindParam(":course_id", $course_id);
                        $delete_finished_rec->execute();
      
        
                        // DELETING PROGRESS UNDER THIS LANGUAGE AND COURSE
                        $delete_tracker = $conn->prepare("DELETE FROM activity_tracker_user_table WHERE course_id = :course_id");
                        $delete_tracker->bindParam(":course_id", $course_id);
                        $delete_tracker->execute();
                            
                        $delete_Course = $conn->prepare("DELETE FROM course_table WHERE id = $course_id");
                        $delete_Course->execute();

                        echo
                        "
                        <script>
                        setTimeout(() => {
                          document.querySelector('.deleted').classList.remove('hidden');
                        }, 0100)
                        setTimeout(() => {
                          document.location.href = './courses_display.php?language=all_languages';
                          document.querySelector('.deleted').classList.add('hidden');
                        }, 1500)
                        </script>
                  
                        ";
                      }
                    }
                  }
              ?>
            
            <div class="deleted hidden position-fixed" style="top: 0; left: 0; z-index: 9999;">
              <div class="invalid_modal_container">
                <div class="invalid_modal d-flex flex-column" style="background: #ddf5d9; color: #444">
                  <div class="h2">
                  ✅ DELETED SUCCESSFULLY!
                  </div>
                </div>
              </div>
            </div>

                <form id='deleteModal' method='POST' enctype='multipart/form-data'>

                    <input type='password' id='password' name='password' style="border: 2px solid #777; color: #444;" class="rounded-3 mt-2 form-control"><br>

                    <div style='text-align: right; margin-top: 10px;'>
                        <button type='submit' name="delete_confirmation" id='deleteBtn' class='btn bgc-red-light rounded-pill font-med deleteBtn' style='width: 100px; font-size: 18px; margin-left: 20px;'>Confirm</button>

                        <a href = "./courses_display.php?language=all_languages">
                            <button type='button'  class='btn bgc-gray-light rounded-pill font-med mx-3 cancelBtn' style='width: 100px; border: #444 solid 1px; font-size: 18px; margin-left: 20px;'>Cancel</button>
                        </a>
                    </div>

                </form>
            </div>
            <div class="overlay"></div>

        </div>

        <?php
    }
        ?>







</section>

<div id="myModal" class="modal">
  <div class="modal-content"
    style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
    <p>Input a password to confirm the deletion of the course:</p>
    <?php
    $username = "";
    print_r($_SESSION);
    print_r($course_id);

    // Check if the form has been submitted
    if (isset($_POST['password'])) {
      // Get the password from the form
      $password = trim($_POST['password']);
      $course_id = $_POST['course_id'];

      $salt = "@specialpassworddummyy";
      $encrypted_password = sha1($password . $salt);
      $password = $encrypted_password;
      // echo $password;
      if (hash_equals($_SESSION['password'], $password)) {
        $password_match = true;


        echo '<script>';

        echo 'var password_match = true;';

        echo 'confirmDelete(password_match);';
        echo '</script>';
      } else {

      }
    }
    ?>
    <form id='deleteModal' method='POST' enctype='multipart/form-data'>
      <input type='password' id='password' name='password' style='width: 500px; margin-bottom: 10px;'>
      <input type='text' id='course_id' name='course_id' style='width: 500px; margin-bottom: 10px;' hidden>

      <div style='text-align: right; margin-top: 10px;'>
        <button type='submit' id='deleteBtn' class='btn bgc-red-light rounded-pill font-med deleteBtn'
          style='width: 100px; font-size: 18px; margin-left: 20px;'>Confirm</button>
        <button type='button' id='cancelBtn' class='btn bgc-gray-light rounded-pill font-med mx-3'
          style='width: 100px; border: #222 solid 2px; font-size: 18px; margin-left: 20px;'>Cancel</button>
      </div>
    </form>



    






    <div class="overlay hidden"></div>

    <script>
      // Get the modal
      var modal = document.getElementById('myModal');

      // Get the button that opens the modal
      var btns = document.querySelectorAll(".deleteLink");

      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("close")[0];

      // Get the delete button in the modal
      var deleteBtn = document.getElementById("deleteBtn");

      // When the user clicks the button, open the modal 
  

      btns.forEach(function(btn) {
        btn.addEventListener('click', function(event) {
          // event.preventDefault(); // uncomment this line if you need to prevent default behavior
          var course_id =document.getElementById('course_id');
          var id = this.getAttribute('data-delete_course_id');
          course_id.value = id;
          modal.style.display = 'block';
        });
      });

      // Add a click event listener to the cancel button
      var cancelBtn = document.getElementById('cancelBtn');
      cancelBtn.addEventListener('click', function () {
        // Hide the modal
        modal.style.display = 'none';
      });


      function confirmDelete(password_match) {
        console.log('confirmDelete called with password_match: ' + password_match);
        if (password_match) {
          if (confirm("Are you sure you want to delete?")) {
            window.location.href = './courses_display.php?delete_course=<?php echo $course_id; ?>';
          }
        } else {
          alert('Invalid password');
        }
      }
    </script>

    <!-- <form id='deleteModal' method='POST' enctype='multipart/form-data' onsubmit='submitForm(event)'>
  <input type='password' id='password' name='password' style='width: 500px; margin-bottom: 10px;'>

  <div style='text-align: right; margin-top 10px;'>
    <button type='submit' id='deleteBtn' class='btn bgc-red-light rounded-pill font-med deleteBtn' style='width: 100px; font-size: 18px; margin-left: 20px;'>Confirm</button>
    <button type='button' id='cancelBtn' class='btn bgc-gray-light rounded-pill font-med mx-3' style='width: 100px; border: #222 solid 2px; font-size: 18px; margin-left: 20px;'>Cancel</button>
  </div>
</form> -->

    <!-- <script>
  console.log('fucking script');
function submitForm(event) {
  event.preventDefault(); // Prevent form from submitting

  // Handle form submission
  // You can use AJAX to submit the form data to the server and handle the response
  // For example:
  fetch('admin/courses_display.php?language=all_languages', {
    method: 'POST',
    body: new FormData(event.target)
  })
  .then(response => {
    if (response.ok) {
      // Form submission successful
      // Display success message or redirect to a success page

      setTimeout(function() {
        confirmDelete(password_match);
      }, 1000);
        
      
      console.log('Form submitted successfully');
    } else {
      // Form submission failed
      // Display error message or handle the error
      console.error('Form submission failed');
    }
  })
  .catch(error => {
    // Handle network errors or other errors
    console.error('An error occurred', error);
  });
}
</script> -->

    <!-- <script>
const form = document.querySelector('#deleteModal');
form.addEventListener('submit', function(event) {
  console.log('submitted');
  var match = password_match;
  // console.log('password')
  isset(match) ? confirmDelete(match);
});

</script> -->
    <?php include './includes/admin_footer.php'; ?>