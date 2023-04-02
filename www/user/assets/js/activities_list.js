let delete_this = (e) => {
  document.querySelector(".modals").classList.remove("hidden");
  document.querySelector(".overlay").classList.remove("hidden");
  e.preventDefault();
};

let toggleCheckboxes = (e) => {
  let checkboxes = document.querySelectorAll(".checkbox");
  let add_q_a = document.querySelector(".add_q_a");
  let done = document.querySelector(".done");
  let submit = document.querySelector(".submit");
  let selectall = document.querySelector(".selectall");
  let unselectall = document.querySelector(".unselectall");
  let genhide = document.querySelector(".genhide");

  Array.from(checkboxes).forEach((checkbox) =>
    checkbox.classList.toggle("hidden")
  );

  add_q_a.classList.toggle("hidden");
  done.classList.toggle("hidden");
  submit.classList.toggle("hidden");
  selectall.classList.toggle("hidden");
  unselectall.classList.toggle("hidden");
  genhide.classList.toggle("hidden");

  if (add_q_a.classList.contains("hidden")) {
    e.textContent = "Discard";
  } else {
    e.textContent = "Select activities to feature";
  }
};

// TO CHECK ALL BOXES
function checkAll() {
  let checkboxes = document.getElementsByTagName("input");
  for (let i = 0; i < checkboxes.length; i++) {
    if (checkboxes[i].type == "checkbox") {
      checkboxes[i].checked = true;
    }
  }
}

// TO UNCHECK ALL BOXES
function uncheckAll() {
  let checkboxes = document.getElementsByTagName("input");
  for (let i = 0; i < checkboxes.length; i++) {
    if (checkboxes[i].type == "checkbox") {
      checkboxes[i].checked = false;
    }
  }
}

// TO CHECK THE CHECKBOXES RANDOMLY
let unhideNumGenInp = (e) => {
  let checkboxes = document.querySelectorAll(".checkbox");
  let add_q_a = document.querySelector(".add_q_a");
  let selectacts = document.querySelector(".selectacts");
  let numGenInput = document.querySelector(".numGenInput");
  let done = document.querySelector(".done");

  add_q_a.classList.toggle("hidden");
  done.classList.toggle("hidden");
  selectacts.classList.toggle("hidden");
  numGenInput.classList.toggle("hidden");

  if (add_q_a.classList.contains("hidden")) {
    e.textContent = "Discard";
  } else {
    e.textContent = "Generate Random Activity";
  }
};

let gen_rand_num = (e) => {
  // Get references to all checkbox elements
  const numberInput = document.querySelector("#numberInput");
  const submitNumInp = document.querySelector(".submitNumInp");
  const changeInp = document.querySelector(".changeInp");
  const continueInp = document.querySelector(".continueInp");

  const numCheckboxesToCheck = parseInt(
    document.getElementById("numberInput").value
  );
  const checkboxes = document.querySelectorAll(".checkbox");

  // Shuffle the checkboxes randomly
  const shuffledCheckboxes = Array.from(checkboxes).sort(
    () => Math.random() - 0.5
  );

  let checkedCount = 0;
  for (let i = 0; i < shuffledCheckboxes.length; i++) {
    if (shuffledCheckboxes[i].type == "checkbox") {
      shuffledCheckboxes[i].checked = checkedCount < numCheckboxesToCheck;
      checkedCount += shuffledCheckboxes[i].checked ? 1 : 0;
    }
  }

  // Hide or show the checkboxes depending on their current state
  Array.from(checkboxes).forEach((checkbox) =>
    checkbox.classList.remove("hidden")
  );
};

let randomizeActsCheckbox = () => {};

let show_act_container = document.querySelector(".show_act_container");
let show_act_form = document.getElementById("show_act_form");
let done = document.querySelector(".done");
let done_id = document.getElementById("done");
let selectacts = document.querySelector(".selectacts");
let overlay = document.querySelector(".overlay");

let removeElement = (e) => {
  show_act_container.classList.remove("hidden");
  selectacts.classList.toggle("hidden");
  overlay.classList.toggle("hidden");
  done.classList.add("hidden");
  show_act_form.remove();
  e.preventDefault();
};

let prevDef = (e) => {
  done.classList.remove("hidden");
  e.preventDefault();
};

done.addEventListener("click", (e) => {
  show_act_form.classList.add("hidden");
  done_id.classList.add("hidden");
  document
    .querySelector(".showScoring")
    .classList.remove("hidden")
    .preventDefault();
  e.preventDefault();
});
