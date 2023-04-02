<form action="" method="POST" id="form" class="pt-3">

<div class="showScoring">
      <div class="activities_modal_container mb-5 ">
        <div class="activities_modal d-flex flex-column ">
            <h3 class="text-center my-4 w-100">SCORING</h3>
            <div class="d-flex align-items-center justify-content-center w-100">
              <div class="form-group mx-2">
                <label class="font-med mb-1" for="quesNum">Number of Questions: </label>
                <!-- counting number of questions -->
                <?php   
                  
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


                    echo "<input type='number' id='quesNum' name='items_count' value='$question_count' readonly class='form-control text-center'>";

                    $query_select_from_activity = $conn->prepare("SELECT * FROM score_table WHERE video_id = :video_id");
                    $query_select_from_activity->bindParam(":video_id", $video_id);
                    $query_select_from_activity->execute();
                    
                    $score_row = $query_select_from_activity->fetch(PDO::FETCH_ASSOC);
                    $passing_score = $score_row['passing_score']; 
                    
                    ?>

                    
                    
                  
                
              </div>
              
              <div class="form-group scoringg mx-2">
                <label class="font-med mb-1" for="selectPassingScore">Input Passing Score:</label>
                <input type="number" required id="quesNum" name="passing_score" class="text-center form-control" value="<?php echo $passing_score; ?>">
              </div>
            </div>
            <!-- save passing score and number of questions to the database -->
            <div class="d-flex align-items-center justify-content-end w-100 my-4">
              <button class="btn bgc-red-light rounded-pill px-4 mx-3 font-med" name="update_scoring" style="font-size: 15px;">Update</button>
              <a href="../../videos_display.php?course_id_display=<?php echo $course_id; ?>" style="width: 22px;">
                <img src="../../assets/img/exit 2.png" style="width: 100%;" alt="">
              </a>
            </div>
          </div>
        </div>
    </div>

    <?php }
  ?>
    
    
  </form>