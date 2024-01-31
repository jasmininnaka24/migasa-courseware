<?php 
  ob_start();
  session_start();
  include '../database.php';

  if($_SESSION['role'] !== 'Super Admin'){
    header("Location: ../hero_section.php");
  }

  if(isset($_POST['upload_template'])){
    
    $layout = $_POST['layout'];
    $role = $_POST['role'];
    $template_file = $_FILES['template_file']['name'];
    $template_file_temp = $_FILES['template_file']['tmp_name'];

    $uniqueId = str_pad(mt_rand(10, 99), 4, '0', STR_PAD_LEFT);

    $template_file = $uniqueId . "_" . $template_file;
    move_uploaded_file($template_file_temp, "../../../backend_storage/uploaded_certificate_templates/$template_file");

    if($layout === 'landscape'){
      $width = '11';
      $height = '8.2';
    } else {
      $height = '10.8';
      $width = '8.2';
    }

    $insert_template = $conn->prepare("INSERT INTO certificate_template (cert_img, width, height, role) VALUES (:template_file, :width, :height, :role)");
    $insert_template->bindParam(":template_file", $template_file);
    $insert_template->bindParam(":width", $width);
    $insert_template->bindParam(":height", $height);
    $insert_template->bindParam(":role", $role);
    $insert_template->execute();

    $cert_id = $conn->lastInsertId();

    // header("Location: ./certificate.php?cert_id=$cert_id");
    echo "
    <script>
    setTimeout(() => {
      document.querySelector('.added').classList.remove('hidden');
    }, 0100)
    setTimeout(() => {
      document.querySelector('.added').classList.add('hidden');
      document.location.href = './certificate.php?cert_id=$cert_id';
    }, 1000)
    </script>
  
    ";
  }


?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="../../assets/bootstrap-5.1.3-dist/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="../../assets/css/general_styles.css" />
    <link rel="stylesheet" href="../../assets/icons/fontawesome/css/all.css" />
    <link rel="stylesheet" href="../../assets/icons/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="../../assets/css/sidebar.css">
    <link rel="stylesheet" href="../../assets/css/admin_home.css">

    <title>Document</title>
    <style>

        .drop-zone {
          max-width: 400px;
          height: 200px;
          padding: 10px;
          display: flex;
          align-items: center;
          justify-content: center;
          text-align: center;
          font-family: "Quicksand", sans-serif;
          font-weight: 500;
          font-size: 20px;
          cursor: pointer;
          color: #777;
          border: 3px solid #444;
          border-radius: 10px;
        }

        .drop-zone--over {
          border-style: solid;
        }

        .drop-zone__input {
          display: none;
        }

        .drop-zone__thumb {
          width: 100%;
          height: 100%;
          border-radius: 10px;
          overflow: hidden;
          background-color: #cccccc;
          background-size: cover;
          position: relative;
        }

        .drop-zone__thumb::after {
          content: attr(data-label);
          position: absolute;
          bottom: 0;
          left: 0;
          width: 100%;
          padding: 5px 0;
          color: #ffffff;
          background: rgba(0, 0, 0, 0.75);
          font-size: 14px;
          text-align: center;
        }

    </style>
  </head>
  <body>

  <div class="added hidden position-fixed" style="top: 0; left: 0; z-index: 9999999 !important;">
    <div class="invalid_modal_container">
      <div class="invalid_modal d-flex flex-column" style="background: #ddf5d9; color: #444">
        <div class="h2">
        ✅ ADDED SUCCESSFULLY!
        </div>
      </div>
    </div>
  </div>

  <div class="deleted hidden position-fixed" style="top: 0; left: 0; z-index: 9999999 !important;">
    <div class="invalid_modal_container">
      <div class="invalid_modal d-flex flex-column" style="background: #ddf5d9; color: #444">
        <div class="h2">
        ✅ DELETED SUCCESSFULLY!
        </div>
      </div>
    </div>
  </div>


  <div class="sidebar close">
    <div class="logo-details">
      <a href="../../choose.php">
        <div class="img">
          <img src="../../assets/img/BIT TYP LOGO.png" width="100%" alt="">
        </div>
      </a>
    </div>
    <ul class="nav-links mt-2">
      <li class="list">
        <div class="icon-link list">
          <a href="#">
            <div class="img">
              <img src="../../assets/img/see.png" width="100%" alt="">
            </div>
            <span class="link_name">View</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">View Category</a></li>
          <li><a href="../../courses_display.php?language=all_languages"><i class="fa-solid fa-folder-open" style="font-size: 1rem;margin: -1rem -1.6rem;"></i> View Courses</a></li>
          <li><a href="../../view_lessons.php?language"><i class="fa-solid fa-video" style="font-size: 1rem;margin: -1rem -1.6rem;"></i> View Lessons</a></li>
        </ul>
      </li>

      <li>
        <div class="icon-link list">
          <a href="#">
            <div class="img">
              <img src="../../assets/img/create.png" width="100%" alt="">
            </div>
            <span class="link_name">Add</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li class="link_name">Add Category</a></li>
          <li><a href="../../read/course/adminCreateCourseUI.php?add_icon"><i class="fa-solid fa-folder-open" style="font-size: 1rem;margin: -1rem -1.6rem;"></i> Add Courses</a></li>
          <li><a href="../../read/videos/adminUploadVideoUI.php?language"><i class="fa-solid fa-video" style="font-size: 1rem;margin: -1rem -1.6rem;"></i> Add Lessons</a></li>
        </ul>
      </li>
      <li>
        <div class="icon-link list">
          <a href="#">
            <div class="img">
              <img src="../../assets/img/edit 2.png" width="100%" alt="">
            </div>
            <span class="link_name">Modify</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Modify Categories</a></li>
          <li><a href="../../modify_course.php?language"><i class="fa-solid fa-folder-open" style="font-size: 1rem;margin: -1rem -1.6rem;"></i> Modify Courses</a></li>
          <li><a href="../../modify_lessons.php?language"><i class="fa-solid fa-video" style="font-size: 1rem;margin: -1rem -1.6rem;"></i> Modify Lessons</a></li>
        </ul>
      </li>
      <li>
        <div class="icon-link list">
          <a href="#">
            <div class="img">
              <img src="../../assets/img/view.png" width="100%" alt="">
            </div>
            <span class="link_name">Settings</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Settings</a></li>
          <li><a href="../languages/language_home.php"><i class="fa-solid fa-globe" style="font-size: 1rem;margin: -1rem -1.6rem;"></i> Language Settings</a></li>
          <li><a href="../manual/admin_manual.php"><i class="fa-solid fa-book" style="font-size: 1rem;margin: -1rem -1.6rem;"></i> Manual Settings</a></li>
          <li><a href="../certificate/add_cert.php"><i class="fa-solid fa-book" style="font-size: 1rem;margin: -1rem -1.6rem;"></i> Certificate Settings</a></li>
        </ul>
      </li>
     
    <div class="profile-details ">
      <a href="../profile/admin_profile.php" class="d-flex align-items-center text-decoration-none hover_admin w-100">
        <div class="profile-content">
          <img src="../../assets/img/user.png" alt="profileImg">
        </div>
        <div class="name-job">
          <div class="profile_name font-bold" style="font-size:20px;">ADMIN PROFILE</div>
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
      <a href="../../choose.php" class="text-decoration-none">
        <button
          class="btn mt-2 mt-2 d-flex align-items-center justify-content-center"
          style="height: 2.5rem"
          name="admin_logout"
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


    <main class="container">
      <h1 style="color: #444" class="mb-5 text-center">LIST OF CERTIFICATES</h1>
      <div class="col-8 mx-auto">

        <div class="mb-4 d-flex align-items-center justify-content-center">
          <a href="./add_cert.php?add_cert">
            <div class="bgc-red-light btn rounded-pill" style="font-size: 18px;">Add a certificate template</div>
          </a>
        </div>
        <table class="table">
          <thead class="text-white" style="background: #444;">
            <tr>
              <th style="border-top-left-radius: 10px;"></th>
              <th>Certificate</th>
              <th style="width: 30%;">View</th>
              <th style="width: 30%; border-top-right-radius: 10px;">Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $get_certs = $conn->prepare("SELECT id, cert_img FROM certificate_Template");
              $get_certs->execute();

              $cert_count = 0;
              while($fetch_certs = $get_certs->fetch(PDO::FETCH_ASSOC)){
                $certificate_id = $fetch_certs['id'];
                $certificate = $fetch_certs['cert_img'];

                $cert_count += 1;
                ?>
                  <tr>
                    <td><?php echo $cert_count; ?></td>
                    <td>
                      <div style="width: 100px">
                        <img src="../../../backend_storage/uploaded_certificate_templates/<?php echo $certificate; ?>" width="100%" alt="">
                      </div>
                    </td>
                    <td><a href="./view_cert.php?view_cert=<?php echo $certificate_id ?>" class=" text-dark text-decoration-none"><div class="mt-3 rounded-pill font-med btn bgc-gray-light px-3" style="border: 1px solid #444; font-size: 16;">View</div></a></td>
                    <td><a href="./add_cert.php?delete=<?echo $certificate; ?>" onClick="return confirm('Are you sure you want to delete?')" class="text-dark text-decoration-none"><div class="mt-3 rounded-pill font-med btn bgc-gray-light px-3" style="border: 1px solid #444; font-size: 16;">Delete</div></a></td>
                  </tr>
                <?php
              }
            ?>
          </tbody>
        </table>
      </div>
    </main>

 
    <?php 
      if(isset($_GET['view'])){
        $certificate = $_GET['view'];
        ?>

          <div style="width: 800px; height: 550px; object-fit: cover; top: 1%; left: 17%; position: absolute; z-index: 9999 !important;">
            <a href="./add_cert.php" class="text-decoration-none">
              <p class="lead text-white text-end" style="font-size: 40px;">&times;</p>
            </a>

            <img width="100%" height="100%" src="../../../backend_storage/uploaded_certificate_templates/<?php echo $certificate; ?>" alt="">
          </div>

          <div class="overlay"></div>

      <?php }

      if(isset($_GET['delete'])){
        $certificate = $_GET['delete'];

        
        $select_cert_id = $conn->prepare("SELECT id FROM certificate_template WHERE cert_img = :cert_img");
        $select_cert_id->bindParam(":cert_img", $certificate);
        $select_cert_id->execute();
        
        $fetch_cert_id = $select_cert_id->fetch(PDO::FETCH_ASSOC);
        $certi_id = $fetch_cert_id['id'];
        
        $certificate = "../../../backend_storage/uploaded_certificate_templates/$certificate";

        unlink($certificate);

        $delete_cert_styles = $conn->prepare("DELETE FROM certificate_styles_table WHERE cert_id = :certi_id");
        $delete_cert_styles->bindParam(":certi_id", $certi_id);
        $delete_cert_styles->execute();

        $delete_cert = $conn->prepare("DELETE FROM certificate_template WHERE id = :certi_id");
        $delete_cert->bindParam(":certi_id", $certi_id);
        $delete_cert->execute();


        // header("Location: ./add_cert.php");
        echo "
        <script>
        setTimeout(() => {
          document.querySelector('.deleted').classList.remove('hidden');
        }, 0100)
        setTimeout(() => {
          document.querySelector('.deleted').classList.add('hidden');
          document.location.href = './add_cert.php';
        }, 1000)
        </script>
      
        ";
      }

      if(isset($_GET['add_cert'])){
        ?>
          <div class="w-75 bg-white position-absolute rounded-3" style="top: 8%;min-height: 80vh; z-index: 99999; left: 12%">
            <a href="./add_cert.php" class="text-end text-decoration-none text-dark">
              <p class="lead font-med mx-3 mt-2" style="font-size: 30px;">&times;</p>
            </a>

            <h3 class="text-center" style="color: #444">Upload a template</h3>

          <form action="" method="POST" enctype="multipart/form-data">
        
            <div class="drop-zone mt-4 mx-auto">
              <span class="drop-zone__prompt">Drop file here or click to upload</span>
              <input required type="file" name="template_file" class="drop-zone__input">
            </div>

            <div class="form-group col-5 mx-auto mt-3">
              <label for="" class="mb-1 font-med" style="font-size: 18px;">Select type of layout</label>
              <select name="layout" required class="form-control" id="" style="border: solid #444 2px;">
                <option value="">Select🔻</option>
                <option value="landscape">Landscape</option>
                <option value="portrait">Portrait</option>
              </select>
            </div>

            <div class="form-group col-5 mx-auto mt-3">
              <label for="" class="mb-1 font-med" style="font-size: 18px;">Select which role the template is for:</label>
              <select name="role" required class="form-control" id="" style="border: solid #444 2px;">
                <option value="">Select🔻</option>
                <option value="Professional">Professional</option>
                <option value="Student">Student</option>
              </select>
            </div>


            <div class="d-flex align-items-center justify-content-center mt-3">
              <button name="upload_template" class="btn bgc-red-light rounded-pill px-4 mb-4" style="font-size: 18px;">Upload</button>
            </div>
          </form>

          </div>
          <div class="overlay"></div>
        <?php
      }
    ?>



  </section>

  <script>
    document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
    const dropZoneElement = inputElement.closest(".drop-zone");

    dropZoneElement.addEventListener("click", (e) => {
      inputElement.click();
    });

    inputElement.addEventListener("change", (e) => {
      if (inputElement.files.length) {
        updateThumbnail(dropZoneElement, inputElement.files[0]);
      }
    });

    dropZoneElement.addEventListener("dragover", (e) => {
      e.preventDefault();
      dropZoneElement.classList.add("drop-zone--over");
    });

    ["dragleave", "dragend"].forEach((type) => {
      dropZoneElement.addEventListener(type, (e) => {
        dropZoneElement.classList.remove("drop-zone--over");
      });
    });

    dropZoneElement.addEventListener("drop", (e) => {
      e.preventDefault();

      if (e.dataTransfer.files.length) {
        inputElement.files = e.dataTransfer.files;
        updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
      }

      dropZoneElement.classList.remove("drop-zone--over");
    });
  });

  /**
   * Updates the thumbnail on a drop zone element.
   *
   * @param {HTMLElement} dropZoneElement
   * @param {File} file
   */
  function updateThumbnail(dropZoneElement, file) {
    let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");

    // First time - remove the prompt
    if (dropZoneElement.querySelector(".drop-zone__prompt")) {
      dropZoneElement.querySelector(".drop-zone__prompt").remove();
    }

    // First time - there is no thumbnail element, so lets create it
    if (!thumbnailElement) {
      thumbnailElement = document.createElement("div");
      thumbnailElement.classList.add("drop-zone__thumb");
      dropZoneElement.appendChild(thumbnailElement);
    }

    thumbnailElement.dataset.label = file.name;

    // Show thumbnail for image files
    if (file.type.startsWith("image/")) {
      const reader = new FileReader();

      reader.readAsDataURL(file);
      reader.onload = () => {
        thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
      };
    } else {
      thumbnailElement.style.backgroundImage = null;
    }
  }
  </script>

  <script src="../../assets/bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
  <script src="../../assets/icons/boxicons/dist/boxicons.js"></script>
  <script src="../../assets/js/modal.js"></script>
  <script src="../../assets/js/admin_sidebar.js"></script>
  <script src="../../assets/js/guide.js"></script>
  <script src="../../assets/js/activities_crudd.js"></script>
  <script src="../../assets/js/activities_list.js"></script>

  </body>
</html>