<?php    
  // ADDING QUESTIONS, CHOICES, AND CORRECT ANSWERS
  if(isset($_POST['save_vid_activity'])){

    // GET COURSE ID
    if(isset($_GET['course_id_createAct']) && isset($_GET['video_id_createAct'])){
      $course_id_createAct = $_GET['course_id_createAct'];
      $video_id_createAct = $_GET['video_id_createAct'];
    }

    // video_title and video_upload
    $video_question = $_POST['video_question'];
    $question_choices = $_POST['question_choices'];
    $correct_answer = $_POST['correct_answer'];
  
    if($video_question != null && $correct_answer != null && $question_choices != null){ 
        
      $insert_question_query = "INSERT INTO activity_table (course_id, video_id, question, correct_answer) VALUES ($course_id_createAct, $video_id_createAct, '$video_question', '$correct_answer')";
      $query_question = $conn->prepare($insert_question_query);
      
      $query_question->execute();

  
      $query_select_from_question = $conn->prepare("SELECT * FROM activity_table WHERE question = '$video_question'");
      $query_select_from_question->execute();
      while($row = $query_select_from_question->fetch(PDO::FETCH_ASSOC)){
        $_SESSION['question_id_db'] = $row['id'];
        $_SESSION['question_db'] = $row['question'];
      }
  
      $question_id_db = $_SESSION['question_id_db'];
      $question_db = $_SESSION['question_db'];
  
      foreach($question_choices as $qc){
        $insert_choices_query = "INSERT INTO choices_table (course_id, video_id, question_id, question, choices) VALUES ($course_id_createAct, $video_id_createAct, $question_id_db, '$question_db', '$qc')";
        $query_choices = $conn->prepare($insert_choices_query);
        $query_choices->execute();
      } 
      $_SESSION['question_id_db'] = "";
      $_SESSION['question_db'] = "";

      // header("Location: adminCreateActivityUI.php?course_id_createAct=$course_id_createAct&video_id_createAct=$video_id_createAct");
      
    } else {
      echo "
        <script>
          let errorMessageContainer = document.querySelector('.errorMessageContainer');
          let invalidInputMessage = document.createElement('p');
          invalidInputMessage.className = 'my-3 font-med text-danger';
          invalidInputMessage.value = 'Please fill out the empty fields';
          errorMessageContainer.appendChild(invalidInputMessage);
        </script>
      ";
    }
  }

  // DONE BUTTON TO REDIRECT BACK TO ADD_VIDEO PAGE
  if(isset($_POST['done_btn'])){
    echo "
      <script>
        let scoringg = document.querySelector('.scoringg');
        let label_score = document.createElement('label');
        let input_score = document.createElement('input');

        label_score.className = 'font-med mb-1';
        label_score.value = 'Input Passing Score:';
        input_score.className = 'text-center form-control';
        input_score.name = 'passing_score';
        input_score.type = 'number';
        input_score.id = 'quesNum';
        input_score.setAttribute('required', '');


        scoringg.appendChild(label_score);
        scoringg.appendChild(input_score);
      </script>
    ";
  }




  // SAVING ACTIVITY FROM UPDATES
  if(isset($_POST['save_activity_from_update'])){
    $video_question = $_POST['video_question'];
    $correct_answer = $_POST['correct_answer'];


    // GET COURSE ID, VIDEO ID, AND QUESTION ID
    if(isset($_GET['update_course_id']) && isset($_GET['update_video_activity'])){
      $course_id = $_GET['update_course_id'];
      $video_id = $_GET['update_video_activity'];
    }
    

    // GETTING VIDEO TITLE
    $get_video_title = $conn->prepare("SELECT * FROM videos_table WHERE course_id = :course_id AND id = :video_id");
    $get_video_title->bindParam(":course_id", $course_id);
    $get_video_title->bindParam(":video_id", $video_id);
    $get_video_title->execute();

    $video_title_row = $get_video_title->fetch(PDO::FETCH_ASSOC);
    $video_title = $video_title_row['video_title'];



    // INSERTING VIDEO ID, VIDEO TITLE, QUESTION AND CORRECT ANSWER TO DATABASE
    $insert_into_activity = $conn->prepare("INSERT INTO activity_table (course_id, video_id, question, correct_answer) VALUES (:course_id, :video_id, :video_question, :correct_answer)");
    
    $insert_into_activity->bindParam(":course_id", $course_id);
    $insert_into_activity->bindParam(":video_id", $video_id);
    $insert_into_activity->bindParam(":video_question", $video_question);
    $insert_into_activity->bindParam(":correct_answer", $correct_answer);
    $insert_into_activity->execute();


    // GETTING QUESTION ID
    $get_question_id = $conn->prepare("SELECT * FROM activity_table WHERE question = :video_question");
    $get_question_id->bindParam(":video_question", $video_question);
    $get_question_id->execute();

    $question_id_row = $get_question_id->fetch(PDO::FETCH_ASSOC);
    $question_id = $question_id_row['id'];
    $question = $question_id_row['question'];

    $question_choices = $_POST['question_choices'];

    // INSERTING QUESTION CHOICES TO DATABASE
    foreach ($question_choices as $qc) {
      $insert_question_choices = $conn->prepare("INSERT INTO choices_table (course_id, video_id, question_id, question, choices) VALUES (:course_id, :video_id, :question_id, :video_question, :question_choices)");
      $insert_question_choices->bindParam(":course_id", $course_id);
      $insert_question_choices->bindParam(":video_id", $video_id);
      $insert_question_choices->bindParam(":question_id", $question_id);
      $insert_question_choices->bindParam(":video_question", $question);
      $insert_question_choices->bindParam(":question_choices", $qc);
      $insert_question_choices->execute();
    }



    
  }





  // // UPDATE ACTIVITY AND CHOICES
  if(isset($_POST['update_activity'])){

    if(isset($_GET['update_video_activity']) && isset($_GET['update_course_activity'])){
      $video_id = $_GET['update_video_activity'];
      $course_id = $_GET['update_course_activity'];
    }

    $question_id = $_POST['question_id'];
    $video_question = $_POST['video_question'];
    $question_choices = $_POST['question_choices'];
    $choice_id = $_POST['choice_id'];
    $correct_answer = $_POST['correct_answer'];

    $update_activity = $conn->prepare("UPDATE activity_table SET question = :question, correct_answer = :correct_answer WHERE id = :question_id");
    $update_activity->bindParam(":question", $video_question);
    $update_activity->bindParam(":correct_answer", $correct_answer);
    $update_activity->bindParam(":question_id", $question_id);
    $update_activity->execute();

    $update_activity = $conn->prepare("UPDATE choices_table SET question = :question WHERE question_id = :question_id");
    $update_activity->bindParam(":question", $video_question);
    $update_activity->bindParam(":question_id", $question_id);
    $update_activity->execute();
    

    foreach ($choice_id as $key => $ci) {
      $qc = $question_choices[$key];

      // SELECT ID FROM CHOICES TABLE
      $select_choice_id = $conn->prepare("SELECT * FROM choices_table WHERE id = :choice_id");
      $select_choice_id->bindParam(":choice_id", $ci);
      $select_choice_id->execute();

      $choice_id_count = 0;
      while($select_choice_id->fetch(PDO::FETCH_ASSOC)){
        $choice_id_count += 1;
      }
      
      if($choice_id_count == 1){
        
        $update_choice = $conn->prepare("UPDATE choices_table SET choices = :choice WHERE id = :choice_id");
        $update_choice->bindParam(":choice", $qc);
        $update_choice->bindParam(":choice_id", $ci);
        $update_choice->execute();

      } 

    }

    if(isset($_GET['update_video_activity']) && isset($_GET['update_course_id'])){
      $video_id = $_GET['update_video_activity'];
      $course_id = $_GET['update_course_id'];
    }

    if(isset($_GET['listOfAllActivities'])){
      header("Location: updateActivityUI.php?update_course_id=$course_id&update_video_activity=$video_id&listOfAllActivities");
    } else {
      header("Location: updateActivityUI.php?update_course_id=$course_id&update_video_activity=$video_id&listOfSelectedActivites");
    }
  }





  // // EDIT ACTIVITY AND CHOICES
  if(isset($_POST['edit_activity'])){

    if(isset($_GET['video_id_editAct']) && isset($_GET['course_id_editAct']) && isset($_GET['question_id_editAct'])){
      $course_id = $_GET['course_id_editAct'];
      $video_id = $_GET['video_id_editAct'];
      $question_id = $_GET['question_id_editAct'];
    }

    $video_question = $_POST['video_question'];
    $question_choices = $_POST['question_choices'];
    $choice_id = $_POST['choice_id'];
    $correct_answer = $_POST['correct_answer'];

    $update_activity = $conn->prepare("UPDATE activity_table SET question = :question, correct_answer = :correct_answer WHERE id = :question_id");
    $update_activity->bindParam(":question", $video_question);
    $update_activity->bindParam(":correct_answer", $correct_answer);
    $update_activity->bindParam(":question_id", $question_id);
    $update_activity->execute();

    $update_activity = $conn->prepare("UPDATE choices_table SET question = :question WHERE question_id = :question_id");
    $update_activity->bindParam(":question", $video_question);
    $update_activity->bindParam(":question_id", $question_id);
    $update_activity->execute();
    

    foreach ($choice_id as $key => $ci) {
      $qc = $question_choices[$key];

      // SELECT ID FROM CHOICES TABLE
      $select_choice_id = $conn->prepare("SELECT * FROM choices_table WHERE id = :choice_id");
      $select_choice_id->bindParam(":choice_id", $ci);
      $select_choice_id->execute();

      $choice_id_count = 0;
      while($select_choice_id->fetch(PDO::FETCH_ASSOC)){
        $choice_id_count += 1;
      }
      
      if($choice_id_count == 1){
        
        $update_choice = $conn->prepare("UPDATE choices_table SET choices = :choice WHERE id = :choice_id");
        $update_choice->bindParam(":choice", $qc);
        $update_choice->bindParam(":choice_id", $ci);
        $update_choice->execute();

      } 

    }

    if(isset($_GET['update_video_activity']) && isset($_GET['update_course_id'])){
      $video_id = $_GET['update_video_activity'];
      $course_id = $_GET['update_course_id'];
    }


    header("Location: adminCreateActivityUI.php?course_id_createAct=$course_id&video_id_createAct=$video_id");
  }



 // ADDING ANOTHER CHOICE FOR EDITING
 if(isset($_POST['add_this_choice_for_edit'])){

    
  // GET COURSE ID, VIDEO ID, AND QUESTION ID
  if(isset($_GET['course_id_editAct']) && isset($_GET['video_id_editAct']) && isset($_GET['question_id_editAct'])){
    $course_id = $_GET['course_id_editAct'];
    $video_id = $_GET['video_id_editAct'];
    $question_id = $_GET['question_id_editAct'];
  }

  $video_question = $_POST['video_question'];
  $question_choices = $_POST['question_choices'];
  $choice_id = $_POST['choice_id'];
  $correct_answer = $_POST['correct_answer'];


  $question_to_add = $_POST['question_choice'];

  // INSERTING INPUT FIELD
  $insert_into_choices_table = $conn->prepare("INSERT INTO choices_table (course_id, video_id, question_id, question, choices) VALUES (:course_id, :video_id, :question_id, :question, :choice)");
  $insert_into_choices_table->bindParam(":course_id", $course_id);
  $insert_into_choices_table->bindParam(":video_id", $video_id);
  $insert_into_choices_table->bindParam(":question_id", $question_id);
  $insert_into_choices_table->bindParam(":question", $video_question);
  $insert_into_choices_table->bindParam(":choice", $question_to_add);
  $insert_into_choices_table->execute();


  // UPDATING QUESTION IF EVER IT HAS BEEN CHANGED
  $update_activity = $conn->prepare("UPDATE activity_table SET question = :question, correct_answer = :correct_answer WHERE id = :question_id");
  $update_activity->bindParam(":question", $video_question);
  $update_activity->bindParam(":correct_answer", $correct_answer);
  $update_activity->bindParam(":question_id", $question_id);
  $update_activity->execute();
  
  $update_activity = $conn->prepare("UPDATE choices_table SET question = :question WHERE question_id = :question_id");
  $update_activity->bindParam(":question", $video_question);
  $update_activity->bindParam(":question_id", $question_id);
  $update_activity->execute();


  // UPDATING CHOICES IF EVER IT HAS BEEN CHANGED
  foreach ($choice_id as $key => $ci) {
    $qc = $question_choices[$key];

    // SELECT ID FROM CHOICES TABLE
    $select_choice_id = $conn->prepare("SELECT * FROM choices_table WHERE id = :choice_id");
    $select_choice_id->bindParam(":choice_id", $ci);
    $select_choice_id->execute();

    $choice_id_count = 0;
    while($select_choice_id->fetch(PDO::FETCH_ASSOC)){
      $choice_id_count += 1;
    }
    
    if($choice_id_count == 1){
      
      $update_choice = $conn->prepare("UPDATE choices_table SET choices = :choice WHERE id = :choice_id");
      $update_choice->bindParam(":choice", $qc);
      $update_choice->bindParam(":choice_id", $ci);
      $update_choice->execute();

    } 

    
  }

}








  // ADDING ANOTHER CHOICE
  if(isset($_POST['add_this_choice'])){

    
    // GET COURSE ID, VIDEO ID, AND QUESTION ID
    if(isset($_GET['update_course_activity']) && isset($_GET['update_video_activity']) && isset($_GET['update_question_id'])){
      $course_id = $_GET['update_course_activity'];
      $video_id = $_GET['update_video_activity'];
      $question_id = $_GET['update_question_id'];
    }

    $video_question = $_POST['video_question'];
    $question_choices = $_POST['question_choices'];
    $choice_id = $_POST['choice_id'];
    $correct_answer = $_POST['correct_answer'];

    $question_to_add = $_POST['question_choice'];

    // INSERTING INPUT FIELD
    $insert_into_choices_table = $conn->prepare("INSERT INTO choices_table (course_id, video_id, question_id, question, choices) VALUES (:course_id, :video_id, :question_id, :question, :choice)");
    $insert_into_choices_table->bindParam(":course_id", $course_id);
    $insert_into_choices_table->bindParam(":video_id", $video_id);
    $insert_into_choices_table->bindParam(":question_id", $question_id);
    $insert_into_choices_table->bindParam(":question", $video_question);
    $insert_into_choices_table->bindParam(":choice", $question_to_add);
    $insert_into_choices_table->execute();


    // UPDATING QUESTION IF EVER IT HAS BEEN CHANGED
    $update_activity = $conn->prepare("UPDATE activity_table SET question = :question, correct_answer = :correct_answer WHERE id = :question_id");
    $update_activity->bindParam(":question", $video_question);
    $update_activity->bindParam(":correct_answer", $correct_answer);
    $update_activity->bindParam(":question_id", $question_id);
    $update_activity->execute();
    
    $update_activity = $conn->prepare("UPDATE choices_table SET question = :question WHERE question_id = :question_id");
    $update_activity->bindParam(":question", $video_question);
    $update_activity->bindParam(":question_id", $question_id);
    $update_activity->execute();


    // UPDATING CHOICES IF EVER IT HAS BEEN CHANGED
    foreach ($choice_id as $key => $ci) {
      $qc = $question_choices[$key];

      // SELECT ID FROM CHOICES TABLE
      $select_choice_id = $conn->prepare("SELECT * FROM choices_table WHERE id = :choice_id");
      $select_choice_id->bindParam(":choice_id", $ci);
      $select_choice_id->execute();

      $choice_id_count = 0;
      while($select_choice_id->fetch(PDO::FETCH_ASSOC)){
        $choice_id_count += 1;
      }
      
      if($choice_id_count == 1){
        
        $update_choice = $conn->prepare("UPDATE choices_table SET choices = :choice WHERE id = :choice_id");
        $update_choice->bindParam(":choice", $qc);
        $update_choice->bindParam(":choice_id", $ci);
        $update_choice->execute();

      } 

      
    }

  }

  



  // DELETE CHOICE
  if(isset($_GET['delete_choice'])){

    $choice_id = $_GET['delete_choice'];

    if(isset($_GET['course_id_editAct']) && isset($_GET['video_id_editAct']) && isset($_GET['question_id_editAct'])){
      $course_id = $_GET['course_id_editAct'];
      $video_id = $_GET['video_id_editAct'];
      $question_id = $_GET['question_id_editAct'];

      $delete_choice = $conn->prepare("DELETE FROM choices_table WHERE id = :choice_id");
      $delete_choice->bindParam(":choice_id", $choice_id);
      $delete_choice->execute();
  
      header("Location: editOneAct.php?course_id_editAct=$course_id&video_id_editAct=$video_id&question_id_editAct=$question_id");
    } 

    else if(isset($_GET['update_course_activity']) && isset($_GET['update_video_activity']) && isset($_GET['update_question_id'])){
      $course_id = $_GET['update_course_activity'];
      $video_id = $_GET['update_video_activity'];
      $question_id = $_GET['update_question_id'];

      $delete_choice = $conn->prepare("DELETE FROM choices_table WHERE id = :choice_id");
      $delete_choice->bindParam(":choice_id", $choice_id);
      $delete_choice->execute();
  
      header("Location: updateOneAct.php?update_course_activity=$course_id&update_video_activity=$video_id&update_question_id=$question_id");
    }

  }





  // SUBMIT CHECKED BOXES
  if(isset($_POST['submitCheckedBoxes'])){

    // GETTING ALL THE CHECKED VALUES
    $checkboxValues = isset($_POST['checkedQuestions']) ? array_map('intval', $_POST['checkedQuestions']) : array();


    
    foreach ($checkboxValues as $value) {
      $status = 'Selected';
      $select_all_question = $conn->prepare('UPDATE activity_table SET status = :status WHERE id = :value');
      $select_all_question->bindValue(':value', $value);
      $select_all_question->bindValue(':status', $status);
      $select_all_question->execute();

      $select_question = $conn->prepare('SELECT * FROM activity_table WHERE id = :checkboxValueId');
      $select_question->bindValue(':checkboxValueId', $value);
      $select_question->execute();

      
      $fetch_question = $select_question->fetch(PDO::FETCH_ASSOC);
      $question = $fetch_question['question'];
      // echo $question;
      
      // RETRIEVING CHOICES UNDER A CERTAIN QUESTION
      $select_choices = $conn->prepare('SELECT * FROM choices_table WHERE question_id = :question_id');
      $select_choices->bindValue(':question_id', $value);
      $select_choices->execute();

      // while($fetch_choices = $select_choices->fetch(PDO::FETCH_ASSOC)){
      //   $choice = $fetch_choices['choices'];
      //   echo $choice . "<br>";
      // }

    }





    // GETTING ALL THE UNCHECKED VALUES
    $uncheckedQuestions = isset($_POST['checkedQuestions']) ? $_POST['checkedQuestions'] : array();
    $allQuestions = array_column($conn->query('SELECT id FROM activity_table')->fetchAll(), 'id');
    $uncheckboxValues = array_diff($allQuestions, $uncheckedQuestions);
    


    
    foreach ($uncheckboxValues as $value) {
      $status = 'Unselected';
      $select_all_question = $conn->prepare('UPDATE activity_table SET status = :status WHERE id = :value');
      $select_all_question->bindValue(':value', $value);
      $select_all_question->bindValue(':status', $status);
      $select_all_question->execute();
    }

    if(isset($_GET['update_course_id']) && isset($_GET['update_video_activity'])){
      $course_id = $_GET['update_course_id'];
      $video_id = $_GET['update_video_activity'];
  
      $select_course_video = $conn->prepare("SELECT * FROM videos_table WHERE course_id = :course_id AND id = :video_id");
      $select_course_video->bindParam(":course_id", $course_id);
      $select_course_video->bindParam(":video_id", $video_id);
      $select_course_video->execute();
      $fetch_data = $select_course_video->fetch(PDO::FETCH_ASSOC);
      $course_title = $fetch_data['course_title'];
      $video_title = $fetch_data['video_title'];
    }

    header("Location: ./updateActivityUI.php?update_course_id=$course_id&update_video_activity=$video_id&listOfSelectedActivites");
  }





  if(isset($_POST['submitSorting'])){
    $video_id = $_POST['video_id'];
    $activitiesOrder = $_POST['activitiesOrder'];

    $update_activity_order = $conn->prepare("UPDATE videos_table SET activity_order = :activity_order where id  = :video_id");
    $update_activity_order->bindParam(":activity_order", $activitiesOrder);
    $update_activity_order->bindParam(":video_id", $video_id);
    $update_activity_order->execute();
  }

?>