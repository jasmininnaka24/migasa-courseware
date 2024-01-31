// add modal function
function openAddModal() {
  var addModal = document.getElementById("addModal");
  addModal.style.display = "block";
}

function openEditModal() {
  var editModal = document.getElementById("editModal");
  editModal.style.display = "block";
}

var addButton = document.getElementById("add-button");
addButton.onclick = openAddModal;




//add show file names
function displayFileNames() {
  const fileInput = document.getElementById('language_icon');
  const fileNames = document.getElementById('file_name');
  if (fileInput.files.length > 0) {
    fileNames.style.display = 'none';
  } else {
    fileNames.style.display = 'inline';
  }
}

const fileInput = document.getElementById('language_icon');
const fileList = document.querySelector('.file-list');

fileInput.addEventListener('change', () => {
  const files = fileInput.files;

  for (let i = 0; i < files.length; i++) {
    const file = files[i];
    const listItem = document.createElement('li');
    const fileName = document.createElement('span');
    const removeButton = document.createElement('button');

    fileName.textContent = file.name;
    removeButton.textContent = 'X';
    removeButton.addEventListener('click', () => {
      listItem.remove();
    });

    listItem.appendChild(fileName);
    listItem.appendChild(removeButton);
    fileList.appendChild(listItem);
  }
});

//edit modal function
var editModal = document.getElementById('edit-modal');
  
var cancelBtn = document.getElementById('cancelBtn');

var editButtons = document.querySelectorAll('.edit-button');
  
  editButtons.forEach(function(button) {
    button.addEventListener('click', function() {
      
      var language = button.getAttribute('data-language');
      var id = button.getAttribute('data-id');
    
      document.getElementById('language').value = language;
      document.getElementById('id').value = id;

      editModal.style.display = 'block';
    });
  });



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
  function openFileUpload() {
    document.getElementById('upload_file').click();
}

function countCharacters() {
  var maxLength = 15; // Set the maximum length of the textarea
  var currentLength = document.getElementById("message").value.length; // Get the current length of the textarea
  var characterCount = document.getElementById("characterCount"); // Get the span element to display the character count
  characterCount.innerHTML = currentLength + "/" + maxLength; // Update the text of the span element
}

var messageTextarea = document.getElementById("message");
messageTextarea.addEventListener("keyup", countCharacters);




