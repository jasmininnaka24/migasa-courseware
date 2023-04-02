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
      <link rel="stylesheet" href="../../assets/css/quiz.css"  >
            
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
      <img src="../../s/img/BIT TYP LOGO.png" alt="Logo" width="18%" height="18%" class="d-inline-block align-text-middle me-2">
    </a>
    </div>
</div>
</nav>

<!--quiz-->
<div class="quizlet">
  <h3 class="font-bold">Question 1: Understanding the Internet</h3>
  <p class="font-med">What is the Internet?</p>
  <div class="answers">
    <div class="answer">
      <label class="font-reg">
        <input type="radio" name="answer" value="c">
        c. A global network of computers connected to each other. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam fuga mollitia expedita dolor facilis perspiciatis, rem quidem non ipsum rerum, debitis id! Mollitia temporibus autem veritatis odio minus eaque maxime?
      </label>
    </div>
    <div class="answer">
      <label>
        <input type="radio" name="answer" value="a">
        a. A type of food.
      </label>
    </div>
    <div class="answer">
      <label>
        <input type="radio" name="answer" value="b">
        b. A social network.
      </label>
    </div>
    <div class="answer">
      <label>
        <input type="radio" name="answer" value="d">
        d. A type of clothing.
      </label>
    </div>
  </div>
</div>

<div class="quizlet">
  <p class="font-med">What is the Internet?</p>
  <div class="answers">
  <div class="answer">
      <label>
        <input type="radio" name="answer" value="a">
        <img src="../../asstes/img/BIT TYP LOGO.png" width="50%" height = "50%"alt="Option a">
       
      </label>
    </div>
   
    <div class="answer">
      <label>
        <input type="radio" name="answer" value="a">
        <img src="../../assets/img/BIT TYP LOGO.png" width="50%" height = "50%"alt="Option a">
       
      </label>
    </div>
    <div class="answer">
      <label>
        <input type="radio" name="answer" value="a">
        <img src="../../assets/img/BIT TYP LOGO.png" width="50%" height = "50%"alt="Option a">
     
      </label>
    </div>
  </div>
</div>
<div class="quizlet">
  <p class="font-med">What is the Internet?</p>
  <div class="answers">
    <div class="answer">
      <textarea rows="5" cols="50" placeholder="Type your answer here"></textarea>
    </div>
  </div>

  <button type="button" class="btn btn-danger font-med" data-dismiss="modal" onclick="openModal()">Close</button>
</div>

      
<!-- Modal -->
<div id="congratulations-modal" class="modal">
  <div class="modal-content">
    <h2 class ="font-bold">Congratulations!</h2>
    <h3 class="font-med">You finished the quiz!</h3>
    <p class="font-med">You got 69 out of 420 questions right.</p>
    <button class="btn btn-start" onclick="location.href='../../student_users/template/course_desc.php'">Home</button>
  </div>
</div>


<script src = "../../assets/js/modal_quiz.js"></script> 


</body>
</html>