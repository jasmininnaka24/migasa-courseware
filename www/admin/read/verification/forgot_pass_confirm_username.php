<?php 
    include '../a_includes/admin_header.php'; 
    include('../database.php');

?>  
<style>
    .col-8 {
  margin: 0 auto;
  max-width: 600px;
}

.my-auto {
  margin-top: 10%;
}

    </style>
   
        <div class="container-fluid anim-to-top-slow" id = pop-up>
            <nav>
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-between mt-4 px-5">
                            <div class="d-flex py-3">
                                <div style="width: 4rem;">
                                    <img src="../../assets/img/migasa 2.png" width="100%" alt="">
                                </div>

                                <h2 style="margin-left: 2rem;" class="font-bold">Admin (Forgot Password)</h2>
                            </div>

                            <a href="../../home.php" class="text-decoration-none">
                                <button class="btn d-flex align-items-center justify-content-center " style="height: 2.5rem">
                                    <p style="margin-right: 0.4rem; font-size: 18px" class="font-med">Discard</p>
                                        <div>
                                            <img src="../../assets/img/exit 2.png" style="width: 20px; height: 16px; margin-top: -20px" width="100%" alt=""/>
                                        </div>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
            
            <!-- user name confirmation -->
            <div class="col-12 mx-auto text-center h5 my-4" style="color: #555;"> 
            Note: Type your <span class="txt-primary">username</span> in the the textbox provided click on the <span class="txt-primary">"Confirm"</span>button to match your username.
            </div>
            <?php 
                $select_username_query = $conn->prepare("SELECT * FROM user_table WHERE id = :id");
                $select_username_query->execute();

                while($rows=$select_username_query->FETCH(PDO::FETCH_ASSOC)){
                    $username = $row['user_username'];
                }
            ?>
           
            <div class = "container mt-4" id =  "username-confirm">
                <div class="row">
                    <div class="col-8 my-auto">

                        <h2 class="font-bold align-items-center">Reset Password</h2>
                        <form method="POST" class="text-left">
                            <div class="row mb-3">
                            <div class="col">
                                <label for="username" class="font-med align-items-center" style="font-size: 20px">Username</label>
                            </div>
                            </div>
                            <div class="row mb-3">
                            <div class="col">
                                <input type="text" id="username" name="username" class="form-control" style="border: .1rem solid #444;" required>
                                
                            </div>
                            </div>
                            <div class="row">
                            <div class="col text-end">
                                <div class="button" id="saveBtn">
                                     <button name="confirmBtn" type="submit" class="btn bgc-red-light rounded-pill font-med" style="width: 100px; font-size: 18px;" onclick="validateUsernameConfirmation()">Confirm</button>
                                </div>
                            </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
                <?php
                    include '../../category_includes/verification_folder/admin_acc_confirm_username_functionality.php'; 
                ?>

    </div>
<!--<script src = "../../assets/js/validation_username_confirmation.js"></script>-->
<?php include '../a_includes/admin_footer.php'; ?>
