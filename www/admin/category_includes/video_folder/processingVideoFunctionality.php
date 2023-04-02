<?php

  // ADDING VIDEO FUNCTIONALITY 
  if(isset($_POST['upload_video'])){

    // GET COURSE ID
    if(isset($_GET['course_id_uploadvid'])){
      $course_id = $_GET['course_id_uploadvid'];
      $select_course_title = $conn->prepare("SELECT * FROM course_table WHERE id = $course_id");
      $select_course_title->execute();
      
      // GETTING COURSE TITLE
      $get_course_title = $select_course_title->fetch(PDO::FETCH_ASSOC);
      $course_title = $get_course_title['course_title'];
    }

    
    $video_title = $_SESSION['add_video_title'];
    $video_subtitle = $_SESSION['add_video_caption'];

    $video_file_name = $_FILES['video_file_name']['name'];
    $videoFileTemp = $_FILES['video_file_name']['tmp_name'];

    $videoDataError = $_FILES['video_file_name']['error'];
    $videoDataSize = filesize($videoFileTemp);
    $sizeLimit = 500000000;

    $file_type = pathinfo($_FILES['video_file_name']['name'], PATHINFO_EXTENSION);

    // Check if the file extension is allowed
    $allowed_ext = array("mp4", "mkv", "webm", "flv", "vob", "ogv", "ogg", "avi", "wmv", "mov", "mpeg", "mpg");
    $correct_file_type = in_array($file_type, $allowed_ext);
    

  if($video_file_name == ""){
    echo "<h3 class='txt-red-light font-med position-absolute w-25' style='top:5%; left: 2%'>File Cannot be Empty</h3>";
  } else {

    if (!$correct_file_type) {
      echo "<h3 class='txt-red-light font-med position-absolute w-25' style='top:5%; left: 2%'>Invalid Video File Type</h3>";
    } else {

      // IF CORRECT FILE TYPE
      if ($videoDataSize > $sizeLimit) {

        // IF SIZE IS GREATER THE THE SIZE LIMIT
        echo "<h3 class='txt-red-light font-med position-absolute w-25' style='top:5%; left: 2%'>VIDEO FILE TOO LARGE</h3>";
      } else {
        
        if($video_subtitle != "" && $video_title != "" && $video_file_name != ""){    
    
        // CREATE FILE UPLOAD DATA = COMES FROM uploadVideo.php FILE
        $VideoUploadData = new VideoUploadData($course_id, $course_title, $video_title, $video_file_name, $video_subtitle);
  
        
        // PROCESS THE SUBMITTED VIDEO DATA
        $videoProcessor = new VideoProcessor($conn, $videoDataSize, $videoDataError, $videoFileTemp);
        $wasSuccessful = $videoProcessor->upload($VideoUploadData);
  
  
        $query_select_from_videos = $conn->prepare("SELECT * FROM videos_table WHERE video_title = '$video_title'");
        $query_select_from_videos->execute();
  
        while($row = $query_select_from_videos->fetch(PDO::FETCH_ASSOC)){
          $video_id_db = $row['id'];
        }
    
        $_SESSION['add_video_title'] = null;
        $_SESSION['add_video_caption'] = null;
        header("Location: ../activity/adminCreateActivityUI.php?course_id_createAct=$course_id&video_id_createAct=$video_id_db");
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
  }   
}
}









// UPDATE VIDEO DETAILS

if(isset($_POST['update_video'])){
  
  // GET COURSE ID
  if(isset($_GET['update_course_id']) && isset($_GET['update_video_id'])){
    $course_id = $_GET['update_course_id'];
    $video_id = $_GET['update_video_id'];

    $select_course_title = $conn->prepare("SELECT * FROM course_table WHERE id = $course_id");
    $select_course_title->execute();
    // GETTING COURSE TITLE
    $get_course_title = $select_course_title->fetch(PDO::FETCH_ASSOC);
    $course_title = $get_course_title['course_title'];
  }

  $video_title = $_POST['video_title'];
  $video_subtitle = $_FILES['video_subtitle']['name'];
  $video_subtitle_temp = $_FILES['video_subtitle']['tmp_name'];

  $video_file_name = $_FILES['video_file_name']['name'];
  $videoFileTemp = $_FILES['video_file_name']['tmp_name'];

  $videoDataError = $_FILES['video_file_name']['error'];
  $videoDataSize = filesize($videoFileTemp);
  $sizeLimit = 500000000;

  $video_title = $_POST['video_title'];

  // GENERATES UNIQUE ID
  $uniqueId = str_pad(mt_rand(0, 999), 4, '0', STR_PAD_LEFT);
  
  // Check if the file extension is allowed
  $file_type = pathinfo($_FILES['video_file_name']['name'], PATHINFO_EXTENSION);
  $allowed_ext = array("mp4", "mkv", "webm", "flv", "vob", "ogv", "ogg", "avi", "wmv", "mov", "mpeg", "mpg");
  $correct_file_type = in_array($file_type, $allowed_ext);

  


  if($video_title != ""){
    // IF SUBTITLE INPUT IS EMPTY

    $query_select = $conn->prepare("SELECT * FROM videos_table WHERE id = :video_id");
    $query_select->bindParam(":video_id", $video_id);
    $query_select->execute();

    switch(true){

      case empty($video_file_name) && empty($video_subtitle):
        $fetch = $query_select->fetch(PDO::FETCH_ASSOC);
        $video_file_name = $fetch['video_file_name'];
        $video_subtitle = $fetch['video_subtitle'];

        // UPDATE
        $queryFiles = $conn->prepare("UPDATE videos_table SET course_title = :course_title, video_title = :video_title, video_file_name = :video_file_name, video_subtitle = :video_subtitle WHERE id = :video_id");
        
        $queryFiles->bindParam(":course_title", $course_title);
        $queryFiles->bindParam(":video_title", $video_title);
        $queryFiles->bindParam(":video_file_name", $video_file_name);
        $queryFiles->bindParam(":video_subtitle", $video_subtitle);
        $queryFiles->bindParam(":video_id", $video_id);
        $queryFiles->execute();
        break;


      case empty($video_file_name) && !empty($video_subtitle):

        $video_subtitle = $uniqueId . "_" . $video_subtitle;
        $video_subtitle = str_replace(" ", "_", $video_subtitle);
        $videoSubLoc = "../../../backend_storage/uploaded_subtitle/$video_subtitle";
        move_uploaded_file($video_subtitle_temp, $videoSubLoc);

        $query_select = $conn->prepare("SELECT * FROM videos_table WHERE id = :video_id");
        $query_select->bindParam(":video_id", $video_id);
        $query_select->execute();
        
        $fetch = $query_select->fetch(PDO::FETCH_ASSOC);
        $video_file_name = $fetch['video_file_name'];
        $video_sub = $fetch['video_subtitle'];

        $video_sub = "../../../backend_storage/uploaded_subtitle/$video_sub";
        unlink($video_sub);


        // UPDATE
        $queryVidFile = $conn->prepare("UPDATE videos_table SET course_title = :course_title, video_title = :video_title, video_file_name = :video_file_name, video_subtitle = :video_subtitle WHERE id = :video_id");
        
        $queryVidFile->bindParam(":course_title", $course_title);
        $queryVidFile->bindParam(":video_title", $video_title);
        $queryVidFile->bindParam(":video_file_name", $video_file_name);
        $queryVidFile->bindParam(":video_subtitle", $video_subtitle);
        $queryVidFile->bindParam(":video_id", $video_id);
        $queryVidFile->execute();
        break; 

      case !empty($video_file_name) && empty($video_subtitle):
        if (!$correct_file_type) {
          echo "<h3 class='txt-red-light font-med position-absolute w-25' style='top:5%; right: 2%'>Invalid Video File Type</h3>";
        } else {
    
          // IF CORRECT FILE TYPE
          if ($videoDataSize > $sizeLimit) {
    
            // IF SIZE IS GREATER THE THE SIZE LIMIT
            echo "<h3 class='txt-red-light font-med position-absolute w-25' style='top:5%; right: 2%'>VIDEO FILE TOO LARGE</h3>";
          } else {
            $query_select = $conn->prepare("SELECT * FROM videos_table WHERE id = :video_id");
            $query_select->bindParam(":video_id", $video_id);
            $query_select->execute();
            
            $fetchSubtitle = $query_select->fetch(PDO::FETCH_ASSOC);
            $video_sub = $fetchSubtitle['video_subtitle'];

            // UPDATE
            $querySubtitle = $conn->prepare("UPDATE videos_table SET course_title = :course_title, video_title = :video_title, video_subtitle = :video_subtitle WHERE id = :video_id");
            
            $querySubtitle->bindParam(":course_title", $course_title);
            $querySubtitle->bindParam(":video_title", $video_title);
            $querySubtitle->bindParam(":video_subtitle", $video_sub);
            $querySubtitle->bindParam(":video_id", $video_id);
            $querySubtitle->execute();

            // PROCESS THE SUBMITTED VIDEO DATA
            $videoProcessor = new UpdateVideoProcessor($conn, $videoDataSize, $videoDataError, $videoFileTemp, $video_id);
            $wasSuccessful = $videoProcessor->upload($video_file_name);

          }
        }
        break;



      case !empty($video_title) && !empty($video_subtitle) && !empty($video_file_name):
        if (!$correct_file_type) {
          echo "<h3 class='txt-red-light font-med position-absolute w-25' style='top:5%; right: 2%'>Invalid Video File Type</h3>";
        } else {
    
          // IF CORRECT FILE TYPE
          if ($videoDataSize > $sizeLimit) {
    
            // IF SIZE IS GREATER THE THE SIZE LIMIT
            echo "<h3 class='txt-red-light font-med position-absolute w-25' style='top:5%; right: 2%'>VIDEO FILE TOO LARGE</h3>";
          } else {
            $video_subtitle = $uniqueId . "_" . $video_subtitle;
            $video_subtitle = str_replace(" ", "_", $video_subtitle);
            $videoSubLoc = "../../../backend_storage/uploaded_subtitle/$video_subtitle";
            move_uploaded_file($video_subtitle_temp, $videoSubLoc);

            $query_select = $conn->prepare("SELECT * FROM videos_table WHERE id = :video_id");
            $query_select->bindParam(":video_id", $video_id);
            $query_select->execute();
            
            $fetchSubtitle = $query_select->fetch(PDO::FETCH_ASSOC);
            $video_sub = $fetchSubtitle['video_subtitle'];

            $video_sub = "../../../backend_storage/uploaded_subtitle/$video_sub";
            unlink($video_sub);
            
            $querySubtitle = $conn->prepare("UPDATE videos_table SET course_title = :course_title, video_title = :video_title, video_subtitle = :video_subtitle WHERE id = :video_id");
              
            $querySubtitle->bindParam(":course_title", $course_title);
            $querySubtitle->bindParam(":video_title", $video_title);
            $querySubtitle->bindParam(":video_subtitle", $video_subtitle);
            $querySubtitle->bindParam(":video_id", $video_id);
            $querySubtitle->execute();

            // PROCESS THE SUBMITTED VIDEO DATA
            $videoProcessor = new UpdateVideoProcessor($conn, $videoDataSize, $videoDataError, $videoFileTemp, $video_id);
            $wasSuccessful = $videoProcessor->upload($video_file_name);
          }
        }
        break;


    }



    // CREATE FILE UPLOAD DATA = COMES FROM uploadVideo.php FILE
          
    $query_select_from_videos = $conn->prepare("SELECT * FROM videos_table WHERE video_title = '$video_title'");
    $query_select_from_videos->execute();

    while($row = $query_select_from_videos->fetch(PDO::FETCH_ASSOC)){
      $video_id_db = $row['id'];
    }


  header("Location: ../../videos_display.php?course_id_display=$course_id");

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

        
  $unlink_video  = $conn->prepare("SELECT * FROM videos_table WHERE id = :video_id");
  $unlink_video ->bindParam(":video_id", $videoLessonToDelete);
  $unlink_video ->execute();
  $fetch_filename = $unlink_video ->fetch(PDO::FETCH_ASSOC); 

  $vid_filename = $fetch_filename['video_file_name'];
  $sub_filename = $fetch_filename['video_subtitle'];

  $sub_filename = "../backend_storage/uploaded_subtitle/$sub_filename";
  $vid_filename = str_replace("../../../backend_storage/uploaded_vids/", "../backend_storage/uploaded_vids/", $vid_filename);

  if (unlink($vid_filename) && unlink($sub_filename)) {
    echo "";
  } 

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

}

?>