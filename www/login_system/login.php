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
   
   if(isset($_POST['login_btn'])){

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $salt = "@specialpassworddummyy";
    $encrypted_password = sha1($password.$salt);
    $password = $encrypted_password;

    $query = "SELECT * FROM user_table WHERE username = :username AND password = :password";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    $checkrow = 0;

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      $checkrow += 1;
      $user_id = $row['id'];
      $password = $row['password'];
      $username = $row['username'];
      $firstname = $row['firstname'];
      $lastname = $row['lastname'];
      $role = $row['role'];

      
    }
    
    if($checkrow == 1){
      

      // extracting data through sessions
      $_SESSION['user_id'] = $user_id;
      $_SESSION['password'] = $password;
      $_SESSION['username'] = $username;
      $_SESSION['firstname'] = $firstname;
      $_SESSION['lastname'] = $lastname;
      $_SESSION['role'] = $role;

      if($_SESSION['role'] == 'Super Admin'){
        echo
        "
        <script>
        setTimeout(() => {
          document.querySelector('.logging').classList.remove('hidden');
        }, 0000)
        setTimeout(() => {
          
          document.location.href = '../admin/choose.php';
          document.querySelector('.logging').classList.add('hidden');
        }, 1000)
        </script>
  
        ";

      } else if($_SESSION['role'] == 'Admin'){

        echo
        "
        <script>
        setTimeout(() => {
          document.querySelector('.logging').classList.remove('hidden');
        }, 0000)
        setTimeout(() => {
          
          document.location.href = '../analytics/main_dashboard.php';
          document.querySelector('.logging').classList.add('hidden');
        }, 1000)
        </script>
  
        ";

      } else if($_SESSION['role'] == 'Professional') {
        echo
        "
        <script>
        setTimeout(() => {
          document.querySelector('.logging').classList.remove('hidden');
        }, 0000)
        setTimeout(() => {
          
          document.location.href = '../user/professional_users/template/pick_language.php';
          document.querySelector('.logging').classList.add('hidden');
        }, 1000)
        </script>
  
        ";
    
      } else if($_SESSION['role'] == 'Student') {
        echo
        "
        <script>
        setTimeout(() => {
          document.querySelector('.invalid').classList.add('hidden');
          document.querySelector('.logging').classList.remove('hidden');
        }, 0000)
        setTimeout(() => {
          
          document.location.href = '../user/student_users/template/pick_language.php';
          document.querySelector('.logging').classList.add('hidden');
        }, 1000)
        </script>
  
        ";
        
      } 
    }else {
      echo
      "
      <script>
      setTimeout(() => {
        document.querySelector('.invalid').classList.remove('hidden');
      }, 0000);
      </script>

      ";
    }
  
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

      <!-- form overflow -->
    <div class="d-flex align-items-center flex-column">
      <div
      class="modals"
      style="min-height: 12rem; top: 20%; position: absolute"
      >
      <h3 class="logging p-3 text-center rounded-3 mb-4 hidden" style="background: #444; color: #fff; transition: all .5s ease-in; font-size: 1.2rem;">Logging in...</h3>

      <h3 class="invalid p-3 text-center rounded-3 mb-4 hidden" style="color: red; font-size: 1.2rem; border: 1px solid red">Invalid Input</h3>

        <h4 class="mt-2">LOG IN</h4>

        <form method="POST">
            <div class="form-group mx-5 mt-4 position-relative">
              <input
                type="text"
                name="username"
                class="form-control mt-2 px-3 py-2 bgc-gray-light rounded-3 font-med text-dark"
                placeholder="Username"
              />
              <input
                type="password"
                id="password"
                name="password"
                class="form-control mt-2 px-3 py-2 bgc-gray-light rounded-3 font-med text-dark"
                placeholder="Password"
                />
                <div class="show-password-toggle">
                  <i id="showPasswordButton" class="fa-sharp fa-solid fa-eye" onclick="togglePasswordVisibility(this)"></i>
                </div>
            </div>
            <div
              class="d-flex align-items-center justify-content-end mx-5 mt-3"
            >
              <button
                type="submit"
                style="font-size: 15px"
                class="w-100 btn bgc-red-light rounded-3 px-4 py-2 font-bold"
                name="login_btn"
              >
                Log In
              </button>
            </div>
        </form>
          <div class=" mt-4 ">
            <a href = "../admin/read/verification/forgot_pass_confirm_username.php" class="text-decoration-none">
              <p class="text-hover font-reg" style="font-size: 15px; transition: all .5s ease;">Forgot your password?<p>
            </a>
            <div class="mt-5">
              <a href = "./role.php" class="text-decoration-none" style="color: #777;">
                <p class="font-reg" style="font-size: 15px; transition: all .5s ease;">Don't have an account? <span class="font-med bold text-hover text-danger" style="transition: all .5s ease;">Register</span><p>
              </a>
            </div>
          </div>
      </div>
    </div>

    <div class="overlay hidden"></div>
    <script src="../admin/assets/bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
    <script src="../admin/assets/js/jquery-3.5.1.min.js"></script>
    <script src="../admin/assets/js/modals.js"></script>
    <script src="../admin/assets/js/change_pic.js"></script>
    <script src="../admin/assets/js/text_expand.js"></script>
    <script src="../admin/assets/js/animations.js"></script>
    <script>
      function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const showPasswordButton = document.getElementById('showPasswordButton');
        if (passwordInput.type === 'password') {
          passwordInput.type = 'text';
          showPasswordButton.classList.remove('fa-eye');
          showPasswordButton.classList.add('fa-eye-slash');
          showPasswordButton.setAttribute('title', 'Hide Password');
        } else {
          passwordInput.type = 'password';
          showPasswordButton.classList.remove('fa-eye-slash');
          showPasswordButton.classList.add('fa-eye');
          showPasswordButton.setAttribute('title', 'Show Password');
        }
      }

    </script>
  </body>
</html>