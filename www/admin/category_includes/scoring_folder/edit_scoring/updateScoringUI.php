  <!-- counting number of questions -->

  <div class="updated hidden position-fixed" style="top: 0; left: 0; z-index: 9999;">
    <div class="invalid_modal_container">
      <div class="invalid_modal d-flex flex-column" style="background: #ddf5d9; color: #444">
        <div class="h2">
        ✅ UPDATED SUCCESSFULLY!
        </div>
      </div>
    </div>
  </div>

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

      $query_select_from_activity = $conn->prepare("SELECT * FROM score_table WHERE video_id = :video_id");
      $query_select_from_activity->bindParam(":video_id", $video_id);
      $query_select_from_activity->execute();
      
      $score_row = $query_select_from_activity->fetch(PDO::FETCH_ASSOC);
      $passing_score = $score_row['passing_score']; 
      $selected_act = $score_row['selected_act']; 

    }

    
  ?>


<style>
  .activities_modal{
    width: 60%;
  }
</style>
<form action="" method="POST" id="form" class="pt-3">

<section class="container-fluid">
    <div class="d-flex align-items-center justify-content-end">
      <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="text-decoration-none">
        <div
          class="btn mt-2 mt-2 d-flex align-items-center justify-content-center"
          style="height: 2.5rem"
        >
          <p
            style="margin-right: 0.4rem; font-size: 18px"
            class="font-med"
            >
            Back
          </p>
          <div>
            <img
            src="../../assets/img/exit 2.png"
            style="width: 20px; height: 16px; margin-top: -20px"
            width="100%"
            alt=""
            />
          </div>
        </div>
      </a>
    </div>
</section>

<div class="showScoring">
      <div class="activities_modal_container mb-5 ">
        <div class="activities_modal d-flex flex-column ">
            <h3 class="text-center my-4 w-100">SCORING</h3>
            <div class="d-flex align-items-center justify-content-center w-100">

              <!-- NUMBER OF ACTIVITIES -->
              <div class="form-group mx-2">
                <label class="font-med mb-1" for="quesNum">Number of all activities: </label>
                <input type='number' id='quesNum' name='items_count' value='<?php echo $question_count; ?>' readonly class='form-control text-center'>
              </div>
              
              <!-- NUMBER OF SELECTED ACTIVITIES -->
              <div class="form-group scoringg mx-3">
                <label class="font-med mb-1" for="selectPassingScore">Number of selected activities:</label>
                <input type='number' id='quesNum' name='selected_act' value='<?php echo $selected_act; ?>' readonly class='form-control text-center'>
              </div>
              
              <!-- INPUT PASSING SCORE -->
              <div class="form-group scoringg mx-3">
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

 
    
    
  </form>