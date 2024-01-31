<?php include '../a_includes/admin_header.php';  ?>
<?php include './adminUploadVideoUI.php';  ?>
<?php
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
  
echo "asdf";


  // Check if the file extension is not allowed
  $allowed_ext = array("mp4", "mkv", "webm", "flv", "vob", "ogv", "ogg", "avi", "wmv", "mov", "mpeg", "mpg");
  $correct_file_type = in_array($file_type, $allowed_ext);
  
if ($video_file_name == "") {
    echo "<h3 class='txt-red-light font-med text-center position-absolute container w-100 d-flex align-items-center justify-content-center' style='top:5%; margin-left: 3%'>File cannot be empty</h3>";
} else {

  if (!$correct_file_type) {
      echo "<h3 class='txt-red-light font-med text-center position-absolute container w-100 d-flex align-items-center justify-content-center' style='top:5%; margin-left: 3%'>Invalid File Type</h3>";
  } else {

    if($video_file_size > $sizeLimit) {
      echo "<h3 class='display-1 txt-red-light font-med text-center container w-100 d-flex align-items-center justify-content-center vh-100'>THE FILE IS TOO LARGE</h3>
      ";
    } else {

        echo "
          let upload = document.querySelector('.upload');
          let go_back = document.querySelector('.go_back');
          upload.textContent = 'Uploading...';
          upload.style.backgroundColor = '#eaeae5';
          upload.style.color = '#444';
          setTimeout(() => {
            upload.disabled = true;
            go_back.disabled = true;
          }, 0500);
        ";
     
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
        
  
        header("Location: ../activity/adminCreateActivityUI.php?course_id_createAct=$course_id&video_id_createAct=$video_id");
      

    }
  }

}
}
  
?>

okay

<?php include '../a_includes/admin_footer.php'; ?>

