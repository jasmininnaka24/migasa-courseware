
<?php include './root_files/includes/root_header.php'; ?>
<style>
  /* Tooltip styling */
  [title]:hover:after {
    content: attr(title);
    padding: 5px 10px;
    color: #fff;
    background-color: #000;
    position: absolute;
    z-index: 1;
    top: 100%;
    left: 50%;
    transform: translateX(-50%);
    white-space: nowrap;
    font-size: 12px;
    border-radius: 5px;
  }
  
</style>
  <body>


  <!-- NAVBARRRRRRRRRRR -->
  <div class="container mt-4">
    <nav class="d-flex align-items-center justify-content-between">
      <div>
        <a href="./splash_page.php" >
          <div style="width: 6rem">
            <img src="./root_files/assets/img/BIT TYP LOGO.png" width="100%" alt="" />
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
  <div class="container animateInfinite mt-5">
    <div class="row anim-to-top">
      <div class="d-flex align-items-center justify-content-center">
        <div style="width: 40%;">
          <img width="100%" src="./root_files/assets/img/BITBee HAPPY.png" alt="">
        </div>
        <!-- <div style="width: 40%;">
          <img width="100%" src="./root_files/assets/img/canva_1.png" alt="">
        </div> -->
      </div>
    </div>
  </div>
  <!-- END OF CONTENTTTTTT -->


  <a href="./about_us.php">
    <div class="position-absolute" style="bottom: 3%; left:7%; width: 2.5rem; height: 2.5rem; object-fit: cover;">
      <img width="100%" height="100%" src="./root_files/assets/img/letter-i.png" alt="" title="About Us">
    </div>
  </a>

  


<?php include './root_files/includes/root_header.php'; ?>
