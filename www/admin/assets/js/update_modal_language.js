//edit modal function
var updateModal = document.getElementById('edit-modal');
  
var cancelBtn = document.getElementById('cancelBtn');

var editButtons = document.querySelectorAll('.edit-button');
  
  deleteButtons.forEach(function(button) {
    button.addEventListener('click', function() {
      
      var language = button.getAttribute('data-language');
      var id = button.getAttribute('data-id');
    
      document.getElementById('language').value = language;
      document.getElementById('id').value = id;

      deleteModal.style.display = 'block';
    });
  });

  function getButtonId(event) {
    const button = event.target;
    const id = button.getAttribute('data-id');
    const language = button.getAttribute('data-language');
    var lang_id = document.getElementById('language_id');
    var lang_name = document.getElementById('language_name');
    lang_id.value = id;
    lang_name.innerHTML = language;
  }



  //show file name
  function displayFileNames() {
    const fileInput = document.getElementById('language_icon');
    const fileNames = document.getElementById('fileName');
    if (fileInput.files.length > 0) {
      fileNames.style.display = 'none';
    } else {
      fileNames.style.display = 'inline';
    }
  }
  const editButtons = document.querySelectorAll('.edit-button');
  const editModal = document.getElementById('edit-modal');
  const editIdInput = document.getElementById('edit-id');

  //edit count character
function cntCharacters(){
    var maxLength = 100;
    var currentLength = document.getElementById('updateMessage').value.length;
    var charCount = document.getElementById("charCount");
    charCount.innerHTML = currentLength + "/" + maxLength;
  }
    