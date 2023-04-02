
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
                type='text'
                name="question_choices[]"
                class='form-control mb-2'
                style='border: #555 solid 1px; margin-right: 1rem;'
                required

                  />
                  <button onclick="deleteChoiceInput(this)" class=" bg-transparent font-med position-absolute mx-2" style="font-size: 2rem; top: -.3rem; right: 0; cursor: pointer; border: none; outline: none;color:#555;">&times;</button>
                </div>
                <div class="form-group position-relative">
                  <input
                  type='text'
                  name="question_choices[]"
                  class='form-control mb-2'
                  style='border: #555 solid 1px; margin-right: 1rem;'
                  required
                  
                    />
                    <button onclick="deleteChoiceInput(this)" class="bg-transparent font-med position-absolute mx-2" style="font-size: 2rem; top: -.3rem; right: 0; cursor: pointer; border: none; outline: none; color:#555;">&times;</button>
                </div>
                <div class="form-group position-relative">
                  <input
                  type='text'
                  name="question_choices[]"
                  class='form-control mb-2'
                  style='border: #555 solid 1px; margin-right: 1rem;'
                  required
  
                    />
                    <button onclick="deleteChoiceInput(this)" class=" bg-transparent font-med position-absolute mx-2" style="font-size: 2rem; top: -.3rem; right: 0; cursor: pointer; border: none; outline: none;color:#555;">&times;</button>
                </div>
                <div class="form-group position-relative">
                  <input
                  type='text'
                  name="question_choices[]"
                  class='form-control mb-2'
                  style='border: #555 solid 1px; margin-right: 1rem;'
                  required
  
                    />
                    <button onclick="deleteChoiceInput(this)" class=" bg-transparent font-med position-absolute mx-2" style="font-size: 2rem; top: -.3rem; right: 0; cursor: pointer; border: none; outline: none;color:#555;">&times;</button>
                </div>
              </div>
              <div class="form-group">
                <input
                type='text'
                class='form-control mb-2'
                name="correct_answer"
                style='border: #555 solid 1px; margin-right: 1rem;'
                placeholder="Correct Answer"
                required
                />
              </div>
          </div>
          <div class="mt-3 d-flex align-items-center justify-content-between w-100 mb-2">
            <button class="btn bgc-red-light rounded-pill px-3 font-med" type="submit" name="save_vid_activity" style="border: none; outline: none; font-size: 14px;">Add This Question</button>
            <button onclick="removeQuestionChoices(this)" class="btn bgc-red-light font-med rounded-pill px-3 py-1" style="border: none; outline: none; font-size: 16px;" name="done_btn">Done</button>
          </div>
      </div>
      </div>
    </div>
</form>
