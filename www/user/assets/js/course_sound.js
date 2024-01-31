function playSoundAndRedirect() {
    var sound = document.getElementById("myAudio");
    sound.play();
    setTimeout(function(){
      window.location.href = '../../../user/student_users/template/courselisting.php';
    }, sound.duration * 999);
  }
  

  