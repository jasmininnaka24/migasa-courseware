<?php 
  ob_start();
  session_start();
  include '../database.php';
  include '../../category_includes/video_folder/uploadVideo.php';
  include '../../category_includes/video_folder/add_video/videoProcessor.php';
  include '../../category_includes/video_folder/processingVideoFunctionality.php';

  include '../a_includes/admin_header.php';

  if(isset($_POST['discard_process'])){
    $_SESSION['add_video_title'] = null;
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


    header("Location: ../../choose.php");
    
  }

  ?>

  <!-- NAVIGATION -->

  <!-- ERROR CONDITION-->
  <?php include '../../includes/error_condition.php' ?>


  <!-- MAIN -->
  <main style="min-height: 90%;" class="w-100 vh-100 d-flex align-items-center justify-content-center flex-column anim-to-top-slow">

      
  <form action="" method="POST">
    <button onClick="return confirm('Changes not saved. Are you sure?')" class="position-absolute bg-transparent" style="font-size: 30px; top: 5%; right: 5%; border: none" name="discard_process">
      &times;
    </button>
  </form>

    <div class="display-5 font-med my-3">Creating a Lesson</div>

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
                  
                  header("Location: ./adminUploadVideoUI.php?languagee=$language_selected&course");
                } else {
                  echo "<h3 class='txt-red-light font-med text-center position-absolute w-100 d-flex align-items-center justify-content-center' style='top:10%; margin-left: 0%'>The field is empty</h3>";
                }
              }


              if(isset($_POST['go_back'])){
                header("Location: ../../choose.php");
              }
              ?>
 
              <!-- video title form ui -->
              <form action="" method="POST" enctype="multipart/form-data">
                <!-- file upload -->
                <div class="mx-auto text-center h3" style="margin-bottom: 0rem; color: #555">
                  To create a lesson, select a course language, first. 
                </div>
                <p style="color: #777; font-size: 19px; margin-bottom: 2rem; " class="text-center mt-4">The language selection will determine the category of the course and the lesson.</p>

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
                  <div class=""></div>
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
                  
                header("Location: ./adminUploadVideoUI.php?course_id_uploadvid=$course_id&add_video_title");
                
              }


              if(isset($_POST['go_back'])){
                header("Location: ./adminUploadVideoUI.php?language");
              }
              ?>
 
              <!-- video title form ui -->
              <form action="" method="POST" enctype="multipart/form-data">
                <!-- file upload -->
                <div class="mx-auto text-center h3" style="margin-bottom: 1rem; color: #555">
                  To create a lesson, you need to choose a course within the <?php echo $language; ?> language category
                </div>
                <p style="color: #777; font-size: 19px; margin-bottom: 2rem; " class="text-center mt-4">The lesson will be organized and saved under the course you will select</p>

                <!-- file upload -->
                <div class="form-group mb-4">
                  <select name="course_selected" class="form-control">
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


            // ADD VIDEO TITLE
            if(isset($_GET['add_video_title'])){ 
              // video title form functionality
              if(isset($_POST['add_title'])){
                $_SESSION['add_video_title'] = $_POST['video_title'];
                if($_SESSION['add_video_title'] != ""){
                  header("Location: ./adminUploadVideoUI.php?course_id_uploadvid=$course_id&add_video_caption");
                } else {
                  echo "<h3 class='txt-red-light font-med text-center position-absolute w-100 d-flex align-items-center justify-content-center' style='top:10%; margin-left: 0%'>The field is empty</h3>";
                }
              }

              
              ?>
              
              <!-- video title form ui -->
              <form action="" method="POST">
                <!-- file upload -->
                <div class="mx-auto text-center h3 m-0" style="margin-bottom: 4rem; color: #555">
                  Add a Lesson Title under <?php echo $course_title; ?>
                </div>
                <p style="color: #777; font-size: 15px; margin-bottom: 4rem; " class="text-center mt-4">Please note that this field is required and must be filled out before you can proceed to the next step.</p>
                <div
                  class="form-group d-flex align-items-center justify-content-center"
                >
                  <input
                    type="text"
                    id="title"
                    name="video_title"
                    class="form-control"
                    style="border: 0.1rem solid #888; font-size: 20px;"
                    placeholder="Title here..."
                    
                  />
                </div>
                <div class="d-flex justify-content-between" style="margin-top: 4rem;">
                  <button name="discard" class="btn bgc-red-light rounded-pill" style="font-size: 18px;">
                    Go back
                  </button>
                  <button name="add_title" class="btn bgc-red-light rounded-pill" style="font-size: 18px;">
                    Proceed to next step
                  </button>
                </div>
              </form>

              <?php 

            }
          ?>




          <!-- ADD VIDEO CAPTION -->
          <?php
            if(isset($_GET['add_video_caption'])){ 
              
              // video title form functionality
              if(isset($_POST['add_caption'])){
                $videoCaptionFileName = $_FILES['video_caption']['name'];
                $videoCaptionTmpName = $_FILES['video_caption']['tmp_name'];
    
                if($videoCaptionFileName != ''){
    
                  // STORE THEM INTO SESSION
                  $_SESSION['add_video_caption'] = $videoCaptionFileName;
                  $_SESSION['videoCaptionTmpName'] = $videoCaptionTmpName;   
                  
                  $videoCaptionFileName = uniqid() . "_" . $videoCaptionFileName;
                  $_SESSION['add_video_caption'] = $videoCaptionFileName;
    
                  // MOVING FILE TO A FOLDER
                  move_uploaded_file($videoCaptionTmpName, "../../../backend_storage/uploaded_subtitle/$videoCaptionFileName");
                  
                  header("Location: ./adminUploadVideoUI.php?course_id_uploadvid=$course_id&upload_course_video");
                } else {
                  echo "<h3 class='txt-red-light font-med text-center position-absolute w-100 d-flex align-items-center justify-content-center' style='top:10%; margin-left: 0%'>The field is empty</h3>";
                }
              }


              if(isset($_POST['go_back'])){
                $videoCaptionFileName = $_SESSION['add_video_caption'];
  
                $file_path = "../../../backend_storage/uploaded_subtitle/$videoCaptionFileName";
    
                if (unlink($file_path)) {
                  echo '';
                } 
    
                $_SESSION['add_video_caption'] = null;
    
                header("Location: ./adminUploadVideoUI.php?course_id_uploadvid=$course_id&add_video_title");
              }
              ?>
 
              

              <!-- video title form ui -->
              <form action="" method="POST" enctype="multipart/form-data">
                <!-- file upload -->
                <div class="mx-auto text-center h3 m-0" style="margin-bottom: 2rem; color: #555">
                Upload a caption for video under <?php echo $course_title; ?>
                </div>
                <p style="color: #777; font-size: 15px; margin-bottom: 2rem; " class="text-center mt-4">Please note that this field is required and must be filled out before you can proceed to the next step.</p>

                <!-- file upload -->
                <div class="form-group mb-4">
                  <div class="d-flex align-items-center rounded-3" style="border: 0.1rem solid #888;">
                    <div class="w-25 px-4 d-flex pt-3 align-items-center justify-content-center" style="border-right: 0.1rem solid #888;">

                      <h4 class="overflow-hidden" class="font-med" style="font-size: 20px;">Caption</h4>
                    </div>
                
                    <div class="py-3 mb-2" style="padding-left: 3rem;">
                      <label
                        for="upload_file"
                        class="rounded-pill bgc-gray-light px-3 py-1"
                        style="border: #555 solid 0.1rem; cursor: pointer"
                        >
                        Upload File
                      </label>
                      <input
                        type="file"
                        name="video_caption"
                        id="upload_file"
                        
                        />
                    </div>
                  </div>

                </div>
                <div class="d-flex justify-content-between mb-1" style="margin-top: 2rem;">
                  <button name="go_back" class="btn bgc-red-light rounded-pill" style="font-size: 18px;">
                    Go back
                  </button>
                  <button name="add_caption" class="preventReload btn bgc-red-light rounded-pill" style="font-size: 18px;">
                    Proceed to next step
                  </button>
                </div>
              </form>              


              <?php 
            }

          ?>




          <!-- UPLOAD VIDEO -->
          <?php
            if(isset($_GET['upload_course_video'])){ 
              
              // video title form functionality
              if(isset($_POST['go_back'])){
                header("Location: ./adminUploadVideoUI.php?course_id_uploadvid=$course_id&add_video_caption");
              }
              ?>
              
              <!-- video title form ui -->
              <form action="" method="POST" enctype="multipart/form-data">
                <!-- file upload -->
                <div class="mx-auto text-center h3 m-0" style="margin-bottom: 2rem; color: #555">
                  Upload a video under <?php echo $course_title; ?>
                </div>
                <p style="color: #777; font-size: 15px;" class="text-center mt-4">Please note that this field is required and must be filled out before you can proceed to the next step.</p>
                <p style="color: #777; font-size: 15px; margin-top: -1rem;" class="text-center">Allowed extension types: mp4, mkv, webm, flv, vob, ogv, ogg, avi, wmv, mov, mpeg, mpg</p>
                <p style="color: #777; font-size: 15px; margin-bottom: 2rem; margin-top: -1rem;" class="text-center">File must be less than 500 megabytes</p>
                <div class="input-group mt-2">
                  <div class="drop-zone">
                    <span class="drop-zone__prompt d-flex flex-column align-items-center" >
                      <i class="fa-solid fa-cloud-arrow-up mb-2" style="font-size: 50px;"></i>
                      <span>
                        Drop file here or click to upload
                      </span>
                    </span>
                    <input type="file" id="vid_upload" name="video_file_name" class="drop-zone__input">
                  </div>
                </div>
                <div class="d-flex justify-content-between mb-1" style="margin-top: 2rem;">
                  <button name="go_back" class="btn bgc-red-light rounded-pill go_back" style="font-size: 18px;">
                    Go back
                  </button>
                  <button name="upload_video" class="preventReload upload btn bgc-red-light rounded-pill" style="font-size: 18px;">
                    Upload this video
                  </button>
                </div>
              </form>

              <?php 
            }

          ?>
        </div>        
      </div>        
    </div>
  </main>
</section>


<div class="overlay hidden"></div>
<script>
  let upload = document.querySelector(".upload");
  let go_back = document.querySelector(".go_back");
  upload.addEventListener("click", () => {
    upload.textContent = "Uploading...";
    upload.style.backgroundColor = "#eaeae5";
    upload.style.color = "#444";
    setTimeout(() => {
      upload.disabled = true;
      go_back.disabled = true;
    }, 0500);
  })


  // Dropdowns

document.querySelector(".drop-zone__input").forEach((inputElement) => {
  const dropZoneElement = inputElement.closest(".drop-zone");

  dropZoneElement.addEventListener("click", (e) => {
    inputElement.click();
  });

  inputElement.addEventListener("change", (e) => {
    if (inputElement.files.length) {
      updateThumbnail(dropZoneElement, inputElement.files[0]);
    }
  });

  dropZoneElement.addEventListener("dragover", (e) => {
    e.preventDefault();
    dropZoneElement.classList.add("drop-zone--over");
  });

  ["dragleave", "dragend"].forEach((type) => {
    dropZoneElement.addEventListener(type, (e) => {
      dropZoneElement.classList.remove("drop-zone--over");
    });
  });

  dropZoneElement.addEventListener("drop", (e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
      inputElement.files = e.dataTransfer.files;
      updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
    }

    dropZoneElement.classList.remove("drop-zone--over");
  });
});

/**
 * Updates the thumbnail on a drop zone element.
 *
 * @param {HTMLElement} dropZoneElement
 * @param {File} file
 */
function updateThumbnail(dropZoneElement, file) {
  let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");

  // First time - remove the prompt
  if (dropZoneElement.querySelector(".drop-zone__prompt")) {
    dropZoneElement.querySelector(".drop-zone__prompt").remove();
  }

  // First time - there is no thumbnail element, so lets create it
  if (!thumbnailElement) {
    thumbnailElement = document.createElement("div");
    thumbnailElement.classList.add("drop-zone__thumb");
    dropZoneElement.appendChild(thumbnailElement);
  }

  thumbnailElement.dataset.label = file.name;

  // Show thumbnail for image files
  if (file.type.startsWith("video/")) {
    const videoElement = document.createElement("video");
    videoElement.src = URL.createObjectURL(file);
    videoElement.autoplay = true;
    videoElement.loop = true;
    videoElement.muted = true;
    videoElement.playsInline = true;

    thumbnailElement.innerHTML = "";
    thumbnailElement.appendChild(videoElement);
  } else {
    thumbnailElement.style.backgroundImage = null;
  }
}

</script>  
    
<?php include '../a_includes/admin_footer.php'; ?>

