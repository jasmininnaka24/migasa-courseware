const lessonCard = document.getElementById('lesson-card');

lessonCard.addEventListener('click', () => {
  lessonCard.classList.add('shake');
  
  // Remove the shake class after the animation finishes
  setTimeout(() => {
    lessonCard.classList.remove('shake');
  }, 500);
});


const card = document.querySelector('#lesson-card');

card.addEventListener('click', () => {
  const sound = document.getElementById('card-sound');
  sound.currentTime = 0;
  sound.play();
});
