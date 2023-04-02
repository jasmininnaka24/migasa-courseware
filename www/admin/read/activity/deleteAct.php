
<?php
  include '../database.php';
  include '../a_includes/admin_header.php';
  

  // DELETING QUESTIONS AND CHOICES
  if(isset($_GET['delete_questionAndchoices'])){
    $quesNumtoDelete = $_GET['delete_questionAndchoices'];

    $delete_this_question_row = $conn->prepare("DELETE FROM activity_table WHERE id = :question_id");
    $delete_this_question_row->bindParam(":question_id", $quesNumtoDelete);
    $delete_this_question_row->execute();

    $delete_question_choices = $conn->prepare("DELETE FROM choices_table WHERE question_id = :question_id");
    $delete_question_choices->bindParam(":question_id", $quesNumtoDelete);
    $delete_question_choices->execute();

  }
  
  if(isset($_GET['update_course_activity']) && isset($_GET['update_video_activity']) && isset($_GET['delete_questionAndchoices']) && isset($_GET['listOfAllActivities'])) {
    $course_id = $_GET['update_course_activity'];
    $video_id = $_GET['update_video_activity'];


    echo "
      <script>
        document.location.href = 'updateActivityUI.php?update_course_id=$course_id&update_video_activity=$video_id&listOfAllActivities';
      </script>
    ";
  } 
  
  if(isset($_GET['update_course_activity']) && isset($_GET['update_video_activity']) && isset($_GET['delete_questionAndchoices']) && isset($_GET['listOfSelectedActivites'])) {
    $course_id = $_GET['update_course_activity'];
    $video_id = $_GET['update_video_activity'];

    echo "
      <script>
        document.location.href = 'updateActivityUI.php?update_course_id=$course_id&update_video_activity=$video_id&listOfSelectedActivites';
      </script>
    ";
  } 

  
  else if(isset($_GET['course_id_createAct']) && isset($_GET['video_id_createAct']))
  
  {
    $course_id = $_GET['course_id_createAct'];
    $video_id = $_GET['video_id_createAct'];

    echo "
    <script>
      document.location.href = 'adminCreateActivityUI.php?course_id_createAct=$course_id&video_id_createAct=$video_id';
    </script>
  ";
  }
  
  include '../a_includes/admin_footer.php'; 
?>
