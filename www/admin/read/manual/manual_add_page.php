<?php
    ob_start();
    session_start();
    include '../database.php';
    include '../../includes/session_role.php';
    include '../../category_includes/manual_table/manual_functionality.php';
    include '../a_includes/admin_header.php';

?>
          <!-- header -->
          <div class="container-fluid anim-to-top-slow">
            <nav>
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-between mt-4 px-5">
                            <div class="d-flex py-3">
                                <div style="width: 4rem;">
                                    <img src="../../assets/img/migasa 2.png" width="100%" alt="">
                                </div>

                                <h2 style="margin-left: 2rem;" class="font-bold">Upload Manual</h2>
                            </div>

                        </div>
                    </div>
                </div>
            </nav>

    <!-- body -->
    <div class="container mt-4">
        <div class="row">
            <h2 class="font-reg">Upload Manual</h2>
            <br>
     
            <form method="POST" enctype="multipart/form-data">
                <div class="input-group mt-3">
                    <p for="manual_upload" class="font-med" style="font-size: 20px; margin-right: 2rem;">Upload File</p>
                    <div class="drop-zone">
                        <span class="drop-zone__prompt d-flex flex-column align-items-center">
                            <i class="fa-solid fa-cloud-arrow-up mb-2" style="font-size: 50px;"></i>
                            <span class="drop-zone__text">
                                Drop file here or click to upload
                            </span>
                        </span>
                        <input type="file" id="manual_pdf" name="manual_pdf" class="drop-zone__input" accept = "application/pdf">
                    </div>
                </div>
                <br>
                <div class="d-flex align-items-center justify-content-end">
                    <a href="./admin_manual.php">
                        <button type="submit" name="addManual" class="btn bgc-red-light rounded-pill font-med mx-3" style="width: 100px; font-size: 1px;">Discard</button>
                    </a>
                    <button type="submit" name="addManual" class="btn bgc-red-light rounded-pill font-med" style="width: 100px; font-size: 18px;">Save</button>
                </div>
            </form>
        </div>
        </div>

<?php include '../a_includes/admin_footer.php'; ?>