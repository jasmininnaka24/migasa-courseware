<?php

    ob_start();
    date_default_timezone_set('Asia/Manila');

    try {
        $conn = new PDO("sqlite:../database.db");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e) {
        echo 'Exception -> ';
        var_dump($e->getMessage());
    }

   session_start();
   
    if(isset($_POST['user_cred'])){
      $username = $_POST['username_val'];
      $password = $_POST['password_val'];

      $salt = "@specialpassworddummyy";
      $encrypted_password = sha1($password.$salt);
      $password = $encrypted_password;

      if(isset($_GET['user_id'])){
        $user_id = $_GET['user_id'];
      }

      $user_db = $conn->prepare("UPDATE user_table SET username = :username, password = :password WHERE id = :user_id");
      $user_db->bindParam(":username", $username);
      $user_db->bindParam(":password", $password);
      $user_db->bindParam(":user_id", $user_id);
      $user_db->execute();

      $_SESSION['reg_username'] = null;
      $_SESSION['reg_password'] = null;
      header("Location: ../login_system/login.php");
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
      href="../admin/assets//bootstrap-5.1.3-dist/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="../admin/assets//css/general_styles.css" />
    <link rel="stylesheet" href="../admin/assets//css/add_video.css">
    <link rel="stylesheet" href="../admin/assets//icons/fontawesome/css/all.css">
    <title>Document</title>
    <style>
      .langwi p {
        font-size: 30px;
      }
      .btn-gray {
        background-color: #c2beaa;
      }
      .btn {
        font-size: 22px;
      }
      .hidden {
        display: none;
      }

    .show-password-toggle {
			cursor: pointer;
			position: absolute;
			top: 75%;
			right: 10px;
      font-size: 22px;
      color: #555;
			transform: translateY(-50%);
		}
    .bold{
      color: #222;
    }
    .text-hover{
      color: #777;
    }
    .text-hover:hover{
      color: #f20e0e;
    }
      @media (max-width: 1100px) {
        .modals{
          width: 40%;
          left: 30%;
        }
      }
      @media (max-width: 860px) {
        .modals{
          width: 50%;
          left: 25%;
        }
      }
      @media (max-width: 700px) {
        .modals{
          width: 70%;
          left: 15%;
        }
      }
      @media (max-width: 550px) {
        .modals{
          width: 80%;
          left: 10%;
        }
      }
      @media (max-width: 400px) {
        .modals{
          width: 90%;
          left: 5%;
        }
      }
    </style>
  </head>
  <body class="bgc-gray-light">



  <main style="height: 90%; width: 90%; margin-top: 5%;" class="mx-auto anim-to-top-slow">
    <form action="" method="POST">
      <div class="row">

        <div style="height: 50%; border: #333 1px solid;" class="col-lg-5 col-md-8 col-sm-10  bg-white my-4 mx-auto rounded-3 d-flex flex-column align-items-center justify-content-center px-4">

        <div class="lead font-med text-center mt-5 px-2" style="color: #555; font-size: 18px;">Make sure to remember these login credentials, as you will need to use them to log in⚠️</div>
    

        <div class="mt-4">
          <div class="lead font-bold text-center mt-2 mb-3 px-2" style="color: #555; font-size: 15px;">You can either change your username and password or just keep them <span style="width: 4rem;">⬅️</span></div>
          <div class="input-group d-flex align-items-center">

            <label class="font-bold" style="margin-right: 1rem;" for="">Username</label>
            <?php
              if(isset($_SESSION['reg_username'])){
                $username = $_SESSION['reg_username'];
              }
              echo "<input class='form-control' style='border: 1px #444 solid;' type='text' name='username_val' value='$username'>";
            ?>
            
          </div>
          <br>

          <div class="input-group d-flex align-items-center">
            <label class="font-bold" style="margin-right: 1.3rem;" for="">Password</label>
            <?php
              if(isset($_SESSION['reg_password'])){
                $password = $_SESSION['reg_password'];
              }
              echo "<input class='form-control' style='border: 1px #444 solid;' type='text' name='password_val' value='$password'>";
            ?>
          </div>
        </div>
        <div class="d-flex mt-4">
          <form action="" method="POST">
            <button name='user_cred' class='btn bgc-red-light mx-2 d-flex align-items-center justify-content-center text-decoration-none mt-3 mb-5' style='width: 10rem; font-size: 18px; bottom: 15%; border: 1px solid #444;'>
              DONE
            </button>
          </form>

        </div>
      </div>

    </div>
    </form>
  </main>

    <div class="overlay hidden"></div>
    <script src="../admin/assets//bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
    <script src="../admin/assets//js/jquery-3.5.1.min.js"></script>
    <script src="../admin/assets//js/modals.js"></script>
    <script src="../admin/assets//js/change_pic.js"></script>
    <script src="../admin/assets//js/text_expand.js"></script>
    <script src="../admin/assets//js/animations.js"></script>

  </body>
</html>