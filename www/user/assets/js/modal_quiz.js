function openModal() {
  var modal = document.getElementById("congratulations-modal");
  modal.style.display = "block";
}

function playSound() {
  var audio = new Audio("../../../user/assets/audios/cheerful.wav");
  audio.play();
}