<?php 
  ob_start();
  session_start();
  include '../database.php';
  include '../a_includes/admin_header.php';

  
?>
<style>



</style>
    <nav class="anim-to-top-slow">
        <div class="row">
            <div class="col-12">
                <div class="d-flex align-items-center justify-content-between mt-4 px-5">
                    <div class="d-flex py-3">
                        <div style="width: 4rem;">
                            <img src="../../assets/img/migasa 2.png" width="100%" alt="">
                        </div>

                        <h2 style="margin-left: 2rem;" class="font-bold">Change Password</h2>
                    </div>

                    
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid anim-to-top-slow" id = pop-up>


             <!-- reset password -->
           
             <div class = "container mt-4" id = "reset-password" >
                <div class = "row d-flex align-items-center justify-content-center">
                    <div class = "col-6">
                        <?php include '../../category_includes/verification_folder/admin_acc_re_pass.php'; ?>
                        <form action = "" method = "POST">

                            <div class = "form-group">
                                <label for = "username" class = "font-med align-items-center" style = "margin-right: 1rem; font-size: 20px">Enter new Password</label>
                                    <br>
                                <input type = "password" id = "password" name = "password" class = "form-control" style = "border-color:transparent; border: .1rem solid #999;" placeholder = "Enter Password..."></input>
  
                            </div>
                            <div class="password-meter">
                                <div class="password-meter-bar"></div>
                            </div>
                            <div class="password-meter-text text-center"></div>
                            <br>
                            <div class="errorMessage">

                            </div>

                            <div class="password-requirements mt-4">
                                <p>Password must be 8 characters long</p>
                                <p>Password must contain at least 1 symbol</p>
                                <p>Password must contain at least 1 number</p>
                                <p>Password must contain at least 1 uppercase letter</p>
                            </div>


                            <div class = "form-group mt-5">
                                <label for = "username" class = "font-med align-items-center" style = "margin-right: 1rem; font-size: 20px">Re-enter new Password</label>
                                    <br>
                                <input type = "password" id = "admin_confirm-password" name = "confirm_password" class = "form-control" placeholder = "confirm password..." style = "border-color:transparent; border: .1rem solid #999;"></input>
                            </div>
                            <br>
                            <div class = "button d-flex align-items-center justify-content-end" id = "saveBtn">
                                
                                <button name="cancelBtn" class="btn bgc-gray-light rounded-pill font-med align-items px-4 mx-2" style="font-size: 18px; border: 1px solid #222;">Cancel</button>
                                
                                <button name = "updatePassVer" type="submit" class="btn bgc-red-light rounded-pill font-med align-items px-4" style="font-size: 18px;">Save</button>
                            </div>
                            
                            
                        <form>
                    </div>
                </div>
                
            </div>


<?php include '../../includes/admin_footer.php'; ?>
<script src="../../assets/js/jquery-3.5.1.min.js"></script>

<?php include "../a_includes/admin_footer.php" ?>
