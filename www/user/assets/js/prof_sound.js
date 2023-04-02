function playSoundAndRedirect() {
    var sound = document.getElementById("myAudio");
    sound.play();
    setTimeout(function(){
      window.location.href = '../../../user/professional_users/template/prof_desc.php';
    }, sound.duration * 1000);
  }
  

  