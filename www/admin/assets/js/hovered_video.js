const video = document.querySelector('video');
const card = document.querySelector('.card');

card.addEventListener('mouseenter', () => {
  video.play();
});

card.addEventListener('mouseleave', () => {
  video.pause();
  video.currentTime = 0;
});


