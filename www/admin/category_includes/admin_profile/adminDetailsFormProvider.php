<form action="" method="POST" enctype="multipart/form-data">
  <?php
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];



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
          
          <a href="../../read/verification/update_qa_recovery.php" class="font-reg text-dark text-decoration-none bgc-gray-light px-3 rounded-pill py-1" style="font-size: 18px; border: 1px solid #333;">Change Recovery Question or Answer</a>

          <a href="../../read/verification/forget_password_re_pass.php" class="font-reg text-dark text-decoration-none bgc-gray-light px-3 rounded-pill py-1 mx-2" style="font-size: 18px; border: 1px solid #333;">Change Password</a>
        </div>


      </div>
      
      <!-- BUTTON -->
      <div class="text-end container-fluid">
        <button
          type="submit"
          name="update_cred"
          style="font-size: 18px"
          class="btn bgc-red-light rounded-pill mt-4"
        >
          Update
        </button>
      </div>


 
</form>