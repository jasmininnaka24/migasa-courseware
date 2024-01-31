<?php
  ob_start();
  session_start();
  include '../database.php';
  // include '../../includes/session_role.php';
  include '../../category_includes/activity_folder/processingActivityFunctionality.php';
  include '../../category_includes/scoring_folder/processingScoringFunctionality.php';
  include '../../category_includes/admin_profile/processingAdminFunctionality.php';

  // include '../a_includes/admin_header.php';
  $session_role = $_SESSION['role'];

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
    <link rel="stylesheet" href="../../assets/icons/fontawesome/css/all.css" />
    <link rel="stylesheet" href="../../assets/icons/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="../../assets/css/add_course.css">
    <link rel="stylesheet" href="../../assets/css/general_styles.css" />
    <link rel="stylesheet" href="../../assets/css/add_video.css">
    <link rel="stylesheet" href="../../assets/css/admin_home.css">
    <link rel="stylesheet" href="../../assets/css/course_display.css">
    <link rel="stylesheet" href="../../assets/css/sidebar.css">    
    <link rel="stylesheet" href = "../../assets/css/manual_style.css">
    <link rel="stylesheet" href = "../../assets/css/verification.css">


    <title>Document</title>
  </head>

  <?php
  
    if($session_role === 'Super Admin'){
      
      include '../a_includes/admin_sidebar.php'; 
      ?>

<div class="updatedd hidden position-fixed" style="top: 0; left: 0; z-index: 9999;">
  <div class="invalid_modal_container">
    <div class="invalid_modal d-flex flex-column" style="background: #ddf5d9; color: #444">
      <div class="h2">
      ✅ UPDATED SUCCESSFULLY!
      </div>
    </div>
  </div>
</div>


<section class="home-section">
      <div class="d-flex align-items-center justify-content-between">
        <i class='bx bx-menu-alt-left' style="font-size: 38px; cursor: pointer;"></i>
        <i class="fa-regular fa-circle-xmark hidden" style="font-size: 30px; cursor: pointer;"></i>
        <a href="../../choose.php" class="text-decoration-none">
          <button
            class="btn mt-2 mt-2 d-flex align-items-center justify-content-center"
            style="height: 2.5rem"
            name="home"
          >
            <p
              style="margin-right: 0.4rem; font-size: 18px"
              class="font-med"
              >
              Home
            </p>
            <div>
              <img
              src="../../assets/img/exit 2.png"
              style="width: 20px; height: 16px; margin-top: -20px"
              width="100%"
              alt=""
              />
            </div>
          </button>
        </a>
      </div>

    <?php
    } else if($session_role === 'Admin') { ?>
      <div class="sidebar close">
    <div class="logo-details">
      <a href="../../../analytics/main_dashboard.php">
        <div class="img">
          <img src="../../../analytics/assets/img/BIT TYP LOGO.png" width="100%" alt="">
        </div>
      </a>
    </div>
    <ul class="nav-links mt-2">
      <li class="list">
        <div class="icon-link list">
          <a href="#">
            <div class="img">
              <img src="../../../analytics/assets/img/see.png" width="100%" alt="">
            </div>
            <span class="link_name">View</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">View Category</a></li>
          <li><a href="../../../analytics/user_tables.php"><i class="fa-solid fa-users" style="font-size: 1rem;margin: -1rem -1.6rem;"></i>  View User Table</a></li>
        </ul>
      </li>

      <li>
        <div class="icon-link list">
          <a href="#">
            <div class="img">
              <img src="../../../analytics/assets/img/create.png" width="100%" alt="">
            </div>
            <span class="link_name">Add</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li class="link_name">Add Category</a></li>
          <li><a href="../../../analytics/add_section.php"><i class="fa-solid fa-layer-group" style="font-size: 1rem;margin: -1rem -1.6rem;"></i> Add a section</a></li>
        </ul>
      </li>


        
        <div class="profile-details ">
          <a href="./admin_profile.php" class="d-flex align-items-center text-decoration-none hover_admin w-100">
            <div class="profile-content">
              <img src="../../../analytics/assets/img/user.png" alt="profileImg">
            </div>
            <div class="name-job">
              <div class="profile_name font-bold py-3" style="font-size:25px; color: #222">ADMIN</div>
            </div>
          </a>
        </div>
      </li>
    </ul>
    </div>


    <section class="home-section">
      <div class="d-flex align-items-center justify-content-between">
        <i class='bx bx-menu-alt-left' style="font-size: 38px; cursor: pointer;"></i>
        <i class="fa-regular fa-circle-xmark hidden" style="font-size: 30px; cursor: pointer;"></i>
        <a href="../../../analytics/main_dashboard.php" class="text-decoration-none">
          <button
            class="btn mt-2 mt-2 d-flex align-items-center justify-content-center"
            style="height: 2.5rem"
            name="home"
          >
            <p
              style="margin-right: 0.4rem; font-size: 18px"
              class="font-med"
              >
              Home
            </p>
            <div>
              <img
              src="../../../analytics/assets/img/exit 2.png"
              style="width: 20px; height: 16px; margin-top: -20px"
              width="100%"
              alt=""
              />
            </div>
          </button>
        </a>
      </div>
      
    <?php }
    ?>
  <body class="">
    <main style="height: 90%;" class="w-100 d-flex align-items-center justify-content-center flex-column">
      <div class="col-10">
        <div class="display-3 font-med mb-1">Admin Profile</div>
        <?php include "../../category_includes/admin_profile/adminDetailsFormProvider.php"; ?>
      </div>
    </main>
  </section>

<?php include '../a_includes/admin_footer.php'; ?>
