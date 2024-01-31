<?php
    ob_start();
    session_start();
    include '../database.php';
    include '../../includes/session_role.php';
    include '../../category_includes/manual_table/manual_functionality.php';
    
    // NAVIGATION
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

  <body class="">


  <div class="deleted hidden position-fixed" style="top: 0; left: 0; z-index: 9999;">
  <div class="invalid_modal_container">
    <div class="invalid_modal d-flex flex-column" style="background: #ddf5d9; color: #444">
      <div class="h2">
      ✅ DELETED SUCCESSFULLY!
      </div>
    </div>
  </div>
</div>

  <?php
    include '../a_includes/admin_sidebar.php';
    include '../a_includes/admin_sidebar_section_header.php';
  ?>

    <style>
      .hover_course{
        background: #eaeae5;
        color: #222;
      }
      .hover_course:hover{
        color: #fff;
        background: #f20e0e;
        transition: all .2s ease-in-out;
      }
      .hover_course:focus{
        color: #fff;
        background: #f20e0e;
        transition: all .2s ease-in-out;
      }
      table {
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 20px;
        border: 1px solid #ddd;
      }

   
      .table td {
        text-align: left;
        padding: 10px;
        border: 1px solid #ddd;
      }

      .table th {
        background-color: #f2f2f2;
        /* border-top: 1px solid #ddd;
        border-left: 1px solid #ddd; */
      }

      .table button {
        border: none;
        padding: 8px 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 18px;
        margin-right: 5px;
        border-radius: 4px;
        outline: none;
      }



      .course, .video, .activity, .scoring{
        transition: all .2s linear;
      }
      .course:hover, .video:hover, .activity:hover, .scoring:hover{
        background: #f2f2f2;
      }
    </style>


    <!-- main body-->


<main style="min-height: 90%;" class="w-100 d-flex align-items-center  flex-column">
<div class="container">
    <?php 
      $manualPDFCount = $conn->prepare("SELECT * FROM manual_table");
      $manualPDFCount->execute();

      $manualCount = 0;
      while($manualPDFCount->fetch(PDO::FETCH_ASSOC)){ $manualCount += 1; }

      if($manualCount === 0){
          echo "
          <a href='./manual_add_page.php' class='d-flex align-items-center justify-content-center text-decoration-none'>
              <button type='submit' class='btn bgc-red-light font-reg rounded-pill px-3 my-3' style='font-size: 18px;'>+ Add Manual File</button>
          </a>
          <div class='text-center font-med display-4 py-5'>NO MANUAL FILE HAS BEEN UPLOADED</div>
          ";
      } else { ?>


    <div class="col-12 mx-auto text-center h5 my-4" style="color: #555;"> 
    Each element in the Video List column is interactive, allowing you to easily <span class="txt-primary">view the videos under a certain course</span> by simply <span class="txt-primary">clicking on the "See List of Videos" button.</span> Additionally, you can <span class="txt-primary"> edit and delete the course by clicking their buttons.</span>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th class="text-center">File Name</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>


        <?php
            $query = "SELECT * FROM manual_table";
            $query_run = $conn ->prepare($query);
            $query_run ->execute();

            while ($row = $query_run->fetch(PDO::FETCH_ASSOC)) {
                $manual_id = $row['id'];
                $manual_pdf = $row['manual_pdf'];
                ?>
                <tr>
                    <td class="text-center font-med course pt-3 w-50"><?php echo $manual_pdf; ?></td>
                    <td class="d-flex align-items-center justify-content-center">
                        <a href="manual_update_page.php?id=<?php echo $manual_id?>" class="text-decoration-none d-flex align-items-center justify-content-center mt-1">
                            <button class="bg-transparent rounded-pill px-4" style="border: #2e6341 1px solid; color: #2e6341;">Edit Manual</button>
                        </a>
                        <a onClick="return confirm('Are you sure you want to delete?')" href="./admin_manual.php?delete_manual_id=<?php echo $manual_id; ?>">      
                            <button class="rounded-pill bg-transparent" style="border: #cc2b0e 1px solid; color: #cc2b0e;">Delete Manual</button>
                        </a>
                    </td>
                </tr>
            <?php
            }
        ?>

        </tbody>
    </table>



        <?php
      }
    ?> 

    
    </div>
</main>
</section>

<?php include '../a_includes/admin_footer.php'; ?>
