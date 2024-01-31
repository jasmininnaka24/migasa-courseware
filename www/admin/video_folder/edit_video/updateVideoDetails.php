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
<?php

  if(isset($_GET['update_course_id']) && isset($_GET['update_video_id'])){
    $course_id = $_GET['update_course_id'];
    $video_id = $_GET['update_video_id'];

    $select_video_id = $conn->prepare("SELECT * FROM videos_table WHERE id = :video_id");
    $select_video_id->bindParam(":video_id", $video_id);
    $select_video_id->execute();

    $row = $select_video_id->fetch(PDO::FETCH_ASSOC); 
    $video_file_name = $row['video_file_name'];
    $video_title = $row['video_title'];

    $course_title_db = $conn->prepare("SELECT course_title FROM course_table WHERE id = :course_id");
    $course_title_db->bindParam("course_id", $course_id);
    $course_title_db->execute();
    $fetch_course_title = $course_title_db->fetch(PDO::FETCH_ASSOC);
    $course_title = $fetch_course_title['course_title'];
    ?>

    <form action="" method="POST" enctype="multipart/form-data">
      <div class="col-lg-8 col-md-10">
      <div class="display-6 mb-3 font-med">
        Update Video under <?php echo $course_title; ?>
      </div>
      <!-- video id - hidden -->
          <div>
            <input hidden type="number" class="form-control mb-3" name="video_id" value="<?php echo $video_id;?>" >
          </div>


        <!-- title upload -->
        <div
        class="input-group d-flex align-items-center justify-content-center"
        >
          <label
          for="title"
          class="font-med"
          style="margin-right: 1rem; font-size: 20px"
          >Title</label
          >
          <input
          type="text"
          id="title"
          name="video_title"
          value="<?php echo $video_title; ?>"
          class="form-control"
          style="border: 0.1rem solid #888"
          />
        </div>

        
        <!-- caption upload -->
        <!-- file upload -->
        <br>
        <div class="form-group mb-4">
          <label
            for="title"
            class="font-med"
            style="margin-right: 1rem; font-size: 20px"
            >Captions</label
            >
          <div class="d-flex mx-auto flex-column justify-content-center align-items-center rounded-3 py-4" style="border: 0.1rem solid #888;">

            <div class="py-3" style="padding-left: 8rem;">
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
                multiple
                onchange="displaySelectedFiles()"
                />
            </div>
            <div style="margin-right: 3rem;">
              <h6 class="mt-0">Existing Files:</h6>
              <br>
              <?php
                $captions_db = $conn->prepare("SELECT caption_file_name FROM caption_table WHERE video_id = :video_id");
                $captions_db->bindParam(":video_id", $video_id);
                $captions_db->execute();

                while($caption_row = $captions_db->fetch(PDO::FETCH_ASSOC)){
                  $caption = $caption_row['caption_file_name'];

                  echo "<div class='d-flex align-items-center justify-content-center' style='margin-top: -1.57rem;'>$caption</div>" . "<br>";
                }
              ?>
            </div>
            
            <div id="selected_files"></div>
          </div>
          <p style="color: #777; font-size: 15px;" class="text-center mt-2">Please note once you upload new files here, the previous files uploaded will be permanently deleted.</p>
        </div>

          <div class="">
            <div class="input-group mt-3">
              <p for="vid_upload" class="font-med" style="font-size: 20px; margin-right: 2rem;">Update Video</p>
            <div class="drop-zone">
              <span class="drop-zone__prompt d-flex flex-column align-items-center" >
                <span class="d-flex justify-content-center">
                  <div style="border: #888 solid 1px;" class="d-flex justify-content-center">
                    <video loop autoplay muted width="115%" src="../../../backend_storage/uploaded_vids/<?php echo $video_file_name; ?>"></video>
                  </div>
                </span>
              </span>
              <input type="file" id="fileInput" name="video_file_name" class="drop-zone__input">
            </div>
          </div>
          <div class="progress">
            <div id="progressBar"></div>
          </div>
        </div>

        </div>
        <div class="mt-3 d-flex justify-content-end">
          <a href="../../videos_display.php?course_id_display=<?php echo $course_id; ?>" class="discard">
            <div class="btn bgc-gray-light rounded-pill mb-3 mx-2 px-3 font-med " style="font-size: 16px; border: 1px solid #444;">Discard</div>
          </a>
          <input type="submit" onclick="uploadFile()" name="update_lesson" class="preventReload upload btn bgc-red-light rounded-pill mb-3 px-3 font-med update" style="font-size: 16px;" value="Submit"> 

        </div>

    </form>


  <?php }

?>

<script>
  
let update = document.querySelector(".update");
let discardLink = document.querySelector('.discard');






update.addEventListener("click", () => {
  update.textContent = "updating...";
  update.style.backgroundColor = "#eaeae5";
  update.style.color = "#444";
  setTimeout(() => {
    update.disabled = true;
    discardLink.removeAttribute('href');
    discardLink.disabled = true;
    discardLink.style.opacity = '0.5';
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

function displaySelectedFiles() {
    const input = document.getElementById('upload_file');
    const output = document.getElementById('selected_files');
    const files = input.files;
    let fileNames = '';

    for (let i = 0; i < files.length; i++) {
      const fileName = files[i].name;
      const fileId = `file_${i}`;
      fileNames += `
        <div class='font-med d-flex align-items-center justify-content-center' id="${fileId}">New file: 
          ${fileName} 
          <button type="button" style='font-size: 15px; background:transparent; border:none; color: red; margin-right: 3rem' class='my-1 font-med' onclick="deleteFile('${fileId}')">X</button>
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
let discard = document.querySelector('.discard');

upload.textContent = 'Uploading...';
upload.style.backgroundColor = '#eaeae5';
upload.style.color = '#444';

discard.style.backroundColor = '#eaeae5';
discard.style.color = '#444';

setTimeout(() => {
  upload.disabled = true;
  discard.disabled = true;

  
}, 0500);

  
// Get the file input element and selected file
var fileInput = document.getElementById("fileInput");
var file = fileInput.files[0];

// Calculate the file size and estimated upload time
var fileSize = file.size;
var uploadTime = fileSize / 1000000 * 1.2; // Time in seconds (assuming 1Mbps upload speed)

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
    alert("Error uploading file.");
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




</script>

