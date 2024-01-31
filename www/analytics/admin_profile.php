<?php
  ob_start();
  session_start();
  include './includes/database.php';
  include './includes/session_role.php';
  // include './category_includes/activity_folder/processingActivityFunctionality.php';
  // include './category_includes/scoring_folder/processingScoringFunctionality.php';
  include '../admin/category_includes/admin_profile/processingAdminFunctionality.php';

  include './includes/admin_header.php';
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="../../assets/bootstrap-5.1.3-dist/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="./assets/icons/fontawesome/css/all.css" />
    <link rel="stylesheet" href="./assets/icons/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="./assets/css/add_course.css">
    <link rel="stylesheet" href="./assets/css/general_styles.css" />
    <link rel="stylesheet" href="./assets/css/add_video.css">
    <link rel="stylesheet" href="./assets/css/admin_home.css">
    <link rel="stylesheet" href="./assets/css/course_display.css">
    <link rel="stylesheet" href="./assets/css/sidebar.css">    
    <link rel="stylesheet" href = "./assets/css/manual_style.css">
    <link rel="stylesheet" href = "./assets/css/verification.css">

    <title>Document</title>
  </head>

  <?php include './includes/admin_sidebar.php'; ?>
  <?php include './includes/admin_sidebar_section_header.php'; ?>

  <body class="">
    <main style="height: 90%;" class="w-100 d-flex align-items-center justify-content-center flex-column anim-to-top-slow">
    <div class="col-10">
      <div class="display-3 font-med mb-1">Admin Profile</div>
      <form action="" method="POST" enctype="multipart/form-data">
        <?php
          $username = $_SESSION['username'];
          $password = $_SESSION['password'];

          if(isset($username) && isset($password)){
            $cred = "SELECT * FROM user_table WHERE username = :username AND password = :password";
            $run_cred = $conn->prepare($cred);
            $run_cred->bindParam(":username", $username);
            $run_cred->bindParam(":password", $password);
            $run_cred->execute(); 
            
            $row = $run_cred->fetch(PDO::FETCH_ASSOC);
            $username = $row['username'];
            $salt = "@specialpassworddummyy";
            $encrypted_password = sha1($password.$salt);
            $original_password = $password;
            $password = $encrypted_password;
            $password = $row['password'];
            $question_recovery = $row['question_recovery'];
            $answer_recovery = $row['answer_recovery'];


            ?>   

            <div class="col-md-8">

              <br />
              <div
                class="form-group"
              >
                <label
                  for="title"
                  class="font-med"
                  style="margin-right: 1rem; font-size: 20px"
                  >Admin Username</label
                >
                <input
                  type="text"
                  id="title"
                  name="username"
                  class="form-control"
                  style="border: 0.1rem solid #888; font-size: 20px;"
                  value="<?php echo $username; ?>"
                />
              </div>



              <!-- recovery question -->
              <br />
      

              <!-- change password -->
              <div class="d-flex align-items-center mt-1">
                <a href="../admin/read/verification/forget_password_re_pass.php" class="font-reg text-dark text-decoration-none bgc-gray-light px-3 rounded-pill py-1" style="font-size: 18px; border: 1px solid #333;">Change Recovery Question or Answer</a>
                <a href="../admin/read/verification/forget_password_re_pass.php" class="font-reg text-dark text-decoration-none bgc-gray-light px-3 rounded-pill py-1 mx-2" style="font-size: 18px; border: 1px solid #333;">Change Password</a>
              </div>

            </div>
            
            <!-- BUTTON -->
            <div class="text-end">
              <button
                type="submit"
                name="update_cred"
                style="font-size: 18px"
                class="btn bgc-red-light rounded-pill mt-4"
              >
                Update
              </button>
            </div>


        <?php 
          }
        ?>
      </form>
    </div>
  </main>
  </section>

<?php include './includes/admin_footer.php'; ?>
