<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link
      rel="stylesheet"
      href="../../assets/bootstrap-5.1.3-dist/css/bootstrap.min.css"
    >
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="../../assets/css/general_styles.css"  >
      <link rel="stylesheet" href="../../assets/css/videoB.css" >
      <link rel="stylesheet" href="../../assets/css/w3.css" >
     

      
      <title>LECTURE</title>
</head>
<body>





<!--navbar-->
<nav class="navbar navbar-expand-lg">
  <div class="container-fluid" style="display: flex; flex-direction: row; align-items: center;">
    <button class="navbar-toggler ms-auto align-middle order-2" type="button" id="navbarToggleBtn" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand me-auto order-1 slide-from-left" href="#">
      <img src="../../assets/img/BIT TYP LOGO.png" alt="Logo" width="18%" height="18%" class="d-inline-block align-text-middle me-2">
    </a>
    <div class="progress" style="width: 50%; height: 30px; position: absolute; left: 27%;">
  <div class="progress-bar bg-danger font-bold"  role="progressbar" style="width: 50%; " aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
</div>

    <div class="scale">
      <div class="help-container " style="position: absolute; top: 40px; right: 120px;">
        <div id="open-modal-btn">
          <a class="nav-link" href="#">
            <img src="../../assets/img/manual.png" width="30" height="30" alt="Manual">
            <span class="font-med" style="color: black;">Help</span>
          </a>
        </div>
      </div>
      <div class="exit-container " style="position: absolute; top: 40px; right: 50px;">
        <a class="nav-link" href="../../professional_users/template/prof_desc.php">
          <img src="../../assets/img/cancel.png" width="30" height="30" alt="Exit">
          <span class="font-reg" style="color: black;"> Exit</span>
        </a>
      </div>
    </div>
  </div>
</nav>


<!--video-->


<div class="container">
  <div class="row">
  <div class=" font-bold col-12">
    <h1 class="font-bold " style="text-align: center;">Lorem ipsum dolor sit, amet consectetur adipisicing . </h1>
    </div>
    <div class="col-8 ">
      <div class="video-player" style="border: 2.5px solid; width: 150%;">
      <video id="my-video" class="video-js vjs-big-play-centered" controls preload="auto">
  <source src="../../assets/videos/LESSON-1-Getting-Started-with-Power-Point-.webm" type="video/webm">
   <!-- need captions to progress -->
  <track kind="captions" src="../../assets/videos/LESSON-1-Getting-Started-with-Power-Point-.vtt" srclang="en" label="English">
  <p class="vjs-no-js">
    To view this video please enable JavaScript, and consider upgrading to a web browser that
    <!-- <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a> -->
  </p>
</video>
      </div>
    </div> 
  </div><br>
  <button id="myButton" class="btn-word font-bold" onclick="showModal()">
  <a href="#" class="btn stretched-link" style="color:white; font-size: 100%;">Quiz time!</a>
  <audio id="myAudio" src="../../assets/audios/pen1.wav"></audio>
</button> <Br><br>
</div>

<!--modal-->
<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close" >&times;</span>
    <h2 class ="font-bold"> Welcome to the Quiz!</h2>
    <p class="font-reg">Are you ready to test your knowledge? Answer the questions to see how well you do!</p>
    <button class="btn-start">
      <a href="../../professional_users/template/prof_quiz.php" style = "text-decoration: none; color: white;">
    Start Quiz</a></button>
  </div>
</div>


<script src = "../../assets/js/quiz_modal.js"></script> 
     <script src = "../../assets/js/video.js"></script> 
      <script src = "../../assets/js/sound_3.js"></script>  
  
</body>
</html>