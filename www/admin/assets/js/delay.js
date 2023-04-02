const myButton = document.getElementById('myButton');
const myAudio = document.getElementById('myAudio');

myButton.addEventListener('click', function() {
  myAudio.play();
  setTimeout(function() {
    window.location.href = '../courseprev.php';
  }, 10000); 
});
