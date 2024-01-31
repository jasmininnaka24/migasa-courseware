//delete modal function
var deleteModal = document.getElementById('delete-modal');
var cancelBtn = document.getElementById('cancelBtn');
var deleteButtons = document.querySelectorAll('.delete-button');
  
deleteButtons.forEach(function(button) {
  button.addEventListener('click', function(event) {      
    var language = button.getAttribute('data-language');
    var id = button.getAttribute('data-id');
    console.log(id);
    document.getElementById('language').value = language;
    document.getElementById('id').value = id;
    deleteModal.style.display = 'block';
  });
});

cancelBtn.addEventListener('click', function(event) {
  deleteModal.style.display = 'none';
});


 