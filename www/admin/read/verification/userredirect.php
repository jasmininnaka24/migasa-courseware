<?php 
  ob_start();
  session_start();
  include '../a_includes/admin_header.php';
?>
<div class="bgc-gray-light w-100 h-100 position-absolute">

    <main style="width: 90%; margin-top: 7%;" class="mx-auto anim-to-top-slow">
      <form action="" method="POST">
      <div class="row">

        <div style="height: 50%; border: #333 1px solid;" class="col-lg-5 col-md-8 col-sm-10  bg-white my-4 mx-auto rounded-3 d-flex flex-column align-items-center justify-content-center px-4">

        <div style="line-height: 2rem;" class="mt-5 text-center font-med">
          Hello there👋🏻 As a user, you don't have the permission to change your password. If you wish to modify it, Let your instructor know and they will do it on your behalf.
        </div>
        <div class="d-flex mt-3">
          <a href="../../../hero_section.php" class="text-decoration-none">
            <div class="btn bgc-red-light mx-2 d-flex align-items-center justify-content-center text-decoration-none mt-3 mb-5" style="width: 10rem; font-size: 18px; bottom: 15%; border: 1px solid #444;">
              Okay
            </div>
          </a>
        </div>
      </div>
    </form>

    </div>
  </main>

  </div>
    <div class="overlay hidden"></div>
    <script src="../admin/assets/bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
  </body>
</html>