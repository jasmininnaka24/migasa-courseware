<?php

// ADDING VIDEO FUNCTIONALITY 
  if(isset($_POST['upload_lesson'])){

    // GET COURSE ID
    if(isset($_GET['course_id_uploadvid'])){
      $course_id = $_GET['course_id_uploadvid'];
    }

    $video_title = ucwords(trim($_POST['video_title']));
    $video_caption = $_FILES['video_caption']['name'];
    $video_caption_temp = $_FILES['video_caption']['tmp_name'];

    $video_file_name = $_FILES['video_file_name']['name'];
    $video_file_tmpName = $_FILES['video_file_name']['tmp_name'];
    $video_file_error = $_FILES['video_file_name']['error'];
    $video_file_size = $_FILES['video_file_name']['size'];
    $file_type = pathinfo($_FILES['video_file_name']['name'], PATHINFO_EXTENSION);

    $uniqueId = str_pad(mt_rand(10, 99), 4, '0', STR_PAD_LEFT);
    $videoDataError = $_FILES['video_file_name']['error'];
    $videoDataSize = filesize($video_file_tmpName);
    $sizeLimit = 500000000;
    

    // Check if the file extension is not allowed
    $allowed_ext = array("mp4", "mkv", "webm", "flv", "vob", "ogv", "ogg", "avi", "wmv", "mov", "mpeg", "mpg");
    $correct_file_type = in_array($file_type, $allowed_ext);
    
  if ($video_file_name == "") {
      echo "<h3 class='txt-red-light font-med text-center position-absolute container w-100 d-flex align-items-center justify-content-center' style='top:5%; margin-left: 16%; padding-left: 50%;'>File cannot be empty</h3>";
  } else {

    if (!$correct_file_type) {
        
    } else {

          // CREATE FILE UPLOAD DATA = COMES FROM uploadVideo.php FILE
          $VideoUploadData = new VideoUploadData($course_id, $video_title, $video_file_name, $video_caption);
    
          
          // PROCESS THE SUBMITTED VIDEO DATA
          $videoProcessor = new VideoProcessor($conn, $videoDataSize, $videoDataError, $video_file_tmpName);
          $wasSuccessful = $videoProcessor->upload($VideoUploadData);
    
          $video_id = $conn->lastInsertId();
    
          foreach($_FILES['video_caption']['tmp_name'] as $key => $vc_temp) {
            $vc = $uniqueId . $_FILES['video_caption']['name'][$key];
            move_uploaded_file($vc_temp, "../../../backend_storage/uploaded_captions/$vc");
            $insert_captions = $conn->prepare("INSERT INTO caption_table (course_id, video_id, caption_file_name) VALUES (:course_id, :video_id, :caption_file_name)");
            $insert_captions->bindParam(":course_id", $course_id);
            $insert_captions->bindParam(":video_id", $video_id);
            $insert_captions->bindParam(":caption_file_name", $vc);
            $insert_captions->execute();
          }

          $set_scoring_value = $conn->prepare("INSERT INTO score_table (course_id, video_id) VALUES (:course_id, :video_id)");
          $set_scoring_value->bindParam(":course_id", $course_id);
          $set_scoring_value->bindParam(":video_id", $video_id);
          $set_scoring_value->execute();
          
    
          // header("Location: ../activity/adminCreateActivityUI.php?course_id_createAct=$course_id&video_id_createAct=$video_id");
          echo "
          <script>
          setTimeout(() => {
            document.querySelector('.added').classList.remove('hidden');
          }, 0200)
          setTimeout(() => {
            document.querySelector('.added').classList.add('hidden');
            document.location.href = '../activity/adminCreateActivityUI.php?course_id_createAct=$course_id&video_id_createAct=$video_id';
          }, 1500)
          </script>
        
          ";

      }
    }   
    
}

// UPDATE VIDEO DETAILS

if(isset($_POST['update_lesson'])){
  
  // GET COURSE ID
  if(isset($_GET['update_course_id']) && isset($_GET['update_video_id'])){
    $course_id = $_GET['update_course_id'];
    $video_id = $_GET['update_video_id'];
  }

  $video_title = $_POST['video_title'];
  $video_caption = $_FILES['video_caption']['name'];
  $video_caption_temp = $_FILES['video_caption']['tmp_name'];

  $video_file_name = $_FILES['video_file_name']['name'];
  $videoFileTemp = $_FILES['video_file_name']['tmp_name'];

  $videoDataError = $_FILES['video_file_name']['error'];
  $videoDataSize = filesize($videoFileTemp);

  $video_title = $_POST['video_title'];

  // GENERATES UNIQUE ID
  $uniqueId = str_pad(mt_rand(0, 999), 4, '0', STR_PAD_LEFT);

  
  if($video_title != ""){
    // IF SUBTITLE INPUT IS NOT EMPTY EMPTY

    switch(true){

      case empty($video_file_name) && ($_FILES['video_caption']['error'][0] == UPLOAD_ERR_NO_FILE):

        // UPDATE
        $queryFiles = $conn->prepare("UPDATE videos_table SET video_title = :video_title WHERE id = :video_id");
        
        $queryFiles->bindParam(":video_title", $video_title);
        $queryFiles->bindParam(":video_id", $video_id);
        $queryFiles->execute();
        break;


      case empty($video_file_name) && ($_FILES['video_caption']['error'][0] != UPLOAD_ERR_NO_FILE):

        // UPDATE
        $queryFiles = $conn->prepare("UPDATE videos_table SET video_title = :video_title WHERE id = :video_id");

        $queryFiles->bindParam(":video_title", $video_title);
        $queryFiles->bindParam(":video_id", $video_id);
        $queryFiles->execute();

        $captions_db = $conn->prepare("SELECT caption_file_name FROM caption_table WHERE video_id = :video_id");
        $captions_db->bindParam(":video_id", $video_id);
        $captions_db->execute();

        while($fetch_caption = $captions_db->fetch(PDO::FETCH_ASSOC)){
          $caption_file_name = $fetch_caption['caption_file_name'];
          
          $caption_file_name = "../../../backend_storage/uploaded_captions/$caption_file_name";
          unlink($caption_file_name);
        }
        
        $captions_db_del = $conn->prepare("DELETE FROM caption_table WHERE video_id = :video_id");
        $captions_db_del->bindParam(":video_id", $video_id);
        $captions_db_del->execute();

        foreach($_FILES['video_caption']['tmp_name'] as $key => $vc_temp) {
          $vc = $uniqueId . $_FILES['video_caption']['name'][$key];
          move_uploaded_file($vc_temp, "../../../backend_storage/uploaded_captions/$vc");
          $insert_captions = $conn->prepare("INSERT INTO caption_table (course_id, video_id, caption_file_name) VALUES (:course_id, :video_id, :caption_file_name)");
          $insert_captions->bindParam(":course_id", $course_id);
          $insert_captions->bindParam(":video_id", $video_id);
          $insert_captions->bindParam(":caption_file_name", $vc);
          $insert_captions->execute();
        }
        break; 

      case !empty($video_file_name) && ($_FILES['video_caption']['error'][0] == UPLOAD_ERR_NO_FILE):
        
        
        // UPDATE
        $queryFiles = $conn->prepare("UPDATE videos_table SET video_title = :video_title WHERE id = :video_id");

        $queryFiles->bindParam(":video_title", $video_title);
        $queryFiles->bindParam(":video_id", $video_id);
        $queryFiles->execute();

        // PROCESS THE SUBMITTED VIDEO DATA
        $videoProcessor = new UpdateVideoProcessor($conn, $videoDataSize, $videoDataError, $videoFileTemp, $video_id);
        $wasSuccessful = $videoProcessor->upload($video_file_name);
        break;



      case !empty($video_title) && ($_FILES['video_caption']['error'][0] != UPLOAD_ERR_NO_FILE) && !empty($video_file_name):

        $update_video_title = $conn->prepare("UPDATE videos_table SET video_title = :video_title WHERE id = :video_id");
          
        $update_video_title->bindParam(":video_title", $video_title);
        $update_video_title->bindParam(":video_id", $video_id);
        $update_video_title->execute();

        $captions_db = $conn->prepare("SELECT caption_file_name FROM caption_table WHERE video_id = :video_id");
        $captions_db->bindParam(":video_id", $video_id);
        $captions_db->execute();
        
        while($fetch_caption = $captions_db->fetch(PDO::FETCH_ASSOC)){
          $caption_file_name = $fetch_caption['caption_file_name'];
          
          $caption_file_name = "../../../backend_storage/uploaded_captions/$caption_file_name";
          unlink($caption_file_name);
        }

        $captions_db_del = $conn->prepare("DELETE FROM caption_table WHERE video_id = :video_id");
        $captions_db_del->bindParam(":video_id", $video_id);
        $captions_db_del->execute();

        foreach($_FILES['video_caption']['tmp_name'] as $key => $vc_temp) {
          $vc = $uniqueId . $_FILES['video_caption']['name'][$key];
          move_uploaded_file($vc_temp, "../../../backend_storage/uploaded_captions/$vc");
          $insert_captions = $conn->prepare("INSERT INTO caption_table (course_id, video_id, caption_file_name) VALUES (:course_id, :video_id, :caption_file_name)");
          $insert_captions->bindParam(":course_id", $course_id);
          $insert_captions->bindParam(":video_id", $video_id);
          $insert_captions->bindParam(":caption_file_name", $vc);
          $insert_captions->execute();
        }

        // PROCESS THE SUBMITTED VIDEO DATA
        $videoProcessor = new UpdateVideoProcessor($conn, $videoDataSize, $videoDataError, $videoFileTemp, $video_id);
        $wasSuccessful = $videoProcessor->upload($video_file_name);
        break;

        
      }
      
      echo
      "
      <script>
      setTimeout(() => {
        document.querySelector('.updatedd').classList.remove('hidden');
      }, 0100)
      setTimeout(() => {
        
        document.location.href = '../../videos_display.php?course_id_display=$course_id';
        document.querySelector('.updatedd').classList.add('hidden');
      }, 1000)
      </script>

      ";

  } else {
  echo "
  <script>
    setTimeout((e) => {
      document.querySelector('.unhide').classList.remove('hidden');
      e.preventDefault();
    }, 0100)
  </script>
  ";
}
}


// DELETE VIDEO LESSON
if(isset($_GET['delete_video_lesson'])){
  $videoLessonToDelete = $_GET['delete_video_lesson'];
  $course_id = $_GET['course_id_display'];

        
  $unlink_video  = $conn->prepare("SELECT video_file_name FROM videos_table WHERE id = :video_id");
  $unlink_video->bindParam(":video_id", $videoLessonToDelete);
  $unlink_video->execute();
  $fetch_filename = $unlink_video->fetch(PDO::FETCH_ASSOC); 

  $vid_filename = $fetch_filename['video_file_name'];
  $vid_filename = str_replace("../../../backend_storage/uploaded_vids/", "../backend_storage/uploaded_vids/", $vid_filename);

  unlink($vid_filename);

  // SELECTING CAPTIONS
  $captions_db = $conn->prepare("SELECT caption_file_name FROM caption_table WHERE video_id = :video_id");
  $captions_db->bindParam(":video_id", $videoLessonToDelete);
  $captions_db->execute();

  while($fetch_caption = $captions_db->fetch(PDO::FETCH_ASSOC)){
    $caption_file_name = $fetch_caption['caption_file_name'];
    
    $caption_file_name = "../backend_storage/uploaded_captions/$caption_file_name";
    unlink($caption_file_name);    
    
  }

  // DELETING CAPTIONS
  $delete_video_row = $conn->prepare("DELETE FROM caption_table WHERE video_id = :video_id");
  $delete_video_row->bindParam(":video_id", $videoLessonToDelete);
  $delete_video_row->execute();

  $delete_video_row = $conn->prepare("DELETE FROM videos_table WHERE id = :video_id");
  $delete_video_row->bindParam(":video_id", $videoLessonToDelete);
  $delete_video_row->execute();

  $delete_activity_row = $conn->prepare("DELETE FROM activity_table WHERE video_id = :video_id");
  $delete_activity_row->bindParam(":video_id", $videoLessonToDelete);
  $delete_activity_row->execute();

  $delete_choices_row = $conn->prepare("DELETE FROM choices_table WHERE video_id = :video_id");
  $delete_choices_row->bindParam(":video_id", $videoLessonToDelete);
  $delete_choices_row->execute();

  $delete_score_row = $conn->prepare("DELETE FROM score_table WHERE video_id = :video_id");
  $delete_score_row->bindParam(":video_id", $videoLessonToDelete);
  $delete_score_row->execute();

  echo "
  <script>
  setTimeout(() => {
    document.querySelector('.deleted').classList.remove('hidden');
  }, 0100)
  setTimeout(() => {
    
    document.querySelector('.deleted').classList.add('hidden');
  }, 1000)
  </script>

  ";
}

?>