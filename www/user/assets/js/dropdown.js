
var dropdown = document.querySelector(".dropdown");
var dropdownButton = document.querySelector(".dropdown-button");
var dropdownContent = document.querySelector(".dropdown-content");


dropdownButton.addEventListener("click", function() {
  dropdownContent.style.display = "block";
});


window.addEventListener("click", function(event) {
  if (!dropdown.contains(event.target)) {
    dropdownContent.style.display = "none";
  }
});
