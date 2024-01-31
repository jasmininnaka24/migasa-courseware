<?php 
  ob_start();
  // session_start();
  include '../database.php';
  include '../../category_includes/video_folder/uploadVideo.php';
  include '../../category_includes/video_folder/add_video/videoProcessor.php';
  include '../../category_includes/video_folder/processingVideoFunctionality.php';

  include '../a_includes/admin_header.php';
  include '../../includes/error_condition.php';


  if(isset($_POST['discard_process'])){



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

  <style>
    html {
    --scrollbarBG: #eaeae5;
    --thumbBG: #555;
    }
    body::-webkit-scrollbar {
      width: 13px;
    }
    body {
      scrollbar-width: thin;
      scrollbar-color: var(--thumbBG) var(--scrollbarBG);
    }
    body::-webkit-scrollbar-track {
      background: var(--scrollbarBG);
    }
    body::-webkit-scrollbar-thumb {
      background-color: var(--thumbBG) ;
      border-radius: 6px;
      border: 3px solid var(--scrollbarBG);
    }
    
    div#feedback {
      padding: 10px;
    }

    .progress {
      background-color: #ddd;
      height: 20px;
      margin: 20px 0;
      overflow: hidden;
    }

    #progressBar {
      background-color: #f20e0e;
      height: 100%;
      width: 0%;
      text-align: center;
      line-height: 20px;
      color: #fff;
      transition: width 0.1s ease-in-out;
    }
  </style>


<div class="added hidden position-fixed" style="top: 0; left: 0; z-index: 9999;">
  <div class="invalid_modal_container">
    <div class="invalid_modal d-flex flex-column" style="background: #ddf5d9; color: #444">
      <div class="h2">
      ✅ UPLOADED SUCCESSFULLY!
      </div>
    </div>
  </div>
</div>

  <!-- MAIN -->
  <!-- <span id="errorSpan" style="display: block; text-align: center; color: red; font-weight: bold;"></span>
  <span id="error_message" style="color: red;"></span> -->

  <form action="" method="POST">
    <button onclick="return confirm('Changes not saved. Are you sure?')" class="position-fixed bg-transparent discard" style="font-size: 30px; top: 5%; right: 5%; border: none" name="discard_process">
      &times;
    </button>
  </form>
  <main style="min-height: 90%;" class="container w-100 d-flex align-items-center justify-content-center flex-column">
  
  <span id="error-messageCap" style = "display: block; margin: auto; text-align: center; color: red; font-weight: bold; font-size: 16px; margin-top: 10px;"></span>
      
  <br><br>

    <div class="">
      <div class="row">
        <div class="col-12 d-flex flex-column align-items-center justify-content-center mx-auto ">


          <!-- SELECT LANGUAGE -->
          <?php
            if(isset($_GET['language'])){ 
              
              // video title form functionality
              if(isset($_POST['select_lang'])){
                $language_selected = $_POST['language_selected'];
    
                if($language_selected != ''){
                  
                  header("Location: ./adminUploadVideoUI.php?languagee=$language_selected&course");
                } else {
                  echo "<script>alert('File cannot be empty');</script>";
                }
              }


              if(isset($_POST['go_back'])){
                header("Location: ../../choose.php");
              }
              ?>
 



              <div class="d-flex align-items-center justify-content-center w-100" style="height: 90vh;">
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
                          $language_id = $lang_row['id'];
                          $language = $lang_row['language'];
                          echo "<option value='$language_id'>$language</option>";
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
              </div>          
              <?php 
            }

          ?>

          
          <!-- SELECT COURSE -->
          <?php
            if(isset($_GET['course']) && isset($_GET['languagee'])){ 
              $course_lang = $_GET['course'];
              $course_lang_id = $_GET['languagee'];
              
              $course_lang_db = $conn->prepare("SELECT language FROM language_table WHERE id = :course_lang_id");
              $course_lang_db->bindParam(":course_lang_id", $course_lang_id);
              $course_lang_db->execute();
              $fetch_course_lang = $course_lang_db->fetch(PDO::FETCH_ASSOC);
              $language = $fetch_course_lang['language'];


              // video title form functionality
              if(isset($_POST['course_selected'])){
                $course_id = $_POST['course_selected'];

                if($course_id != ''){
                  
                  header("Location: ./adminUploadVideoUI.php?course_id_uploadvid=$course_id&add_lesson");
                } else {
                  echo "<script>alert('File cannot be empty');</script>";
                }
              }


              if(isset($_POST['go_back'])){
                header("Location: ./adminUploadVideoUI.php?language");
              }
              ?>
 
              <div class="d-flex align-items-center justify-content-center w-100" style="height: 90vh;">
                <!-- video title form ui -->
                <form method="POST" class="col-8" enctype="multipart/form-data">
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
                        $select_lang_course = $conn->prepare("SELECT * FROM course_table WHERE course_lang_id = :course_language");
                        $select_lang_course->bindParam(":course_language", $course_lang_id);
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
              </div>


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


            
            // ADD LESSON
            if(isset($_GET['add_lesson'])){ 
              ?>
              <!-- video title form functionality -->
              <form class="col-10" method="POST" enctype="multipart/form-data">
                <h3 class="uploaded hidden p-3 text-center rounded-3 " style="background: #beebbf; color: #333; transition: all .5s ease-in; font-size: 1.2rem;">File uploaded successfully</h3>

                <div class="mb-5">
                  <div class="display-6 text-center font-med my-5">Create a Lesson under <?php echo $course_title; ?></div>

                <br>
                  <!-- file upload -->
                  <div class="mx-auto text-center h4 mt-3" style="margin-bottom: 1rem; color: #555">
                    <span class="txt-red-light text-center font-bold">STEP 1: </span>
                    Add a Title
                  </div>
                  <div
                    class="form-group d-flex align-items-center justify-content-center"
                  >
                    <input
                      type="text"
                      id="title"
                      name="video_title"
                      required
                      class="form-control text-center text-capitalize"
                      style="border: 0.1rem solid #888; font-size: 20px;"
                      placeholder="Title here..."
                      
                    />
                  </div>
                  <p style="color: #777; font-size: 15px;" class="text-center mt-2">Please note that this field is required and must be filled out before you can proceed to the next step.</p>

                </div>

                <br>
                <!-- ADD CAPTIONS -->
                <div class="my-5">
                  <!-- file upload -->
                  <div class="mx-auto text-center h4" style="margin-bottom: 1rem; color: #555">
                    <span class="txt-red-light text-center font-bold">STEP 2: </span>
                    Upload captions
                  </div>

                  <!-- file upload -->
                  <div class="form-group mb-4">
                    <div class="d-flex mx-auto flex-column justify-content-center align-items-center rounded-3 py-4" style="border: 0.1rem solid #888;">
                  
                      <div class="py-3" style="padding-left: 12rem;">
                        <label
                          for="upload_file"
                          class="rounded-pill bgc-gray-light px-3 py-1"
                          style="border: #555 solid 0.1rem; cursor: pointer"
                          >
                          Upload File
                        </label>
                        <input
                          type="file"
                          name="video_caption[]"
                          id="upload_file"
                          required
                          multiple
                          onchange="validateFileTypeSRTAndEmpty()"
                        />
                      </div>
                      
                      <div id="selected_files"></div>
                    </div>
                    <p style="color: #777; font-size: 15px;" class="text-center mt-2">Please note that this field is required and must be filled out before you can proceed to the next step.</p>
                  </div>
                </div>



                <br>
                <!-- ADD VIDEO -->
                <div class="my-5">
                  <!-- file upload -->
                  <div class="mx-auto text-center h4" style="margin-bottom: 1rem; color: #555">
                    <span class="txt-red-light text-center font-bold">STEP 3: </span>
                    Upload a video
                  </div>

                  <div class="input-group mt-2">
                    <div class="drop-zone">
                      <span class="drop-zone__prompt d-flex flex-column align-items-center" >
                        <i class="fa-solid fa-cloud-arrow-up mb-2" style="font-size: 50px;"></i>
                        <span>
                          Drop file here or click to upload
                        </span>
                        <p style="color: #777; font-size: 15px;" class="text-center">Allowed extension types: mp4, mkv, webm, flv, vob, ogv, ogg, avi, wmv, mov, mpeg, mpg</p>
                        <p class='txt-red-light font-med' style="font-size: 15px; margin-bottom: 2rem; margin-top: -1rem;" class="text-center">File must be less than 500 megabytes</p>

                      </span>
                      <input type="file" id="fileInput" name="video_file_name" class="drop-zone__input" onchange="checkFileSize()">
                      <span id="errorSpan" style="color: red;"></span>
                    </div>
                  </div>
                  <p style="color: #777; font-size: 15px;" class="text-center mt-2">Please note that this field is required and must be filled out before you can submit the form.</p>

                  <div class="progress">
                    <div id="progressBar"></div>
                  </div>

                  <!-- <div id="errorMessage"></div> --> 

                  <div class="d-flex justify-content-center mb-1" style="margin-top: 2rem;">
                    <input type="submit" onclick="uploadFile(); checkFileType(); checkFieldEmpty(); validateForm();" name="upload_lesson" class="preventReload upload btn bgc-red-light rounded-pill px-5 mx-3" style="font-size: 18px;" value="Submit"> 
                  </div>
                </div>

                <!--  -->
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

  function displaySelectedFiles() {
    const input = document.getElementById('upload_file');
    const output = document.getElementById('selected_files');
    const files = input.files;
    let fileNames = '';

    for (let i = 0; i < files.length; i++) {
      const fileName = files[i].name;
      const fileId = `file_${i}`;
      fileNames += `
        <div id="${fileId}">
          ${fileName}
          <button type="button" style='font-size: 15px; background:transparent; border:none; color: red' class='my-1 font-med' onclick="deleteFile('${fileId}')">X</button>
        </div>
      `;
    }

    output.innerHTML = fileNames;
  }

  function deleteFile(fileId) {
    const fileElement = document.getElementById(fileId);
    fileElement.parentNode.removeChild(fileElement);
  }

</script>
<script>


  function uploadFile() {

  let upload = document.querySelector('.upload');
  let go_back = document.querySelector('.go_back');
  upload.textContent = 'Uploading...';
  upload.style.backgroundColor = '#eaeae5';
  upload.style.color = '#444';
  setTimeout(() => {
    upload.disabled = true;
    go_back.disabled = true;
  }, 0500);
    
  // Get the file input element and selected file
  var fileInput = document.getElementById("fileInput");
  var file = fileInput.files[0];

  // Calculate the file size and estimated upload time
  var fileSize = file.size;
  var uploadTime = fileSize / 1000000 * 2.5; // Time in seconds (assuming 1Mbps upload speed)
  
  // Get the progress bar element and initialize progress to 0
  var progressBar = document.getElementById("progressBar");
  var progress = 0;

  // Create a new FormData object and append the file to it
  var formData = new FormData();
  formData.append("file", file);

  // Send the file to the server using AJAX and update progress bar
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/upload", true);
  xhr.upload.onprogress = function(event) {
    if (event.lengthComputable) {
      progress = Math.round((event.loaded / event.total) * 100);
      progressBar.style.width = progress + "%";
      progressBar.innerText = progress + "%";
    }
  };
  xhr.onload = function() {
    if (xhr.status == 200) {
      progressBar.style.width = "100%";
      progressBar.innerText = "100%";
      alert("File uploaded successfully!");
    } else {
      alert("INVALID VIDEO FILE TYPE");
    }
  };
  xhr.send(formData);

  // Start a timer to update the progress bar every second
  var interval = setInterval(function() {
    progress += 1;
    progressBar.style.width = progress + "%";
    progressBar.innerText = progress + "%";
    if (progress >= 100) {
      clearInterval(interval);
    }
  }, uploadTime * 10);
}

//upload caption js function
function validateFileTypeSRTAndEmpty() {
const input = document.getElementById('upload_file');
const file = input.files[0];
const allowedExtensions = /(.srt)$/i;

// Check if a file has been selected
if (input.files.length === 0) {
alert('File is empty');
return false;
}

// Check if the file type is valid
if (!allowedExtensions.exec(file.name)) {
alert('Invalid file type. Please upload a video file with a valid extension (.srt).');
input.value = '';
return false;
}

// Everything is valid, so clear error message
return true;
}

//upload video js function
function checkFileSize() {
const fileInput = document.getElementById('fileInput');
const sizeLimit = 50000000; // 50 MB in bytes

if (fileSize <= sizeLimit) {
errorSpan.innerText = '';
} else {
alert("File size is too large. Please limit it to 50MB.");
fileInput.value = ''; // reset the file input field
}

}

//upload video file type checking
function checkFileType() {
  const fileInput = document.getElementById('fileInput');
  const allowedExtensions = /(\.mp4|\.mkv|\.webm|\.flv|\.vob|\.ogv|\.ogg|\.avi|\.wmv|\.mov|\.mpeg|\.mpg)$/i;
  const fileName = fileInput.value;
  if (!allowedExtensions.exec(fileName)) {
    alert('Invalid file type. Please upload a file with one of the following extensions: .mp4, .mkv, .webm, .flv, .vob, .ogv, .ogg, .avi, .wmv, .mov, .mpeg, .mpg');
    fileInput.value = '';
    return false;
  }
  return true;
}

function checkFieldEmpty() {
  const input = document.getElementById('upload_file');
  const inputTitle = document.getElementById('title');
  
  if (input.files.length === 0) {
    alert('File upload field cannot be empty.');
    return false;
  }
  
  if (inputTitle.value.trim() === '') {
    alert('Title field cannot be empty.');
    return false;
  }
  
  return true;
}
</script>



<?php include '../a_includes/admin_footer.php'; ?>



