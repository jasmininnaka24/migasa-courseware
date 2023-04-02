<style>
.checkbox[type="checkbox"] {
  transform: scale(2); 
}

/* Style for the checked checkbox */
.checkbox[type="checkbox"]:checked {
  background-color: red; 
  color: white; 
}

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

</style>





<!-- LIST OF ALL ACTIVITIES -->
<?php 
  if(isset($_GET['listOfAllActivities'])){ ?>

    <div class="col-10 mx-auto text-center h4 mt-4 mb-4" style="margin-bottom: 2rem; color: #777">
      You can make an activity under <span class="font-bold" style="color: #444"><?php echo $course_title; ?></span> course and lesson <span class="font-bold" style="color: #444"><?php echo $video_title; ?></span>.
    </div>



    <div>
      <?php include '../../category_includes/activity_folder/edit_activity/updateActivityDetails.php'; ?>
    </div>



    <!-- CHECKBOX FORM -->
    <form method="POST" class="anim-to-top-slow" style="margin-bottom: 5rem;">
      <div class="list">
        <?php
          if(isset($_GET['update_video_activity']) && isset($_GET['update_course_id'])){
            $course_id = $_GET['update_course_id'];
            $video_id = $_GET['update_video_activity'];
            $query_select_all_activity = $conn->prepare("SELECT * 
            FROM activity_table 
            WHERE course_id = :course_id 
            AND video_id = :video_id 
            ORDER BY (status = 'Selected') DESC");

            $query_select_all_activity->bindParam(":course_id", $course_id);
            $query_select_all_activity->bindParam(":video_id", $video_id);

            $query_select_all_activity->execute();

            if(isset($_GET['update_course_id']) && isset($_GET['update_video_activity'])){
              $course_id = $_GET['update_course_id'];
              $video_id = $_GET['update_video_activity'];
              
              $query_select_from_activity = $conn->prepare("SELECT * FROM activity_table WHERE video_id = :video_id");
              $query_select_from_activity->bindParam(":video_id", $video_id);
              $query_select_from_activity->execute();
              
              $question_count = 0;
              
              while($query_select_from_activity->fetch(PDO::FETCH_ASSOC)){
                $question_count += 1;
                
              }
              if($question_count == 0){
                echo "<h1 class='w-75 text-dark text-center mx-auto rounded-3 py-4'>NO ACTIVITY HAS BEEN ADDED</h1>";
              }
            }

            
            
            while($row = $query_select_all_activity->fetch(PDO::FETCH_ASSOC)){
              $question_id = $row['id'];
              $question = $row['question']; 
              $correct_ans = $row['correct_answer']; 
              
              ?>
                <div class="mt-4 ">
                  <div class="activities_modal d-flex flex-column position-relative">
                    <input 
                      type="checkbox" 
                      class="checkbox hidden position-absolute" 
                      style="top: 6%; left: 3%" 
                      name="checkedQuestions[]" 
                      value="<?php echo $question_id; ?>" 
                      
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
                    <div class="d-flex justify-content-end w-100">
                      <div>
                        <!-- edit and delete -->
                        <a href="./updateOneAct.php?update_course_activity=<?php echo $course_id; ?>&update_video_activity=<?php echo $video_id; ?>&update_question_id=<?php echo $question_id;?>&listOfAllActivities" class="text-decoration-none text-dark">
                          <i class="fa-solid fa-pen-to-square mx-1 my-1" style="cursor: pointer;"></i>
                        </a>
                        <a onClick="return confirm('Are you sure you want to delete?')" style="font-size: 15px;" class="text-decoration-none text-dark" href="./deleteAct.php?update_course_activity=<?php echo $course_id; ?>&update_video_activity=<?php echo $video_id; ?>&delete_questionAndchoices=<?php echo $question_id;?>&listOfAllActivities">       
                          <i class="fa-solid fa-trash mx-1 my-1 text-dark" style="cursor: pointer;"></i>
                        </a>
                      </div>
                    </div>
                    <h5 class="d-flex flex-column"><span class="font-reg mb-1" style="font-size: .9rem;">Question <?php echo ":</span> " . $question; ?></h5>
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
            }
          }
        ?>

      </div>

        <button class="btn bgc-red-light rounded-pill submit hidden position-fixed" style="font-size: 18px; bottom: 5%; right: 5%" name="submitCheckedBoxes">Submit</button>

    </form>
   



      <?php 
      
    }
    ?>


<!-- LIST OF ALL SELECTED ACTIVITIES -->
<?php
  if(isset($_GET['listOfSelectedActivites'])){ 
    
      if(isset($_GET['update_video_activity'])){
        $video_id = $_GET['update_video_activity'];
      }
    ?>
    
    <div class="col-10 mx-auto text-center h1 mt-5" style="margin-bottom: 1rem; color: #444">
      List of selected activities
    </div>
    <p class="col-lg-8 col-sm-10 col-10 text-center mx-auto h6" style="margin-bottom: 4rem; color: #777">
      You have the option to change the order of the list. You can either shuffle the order randomly or sort it in either ascending or descending order.
    </p>

    

    <form class="col-lg-6 col-sm-10 col-10 mx-auto" method="POST">
      <div class="input-group mb-5" style="font-size: 18px;">
        <input type="number" class="hidden" name="video_id" value="<?php echo $video_id; ?>">
        <select name="activitiesOrder" id="" class="rounded-3 form-control" style="font-size: 18px; border: 1px #999 solid">
          <?php
              $order = $conn->prepare("SELECT * FROM videos_table WHERE id = :video_id");
              $order->bindParam(":video_id", $video_id);
              $order->execute();

              $selected_order = $order->fetch(PDO::FETCH_ASSOC);
              $order = $selected_order['activity_order'];

              if($order === 'ascending'){ ?>
                <option value="ascending">In Order - Ascending</option>
                <option value="descending">In Order - Descending</option>
                <option value="shuffled">Shuffled</option>
                <?php }
              
              else if($order === 'descending') { ?>
                <option value="descending">In Order - Descending</option>
                <option value="ascending">In Order - Ascending</option>
                <option value="shuffled">Shuffled</option>
                <?php }

              else if($order === 'shuffled') { ?>
                <option value="shuffled">Shuffled</option>
                <option value="ascending">In Order - Ascending</option>
                <option value="descending">In Order - Descending</option>

              <?php }

            
          ?>
        </select>
        <button class="btn bgc-red-light" style="font-size: 18px;" name="submitSorting">Submit</button>
      </div>
    </form>

    <div class="list anim-to-top-slow">
        <?php
          if(isset($_GET['update_video_activity']) && isset($_GET['update_course_id'])){
            $course_id = $_GET['update_course_id'];
            $video_id = $_GET['update_video_activity'];
            $status = 'Selected';

            switch (true) {
              case $order === 'ascending':
                $order = 'id ASC';
                break;
              case $order === 'descending':
                $order = 'id DESC';
                break;
              case $order === 'shuffled':
                $order = 'RANDOM()';
                break;
            }


            $query_select_all_activity = $conn->prepare("SELECT * FROM activity_table WHERE course_id = :course_id AND video_id = :video_id AND status = :status ORDER BY $order");

            $query_select_all_activity->bindParam(":course_id", $course_id);
            $query_select_all_activity->bindParam(":video_id", $video_id);
            $query_select_all_activity->bindParam(":status", $status);

            $query_select_all_activity->execute();

            if(isset($_GET['update_course_id']) && isset($_GET['update_video_activity'])){
              $course_id = $_GET['update_course_id'];
              $video_id = $_GET['update_video_activity'];
              
              $query_select_from_activity = $conn->prepare("SELECT * FROM activity_table WHERE video_id = :video_id");
              $query_select_from_activity->bindParam(":video_id", $video_id);
              $query_select_from_activity->execute();
              
              $question_count = 0;
              
              while($query_select_from_activity->fetch(PDO::FETCH_ASSOC)){
                $question_count += 1;
              }
              if($question_count == 0){
                echo "<h1 class='w-75 text-dark text-center mx-auto rounded-3 py-4'>NO ACTIVITY HAS BEEN ADDED</h1>";
              }
            }
            
            $num_id = 1; // initialize the $num_id variable to 1
            while($row = $query_select_all_activity->fetch(PDO::FETCH_ASSOC)){
              $question_id = $row['id'];
              $question = $row['question']; 
              $correct_ans = $row['correct_answer']; 
              
              ?>
                <div class="mt-4 ">
                  <div class="activities_modal d-flex flex-column position-relative">

                    <div class="d-flex justify-content-end w-100">
                      <div>
                        <!-- edit and delete -->
                        <a href="./updateOneAct.php?update_course_activity=<?php echo $course_id; ?>&update_video_activity=<?php echo $video_id; ?>&update_question_id=<?php echo $question_id;?>&listOfSelectedActivites" class="text-decoration-none text-dark">
                          <i class="fa-solid fa-pen-to-square mx-1 my-1" style="cursor: pointer;"></i>
                        </a>
                        <a onClick="return confirm('Are you sure you want to delete?')" style="font-size: 15px;" class="text-decoration-none text-dark" href="./deleteAct.php?update_course_activity=<?php echo $course_id; ?>&update_video_activity=<?php echo $video_id; ?>&delete_questionAndchoices=<?php echo $question_id;?>&listOfSelectedActivites">
                        <button class="bg-transparent m-0" style="border: none;" onclick="delete_this(this)">
                          <i class="fa-solid fa-trash mx-1 my-1" style="cursor: pointer;"></i>
                        </button>
                        </a>
                      </div>
                    </div>
                    <h5 class="d-flex flex-column"><span class="font-reg mb-1" style="font-size: .9rem;">Question <?php echo ":</span> " . $question; ?></h5>
                    <?php
                      $query_select_from_choices = $conn->prepare("SELECT * FROM choices_table WHERE question_id = $question_id ORDER BY $order");
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
    <div>
      <a href="../scoring/updateScoringUI.php?update_course_id=<?php echo $course_id;?>&update_video_activity=<?php echo $video_id;?>">
        <button class="btn bgc-red-light rounded-pill px-3 py-1 done position-fixed" id="done" style="font-size: 18px; bottom: 5%; right: 5%">Done</button>
      </a>
    </div>

    <?php
  }
?>

<script src="../../../assets/js/activities_list.js"></script>
