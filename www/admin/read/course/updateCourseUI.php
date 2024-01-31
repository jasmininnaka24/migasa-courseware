<?php 
  ob_start();
  session_start();
  include '../database.php';
  include '../../includes/session_role.php';
  include '../../category_includes/course_folder/processingCourseFunctionality.php';
  include '../a_includes/admin_header.php';
?>

  <!-- ERROR CONDITION -->
  <?php include '../../includes/error_condition.php'; ?>
  <!-- MAIN -->
  <main style="min-height: 90%;" class="d-flex align-items-center flex-column vh-100">
    <div class="container mt-4">
      <div class="row">
        
        <?php include '../../category_includes/course_folder/edit_course/updateCourseDetails.php'; ?>
      </div>     
    </div>
  </main>

</section>


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

