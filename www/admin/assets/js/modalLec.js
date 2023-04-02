var modal = document.getElementById('helpModal');
// Get the button that opens the modal
var modalBtn = document.getElementById('open-modal-btn');
// Get the close button
var closeBtn = document.getElementsByClassName('close')[0];



// Listen for a click on the button
modalBtn.addEventListener('click', openModal);

// Listen for a click on the close button
closeBtn.addEventListener('click', closeModal);

// Listen for a click outside the modal
window.addEventListener('click', outsideClick);

// Function to open the modal
function openModal() {
  modal.style.display = 'block';
}

// Function to close the modal
function closeModal() {
  modal.style.display = 'none';
}

// Function to close the modal if clicked outside
function outsideClick(e) {
  if (e.target == modal) {
    modal.style.display = 'none';
  }
}