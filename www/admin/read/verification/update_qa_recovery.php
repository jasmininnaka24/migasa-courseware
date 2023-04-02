<?php 
  ob_start();
  session_start();
  include '../database.php';
  include '../a_includes/admin_header.php';


  if(isset($_POST['save_rqa'])){
    $question_rec = trim($_POST['question_rec']);
    $answer_rec = trim($_POST['answer_rec']);

    // if question recovery is empty
    if($question_rec === ''){
        $question_rec_db = $conn->prepare('SELECT * FROM user_table WHERE id = 1');
        $question_rec_db->execute();

        $fetch_question_rec = $question_rec_db->fetch(PDO::FETCH_ASSOC);
        $question_rec = $fetch_question_rec['question_recovery'];
    }
    
    // if answer recovery is empty
    if($question_rec === ''){
        $answer_rec_db = $conn->prepare('SELECT * FROM user_table WHERE id = 1');
        $answer_rec_db->execute();

        $fetch_answer_rec = $answer_rec_db->fetch(PDO::FETCH_ASSOC);
        $answer_rec = $fetch_answer_rec['answer_recovery'];
    }

     // Define password requirements
     $minimum_length = 8;
     $minimum_symbol_count = 1;
     $minimum_uppercase_count = 1;

     $moreThanEightChar = strlen($answer_rec) <= $minimum_length;
     $containSymbol = preg_match_all("/[!@#$%^&*()\-_=+{};:,<.>]/", $answer_rec) < $minimum_symbol_count;
     $containsUpperCase = preg_match_all("/[A-Z]/", $answer_rec) < $minimum_uppercase_count;


     if ($moreThanEightChar || $containSymbol || $containsUpperCase) {

         if ($moreThanEightChar) {
             echo "
             <p class='text-center text-danger'>Be at least $minimum_length characters long</p>";
         }
         if ($containSymbol) {
             echo "<p class='text-center text-danger'>Contain at least $minimum_symbol_count symbol</p>";
         }
         if ($containsUpperCase) {
             echo "<p class='text-center text-danger'>Contain at least $minimum_uppercase_count uppercase letter</p>";
         }
         echo "</ul>";
     } else {
         $salt = "@specialpassworddummyy";
         $answer_rec = sha1($answer_rec.$salt);
         $admin_id = 1;
         
         $update_admin_cred = "UPDATE user_table SET question_recovery = :question_rec, answer_Recovery = :answer_rec WHERE id = :admin_id";
         $run_update_admin_cred = $conn->prepare($update_admin_cred);
         $run_update_admin_cred->bindParam(":question_rec", $question_rec);
         $run_update_admin_cred->bindParam(":answer_rec", $answer_rec);
         $run_update_admin_cred->bindParam(":admin_id", $admin_id);
         $run_update_admin_cred->execute();


         if(isset($_SESSION['role'])) {
             echo "
                 <script>
                     document.location.href = '../profile/admin_profile.php';
                 </script>
             ";
         } else {
             echo "
             <script>
                 document.location.href = '../../../hero_section.php';
             </script>
             ";
             $_SESSION['role'] == null;
             $_SESSION['admin_username'] == null;
             $_SESSION['admin_password'] == null;
         }
     }

 } 
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

                        <h2 style="margin-left: 2rem;" class="font-bold">Change Recovery Question or Answer</h2>
                    </div>

                    
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid anim-to-top-slow" id = pop-up>


             <div class = "container mt-4" id = "reset-password" >
                <div class = "row d-flex align-items-center justify-content-center">
                    <div class = "col-6">
                        <form action = "" method = "POST">

                            <div class = "form-group">

                                <label for="username" class = "font-med align-items-center mb-2" style = "margin-right: 1rem; font-size: 20px">
                                    Enter a new question for recovery
                                </label>

                                <br>
                                
                                <input type = "text" name = "question_rec" class = "form-control" style = "border-color:transparent; border: .1rem solid #999;" placeholder = "Question here..."></input>
                            </div>
                            <br>
                            <div class = "form-group">

                                <label for="username" class = "font-med align-items-center mb-2" style = "margin-right: 1rem; font-size: 20px">
                                    Enter a new answer for recovery
                                </label>

                                <br>
                                
                                <input type = "text" id="password" name = "answer_rec" class = "form-control" style = "border-color:transparent; border: .1rem solid #999;" placeholder = "Answer here..."></input>
                            </div>


                            <div class="password-meter">
                                <div class="password-meter-bar"></div>
                            </div>
                            <div class="password-meter-text text-center"></div>
                            <br>
                            <div class="errorMessage">

                            </div>

                            <div class="password-requirements mt-3">
                                <p>Password must be 8 characters long</p>
                                <p>Password must contain at least 1 symbol</p>
                                <p>Password must contain at least 1 number</p>
                                <p>Password must contain at least 1 uppercase letter</p>
                            </div>



                            <br>
                            <div class = "button d-flex align-items-center justify-content-end" id = "saveBtn">
                            <a href="../profile/admin_profile.php">
                                <div class="btn bgc-gray-light rounded-pill font-med align-items px-4 mx-2" style="font-size: 18px; border: 1px solid #222;">Cancel</div>
                            </a>
                                    
                                <button name = "save_rqa" type="submit" class="btn bgc-red-light rounded-pill font-med align-items px-4" style="font-size: 18px;">Save</button>
                            </div>
                            
                            
                        <form>
                    </div>
                </div>
                
            </div>


<?php include '../../includes/admin_footer.php'; ?>
<script src="../../assets/js/jquery-3.5.1.min.js"></script>

<?php include "../a_includes/admin_footer.php" ?>
