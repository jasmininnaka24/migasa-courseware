<div class="showScoring hidden">
      <div class="activities_modal_container mb-5">
        <div class="activities_modal d-flex flex-column">
          <div class="d-flex align-items-center justify-content-center w-100">
            <div class="form-group mx-2">
              <label class="font-med mb-1" for="quesNum">Number of Questions: </label>
              <!-- counting number of questions -->
              <?php
              
                if(isset($_GET['video_id_createAct'])){
                 $video_id_scoring= $_GET['video_id_createAct'];
                }
                $query_select_from_activity = $conn->prepare("SELECT * FROM activity_table WHERE video_id = $video_id_scoring");
                $query_select_from_activity->execute();

                $question_count = 0;
                while($row = $query_select_from_activity->fetch(PDO::FETCH_ASSOC)){
                  $question_count += 1;
                }

                echo "<input type='number' id='quesNum' name='items_count' value='$question_count' readonly class='form-control text-center'>";
              ?>
              
            </div>
            
            <div class="form-group scoringg mx-2">
              <label class="font-med mb-1" for="selectPassingScore">Input Passing Score:</label>
              <input type="number" required id="quesNum" name="passing_score" class="text-center form-control" value="0">
            </div>
           
          </div>
          <!-- save passing score and number of questions to the database -->
          <div class="d-flex align-items-center justify-content-end w-100 mt-3">
            <button class="btn bgc-red-light rounded-pill px-4 font-med" name="save_scoring"  style="font-size: 15px;">Save</button>
          </div>
          
        </div>
      </div>
    </div>