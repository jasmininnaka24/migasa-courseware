<?php
     include('../database.php');

    if(isset($_POST['verifyBtn'])){
        $question_recovery = $_POST['question_recovery'];
        $answer_recovery = $_POST['answer_recovery'];

        $salt = "@specialpassworddummyy";
    
        // encrypting answer
        $encrypted_answer_rec = sha1($answer_recovery.$salt);
        $answer_recovery = $encrypted_answer_rec;
   
        $verification = "SELECT * FROM user_table WHERE question_recovery = :question_recovery AND answer_recovery = :answer_recovery";
        $run_verification = $conn->prepare($verification);
        $run_verification->bindParam(':question_recovery', $question_recovery);
        $run_verification->bindParam(':answer_recovery', $answer_recovery);
        $run_verification->execute();
        $row = $run_verification->FETCH(PDO::FETCH_ASSOC);
      

        if($row['question_recovery'] == $question_recovery && $row['answer_recovery'] == $answer_recovery){
            echo "
                <script>
                    document.location.href = './forget_password_re_pass.php';
                </script>
            ";
        }else{
            echo "<p class='text-danger'>Invalid!</p>"; 
    }
}
?>

<?php
    $validation_query = "SELECT * FROM user_table";
    $run_validation_query = $conn->prepare($validation_query);
    $run_validation_query->execute();
    
    $row = $run_validation_query -> FETCH(PDO::FETCH_ASSOC);
    $question_recovery = $row['question_recovery'];
?>