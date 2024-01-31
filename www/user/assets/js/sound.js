function playSoundAndRedirect() {
    var sound = document.getElementById("myAudio");
    sound.play();
    setTimeout(function(){
      window.location.href = '../../../user/student_users/template/course_vid.php';
    }, sound.duration * 999);
  }
  

  function enrollRedirect() {
    var sound = document.getElementById("myAudio");
    sound.play();
    setTimeout(function(){
      window.location.href = '../../../user/student_users/template/course.php';
    }, sound.duration * 999);
  }
  

  