<?php 
  ob_start();
  session_start();
  include './includes/database.php';
  include './includes/session_role.php';
  include './category_includes/video_folder/processingVideoFunctionality.php';
  include './includes/admin_header.php';

  if(isset($_GET['course_id_display'])){
    $course_id = $_GET['course_id_display'];

    $fetchCourseTitle = $conn->prepare("SELECT * FROM course_table WHERE id = :course_id");
    $fetchCourseTitle->bindParam(":course_id", $course_id);
    $fetchCourseTitle->execute();
    $titleRow = $fetchCourseTitle->fetch(PDO::FETCH_ASSOC);
    $courseTitle = $titleRow['course_title'];
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
      .langwi p {
        font-size: 30px;
      }
      .btn-gray {
        background-color: #c2beaa;
      }
      .btn {
        font-size: 22px;
      }
      .hidden {
        display: none;
      }
      .show_vid_style {
        object-fit: cover;
        height: 100%;
        width: 100%;
      }
      .show_vid_container {
        width: 100%;
        height: 20vh;
        overflow: hidden;
      }
      .grid_videos {
        display: grid;
        grid-template-columns: repeat(4, 22%);
        justify-content: space-between;
      }
      .course_crud {
        display: flex;
        align-items: center;
      }
      .maintenance_icons{
        display: flex;
        align-items: center;
        justify-content: end;
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
        font-size: 17px;
        margin-right: 5px;
        border-radius: 4px;
        outline: none;
      }



      .course, .video, .activity, .scoring{
        transition: all .2s linear;
      }
      .course:hover, .video:hover, .activity:hover, .scoring:hover{
        background: #f2f2f2;
      }
      .checkbox[type="checkbox"] {
        transform: scale(2); 
      }

      /* Style for the checked checkbox */
      .checkbox[type="checkbox"]:checked {
        background-color: red; 
        color: white; 
      }


      @media (max-width: 760px) {
        .grid_videos {
          grid-template-columns: repeat(2, 40%);
          justify-content: space-evenly;
        }
        .show_vid_container {
          margin: 1rem;
        }
      }

      @media (max-width: 500px) {
        .course_crud {
          flex-direction: column;
          margin: none;
        }
        .title {
          text-align: center;
        }
        .course_crud div a {
          /* justify-content: start; */
          margin: 0;
        }
        .grid_videos {
          grid-template-columns: repeat(1, 70%);
          justify-content: space-evenly;
        }
        .show_vid_container {
          margin: 1rem;
        }
      }

    </style>
  </head>
  <body>

  <div class="deleted hidden position-fixed" style="top: 0; left: 0; z-index: 9999;">
    <div class="invalid_modal_container">
      <div class="invalid_modal d-flex flex-column" style="background: #ddf5d9; color: #444">
        <div class="h2">
        ✅ DELETED SUCCESSFULLY!
        </div>
      </div>
    </div>
  </div>

    <!-- SIDEBAR NAVIGATION -->
    <?php include './includes/admin_sidebar.php'; ?>
    <?php include './includes/admin_sidebar_section_header.php'; ?>

    <?php
      if(isset($_POST['submit_lesson_to_del'])){
        $lesson_ids = $_POST['checkedLessonsToDel'];

        foreach ($lesson_ids as $lesson_id) {

          $caption_file_name_db = $conn->prepare("SELECT caption_file_name FROM caption_table WHERE video_id = :lesson_id");
          $caption_file_name_db->bindParam("lesson_id", $lesson_id);
          $caption_file_name_db->execute();
          
          while($fetch_capname = $caption_file_name_db->fetch(PDO::FETCH_ASSOC)){
            $caption_file_name = $fetch_capname['caption_file_name'];
            $caption_file_name = "../backend_storage/uploaded_captions/$caption_file_name";
            unlink($caption_file_name);
          }

          $video_file_name_db = $conn->prepare("SELECT video_file_name FROM videos_table WHERE id = :lesson_id");
          $video_file_name_db->bindParam("lesson_id", $lesson_id);
          $video_file_name_db->execute();
          
          while($fetch_vidname = $video_file_name_db->fetch(PDO::FETCH_ASSOC)){
            $video_file_name = $fetch_vidname['video_file_name'];
            $video_file_name = str_replace("../../../backend_storage/uploaded_vids/", "", $video_file_name);
            $video_file_name = "../backend_storage/uploaded_vids/$video_file_name";
            unlink($video_file_name);
          }

          $lesson_id_db = $conn->prepare("DELETE FROM caption_table WHERE video_id = :lesson_id");
          $lesson_id_db->bindParam(":lesson_id", $lesson_id);
          $lesson_id_db->execute();

          $lesson_id_db = $conn->prepare("DELETE FROM videos_table WHERE id = :lesson_id");
          $lesson_id_db->bindParam(":lesson_id", $lesson_id);
          $lesson_id_db->execute();

        }
      }
    ?>

      <!-- main -->
      <form method="POST" style="min-height: 90%;" class="w-100 d-flex align-items-center justify-content-center flex-column mt-2">
        <div class="d-flex align-items-center justify-content-center text-center mb-4">
          <div class="display-5 font-med"><?php echo $courseTitle; ?> Lesson List 
            <img src="./assets/img/videos.png" width="4%" alt="">
          </div>
        </div>

        <div class="d-flex align-items-center justify-content-center mx-3">
          <a href="./read/videos/adminUploadVideoUI.php?course_id_uploadvid=<?php echo $course_id; ?>&add_lesson" class="text-decoration-none">
              <div
                style="font-size: 18px"
                class="btn bgc-red-light px-3 py-1 rounded-pill font-reg"
              >
                +Add a lesson in this course
              </div>
            </a>
          </div>

        <?php 
        $videoCount = $conn->prepare("SELECT * FROM videos_table WHERE course_id = :course_id");
        $videoCount->bindParam(":course_id", $course_id);
        $videoCount->execute();

        $count = 0;
        while($videoCount->fetch(PDO::FETCH_ASSOC)){
          $count += 1;
        }

        if($count === 0){
          echo "
            <div class='text-center font-med display-4 py-5'>NO VIDEO HAS BEEN UPLOADED</div>
          ";
        } else { ?>


      <div class="col-12 mx-auto text-center h5 my-4" style="color: #555;">
        To modify the details of a particular video, you can click the edit button icon located in the modify column. Additionally, you can delete the video entirely as well as its activities and scoring by clicking on the delete button located beside the edit button.
      </div>
      <div class="mt-3 mb-2 d-flex align-items-center justify-content-center w-100" >
        <div class="mx-2 btn bgc-gray-light rounded-pill selectacts" onclick="toggleCheckboxes(this)" id="toggle-checkboxes" style="border: #444 1px solid; font-size: 18px;">Select lessons to delete</div>
        <div class="mx-2 btn bgc-gray-light rounded-pill selectall" onclick="checkAll()" style="border: #444 1px solid; font-size: 18px;">Select All</div>
        <div class="mx-2 btn bgc-gray-light rounded-pill unselectall" onclick="uncheckAll()" style="border: #444 1px solid; font-size: 18px;">Unselect All</div>
        <a href="./videos_display.php?course_id_display=<?php echo $course_id; ?>" class="add_q_a hidden text-decoration-none">
          <div class="mx-2 btn bgc-gray-light rounded-pill" style="border: #444 1px solid; font-size: 18px;">Discard</div>
          <button class="mx-2 btn bgc-red-light rounded-pill" name="submit_lesson_to_del" style="font-size: 18px;">Delete</button>
        </a>
      </div>


      <table class="table mt-4">
          <thead>
            <tr>
              <th class="text-center"></th>
              <th class="text-center"></th>
              <th class="text-center">Video</th>
              <th class="text-center" style="width: 20%">Video Title</th>
              <th class="text-center">List of Activities</th>
              <th class="text-center">Scoring</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $select_videos = $conn->prepare("SELECT * FROM videos_table WHERE course_id = :course_id ORDER BY id DESC");
              $select_videos->bindParam(":course_id", $course_id);
              $select_videos->execute();
              
              $num_count = 1;
              while($video_row = $select_videos->fetch(PDO::FETCH_ASSOC)){
                $video_id = $video_row['id'];
                $video_title = $video_row['video_title'];
                $video_file_name = $video_row['video_file_name'];

                $video_file_name = str_replace("../../../backend_storage/uploaded_vids/","",$video_file_name);
                
                ?>

                <tr>
                  <td>
                  <input 
                      type="checkbox" 
                      class="checkbox hidden mt-2"
                      style="margin-left: .5rem;" 
                      name="checkedLessonsToDel[]" 
                      value="<?php echo $video_id; ?>" 
                      
                      <?php 
                          $status = "Selected";
                          $select_checked_boxes = $conn->prepare("SELECT * FROM activity_table WHERE id = :id AND status = :status");
                          $select_checked_boxes->bindParam(":id", $question_id);
                          $select_checked_boxes->bindParam(":status", $status);
                          $select_checked_boxes->execute();

                          $count = 0;
                          while($select_checked_boxes->fetch(PDO::FETCH_ASSOC)){
                            $count += 1;
                          }

                          if($count> 0){
                            echo "checked='checked'"; 
                          }
                        
                      ?>


                    >
                  </td>
                  <td class="text-center font-med course pt-3"><?php echo $video_id; ?></td>
                  <td class="text-center video">
                    <div class="d-flex align-items-center justify-content-center pt-1">
                      <div style="width: 150px; object-fit: cover;">
                        <video loop autoplay muted src="../backend_storage/uploaded_vids/<?php echo $video_file_name; ?>" width="100%"></video>
                     
                      </div>
                    </div>
                  </td>
                  <td class="text-center font-med course pt-5" style="font-style: 22px;"><?php echo $video_title; ?></td>
                  <td class="text-center font-med course" style="padding-top: 35px;">
                    <a href="./read/activity/updateActivityUI.php?update_course_id=<?php echo $course_id; ?>&update_video_activity=<?php echo $video_id; ?>&listOfAllActivities" class="text-decoration-none d-flex align-items-center justify-content-center mt-1">
                      <div class="bgc-gray-light rounded-pill px-4" style="border: #222 1px solid; font-size: 18px; padding: .4rem 0">List of Activities</div>
                    </a>
                  </td>
                  <td class="text-center font-med course" style="padding-top: 35px;">
                    <a href="./read/scoring/updateScoringUI.php?update_course_id=<?php echo $course_id; ?>&update_video_activity=<?php echo $video_id; ?>" class="text-decoration-none d-flex align-items-center justify-content-center mt-1">
                      <div class="bgc-gray-light rounded-pill px-4" style="border: #222 1px solid; font-size: 18px; padding: .4rem 0">See Scoring</div>
                    </a>
                  </td>

                  <td class="" style="padding-top: 35px;">
                    <div class="d-flex align-items-center justify-content-center">

                      <a href="./read/videos/updateVideoUI.php?update_course_id=<?php echo $course_id; ?>&update_video_id=<?php echo $video_id; ?>" class="text-decoration-none d-flex align-items-center justify-content-center mt-1">
                        <div class="btn mx-1 bg-transparent rounded-pill px-4" style="font-size: 18px; border: #2e6341 1px solid; color: #2e6341;">Edit Video</div>
                    </a>
                    <a onClick="return confirm('Are you sure you want to delete?')" href="./videos_display.php?course_id_display=<?php echo $course_id; ?>&delete_video_lesson=<?php echo $video_id; ?>">
                      <div class="rounded-pill btn mx-1 bg-transparent" style="font-size: 18px; border: #cc2b0e 1px solid; color: #cc2b0e;">Delete Video</div>
                    </a>
                  </div>
                  </td>
                </tr>
                <?php 
                $num_count += 1;
                
              }
            }
            ?>

          </tbody>
        </table>
      </form>

    </section>


  <div class="overlay hidden"></div>

  <script>
    let delete_this = (e) => {
      document.querySelector(".modals").classList.remove("hidden");
      document.querySelector(".overlay").classList.remove("hidden");
      e.preventDefault();
    };

    let toggleCheckboxes = (e) => {
      let checkboxes = document.querySelectorAll(".checkbox");
      let add_q_a = document.querySelector(".add_q_a");

      Array.from(checkboxes).forEach((checkbox) =>
        checkbox.classList.remove("hidden")
      );

      add_q_a.classList.remove("hidden");

      if (add_q_a.classList.contains("hidden")) {
        e.classList.toggle("hidden");
        discardChanges.classList.toggle("hidden");
      }
    };

    // TO CHECK ALL BOXES
    function checkAll() {
      let checkboxes = document.querySelectorAll(".checkbox");
      let add_q_a = document.querySelector(".add_q_a");
      add_q_a.classList.remove("hidden");

      Array.from(checkboxes).forEach((checkbox) =>
        checkbox.classList.remove("hidden")
      );
      let checkboxs = document.getElementsByTagName("input");
      for (let i = 0; i < checkboxs.length; i++) {
        if (checkboxs[i].type == "checkbox") {
          checkboxs[i].checked = true;
        }
      }
    }

    // TO UNCHECK ALL BOXES
    function uncheckAll() {
      let checkboxes = document.querySelectorAll(".checkbox");
      let add_q_a = document.querySelector(".add_q_a");
      add_q_a.classList.remove("hidden");

      Array.from(checkboxes).forEach((checkbox) =>
        checkbox.classList.remove("hidden")
      );

      let checkboxs = document.getElementsByTagName("input");
      for (let i = 0; i < checkboxs.length; i++) {
        if (checkboxs[i].type == "checkbox") {
          checkboxs[i].checked = false;
        }
      }
    }

    // TO CHECK THE CHECKBOXES RANDOMLY
    let unhideNumGenInp = (e) => {
      let checkboxes = document.querySelectorAll(".checkbox");
      let add_q_a = document.querySelector(".add_q_a");
      let selectacts = document.querySelector(".selectacts");
      let numGenInput = document.querySelector(".numGenInput");
      let done = document.querySelector(".done");
      let discardChanges = document.querySelector(".discardChanges");
      let submit = document.querySelector(".submit");

      add_q_a.classList.toggle("hidden");
      done.classList.toggle("hidden");
      selectacts.classList.toggle("hidden");
      numGenInput.classList.toggle("hidden");
      submit.classList.toggle("hidden");

      if (add_q_a.classList.contains("hidden")) {
        e.classList.toggle("hidden");
        discardChanges.classList.toggle("hidden");
      }
    };

    let gen_rand_num = (e) => {
      // Get references to all checkbox elements
      const numberInput = document.querySelector("#numberInput");
      const submitNumInp = document.querySelector(".submitNumInp");
      const changeInp = document.querySelector(".changeInp");
      const continueInp = document.querySelector(".continueInp");

      const numCheckboxesToCheck = parseInt(
        document.getElementById("numberInput").value
      );
      const checkboxes = document.querySelectorAll(".checkbox");

      // Shuffle the checkboxes randomly
      const shuffledCheckboxes = Array.from(checkboxes).sort(
        () => Math.random() - 0.5
      );

      let checkedCount = 0;
      for (let i = 0; i < shuffledCheckboxes.length; i++) {
        if (shuffledCheckboxes[i].type == "checkbox") {
          shuffledCheckboxes[i].checked = checkedCount < numCheckboxesToCheck;
          checkedCount += shuffledCheckboxes[i].checked ? 1 : 0;
        }
      }

      // Hide or show the checkboxes depending on their current state
      Array.from(checkboxes).forEach((checkbox) =>
        checkbox.classList.remove("hidden")
      );
    };

    let randomizeActsCheckbox = () => {};

    let show_act_container = document.querySelector(".show_act_container");
    let show_act_form = document.getElementById("show_act_form");
    let done = document.querySelector(".done");
    let done_id = document.getElementById("done");
    let selectacts = document.querySelector(".selectacts");
    let overlay = document.querySelector(".overlay");

    let removeElement = (e) => {
      show_act_container.classList.remove("hidden");
      // selectacts.classList.toggle("hidden");
      overlay.classList.toggle("hidden");
      done.classList.add("hidden");
      // show_act_form.remove();
      e.preventDefault();
    };

    let prevDef = (e) => {
      done.classList.remove("hidden");
      e.preventDefault();
    };

    done.addEventListener("click", (e) => {
      show_act_form.classList.add("hidden");
      done_id.classList.add("hidden");
      document
        .querySelector(".showScoring")
        .classList.remove("hidden")
        .preventDefault();
      e.preventDefault();
    });



  </script>
<?php   include './includes/admin_footer.php'; ?>
