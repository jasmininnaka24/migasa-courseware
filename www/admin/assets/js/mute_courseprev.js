const audio = document.getElementById("autoA");

function toggleMute() {
  if (audio.muted) {
    audio.muted = false;
    muteBtn.innerHTML = "Mute";
  } else {
    audio.muted = true;
    muteBtn.innerHTML = "Unmute";
  }
}

function setVolume(volume) {
  audio.volume = volume;
}

const muteBtn = document.getElementById('mute-btn');
muteBtn.addEventListener('click', toggleMute);

const volumeBtn = document.querySelector('.children-friendly');
volumeBtn.addEventListener('click', function(event) {
  const volumeContainer = event.currentTarget.querySelector('.volume-container');
  if (volumeContainer.style.display === 'block') {
    volumeContainer.style.display = 'none';
  } else {
    volumeContainer.style.display = 'block';
  }
});

const volumeSlider = document.getElementById('volume-slider');
volumeSlider.addEventListener('input', function() {
  setVolume(this.value);
});