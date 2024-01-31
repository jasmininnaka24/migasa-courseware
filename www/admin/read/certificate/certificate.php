<?php 
  ob_start();
  session_start();
  include '../database.php';

  if($_SESSION['role'] !== 'Super Admin'){
    header("Location: ../hero_section.php");
  }


?>
   <?php
      if(isset($_POST['try_style'])){
        $_SESSION['name_pos_left'] = $_POST['name_pos_left'];
        $_SESSION['name_pos_top'] = $_POST['name_pos_top'];
        $_SESSION['name_pos_size'] = $_POST['name_pos_size'];

        $_SESSION['course_pos_left'] = $_POST['course_pos_left'];
        $_SESSION['course_pos_top'] = $_POST['course_pos_top'];
        $_SESSION['course_pos_size'] = $_POST['course_pos_size'];

        $_SESSION['date_pos_left'] = $_POST['date_pos_left'];
        $_SESSION['date_pos_top'] = $_POST['date_pos_top'];
        $_SESSION['date_pos_size'] = $_POST['date_pos_size'];
        
        $_SESSION['ave_pos_left'] = $_POST['ave_pos_left'];
        $_SESSION['ave_pos_top'] = $_POST['ave_pos_top'];
        $_SESSION['ave_pos_size'] = $_POST['ave_pos_size'];
        

      }

      if(isset($_POST['save_template'])){

        if(isset($_GET['cert_id'])){
          $cert_id = $_GET['cert_id'];
        }

        $name_pos_left = $_POST['name_pos_left'];
        $name_pos_top = $_POST['name_pos_top'];
        $name_pos_size = $_POST['name_pos_size'];

        $course_pos_left = $_POST['course_pos_left'];
        $course_pos_top = $_POST['course_pos_top'];
        $course_pos_size = $_POST['course_pos_size'];

        $date_pos_left = $_POST['date_pos_left'];
        $date_pos_top = $_POST['date_pos_top'];
        $date_pos_size = $_POST['date_pos_size'];
        
        $ave_pos_left = $_POST['ave_pos_left'];
        $ave_pos_top = $_POST['ave_pos_top'];
        $ave_pos_size = $_POST['ave_pos_size'];

        $insert_styles = $conn->prepare("INSERT INTO certificate_styles_table (cert_id, name_pos_left, name_pos_top, name_pos_size, course_pos_left, course_pos_top, course_pos_size, date_pos_left, date_pos_top, date_pos_size, ave_pos_left, ave_pos_top, ave_pos_size) VALUES (:cert_id, :name_pos_left, :name_pos_top, :name_pos_size, :course_pos_left, :course_pos_top, :course_pos_size, :date_pos_left, :date_pos_top, :date_pos_size, :ave_pos_left, :ave_pos_top, :ave_pos_size)");

        $insert_styles->bindParam(":cert_id", $cert_id);

        $insert_styles->bindParam(":name_pos_left", $name_pos_left);
        $insert_styles->bindParam(":name_pos_top", $name_pos_top);
        $insert_styles->bindParam(":name_pos_size", $name_pos_size);

        $insert_styles->bindParam(":course_pos_left", $course_pos_left);
        $insert_styles->bindParam(":course_pos_top", $course_pos_top);
        $insert_styles->bindParam(":course_pos_size", $course_pos_size);

        $insert_styles->bindParam(":date_pos_left", $date_pos_left);
        $insert_styles->bindParam(":date_pos_top", $date_pos_top);
        $insert_styles->bindParam(":date_pos_size", $date_pos_size);

        $insert_styles->bindParam(":ave_pos_left", $ave_pos_left);
        $insert_styles->bindParam(":ave_pos_top", $ave_pos_top);
        $insert_styles->bindParam(":ave_pos_size", $ave_pos_size);
        $insert_styles->execute();

        $_SESSION['name_pos_left'] = null;
        $_SESSION['name_pos_top'] = null;
        $_SESSION['name_pos_size'] = null;

        $_SESSION['course_pos_left'] = null;
        $_SESSION['course_pos_top'] = null;
        $_SESSION['course_pos_size'] = null;

        $_SESSION['date_pos_left'] = null;
        $_SESSION['date_pos_top'] = null;
        $_SESSION['date_pos_size'] = null;
        
        $_SESSION['ave_pos_left'] = null;
        $_SESSION['ave_pos_top'] = null;
        $_SESSION['ave_pos_size'] = null;

        // header("Location: ./view_cert.php?view_cert=$cert_id");
        echo "
        <script>
        setTimeout(() => {
          document.querySelector('.added').classList.remove('hidden');
        }, 0100)
        setTimeout(() => {
          document.querySelector('.added').classList.add('hidden');
          document.location.href = './view_cert.php?view_cert=$cert_id';
        }, 1000)
        </script>
      
        ";

      }
      if(isset($_POST['discard'])){
        if(isset($_GET['cert_id'])){
          $cert_id = $_GET['cert_id'];
        }
        
        $select_cert_img = $conn->prepare("SELECT cert_img FROM certificate_template WHERE id = :cert_id");
        $select_cert_img->bindParam(":cert_id", $cert_id);
        $select_cert_img->execute();
        
        $fetch_cert_img = $select_cert_img->fetch(PDO::FETCH_ASSOC);
        $cert_img = $fetch_cert_img['cert_img'];
        
        $cert_img = "../../../backend_storage/uploaded_certificate_templates/$cert_img";

        unlink($cert_img);

        $delete_cert = $conn->prepare("DELETE FROM certificate_template WHERE id = :cert_id");
        $delete_cert->bindParam(":cert_id", $cert_id);
        $delete_cert->execute();


        $_SESSION['name_pos_left'] = null;
        $_SESSION['name_pos_top'] = null;
        $_SESSION['name_pos_size'] = null;

        $_SESSION['course_pos_left'] = null;
        $_SESSION['course_pos_top'] = null;
        $_SESSION['course_pos_size'] = null;

        $_SESSION['date_pos_left'] = null;
        $_SESSION['date_pos_top'] = null;
        $_SESSION['date_pos_size'] = null;
        
        $_SESSION['ave_pos_left'] = null;
        $_SESSION['ave_pos_top'] = null;
        $_SESSION['ave_pos_size'] = null;

        header("Location: ./add_cert.php");
        // echo "
        // <script>
        // setTimeout(() => {
        //   document.querySelector('.deleted').classList.remove('hidden');
        // }, 0100)
        // setTimeout(() => {
        //   document.querySelector('.deleted').classList.add('hidden');
        //   document.location.href = './add_cert.php';
        // }, 1000)
        // </script>
      
        // ";
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
      href="../../assets/bootstrap-5.1.3-dist/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="../../assets/css/general_styles.css" />
    <link rel="stylesheet" href="../../assets/icons/fontawesome/css/all.css" />
    <link rel="stylesheet" href="../../assets/icons/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="../../assets/css/admin_home.css">

    <title>Document</title>
    <?php 
      if(isset($_GET['cert_id'])){
        $cert_id = $_GET['cert_id'];

        $select_width_height = $conn->prepare("SELECT width, height FROM certificate_template WHERE id = :cert_id");
        $select_width_height->bindParam(":cert_id", $cert_id);
        $select_width_height->execute();

        $fetch_width_height = $select_width_height->fetch(PDO::FETCH_ASSOC);
        $width = $fetch_width_height['width'];
        $height = $fetch_width_height['height'];
      }
    ?>
    <style>
      .certificate {
        width: <?php echo $width . 'in'; ?>;
        height: <?php echo $height . 'in'; ?>;
        border: 2px solid #999;
        object-fit: cover;
      }
    </style>
  </head>
  <body>



<div class="added hidden position-fixed" style="top: 0; left: 0; z-index: 9999999 !important;">
  <div class="invalid_modal_container">
    <div class="invalid_modal d-flex flex-column" style="background: #ddf5d9; color: #444">
      <div class="h2">
      ✅ SUCCESSFULLY SAVED!
      </div>
    </div>
  </div>
</div>

<div class="deleted hidden position-fixed" style="top: 0; left: 0; z-index: 9999999 !important;">
  <div class="invalid_modal_container">
    <div class="invalid_modal d-flex flex-column" style="background: #ddf5d9; color: #444">
      <div class="h2">
      ✅ SUCCESSFULLY DELETED!
      </div>
    </div>
  </div>
</div>



<section class="home-section">


<br>
    <main class="container mt-3">
      <h1 class="text-center" style="color: #444">Create a custom layout for certificate</h1>
      <div class="row mt-5">
        <div class="d-flex align-items-center justify-content-center">
          <div class="position-relative" >
            <p class="lead font-med position-absolute" style="left: <?php echo isset($_SESSION['name_pos_left']) ? $_SESSION['name_pos_left'] : '5'; ?>%; top: <?php echo isset($_SESSION['name_pos_top']) ? $_SESSION['name_pos_top'] : '5'; ?>%; font-size: <?php echo isset($_SESSION['name_pos_size']) ? $_SESSION['name_pos_size'] : '18'; ?>px">Anthony Rodriguez</p>


            <p class="lead font-med position-absolute" style="left: <?php echo isset($_SESSION['course_pos_left']) ? $_SESSION['course_pos_left'] : '5'; ?>%; top: <?php echo isset($_SESSION['course_pos_top']) ? $_SESSION['course_pos_top'] : '10'; ?>%; font-size: <?php echo isset($_SESSION['course_pos_size']) ? $_SESSION['course_pos_size'] : '18'; ?>px">Microsoft Office Powerpoint</p>


            <p class="lead font-med position-absolute" style="left: <?php echo isset($_SESSION['date_pos_left']) ? $_SESSION['date_pos_left'] : '5'; ?>%; top: <?php echo isset($_SESSION['date_pos_top']) ? $_SESSION['date_pos_top'] : '15'; ?>%; font-size: <?php echo isset($_SESSION['date_pos_size']) ? $_SESSION['date_pos_size'] : '18'; ?>px">2023-04-18</p>


            <p class="lead font-med position-absolute" style="left: <?php echo isset($_SESSION['ave_pos_left']) ? $_SESSION['ave_pos_left'] : '5'; ?>%; top: <?php echo isset($_SESSION['ave_pos_top']) ? $_SESSION['ave_pos_top'] : '20'; ?>%; font-size: <?php echo isset($_SESSION['ave_pos_size']) ? $_SESSION['ave_pos_size'] : '18'; ?>px">90%</p>

            <?php
              if(isset($_GET['cert_id'])){
                $cert_id = $_GET['cert_id'];
                $select_template_file = $conn->prepare("SELECT cert_img FROM certificate_template WHERE id = $cert_id");
                $select_template_file->execute();
                $fetch_template = $select_template_file->fetch(PDO::FETCH_ASSOC);
                $template_file = $fetch_template['cert_img'];
              }
            ?>

            <div class="certificate">
              <img src="../../../backend_storage/uploaded_certificate_templates/<?php echo $template_file; ?>" width="100%" height="100%" alt="">
            </div>
          </div>
        </div>

        <div class="col-12" style="margin-top: 3rem; margin-bottom: 2rem;">
          <form action="" method="POST">
            <div class="d-flex align-items-center justify-content-center">
              <div class="form-group mb-3 mx-3">
                <label class="lead font-med mb-1" for="">Name position: </label>
                <input type="text" name="name_pos_left" class="form-control mb-2" style="border: 2px solid #555;" value='<?php echo isset($_SESSION['name_pos_left']) ? $_SESSION['name_pos_left'] : ''; ?>' placeholder="e.g From left: 4% ">
                <input type="text" name="name_pos_top" class="form-control mb-2" style="border: 2px solid #555;" value='<?php echo isset($_SESSION['name_pos_top']) ? $_SESSION['name_pos_top'] : ''; ?>' placeholder="e.g From Top: 4% ">
                <input type="text" name="name_pos_size" class="form-control mb-2" style="border: 2px solid #555;" value='<?php echo isset($_SESSION['name_pos_size']) ? $_SESSION['name_pos_size'] : ''; ?>' placeholder="e.g Font size: 5px ">
              </div>
              <div class="form-group mb-3 mx-3">
                <label class="lead font-med mb-1" for="">Course position: </label>
                <input type="text" name="course_pos_left" class="form-control mb-2" style="border: 2px solid #555;" value='<?php echo isset($_SESSION['course_pos_left']) ? $_SESSION['course_pos_left'] : ''; ?>' placeholder="e.g From Left: 4% ">
                <input type="text" name="course_pos_top" class="form-control mb-2" style="border: 2px solid #555;" value='<?php echo isset($_SESSION['course_pos_top']) ? $_SESSION['course_pos_top'] : ''; ?>' placeholder="e.g From Top: 4% ">
                <input type="text" name="course_pos_size" class="form-control mb-2" style="border: 2px solid #555;" value='<?php echo isset($_SESSION['course_pos_size']) ? $_SESSION['course_pos_size'] : ''; ?>' placeholder="e.g Font size: 5px ">

              </div>
              <div class="form-group mb-3 mx-3">
                <label class="lead font-med mb-1" for="">Date position: </label>
                <input type="text" name="date_pos_left" class="form-control mb-2" style="border: 2px solid #555;" value='<?php echo isset($_SESSION['date_pos_left']) ? $_SESSION['date_pos_left'] : ''; ?>' placeholder="e.g From Left: 4% ">
                <input type="text" name="date_pos_top" class="form-control mb-2" style="border: 2px solid #555;" value='<?php echo isset($_SESSION['date_pos_top']) ? $_SESSION['date_pos_top'] : ''; ?>' placeholder="e.g From Top: 4% ">
                <input type="text" name="date_pos_size" class="form-control mb-2" style="border: 2px solid #555;" value='<?php echo isset($_SESSION['date_pos_size']) ? $_SESSION['date_pos_size'] : ''; ?>' placeholder="e.g Font size: 5px ">

              </div>
              <div class="form-group mb-3 mx-3">
                <label class="lead font-med mb-1" for="">Average position: </label>
                <input type="text" name="ave_pos_left" class="form-control mb-2" style="border: 2px solid #555;" value='<?php echo isset($_SESSION['ave_pos_left']) ? $_SESSION['ave_pos_left'] : ''; ?>' placeholder="e.g From Left: 4% ">
                <input type="text" name="ave_pos_top" class="form-control mb-2" style="border: 2px solid #555;" value='<?php echo isset($_SESSION['ave_pos_top']) ? $_SESSION['ave_pos_top'] : ''; ?>' placeholder="e.g From Top: 4% ">
                <input type="text" name="ave_pos_size" class="form-control mb-2" style="border: 2px solid #555;" value='<?php echo isset($_SESSION['ave_pos_size']) ? $_SESSION['ave_pos_size'] : ''; ?>' placeholder="e.g Font size: 5px ">
              </div>
            </div>
            <div class="mt-3 d-flex align-items-center justify-content-center">
              <button name="try_style" class=" mx-3 btn bgc-gray-light rounded-pill font-med w-25" style="font-size: 16px; border: 1px solid #444">Try it</button>
              <button onClick="return confirm('Once you save this, you cannot apply changes anymore. Are you sure you already want to save anyway?')" name="save_template" class=" mx-3 btn bgc-red-light rounded-pill font-med w-25" style="font-size: 16px;">Save this</button>
              <button onClick="return confirm('Are you sure you want to discard the process?')" name="discard" class=" mx-3 btn bgc-gray-light rounded-pill font-med w-25" style="font-size: 16px; border: 1px solid #444">Discard</button>
            </div>
          </form>
        </div>
      </div>
    </main>

 



  </section>


  <script src="../../assets/bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
  <script src="../../assets/icons/boxicons/dist/boxicons.js"></script>
  <script src="../../assets/js/modal.js"></script>
  <script src="../../assets/js/admin_sidebar.js"></script>
  <script src="../../assets/js/guide.js"></script>
  <script src="../../assets/js/activities_crudd.js"></script>
  <script src="../../assets/js/activities_list.js"></script>

  </body>
</html>