function playSoundAndRedirect() {
    var sound = document.getElementById("myAudio");
    sound.play();
    setTimeout(function(){
      window.location.href = '../quiz.php';
    }, sound.duration * 1000);
  }
  

  