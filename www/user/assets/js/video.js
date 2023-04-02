const video = document.getElementById("myVideo");
const playButton = document.getElementById("play-pause-button");
const muteButton = document.getElementById("mute-button");
const volumeBar = document.getElementById("volume-bar");
const progressBar = document.getElementById("progress-bar");
const captionButton = document.getElementById("caption-button");
const fullscreenButton = document.getElementById("fullscreen-button");

// Toggle play/pause on click
playButton.addEventListener("click", function() {
  if (video.paused || video.ended) {
    video.play();
    playButton.classList.add("playing");
  } else {
    video.pause();
    playButton.classList.remove("playing");
  }
});

// Toggle mute/unmute on click
muteButton.addEventListener("click", function() {
  if (video.muted) {
    video.muted = false;
    muteButton.classList.remove("muted");
  } else {
    video.muted = true;
    muteButton.classList.add("muted");
  }
});

// Update volume on input
volumeBar.addEventListener("input", function() {
  video.volume = volumeBar.value / 100;
  if (video.volume === 0) {
    muteButton.classList.add("muted");
  } else if (video.volume < 0.5) {
    muteButton.classList.add("low-volume-button");
    muteButton.classList.remove("muted");
  } else {
    muteButton.classList.remove("low-volume-button");
    muteButton.classList.remove("muted");
  }
});

// Update progress bar on timeupdate
video.addEventListener("timeupdate", function() {
  const progress = (video.currentTime / video.duration) * 100;
  progressBar.style.width = progress + "%";
});

// Seek on click on progress bar
progressBar.addEventListener("click", function(e) {
  const pos = (e.pageX - this.offsetLeft) / this.offsetWidth;
  video.currentTime = pos * video.duration;
});

captionButton.addEventListener("click", function() {
  // Do something when the caption button is clicked
});

fullscreenButton.addEventListener("click", function() {
  if (video.requestFullscreen) {
    video.requestFullscreen();
  } else if (video.webkitRequestFullscreen) {
    video.webkitRequestFullscreen();
  } else if (video.mozRequestFullScreen) {
    video.mozRequestFullScreen();
  } else if (video.msRequestFullscreen) {
    video.msRequestFullscreen();
  }
});
