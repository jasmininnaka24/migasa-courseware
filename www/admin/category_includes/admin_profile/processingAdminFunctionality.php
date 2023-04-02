<?php
  if(isset($_POST['update_cred'])) {

    $username = trim($_POST['username']);
    $id = 1;

    
    $update_cred = "UPDATE user_table SET username = :username, question_recovery = :question_recovery, answer_recovery = :answer_recovery WHERE id = :id";
    $run_update_cred = $conn->prepare($update_cred);
    $run_update_cred->bindParam(":username", $username);
    $run_update_cred->bindParam(":question_recovery", $question_recovery);
    $run_update_cred->bindParam(":answer_recovery", $answer_recovery);
    $run_update_cred->bindParam(":id", $id);
    $run_update_cred->execute();
    
    $_SESSION['username'] = $username;
    
  }
?>
