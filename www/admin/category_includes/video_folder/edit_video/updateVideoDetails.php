<?php

  if(isset($_GET['update_course_id']) && isset($_GET['update_video_id'])){
    $course_id = $_GET['update_course_id'];
    $video_id = $_GET['update_video_id'];

    $select_video_id = $conn->prepare("SELECT * FROM videos_table WHERE id = :video_id");
    $select_video_id->bindParam(":video_id", $video_id);
    $select_video_id->execute();

    $row = $select_video_id->fetch(PDO::FETCH_ASSOC); 
    $video_file_name = $row['video_file_name'];
    $video_file_name = str_replace("../../../backend_storage/uploaded_vids/", "", $video_file_name);
    $video_title = $row['video_title'];
    $video_subtitle = $row['video_subtitle'];
    $course_title = $row['course_title'];

    ?>

    <form action="" method="POST" enctype="multipart/form-data">
      <div class="d-flex align-items-center pb-3">
        <div style="width: 3rem; margin-right: 1rem;">
          <img src="../../assets/img/migasa 2.png" width="100%" alt="">
        </div>
        <div class="h3 mb-3 font-med pt-4" style="color: #777;">
          Update Video under <span style="color: #444;"><?php echo $course_title; ?></span>
        </div>
      </div>


      <div class="col-lg-8 col-md-8">
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
        <div class="form-group my-3">
          <label
            for="title"
            class="font-med mb-1"
            style="margin-right: 1rem; font-size: 20px"
            >Caption</label
            >
          <div class="d-flex align-items-center rounded-3" style="border: 0.1rem solid #888;">
            <div class="w-25 px-4 d-flex pt-3 align-items-center justify-content-center" style="border-right: 0.1rem solid #888;">

              <p class="overflow-hidden "><?php echo $video_subtitle; ?></p>
            </div>
            
            <div class="py-1 mb-2" style="padding-left: 3rem;">
              <div>
                <label
                  for="upload_file"
                  class="rounded-pill bgc-gray-light px-3 py-1"
                  style="border: #555 solid 0.1rem; cursor: pointer"
                  >
                  Update Caption File
                </label>
                <input
                type="file"
                name="video_subtitle"
                id="upload_file"
                
                />
              </div>
            </div>
          </div>

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
              <input type="file" id="vid_upload" name="video_file_name" class="drop-zone__input">
            </div>
          </div>
        </div>

        </div>
        <div class="mt-3 d-flex justify-content-end">
          <a href="../../videos_display.php?course_id_display=<?php echo $course_id;?>" class="mx-3">
            <div class="btn bgc-gray-light rounded-pill mb-3 px-3 font-med" style="font-size: 16px; border: 1px solid #444;">Discard</div>
          </a>
          <button class="btn bgc-red-light rounded-pill mb-3 px-3 font-med update" style="font-size: 16px;" onclick="preventFromReload()" name="update_video">Update</button>
        </div>

    </form>


  <?php }

?>

<script>
  
let update = document.querySelector(".update");
update.addEventListener("click", () => {
  update.textContent = "updating...";
  update.style.backgroundColor = "#eaeae5";
  update.style.color = "#444";
  setTimeout(() => {
    update.disabled = true;
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

