function playSoundAndRedirect() {
    var sound = document.getElementById("myAudio");
    sound.play();
    setTimeout(function(){
      window.location.href = '../courseprev.php';
    }, sound.duration * 1000);
  }
  

  