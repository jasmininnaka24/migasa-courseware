<?php
    // session_start();

     include('../database.php');


    if(isset($_POST['verifyBtn'])){
        $question_recovery = trim($_POST['question_recovery']);
        $answer_recovery = trim($_POST['answer_recovery']);

        $salt = "@specialpassworddummyy";
    
        // encrypting answer
        $encrypted_answer_rec = sha1($answer_recovery.$salt);
        $answer_recovery = $encrypted_answer_rec;

        if(isset($_GET['username'])){
            $username = $_GET['username'];
            
            $validation_query = "SELECT * FROM user_table WHERE username = :username";
            $run_validation_query = $conn->prepare($validation_query);
            $run_validation_query->bindParam(":username", $username);
            $run_validation_query->execute();
            
            $row = $run_validation_query->fetch(PDO::FETCH_ASSOC);
            $question_recovery_db = $row['question_recovery'];
            $answer_recovery_db = $row['answer_recovery'];
       
    
            if($question_recovery_db == $question_recovery && $answer_recovery_db == $answer_recovery){
                echo "
                    <script>
                        document.location.href = './forget_password_re_pass.php?username=$username';
                    </script>
                ";
                
            }else{
                echo "<p class='text-danger'>Invalid!</p>"; 
        }
        }

}


if(isset($_GET['username'])){
    $username = $_GET['username'];
            
    $validation_query = "SELECT * FROM user_table WHERE username = :username";
    $run_validation_query = $conn->prepare($validation_query);
    $run_validation_query->bindParam(":username", $username);
    $run_validation_query->execute();
    
    $row = $run_validation_query->fetch(PDO::FETCH_ASSOC);
    $question_recovery_db = $row['question_recovery'];
}

?>

