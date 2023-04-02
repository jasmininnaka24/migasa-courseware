<div class="list">
  <?php
    if(isset($_GET['video_id_createAct']) && isset($_GET['course_id_createAct'])){
      $course_id = $_GET['course_id_createAct'];
      $video_id = $_GET['video_id_createAct'];
      $query_select_from_activity = $conn->prepare("SELECT * FROM activity_table WHERE video_id = :video_id");
      $query_select_from_activity->bindParam(":video_id", $video_id);
      $query_select_from_activity->execute();

      $num_id = 1; // initialize the $num_id variable to 1


      while($row = $query_select_from_activity->fetch(PDO::FETCH_ASSOC)){
        $question_id = $row['id'];
        $question = $row['question']; 
        $correct_ans = $row['correct_answer']; 
        
        
        ?>
          <div class="mt-4 ">
            <div class="activities_modal d-flex flex-column">
              <div class="d-flex justify-content-end w-100">
                <div>
                  <a class="text-decoration-none text-dark" href="./editOneAct.php?course_id_editAct=<?php echo $course_id; ?>&video_id_editAct=<?php echo $video_id; ?>&question_id_editAct=<?php echo $question_id;?>">
                    <i class="fa-solid fa-pen-to-square mx-1 my-1" style="cursor: pointer;"></i>
                  </a>
                  <a onClick="return confirm('Are you sure you want to delete?')"  style="font-size: 15px;" class="text-decoration-none text-dark" href="deleteAct.php?course_id_createAct=<?php echo $course_id; ?>&video_id_createAct=<?php echo $video_id; ?>&delete_questionAndchoices=<?php echo $question_id;?>">
                    <button class="bg-transparent m-0" style="border: none;" onclick="delete_this(this)">
                    <i class="fa-solid fa-trash mx-1 my-1" style="cursor: pointer;"></i>
                  </button>
                  </a>
                </div>
              </div>
              <h5 class="d-flex flex-column"><span class="font-reg mb-1" style="font-size: .9rem;">Question <?php echo $num_id . ":</span> " . $question; ?></h5>
              <?php
                $query_select_from_choices = $conn->prepare("SELECT * FROM choices_table WHERE question_id = $question_id");
                $query_select_from_choices->execute();?>

                <ol>
                <?php
                while($row = $query_select_from_choices->fetch(PDO::FETCH_ASSOC)){
                  $choices_id = $row['id'];
                  $choices = $row['choices']; 
                      echo "<li>$choices</li>";
                    }
                    ?>
                </ol>
              <p class="font-med">Answer: <?php echo $correct_ans; ?></p>
            </div>
          </div>

          <?php 
             $num_id += 1;
          ?>
          


          <?php
         
      }
    }
  ?>
  
</div>

