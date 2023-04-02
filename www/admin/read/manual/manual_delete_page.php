<?php
    ob_start();
    session_start();
    include '../database.php';
    include '../../includes/session_role.php';
    include '../../category_includes/manual_table/manual_functionality.php';
    include '../a_includes/admin_header.php';
?>

      <!-- header -->
      <div class="container-fluid">
        <nav>
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between mt-4 px-5">
                         <div class="d-flex py-3">
                            <div style="width: 4rem;">
                                <img src="../../assets/img/migasa 2.png" width="100%" alt="">
                            </div>

                            <h2 style="margin-left: 2rem;" class="font-bold">Admin</h2>
                        </div>

                        <a href="./admin_manual.php" class="text-decoration-none d-flex align-items-center">
                            <button class="btn mt-3 d-flex align-items-center justify-content-center" style="height: 2.5rem">
                                <p style="margin-right: 0.4rem; font-size: 18px" class="font-med">Back</p>
                                <div>
                                    <img src="../../assets/img/exit.png" style="width: 20px; height: 16px; margin-top: -20px" width="100%" alt=""/>
                                </div>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- main body -->
        <div class="container mt-4">
            <div class="row">
                <h2 class="font-reg">Delete Manual</h2>
                <br>
                <form method = "POST" enctype = "multipart/form-data">
                                        
                    <div class="input-group mt-3">
                        <?php
                            $id = $_GET['id'];
                            $query = "SELECT * FROM manual_table WHERE id = $id";
                            $result = $conn->prepare($query);
                            $result->execute();
                                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<p>Are you sure you want to delete the ".$row['manual_pdf']."?</p>";
                                    echo "<input type=\"hidden\" name=\"id\" value=\"$id\">";
                                }
                        ?> 
                    </div>
                    <br>
                        <button type="submit" name = "deleteBtn" class="btn bgc-red-light rounded-pill text-light" style="width: 100px">Delete</button>
                </form>
            </div>
        </div>
<?php include '../a_includes/admin_footer.php'; ?>
