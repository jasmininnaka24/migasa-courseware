<?php
  if(isset($_GET['update_course_activity']) && isset($_GET['update_question_id']) && $_GET['update_video_activity']){
    $course_id = $_GET['update_course_activity'];
    $video_id = $_GET['update_video_activity'];
    $question_id = $_GET['update_question_id'];
    
    // GET QUESTION 
    $get_question = $conn->prepare("SELECT * FROM activity_table WHERE id = :question_id");
    $get_question->bindParam(":question_id", $question_id);
    $get_question->execute();

    $get_question_row = $get_question->fetch(PDO::FETCH_ASSOC);
    $question = $get_question_row['question'];
    $correct_answer = $get_question_row['correct_answer'];

    // GET CHOICES
    $get_choices = $conn->prepare("SELECT * FROM choices_table WHERE question_id = :question_id");
    $get_choices->bindParam(":question_id", $question_id);
    $get_choices->execute();

  }
?>


<form action="" method="POST" class="acts" id="form">
 
    <!-- Error message pop up -->
    <div class="errorMessageContainer">
    
    </div>

    <div class="activities_modal_container show_act_container" id="activities_modal_container">
      <div class="activities_modal d-flex flex-column">
        <div class='row '>
          <input type="number" name="question_id" hidden value="<?php echo $question_id; ?>">
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
                ><?php echo $question; ?></textarea
                >
            </div>
          <div class=''>
            <div class="d-flex justify-content-start align-items-center">
              <label for='' class='mb-1 mt-2 font-med text-start'>Choices</label>
              <button class="add_quiz_icon bg-transparent p-0" style="border:none; outline:none" onclick="removeAddIcon(this)">
                <i class="fa-solid fa-circle-plus txt-red-light pt-2 mx-2" style="cursor: pointer;"></i>
              </button>
            </div>
            <div id="choices_box">

            <?php
              while($choices_row = $get_choices->fetch(PDO::FETCH_ASSOC)){
                $choices = $choices_row['choices'];
                $choice_id = $choices_row['id'];
                ?>

                <div class="form-group position-relative">
                  <div class="my-3">
                    <input type="number" name="choice_id[]" hidden value="<?php echo $choice_id; ?>">
                    <textarea
                    required
                    name='question_choices[]'
                    id=''
                    class='form-control mx-2 summernote-img'
                    style='border: #555 solid 1px; margin-right: 1rem;'
                    
                    ><?php echo $choices; ?></textarea>
                    <a class="prevRel" href="./updateOneAct.php?update_course_activity=<?php echo $course_id; ?>&update_video_activity=<?php echo $video_id; ?>&update_question_id=<?php echo $question_id; ?>&delete_choice=<?php echo $choice_id; ?>">
                      <button onclick="deleteChoiceInput(this)" class="bg-transparent font-med position-absolute mx-2" style="font-size: 2rem; top: -.3rem; right: 0; cursor: pointer; border: none; outline: none;color:#555;">&times;</button>
                    </a>
                  </div>
                </div>

              <?php }
            ?>
              

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
                
                ><?php echo $correct_answer; ?></textarea>
              </div>
          </div>
          <div class="my-3 d-flex align-items-center justify-content-between w-100 mb-2">
            <a href="./updateActivityUI.php?update_course_id=<?php echo $course_id; ?>&update_video_activity=<?php echo $video_id; ?>&listOfAllActivities">
              <div class="btn bgc-gray-light rounded-pill px-3 font-med"  style="border: #222 solid 1px; outline: none; font-size: 14px;">Cancel</div>
            </a>
            <button class="btn bgc-red-light rounded-pill px-3 font-med" type="submit" onclick="prevDef(this)" name="update_activity" style="border: none; outline: none; font-size: 14px;">Update</button>
          </div>
      </div>
      </div>
    </div>
</form>
<script>
  let show_act_container = document.querySelector('.show_act_container');
  let show_act_form = document.getElementById('show_act_form');
  let done = document.querySelector('.done');
  let prevRel = document.querySelector('.prevRel');
  let done_id = document.getElementById('done');
  let form = document.getElementById('form');

  let prevDef = (e) => {
    e.preventDefault();
  }

  prevRel.addEventListener("click", (e) => {
    e.preventDefault();
  })


  // FOR ADDING QUIZ ICON

  let add_quiz_icon = document.querySelector(".add_quiz_icon");
  let boxesContainer = document.getElementById("choices_box");
  let done_btn = document.querySelector(".done_btn");
  let showScoring = document.querySelector(".showScoring");

  let removeQuestionChoices = (e) => {
    showScoring.classList.remove("hidden");
    e.parentElement.parentElement.parentElement.parentElement.remove();
    e.preventDefault();
  };

  add_quiz_icon.addEventListener("click", (e) => {
    e.preventDefault();
    showData();
    add_quiz_icon.classList.add('hidden');
    e.preventDefault();
  });

  let data = {};

  let deleteChoiceInput = (e) => {
    e.parentElement.remove();
    e.preventDefault();
  };

  let showData = (e) => {
  // create a new div element for the input field
  let inputGroup = document.createElement("div");
  inputGroup.className = "form-group position-relative";

  // create the textarea field
  let textareaField = document.createElement("textarea");
  textareaField.name = "question_choice";
  textareaField.className = "form-control mb-2 summernote-img";
  textareaField.style.border = "#555 solid 1px";
  textareaField.style.marginRight = "1rem";
  textareaField.required = true;
  textareaField.classList.add("summernote-img"); // add the class to the textarea field

  // get the value of the last textarea field (if any)
  let textareas = boxesContainer.querySelectorAll(
    'textarea[name="question_choice"]'
  );
  if (textareas.length > 0) {
    textareaField.value = "";
    textareaField.required = true;
  }

  // create the delete button
  let deleteButton = document.createElement("button");
  deleteButton.className = "bg-transparent font-med position-absolute mx-2";
  deleteButton.style.fontSize = "2rem";
  deleteButton.style.top = "-.3rem";
  deleteButton.style.right = 0;
  deleteButton.style.cursor = "pointer";
  deleteButton.style.color = "#555";
  deleteButton.style.border = "none";
  deleteButton.style.outline = "none";
  deleteButton.textContent = "×";
  deleteButton.onclick = function () {
    inputGroup.remove();
    add_quiz_icon.classList.remove('hidden');
  };

  let checkButton = document.createElement("button");
  checkButton.className = "bg-transparent font-bold position-absolute mx-2";
  checkButton.style.fontSize = "1.3rem";
  checkButton.style.fontWeight = "800";
  checkButton.style.top = ".1rem";
  checkButton.style.right = "1.7rem";
  checkButton.style.cursor = "pointer";
  checkButton.style.color = "red";
  checkButton.style.border = "none";
  checkButton.style.outline = "none";
  checkButton.name = "add_this_choice";
  checkButton.textContent = "✓";

  // append the textarea field and delete button to the input group
  inputGroup.appendChild(textareaField);
  inputGroup.appendChild(deleteButton);
  inputGroup.appendChild(checkButton);

  // append the input group to the boxes container
  boxesContainer.appendChild(inputGroup);

  // initialize Summernote on the new textarea field
  $(textareaField).summernote({
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

  e.preventDefault();
};


  let removeAddIcon = (e) => {
    e.classList.add('hidden');
  }

</script>