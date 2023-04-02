function playSoundAndRedirect() {
    var sound = document.getElementById("myAudio");
    sound.play();
    setTimeout(function(){
      window.location.href = '../languages/eng_page.php';
    }, sound.duration * 1000);
  }
  

  