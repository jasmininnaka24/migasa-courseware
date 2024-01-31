<?php 
  ob_start();
  session_start();

  if(isset($_POST['professional'])){
    $_SESSION['reg_role'] = "Professional";
    header("Location: ./register.php?professional");
  }
  
  if(isset($_POST['student'])){
    $_SESSION['reg_role'] = "Student";
    header("Location: ./register.php?student");
  }

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="../admin/assets/bootstrap-5.1.3-dist/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="../admin/assets/css/general_styles.css" />
    <link rel="stylesheet" href="../admin/assets/css/add_video.css">
    <link rel="stylesheet" href="../admin/assets/icons/fontawesome/css/all.css">
    <title>Document</title>
  </head>
  <body class="bgc-gray-light">

  <section class="container-fluid">
    <div class="d-flex align-items-center justify-content-between">
      <div></div>
      <a href="../hero_section.php" class="text-decoration-none">
        <button
          class="btn mt-3 d-flex align-items-center justify-content-center"
          style="height: 2.5rem"
          name="admin_logout"
        >
          <p
            style="margin-right: 0.4rem; font-size: 18px"
            class="font-med pb-1"
            >
            Back 
          </p>
          <div class="pb-2">
            <img
            src="../admin/assets/img/exit 2.png"
            style="width: 20px; height: 16px; margin-top: -20px"
            width="100%"
            alt=""
            />
          </div>
        </button>
      </a>
    </div>

  </section>

    <main style="height: 90%; width: 90%; margin-top: 10%;" class="mx-auto anim-to-top-slow">
      <form action="" method="POST">
      <div class="row">

        <div style="height: 50%; border: #333 1px solid;" class="col-lg-5 col-md-8 col-sm-10  bg-white my-4 mx-auto rounded-3 d-flex flex-column align-items-center justify-content-center px-4">
          <div style="width: 60px;" class="mt-5 mb-3">
          <img src="../admin/assets/img/create_lesson.png" width="100%" alt="">
        </div>
        <div style="line-height: 2rem;" class="text-center font-med">
          Are you a student or Professional?
        </div>
        <div class="d-flex mt-3">
            <button name="student" class="btn bgc-red-light mx-2 d-flex align-items-center justify-content-center text-decoration-none mt-3 mb-5" style="width: 10rem; font-size: 18px; bottom: 15%; border: 1px solid #444;">
              Student
            </button>
            <button name="professional" class="btn bgc-red-light mx-2 d-flex align-items-center justify-content-center text-decoration-none mt-3 mb-5" style="width: 10rem; font-size: 18px; bottom: 15%; border: 1px solid #444;">
              Professional
            </button>
        </div>
      </div>
    </form>

    </div>
  </main>


    <div class="overlay hidden"></div>
    <script src="../admin/assets/bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
  </body>
</html>