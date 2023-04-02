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


      // adminpass - password
      ?>   

      <div class="col-md-8">

        <!-- admin username -->
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
          <a href="../../read/verification/update_qa_recovery.php" class="font-reg text-dark text-decoration-none bgc-gray-light px-3 rounded-pill py-1" style="font-size: 18px; border: 1px solid #333;">Change Recovery Question or Answer</a>
          <a href="../../read/verification/forget_password_re_pass.php" class="font-reg text-dark text-decoration-none bgc-gray-light px-3 rounded-pill py-1 mx-2" style="font-size: 18px; border: 1px solid #333;">Change Password</a>
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