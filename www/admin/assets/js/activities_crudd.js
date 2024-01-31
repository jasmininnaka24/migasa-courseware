let add_quiz_icon = document.querySelector(".add_quiz_icon");
let boxesContainer = document.getElementById("choices_box");
let done_btn = document.querySelector(".done_btn");
let showScoring = document.querySelector(".showScoring");

let removeQuestionChoices = (e) => {
  showScoring.classList.remove("hidden");
  e.parentElement.parentElement.parentElement.parentElement.remove();
  e.preventDefault();
};

let data = {};

let deleteChoiceInput = (e) => {
  e.parentElement.remove();
  // e.preventDefault();
};

add_quiz_icon.addEventListener("click", (e) => {
  e.preventDefault();
  showData();
  e.preventDefault();
});
let showData = (e) => {
  // create a new div element for the input field
  let inputGroup = document.createElement("div");
  inputGroup.className = "form-group position-relative";

  // create the input field
  let inputField = document.createElement("textarea");
  inputField.name = "question_choices[]";
  inputField.className = "form-control mb-2";
  inputField.classList.add("summernote-img"); // add the class to the input field
  inputField.style.border = "#555 solid 1px";
  inputField.style.marginRight = "1rem";
  inputField.required = true;

  // get the value of the last input field (if any)
  let inputs = boxesContainer.querySelectorAll(
    'textarea[name="question_choices[]"]'
  );
  if (inputs.length > 0) {
    // let lastValue = inputs[inputs.length - 1].value;
    inputField.value = "";
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
  };

  // append the input field and delete button to the input group
  inputGroup.appendChild(inputField);
  inputGroup.appendChild(deleteButton);
  inputGroup.appendChild(document.createElement("br"));

  // append the input group to the boxes container
  boxesContainer.appendChild(inputGroup);

  // initialize Summernote on the new input field
  $(inputField).summernote({
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
