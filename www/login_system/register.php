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
   
   if(isset($_POST['register_btn'])){

    $firstname = ucwords(trim($_POST['firstname'])) ;
    $lastname = ucwords(trim($_POST['lastname'])) ;
    $group_name_id = strtolower(trim($_POST['group_name_id']));

    
    $role = $_SESSION['reg_role'];

    // GENERATES UNIQUE ID
    $uniqueId = str_pad(mt_rand(10, 99), 2, '0', STR_PAD_LEFT);
    $username = strtolower(str_replace(" ", "", $firstname). str_replace(" ", "", $lastname) . $uniqueId);
    
    if($role === 'Professional') {
      $role = 'Professional';
    }
    
    if($role === 'Student'){        
      $role = 'Student';
      
    } 
    
    $_SESSION['reg_username'] = $username;

    $password = $username;
    $_SESSION['reg_password'] = $password;

    $salt = "@specialpassworddummyy";
    $encrypted_password = sha1($password.$salt);

    $add_user = $conn->prepare("INSERT INTO user_table(username, firstname, lastname, password, question_recovery, answer_recovery, role, group_name_id) VALUES(:username, :firstname,:lastname, :password, :ques_recovery, :ans_recovery, :role, :group_name_id)");

    $ques_recovery = "What is your full name?";
    $ans_recovery = "" . $firstname . " " . $lastname . "";
    $ans_recovery = sha1($ans_recovery.$salt);

    $add_user->bindParam(":username", $username);
    $add_user->bindParam(":firstname", $firstname);
    $add_user->bindParam(":lastname", $lastname);
    $add_user->bindParam(":password", $encrypted_password);
    $add_user->bindParam(":ques_recovery", $ques_recovery);
    $add_user->bindParam(":ans_recovery", $ans_recovery);
    $add_user->bindParam(":role", $role);
    $add_user->bindParam(":group_name_id", $group_name_id);
    $add_user->execute();

    $user_id_db = $conn->prepare("SELECT * FROM user_table WHERE username = :username AND firstname = :firstname AND lastname = :lastname AND group_name_id = :group_name_id AND role = :role");

    $user_id_db->bindParam(":username", $username);
    $user_id_db->bindParam(":firstname", $firstname);
    $user_id_db->bindParam(":lastname", $lastname);
    $user_id_db->bindParam(":group_name_id", $group_name_id);
    $user_id_db->bindParam(":role", $role);
    $user_id_db->execute();

    $user_id_row = $user_id_db->fetch(PDO::FETCH_ASSOC);
    $user_id = $user_id_row['id'];
      
    echo
    "
    <script>
      setTimeout(() => {
        document.querySelector('.registered').classList.remove('hidden');
      }, 0000)
      setTimeout(() => {
        document.querySelector('.registered').classList.add('hidden');
        document.location.href = './remember_cred.php?user_role=$role&user_id=$user_id';
      }, 1000)
    </script>
    ";




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
      <div class="d-flex align-items-center">
        <a href="./role.php" class="text-decoration-none">
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
          Home
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
    </div>

  </section>

      <!-- form overflow -->
    <div class="d-flex align-items-center flex-column">
      <div
        class="modals"
        style="min-height: 12rem; top: 20%; position: absolute"
      >
      <h3 class="registered p-3 text-center rounded-3 hidden" style="background: #444; color: #fff; transition: all .5s ease-in; font-size: 1.2rem;">Successfully Registered!</h3>

      <h3 class="invalid p-3 text-center rounded-3 mb-4 hidden" style="color: red; font-size: 1.2rem; border: 1px solid red">Passwords did not match</h3>


        <h4 class="mt-2">REGISTER</h4>
        <form method="POST">
            <div class="form-group mx-5 mt-4 position-relative">
              <input
                type="text"
                name="firstname"
                class="form-control mt-2 px-3 py-2 bgc-gray-light rounded-3 font-med text-dark text-capitalize"
                placeholder="First name"
                required
              />
              <input
                type="text"
                name="lastname"
                class="form-control mt-2 px-3 py-2 bgc-gray-light rounded-3 font-med text-dark text-capitalize"
                placeholder="Last name"
                required
              />

              <?php
                $group_db_exists = $conn->prepare("SELECT * FROM user_group_table");
                $group_db_exists->execute();

                $group_count = 0;
                while($group_row = $group_db_exists->fetch(PDO::FETCH_ASSOC)){
                  $group_count += 1;
                }

                if($group_count > 0){ ?>
                  <select name="group_name_id" id="" class="form-control mt-2 px-3 py-2 bgc-gray-light rounded-3 font-med text-dark" required>
                    <option value="">Select Section🔻</option>
                    <?php
                      $group_db_exists = $conn->prepare("SELECT * FROM user_group_table");
                      $group_db_exists->execute();
                      while($group_row = $group_db_exists->fetch(PDO::FETCH_ASSOC)){
                        $group_name_id = $group_row['id'];
                        $group_name = $group_row['group_name'];
                        echo "<option class='text-capitalize' value='$group_name_id'>$group_name</option>";
                      }
                    ?>
                  </select>
                <?php }
              ?>

            </div>
            <div
              class="d-flex align-items-center justify-content-end mx-5 mt-3"
            >
              <button
                type="submit"
                style="font-size: 15px"
                class="w-100 btn bgc-red-light rounded-3 px-4 py-2 font-bold"
                name="register_btn"
              >
                Register
              </button>
            </div>
        </form>
          <div class=" mt-4 ">
            <div class="mt-5">
              <a href = "./login.php" class="text-decoration-none" style="color: #777;">
                <p class="font-reg" style="font-size: 15px; transition: all .5s ease;">Already have an account? <span class="font-med bold text-hover text-danger" style="transition: all .5s ease;">Log in</span><p>
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
  </body>
</html>