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

    header("Location: ../../courses_display.php?language=all_languages");
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
    <div class="added hidden position-fixed" style="top: 0; left: 0; z-index: 9999;">
  <div class="invalid_modal_container">
    <div class="invalid_modal d-flex flex-column" style="background: #ddf5d9; color: #444">
      <div class="h2">
      ✅ CREATED SUCCESSFULLY!
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">

<form action="" method="POST">
    <button onClick="return confirm('Changes not saved. Are you sure?')" class="position-absolute bg-transparent" style="font-size: 30px; top: 5%; right: 5%; border: none" name="discard_process">
      &times;
    </button>
  </form>
  </div>

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

