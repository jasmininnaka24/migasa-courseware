<?php 
    include '../a_includes/admin_header.php';
    include '../../category_includes/verification_folder/admin_acc_verification_functionality.php'; 
    include '../a_includes/admin_header.php';
?>

    <div class="container-fluid anim-to-top-slow" id = pop-up>
        <nav>
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between mt-4 px-5">
                        <div class="d-flex py-3">
                            <div style="width: 4rem;">
                                <img src="../../assets/img/BIT TYP LOGO.png" width="100%" alt="">
                            </div>

                            <h2 style="margin-left: 2rem;" class="font-bold">Admin(Forget Password)</h2>
                        </div>

                        <a href="../../admin_home.php" class="text-decoration-none">
                            <button class="btn d-flex align-items-center justify-content-center " style="height: 2.5rem">
                                <p style="margin-right: 0.4rem; font-size: 18px" class="font-med">Discard</p>
                                    <div>
                                        <img src="../../assets/img/exit.png" style="width: 20px; height: 16px; margin-top: -20px" width="100%" alt=""/>
                                    </div>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
                    <!-- account verification -->
        
        <div class="container mt-4" id="verification-admin" name="accVerification">
            <div class="row justify-content-center">
                <div class="col-8 my-auto">
                    <h2 class="font-bold align-items-center">Account Verification</h2>
                    <form method="POST" class="text-left" style = "margin-top: 30px;">
                    <div class="input-group d-flex align-items-center justify-content-center">
                    <label for="question_recovery" class="font-med align-items-center" style="margin-right: 1rem; font-size: 20px">Question</label>
                    <input type="text" id="question_recovery" readonly name="question_recovery" value="<?php echo $question_recovery_db; ?>" class="form-control" style="border-radius: 0;" required>
                    </div>
                    <br>
                    <div class="input-group d-flex align-items-center justify-content-center" style="padding-left: 17px;">
                    <label for="answer_recovery" class="font-med align-items-center" style="margin-right: 1rem; font-size: 20px; ">Answer</label>
                    <input type="text" id="answer_recovery" name="answer_recovery" class="form-control" style="border-radius: 0px; border: 2px solid #444;">
                    </div>

                            <br>
                        <div class="button" id="saveBtn" style="text-align: right;">
                            <button name="verifyBtn" type="submit" class="btn bgc-red-light rounded-pill font-med" style="width: 100px; font-size: 18px;">Verify</button>
                        </div>
                     </form>
                </div>
            </div>
        </div>  
    </div>  


<?php include '../a_includes/admin_footer.php'; ?>
