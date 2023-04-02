<?php 
  ob_start();
  session_start();
  include '../database.php';
  include '../../includes/session_role.php';
  include '../../category_includes/course_folder/processingCourseFunctionality.php';
  ?>




  <?php
  include '../a_includes/admin_header.php';
  
  
  if(isset($_POST['discard_process'])){
    $courseIconFileName = $_SESSION['add_course_icon'];

    $file_path = "../../../backend_storage/uploaded_icons/$courseIconFileName";

    if (unlink($file_path)) {
      echo '';
    } 

    $_SESSION['add_course_icon'] = null;
    $_SESSION['add_title'] = null;
    $_SESSION['add_description'] = null;
    $_SESSION['add_language'] = null;

    header("Location: ../../choose.php");
  }

?>
  <style>
    .hidden{
      display: none;
    }

 
      html {
      --scrollbarBG: #eaeae5;
      --thumbBG: #555;
      }
      body::-webkit-scrollbar {
        width: 13px;
      }
      body {
        scrollbar-width: thin;
        scrollbar-color: var(--thumbBG) var(--scrollbarBG);
      }
      body::-webkit-scrollbar-track {
        background: var(--scrollbarBG);
      }
      body::-webkit-scrollbar-thumb {
        background-color: var(--thumbBG) ;
        border-radius: 6px;
        border: 3px solid var(--scrollbarBG);
      }

  </style>
  
<div class="container-fluid">


  </div>

  <!-- NAVIGATION -->

  <!-- ERROR CONDITION -->
  <?php include '../../includes/error_condition.php'; ?>
  
  <!-- MAIN -->
  <?php
    include '../../category_includes/course_folder/add_course/courseDetailsFormProvider.php';
  ?>

</section>
</div>
<div class="overlay hidden"></div>

  <script>
    function countCharacters() {
      var message = document.getElementById("message").value;
      var count = message.length;
      if (count > 250) {
        document.getElementById("message").value = message.substring(0, 250);
        count = 250;
      }
      document.getElementById("characterCount").innerHTML = count;
    }
  </script>
    
<?php include "../a_includes/admin_footer.php" ?>

