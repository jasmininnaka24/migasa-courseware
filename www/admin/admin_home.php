<?php 
  ob_start();
  session_start();

  include './includes/database.php';
  include './includes/session_role.php';
  include './category_includes/video_folder/processingVideoFunctionality.php';
  include './includes/admin_header.php';

  if(isset($_POST['admin_logout'])){
    $_SESSION['admin_password'] = null;
    $_SESSION['admin_username'] = null;
    $_SESSION['role'] = null;
    
    header("Location: ../hero_section.php");
  }

?>
<?php include './includes/admin_sidebar.php'; ?>
<section class="home-section">
    <div class="d-flex align-items-center justify-content-between">
      <i class='bx bx-menu-alt-left' style="font-size: 38px; cursor: pointer;"></i>
      <i class="fa-regular fa-circle-xmark hidden" style="font-size: 30px; cursor: pointer;"></i>
      <form action="" method="POST">
        <button
          class="btn mt-2 mt-2 d-flex align-items-center justify-content-center"
          style="height: 2.5rem"
          name="admin_logout"
        >
          <p
            style="margin-right: 0.4rem; font-size: 18px"
            class="font-med"
            >
            Log Out
          </p>
          <div>
          <img
            src="./assets/img/exit 2.png"
            style="width: 20px; height: 16px; margin-top: -20px"
            width="100%"
            />
          </div>
        </button>
      </form>
    </div>
    
      <main style="height: 90%;" class="w-100 d-flex align-items-center justify-content-center flex-column anim-to-top-slow">
    
        <div class="display-1 font-med text-center">WELCOME TO THE<br>ADMIN HOMEPAGE</div>
        <a href="./choose.php" class="mt-3" style="width: 10rem;">
          <button class="btn bgc-red-light rounded-pill px-3" style="font-size: 19px;">
            Get Started
          </button>
        </a>
    
      </main>
  </section>


    
  <div class="assistant_show hidden" style="z-index: 200; position: absolute; width: 15rem; right: 5%; bottom: 10%;">
    <img src="./assets/img/assistant.png" width="100%">
  </div>

  <!-- <div class="overlay hidden" style="z-index: 100;"></div> -->

<?php include './includes/admin_footer.php';?>