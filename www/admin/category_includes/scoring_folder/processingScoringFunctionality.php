<?php

    // SAVE PASSING SCORE 
    if(isset($_POST['save_scoring'])){

      // GET COURSE ID AND VIDEO ID
      if(isset($_GET['course_id_createAct']) && isset($_GET['video_id_createAct'])){
        $course_id_scoring = $_GET['course_id_createAct'];
        $video_id_scoring = $_GET['video_id_createAct'];
      }        


      if($_POST['passing_score'] != ''){
        $items_count = $_POST['items_count'];
        $passing_score = $_POST['passing_score'];

        $query_insert_scoring = $conn->prepare("INSERT INTO score_table(course_id, video_id, items_count, passing_score) VALUES($course_id_scoring, $video_id_scoring, $items_count, $passing_score)");
        $query_insert_scoring->execute();


        // header("Location: ../../read/activity/updateActivityUI.php?update_course_id=$course_id_scoring&update_video_activity=$video_id_scoring&listOfAllActivities");

        echo "
        <script>
        setTimeout(() => {
          document.querySelector('.added').classList.remove('hidden');
        }, 0100)
        setTimeout(() => {
          document.location.href = '../../read/activity/updateActivityUI.php?update_course_id=$course_id_scoring&update_video_activity=$video_id_scoring&listOfAllActivities';
          document.querySelector('.added').classList.add('hidden');
        }, 1000)
        </script>
      
        ";

      } 
    }


    // UPDATE SCORING
    if(isset($_POST['update_scoring'])){
      if($_POST['passing_score'] != ''){
        
      // GET COURSE ID AND VIDEO ID
      if(isset($_GET['update_course_id']) && isset($_GET['update_video_activity'])){
        $course_id_scoring = $_GET['update_course_id'];
        $video_id_scoring = $_GET['update_video_activity'];
      }
            

        $items_count = $_POST['items_count'];
        $passing_score = $_POST['passing_score'];
        $selected_act = $_POST['selected_act'];

        $query_update_scoring = $conn->prepare("UPDATE score_table SET items_count = :items_count, selected_act = :selected_act, passing_score = :passing_score WHERE course_id = :course_id AND video_id = :video_id");

        $query_update_scoring->bindParam(":course_id", $course_id_scoring);
        $query_update_scoring->bindParam(":video_id", $video_id_scoring);
        $query_update_scoring->bindParam(":items_count", $items_count);
        $query_update_scoring->bindParam(":selected_act", $selected_act);
        $query_update_scoring->bindParam(":passing_score", $passing_score);
        $query_update_scoring->execute();

        // header("Location: ../../videos_display.php?course_id_display=$course_id_scoring");
        echo "
        <script>
        setTimeout(() => {
          document.querySelector('.updated').classList.remove('hidden');
        }, 0100)
        setTimeout(() => {
          document.location.href = '../../videos_display.php?course_id_display=$course_id_scoring';
          document.querySelector('.updated').classList.add('hidden');
        }, 1000)
        </script>
      
        ";
      } 
    }
?>