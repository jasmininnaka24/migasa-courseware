var editModal = document.getElementById('edit-modal');
  
var cancelBtn = document.getElementById('cancelBtn');

var editButtons = document.querySelectorAll('.edit-button');
  
  editButtons.forEach(function(button) {
    button.addEventListener('click', function() {
      
      var language = button.getAttribute('data-language');
      var id = button.getAttribute('data-id');
    
      document.getElementById('language').value = language;
      var lang_id = document.getElementById('id').value = id;
      console.log(lang_id);

      editModal.style.display = 'block';
    });
  });

  var buttons = document.querySelectorAll('.edit-button');
    buttons.forEach(function(button) {
        button.addEventListener('click', function() {
            //var language_icons = document.querySelector('.icons');
            var language = document.querySelector('.language');
            var language_description = document.querySelector('.language_description');
            var language_id = this.getAttribute('data-language');
            var language_description_id = this.getAttribute('data-description');
            //var language_icons_val = this.getAttribute('data-icons');
            
            language.placeholder = language_id;
            language_description.placeholder = language_description_id;
            //language_icons.value = language_icons_val.split(',').join(';');
            console.log('The button was clicked.');
        });
    });

   
//edit count character
function cntCharacters(){
  var maxLength = 100;
  var currentLength = document.getElementById('updateMessage').value.length;
  var charCount = document.getElementById("charCount");
  charCount.innerHTML = currentLength + "/" + maxLength;
}

  