
<?php include './root_files/includes/root_header.php'; ?>

  <body>


  <!-- NAVBARRRRRRRRRRR -->
  <div class="container mt-4">
    <nav class="d-flex align-items-center justify-content-between">
      <div>
        <a href="./splash_page.php" >
          <div style="width: 3rem">
            <img src="./root_files/assets/img/MIGASA LOGO TYPE 3.png" width="100%" alt="" />
          </div>
        </a>
      </div>
      <div class="d-flex align-items-center">
        <a href="./login_system/login.php" class="d-flex align-items-center text-decoration-none">
          <div class="h5 mx-2 bgc-red-light btn rounded-pill px-3 font-med" style="font-size: 16px;">
            Log In
          </div>
        </a>
        <a href="./login_system/role.php" class="d-flex align-items-center text-decoration-none">
          <div class="h5 mx-2 bgc-gray-light btn rounded-pill px-3 font-med" style="font-size: 16px; border: #444 1px solid">
            Register
          </div>
        </a>
      </div>
    </nav>
  </div>
  <!-- END OF NAVBARRRRRRRRRRR -->





  <!-- CONTENTTTTTTTT -->
  <div class="container mt-5">
    <div class="display-3 text-center font-med">Dito mo na ilagay hero section</div>
    <div class="mt-5 d-flex align-items-center justify-content-center">
      <a href="./user/student_users/template/pick_language.php">
        <button class="btn bgc-red-light mx-3" style="width: 10rem;">Students</button>
      </a>
      <a href="./user/professional_users/template/pick_language.php">
        <button class="btn bgc-red-light mx-3" style="width: 10rem;">Professional Users</button>
      </a>
    </div>
  </div>
  <!-- END OF CONTENTTTTTT -->



  

<?php include './root_files/includes/root_footer.php'; ?>