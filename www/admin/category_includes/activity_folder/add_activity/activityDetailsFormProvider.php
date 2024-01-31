<?php
  if(isset($_GET['course_id_createAct']) && isset($_GET['video_id_createAct'])){
    $course_id = $_GET['course_id_createAct'];
    $video_id = $_GET['video_id_createAct'];
  }
?>
<form action="" method="POST" id="acts">
 
    <!-- Error message pop up -->
    <div class="errorMessageContainer">
    
    </div>

    <!-- SCORING UI -->
    <?php include '../../category_includes/scoring_folder/add_scoring/includeScoringUI.php'; ?>
    

    <div class="hide_act_modal">
      <div class="activities_modal d-flex flex-column">
        <div class='row '>
            <div class='input-group text-start'>
              <div class="d-flex justify-content-start">
                <label for='' class='mb-2 mt-3 font-med text-start'>Question</label>
              </div>
                <textarea
                  required
                name='video_question'
                id=''
                cols='30'
                rows='3'
                class='form-control text-start mx-2 bg-light summernote'
                style='border: #555 solid 1px;'
                
                ></textarea
                >
            </div>
          <div class=''>
            <div class="d-flex justify-content-start align-items-center">
              <label for='' class='mb-1 mt-2 font-med text-start'>Choices</label>
              <i class="fa-solid fa-circle-plus txt-red-light add_quiz_icon pt-1 mx-2" style="cursor: pointer;"></i>
            </div>
            <div id="choices_box">
              <div class="form-group position-relative">
                
              <textarea
                required
                  name='question_choices[]'
                  id=''
                  class='form-control mx-2 summernote-img'
                  style='border: #555 solid 1px; margin-right: 1rem;'
                
                ></textarea>

                  <button onclick="deleteChoiceInput(this)" class=" bg-transparent font-med position-absolute mx-2" style="font-size: 2rem; top: -.3rem; right: 0; cursor: pointer; border: none; outline: none;color:#555;">&times;</button>
                </div>
                <br>
  
                <div class="form-group position-relative">
                  
                <textarea
                  required
                  name='question_choices[]'
                  id=''
                  class='form-control mx-2 summernote-img'
                  style='border: #555 solid 1px; margin-right: 1rem;'
                
                ></textarea>
            
                    <button onclick="deleteChoiceInput(this)" class=" bg-transparent font-med position-absolute mx-2" style="font-size: 2rem; top: -.3rem; right: 0; cursor: pointer; border: none; outline: none;color:#555;">&times;</button>
                    <br>
                </div>
                <div class="form-group position-relative">
                  
                <textarea
                  required
                  name='question_choices[]'
                  id=''
                  class='form-control mx-2 summernote-img'
                  style='border: #555 solid 1px; margin-right: 1rem;'
                
                ></textarea>
     
                    <button onclick="deleteChoiceInput(this)" class=" bg-transparent font-med position-absolute mx-2" style="font-size: 2rem; top: -.3rem; right: 0; cursor: pointer; border: none; outline: none;color:#555;">&times;</button>
                    <br>
                </div>
                <div class="form-group position-relative">
                
                <textarea
                  required
                  name='question_choices[]'
                  id=''
                  class='form-control mx-2 summernote-img'
                  style='border: #555 solid 1px; margin-right: 1rem;'
                
                ></textarea>
     
                    <button onclick="deleteChoiceInput(this)" class=" bg-transparent font-med position-absolute mx-2" style="font-size: 2rem; top: -.3rem; right: 0; cursor: pointer; border: none; outline: none;color:#555;">&times;</button>
                    <br>
                </div>
              </div>
              <div class="form-group">
                <br>
                <h4>Correct Answer</h4>
                <textarea
                  required
                  name='correct_answer'
                  id=''
                  class='form-control mx-2 summernote-img'
                  style='border: #555 solid 1px; margin-right: 1rem;'
                
                ></textarea>
              </div>
          </div>
          <div class="mt-3 d-flex align-items-center justify-content-between w-100 mb-2">
            <button class="btn bgc-red-light rounded-pill px-3 font-med" type="submit" name="save_vid_activity" style="border: none; outline: none; font-size: 14px;">Add This Question</button>
            <a href="../../read/activity/updateActivityUI.php?update_course_id=<?php echo $course_id; ?>&update_video_activity=<?php echo $video_id; ?>&listOfAllActivities">
              <div class="btn bgc-red-light font-med rounded-pill px-3 py-1" style="border: none; outline: none; font-size: 16px;">Done</div>
            </a>
          </div>
      </div>
      </div>
    </div>
</form>

<script>
    $(".summernote-img").each(function () {
    $(this).summernote({
      height: 100,
      placeholder: "Type something...",
      tableClassName: function () {
        $(this)
          .addClass("table table-bordered")

          .attr("cellpadding", 12)
          .attr("cellspacing", 0)
          .attr("border", 1)
          .css("borderCollapse", "collapse");

        $(this)
          .find("td")
          .css("borderColor", "#999")
          .css("background", "#f5f5f5")
          .css("padding", "15px");
      },

      toolbar: [
        ["font", ["", "", ""]],
        ["style", ["", "", "", ""]],
        ["insert", ["picture"]],
        ["code", [""]],
        ["undo", [""]],
        ["redo", [""]],
        ["para", ["", "", "", ""]],
      ],
    });
  });
</script>