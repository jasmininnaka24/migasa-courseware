function playSoundAndRedirect() {
    var sound = document.getElementById("myAudio");
    sound.play();
    setTimeout(function(){
      window.location.href = '../lecturevid.php';
    }, sound.duration * 1000);
  }
  

  