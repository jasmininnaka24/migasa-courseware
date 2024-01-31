<?php
  if(isset($_GET['course_id_uploadvid'])){
    $course_id = $_GET['course_id_uploadvid'];
    $select_course = $conn->prepare("SELECT * FROM course_table WHERE id = :course_id");
    $select_course->bindParam(":course_id", $course_id);
    $select_course->execute();
    $fetch_course = $select_course->fetch(PDO::FETCH_ASSOC);
    $course_title = $fetch_course['course_title'];
  }
?>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="col-lg-10 col-md-10">
      <div class="display-6 mb-3 font-med">
        Upload a Video under <?php echo $course_title; ?>
      </div>
    
        <!-- file upload -->
        <div class="form-group mb-4">
          <div class="d-flex align-items-center rounded-3" style="border: 0.1rem solid #888;">
            <div class="w-25 px-4 d-flex pt-3 align-items-center justify-content-center" style="border-right: 0.1rem solid #888;">

              <h4 class="overflow-hidden" class="font-med" style="font-size: 20px;">Subtitle</h4>
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
                name="video_subtitle"
                id="upload_file"
                />
              </div>
          </div>

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
      value=""
      class="form-control"
      style="border: 0.1rem solid #888"
      />
    </div>

    <div class="input-group mt-3">

      <p for="vid_upload" class="font-med" style="font-size: 20px; margin-right: 2rem;">Upload File</p>
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

    </div>
    <div class="mt-3 d-flex justify-content-end">
      <button class="btn bgc-red-light rounded-pill mb-3 px-3 font-med upload" style="font-size: 16px;" onclick="preventFromReload()" name="upload_video">Upload Video</button>
    </div>

</form>

