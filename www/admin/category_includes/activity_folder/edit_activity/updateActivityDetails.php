
<div class="w-100 d-flex flex-column align-items-center justify-content-center" >

<?php
      if(isset($_GET['update_video_activity']) && isset($_GET['update_course_id'])){
        $course_id = $_GET['update_course_id'];
        $video_id = $_GET['update_video_activity'];
        $query_select_all_activity = $conn->prepare("SELECT * FROM activity_table WHERE course_id = :course_id AND video_id = :video_id");
  
        $query_select_all_activity->bindParam(":course_id", $course_id);
        $query_select_all_activity->bindParam(":video_id", $video_id);
  
        $query_select_all_activity->execute();
        $rowCount = 0;
      }
?>
  <div class="mt-3 mb-2 d-flex align-items-center justify-content-center w-100" >
    <button onclick="removeElement(this)" class="mx-2 add_q_a btn bgc-red-light rounded-pill px-3 py-1" id="show_act_form" style="font-size: 18px;">Add Question and Choices</button>
    <button class="mx-2 btn bgc-gray-light rounded-pill selectacts" onclick="toggleCheckboxes(this)" id="toggle-checkboxes" style="border: #444 1px solid; font-size: 18px;">Select activities to feature</button>
    <button class="mx-2 btn bgc-gray-light rounded-pill genhide"  onclick="unhideNumGenInp(this)" style="border: #444 1px solid; font-size: 18px;">Generate Random Activity</button>
    <button class="mx-2 btn bgc-gray-light rounded-pill hidden selectall" onclick="checkAll()" style="border: #444 1px solid; font-size: 18px;">Select All</button>
    <button class="mx-2 btn bgc-gray-light rounded-pill hidden unselectall" onclick="uncheckAll()" style="border: #444 1px solid; font-size: 18px;">Unselect All</button>
    <a href="./updateActivityUI.php?update_course_id=<?php echo $course_id; ?>&update_video_activity=<?php echo $video_id; ?>&listOfAllActivities">
      <button class="mx-2 btn bgc-gray-light rounded-pill discardChanges hidden" style="border: #444 1px solid; font-size: 18px;">Discard</button>
    </a>



    <a href="../scoring/updateScoringUI.php?update_course_id=<?php echo $course_id;?>&update_video_activity=<?php echo $video_id;?>">
      <button class="btn bgc-red-light rounded-pill px-3 py-1 done position-fixed" id="done" style="font-size: 18px; bottom: 5%; right: 5%; z-index: 99999">Done</button>
    </a>
  </div>


  <!-- GENERATE RANDOM NUMBER BASED ON THE SUBMITTED NUMBER INPUT -->
    <div action="" class="my-4 col-lg-4 col-md-6 col-sm-8 col-10 mx-auto">
      <div class="input-group hidden numGenInput">
        <input class="form-control" id="numberInput" type="number" required placeholder="Enter the number of items to be featured" style="border: 1px solid #222;">
        <button onclick="gen_rand_num(this)" class="btn bgc-gray-light submitNumInp" style="border: 1px solid #222; font-size: 18px; z-index: 99999">Submit</button>
      </div>


    </div>


</div>
  
<form action="" method="POST" class="acts">
 
    <!-- Error message pop up -->
    <div class="errorMessageContainer">
    
    </div>


    

    <div class="activities_modal_container show_act_container hidden position-absolute mt-3" id="activities_modal_container" style="z-index: 600;">
      <div class="activities_modal d-flex flex-column" style=" box-shadow: 0 3px 8px #777 ;
">
        <div class='row '>
          <div class='input-group text-start'>
            <div class="d-flex justify-content-start">
              <label for='' class='mb-2 mt-3 font-med text-start'>Question</label>
            </div>
              <textarea
              name='video_question'
              id=''
              cols='30'
              rows='3'
              class='form-control text-start mx-2 bg-light summernote'
              style='border: #555 solid 1px;'
              required
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
                <input
                required
                  type='text'
                  name="question_choices[]"
                  class='form-control mb-2'
                  style='border: #555 solid 1px; margin-right: 1rem;'
                  
                  />
                  <button onclick="deleteChoiceInput(this)" class=" bg-transparent font-med position-absolute mx-2" style="font-size: 2rem; top: -.3rem; right: 0; cursor: pointer; border: none; outline: none;color:#555;">&times;</button>
                </div>
                <div class="form-group position-relative">
                  <input
                  required
                    type='text'
                    name="question_choices[]"
                    class='form-control mb-2'
                    style='border: #555 solid 1px; margin-right: 1rem;'
                    
                    />
                    <button onclick="deleteChoiceInput(this)" class="bg-transparent font-med position-absolute mx-2" style="font-size: 2rem; top: -.3rem; right: 0; cursor: pointer; border: none; outline: none; color:#555;">&times;</button>
                </div>
                <div class="form-group position-relative">
                  <input
                  required
                    type='text'
                    name="question_choices[]"
                    class='form-control mb-2'
                    style='border: #555 solid 1px; margin-right: 1rem;'
                    
                    />
                    <button onclick="deleteChoiceInput(this)" class=" bg-transparent font-med position-absolute mx-2" style="font-size: 2rem; top: -.3rem; right: 0; cursor: pointer; border: none; outline: none;color:#555;">&times;</button>
                </div>
                <div class="form-group position-relative">
                  <input
                  required
                    type='text'
                    name="question_choices[]"
                    class='form-control mb-2'
                    style='border: #555 solid 1px; margin-right: 1rem;'
                    
                    />
                    <button onclick="deleteChoiceInput(this)" class=" bg-transparent font-med position-absolute mx-2" style="font-size: 2rem; top: -.3rem; right: 0; cursor: pointer; border: none; outline: none;color:#555;">&times;</button>
                </div>
              </div>
              <div class="form-group">
                <input
                required
                type='text'
                class='form-control mb-2'
                name="correct_answer"
                style='border: #555 solid 1px; margin-right: 1rem;'
                
                placeholder="Correct Answer"
                />
              </div>
          </div>
          <div class="my-3 d-flex align-items-center justify-content-between w-100 mb-2">

            <button class="btn bgc-red-light rounded-pill px-3 font-med" type="submit" onclick="prevDef(this)" name="save_activity_from_update" style="border: none; outline: none; font-size: 14px;">Add This Question</button>
            
            <!-- removeQuestionChoices -->
            <button onclick="hideModal()" class="btn bgc-red-light font-med rounded-pill px-3 py-1" style="border: none; outline: none; font-size: 16px;" name="done_btn">Done</button>
          </div>
      </div>
      </div>
    </div>
</form>
<div class="overlay hidden" style="max-height: 100%; z-index: 500;"></div>

<script>
  function hideModal() {
  const modal = document.querySelector('#activities_modal_container');
  const overlay = document.querySelector('.overlay');
  modal.classList.add('hidden');
  overlay.classList.add('hidden');
}

</script>