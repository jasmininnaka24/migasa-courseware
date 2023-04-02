<?php 
  ob_start();
  session_start();
  include '../database.php';
  include '../../includes/session_role.php';
  include '../../category_includes/course_folder/processingCourseFunctionality.php';
  include '../a_includes/admin_header.php';
  
?>
<div class="container-fluid">
  <!-- NAVIGATION -->


  <!-- ERROR CONDITION -->
  <?php include '../../includes/error_condition.php'; ?>
  <!-- MAIN -->
  <main style="min-height: 90%;" class="w-100 d-flex align-items-center justify-content-center flex-column anim-to-top-slow my-5">
    <div class="container">
      <div class="row">
          <?php include '../../category_includes/course_folder/add_course/courseDetailsFormProvider.php'; ?>

      </div>        
    </div>
  </main>
</div>
<div class="overlay hidden"></div>

  <script>
    function countCharacters() {
      var message = document.getElementById("message").value;
      var count = message.length;
      if (count > 150) {
        document.getElementById("message").value = message.substring(0, 150);
        count = 150;
      }
      document.getElementById("characterCount").innerHTML = count;
    }
  </script>
    
<?php include "../a_includes/admin_footer.php" ?>

