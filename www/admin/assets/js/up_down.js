const myButton = document.getElementById('myButton');
const myImageContainer = document.getElementById('myImageContainer');

myButton.addEventListener('click', () => {
  myImageContainer.classList.add('show');
  setTimeout(() => {
    window.location.href = '../courseprev.php';
  }, 1000); // Wait for the animation to finish before redirecting
});
