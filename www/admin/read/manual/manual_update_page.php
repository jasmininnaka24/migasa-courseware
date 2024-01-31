<?php
    ob_start();
    session_start();
    include '../database.php';
    include '../../includes/session_role.php';
    include '../../category_includes/manual_table/manual_functionality.php';
    include '../a_includes/admin_header.php';

?>
<div class="updated hidden position-fixed" style="top: 0; left: 0; z-index: 9999;">
  <div class="invalid_modal_container">
    <div class="invalid_modal d-flex flex-column" style="background: #ddf5d9; color: #444">
      <div class="h2">
      ✅ UPDATED SUCCESSFULLY!
      </div>
    </div>
  </div>
</div>
    <!-- header -->
    <div class="container-fluid">
        <nav>
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between mt-4 px-5">
                        <div class="d-flex py-3">
                            <div style="width: 4rem;">
                                <img src="../../assets/img/BIT TYP LOGO.png" width="100%" alt="">
                            </div>

                            <h2 style="margin-left: 2rem;" class="font-bold">Update Manual</h2>
                        </div>

                    </div>
                </div>
            </div>
        </nav>

        <!--Main Body-->
        <div class="container mt-4">
        <div class="row">
            <br>
        <form method = "POST" enctype = "multipart/form-data">
            <div class="input-group mt-3">
                <p for="manual_upload" class="font-med" style="font-size: 20px; margin-right: 2rem;">Update File</p>
                <div class="drop-zone">
                    <?php
                        $id = $_GET['id'];
                        $query = "SELECT * FROM manual_table WHERE id = $id";
                        $result = $conn->prepare($query);
                        $result->execute();
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            echo "<input type=\"hidden\" name=\"id\" value=\"$id\">";
                            echo "<input type=\"file\" id=\"manual_pdf\" name=\"manual_pdf\" class=\"drop-zone__input\">";
                            echo "<p id=\"file-display\">$row[manual_pdf]</p>";
                        }
                    ?>       
                </div>    
            </div>
            <br>
            <div class="d-flex align-items-center justify-content-end">
                <a href="./admin_manual.php">
                    <div class="btn bgc-gray-light rounded-pill font-med mx-3" style="width: 100px; font-size: 18px; border: 1px solid #222;">Discard</div>
                </a>
                <button type="submit" name = "updateBtn" class="btn bgc-red-light rounded-pill font-med" style="width: 100px; font-size: 18px;">Update</button>
            </div>
        </form>
    <?php include '../a_includes/admin_footer.php'; ?>

