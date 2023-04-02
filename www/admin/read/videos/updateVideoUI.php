<?php 
  ob_start();
  session_start();
  include '../database.php';
  include '../../includes/session_role.php';
  include '../../category_includes/video_folder/uploadVideo.php';
  include '../../category_includes/video_folder/edit_video/updateVideoProcessor.php';
  include '../../category_includes/video_folder/processingVideoFunctionality.php';

  include '../a_includes/admin_header.php';

?>

  <!-- ERROR CONDITION-->
  <?php include '../../includes/error_condition.php' ?>
  <!-- MAIN -->
  <main style="min-height: 90%;" class="w-100 d-flex align-items-center justify-content-center flex-column anim-to-top-slow">
    <div class="container mt-4">
      <div class="row">
        <?php include '../../category_includes/video_folder/edit_video/updateVideoDetails.php'; ?>
      </div>        
    </div>
  </main>
</section>
<div class="overlay hidden"></div>

<?php include '../a_includes/admin_footer.php'; ?>
