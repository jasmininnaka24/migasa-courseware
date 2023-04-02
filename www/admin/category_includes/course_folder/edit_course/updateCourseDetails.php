<?php

  if(isset($_GET['update_course_id'])){
    $update_course_id = $_GET['update_course_id'];
    
    $select_course_id = $conn->prepare("SELECT * FROM course_table WHERE id = $update_course_id");
    $select_course_id->execute();

    $row = $select_course_id->fetch(PDO::FETCH_ASSOC);

    $course_id = $row['id'];
    $course_title = $row['course_title'];
    $course_desc = $row['course_desc'];
    $course_icon = $row['course_icon'];
    $course_lang = $row['course_lang'];

    $course_desc_length = strlen($course_desc);

    ?>



<main style="min-height: 90%;" class="d-flex justify-content-center flex-column anim-to-top-slow">
  <div class="d-flex container" style="margin-bottom: 1rem;">
    <div style="width: 3rem; margin-right: 1rem;">
      <img src="../../assets/img/migasa 2.png" width="100%" alt="">
    </div>
    <div class="h3 mb-3 font-med pt-1" style="color: #777;">Update <span class=""><?php echo $course_title; ?></span> Course</div>
  </div>
    <div class="container mt-2">
      <div class="row">
        <form action="" method="POST" enctype="multipart/form-data" class=" anim-to-top-slow">
  
  <!-- <div class="col-10 h5 my-3" style="margin-bottom: 2rem; color: #555">
  You can type in the necessary modifications. If you want to alter the icon, simply press the update file button. Once you're done, click on the Update Course button.
  </div> -->
  <div class="col-md-8">

    <!-- course id - hidden -->
    <div>
      <input hidden type="number" class="form-control mb-3" name="course_id" value="<?php echo $course_id;?>" >
    </div>

      <!-- file upload -->
      <div class="form-group mb-2">
        <div class="d-flex align-items-center rounded-3" style="border: 0.1rem solid #888;">
          <div class="w-25 d-flex align-items-center justify-content-center" style="border-right: 0.1rem solid #888;">

            <img src="../../../backend_storage/uploaded_icons/<?php echo $course_icon; ?>" width="100" class="p-3" alt="">
          </div>
          
          <div class="mx-5 mb-2">
            <label
              for="upload_file"
              class="rounded-pill bgc-gray-light px-3 py-1"
              style="border: #555 solid 0.1rem; cursor: pointer"
              >
              Update File
            </label>
            <input
              type="file"
              name="course_icon"
              id="upload_file"
              accept="image/*"
              />
            </div>
        </div>

      </div>
      <!-- title upload -->
      <br />
      <div
        class="form-group d-flex align-items-center justify-content-center"
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
          name="course_title"
          class="form-control text-capitalize"
          value="<?php echo $course_title; ?>"
          style="border: 0.1rem solid #888; font-size: 20px;"
        />
      </div>
      <!-- Activities -->
      <br />
      <label
        for="description"
        class="font-med mb-2"
        style="margin-right: 1rem; font-size: 20px"
        >Description</label
      >
      <div
        class="input-group d-flex align-items-center justify-content-center position-relative"
      >
        <textarea
          name="course_description"
          id="message"
          cols="20"
          rows="5"
          class="form-control"
          style="border: 0.1rem solid #888; font-size: 20px; resize: none;"
          maxlength="250"
          onkeyup="countCharacters()"
        ><?php echo $course_desc; ?></textarea
        >
        <div class="counter">
          <span id="characterCount"><?php echo $course_desc_length; ?></span>/250
        </div>
      </div>

      
      <div class="form-group mt-2 mb-4">
        <label
          for="description"
          class="font-med mb-2"
          style="margin-right: 1rem; font-size: 20px"
          >Course Language</label
        >
        <select name="course_lang" id="" class="form-control" style="border: 0.1rem solid #888; font-size: 20px;">
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




    </div>
      <div class="d-flex align-items-center justify-content-end w-100 mb-3">
        <a href="../../courses_display.php?language=all_languages" class="text-decoration-none">
          <div
          style="font-size: 16px; border: 1px solid #222;"
          class="btn bgc-gray-light font-med rounded-pill mx-3"
          >
            Discard
          </div>
        </a>
        <button
          type="submit"
          name="update_course"
          style="font-size: 16px"
          class="btn bgc-red-light font-med rounded-pill "
        >
          Update Course
        </button>
      </div>
    </form>

      </div>
    </div>
  </main>


  <?php }

?>

