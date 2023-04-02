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
    <link rel="stylesheet" href="../../assets/css/general_styles.css"  >
    <link rel="stylesheet" href="../../assets/css/pick_language.css"  >

</head>
<body>

<audio autoplay>
  <source src="../../assets/audios/intro.wav" >
  Your browser does not support the audio element.
</audio>
    <div class="container ">
      <nav>
        <div class="row">
          <div  class="pt-2 position-sticky slide-from-left-2">
            <a href="./index.php">
              <img src="../../assets/img/BIT TYP LOGO.png" width="13%" alt="" />
            </a>
          </div>
        </div>
        <div class="container-fluid">
  <div class="row justify-content-center" >
    <div class="col-lg-8 col-md-12 d-flex flex-column align-items-center justify-content-center langwi">
      <h2 class="  font-bold mb-5 text-center">Please Pick a language.  <p class="font-italic " style="font-size: 100%;">Maari lamang ay pumili ng Wika. </p> </h2>
      <div class="row justify-content-center">
  <div class="col-12 col-sm-6 col-md-6 mb-5">
    <div class="card border-0 shadow-lg mb-5 card-expanded shadow slideup1" style="height: 400px;  ">
      <img id="image2" src="../../assets/img/english.png" alt="Image" class="card-img-top"><br><Br>
      <div class="card-body text-center">
        <h2 class="card-title mb-0 font-weight-bold font-bold" style="font-size:40px">English</h2>
        <button  id="myButton" class="btn btn-primary font-reg mt-3" onclick="playSoundAndRedirect()">
          <a href="#" class="font-bold" style="color: white; text-decoration: none;">Learn more!</a>
          <audio id="myAudio" src="../../assets/audios/pen1.wav"></audio>
        </button>
      </div>
    </div>
  </div>
  <div class="col-12 col-sm-6 col-md-6 mb-5" >
    <div class="card border-0 shadow-lg mb-5 card-expanded shadow slideup1" style="height: 400px;  ">
      <img id="image" src="../../assets/img/pinoyflag.png" alt="Image" class="card-img-top first-image"><br><br>
      <div class="card-body text-center">
        <h2 class="card-title mb-0 font-weight-bold font-bold" style="font-size: 40px;">Filipino</h2>
        <button class="btn btn-primary font-reg mt-3">
          <a href="#" class="font-bold" style="color:white; text-decoration: none;">Matuto rito!</a>
        </button>
      </div>
    </div>
  </div>
</div>

      <script src = "../../assets/js/pick_language.js"></script>
      <script src = "../../assets/js/language_sound.js"></script>  
</body>
</html>