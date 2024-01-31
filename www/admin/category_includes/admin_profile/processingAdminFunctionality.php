<?php
  if(isset($_POST['update_cred'])) {
    
    $username = trim($_POST['username']);
    
    $user_id = $_SESSION['user_id'];
    
    $update_cred = "UPDATE user_table SET username = :username WHERE id = :user_id";
    $run_update_cred = $conn->prepare($update_cred);
    $run_update_cred->bindParam(":username", $username);
    $run_update_cred->bindParam(":user_id", $user_id);
    $run_update_cred->execute();
    
    $_SESSION['username'] = $username;
    echo "
    <script>
    setTimeout(() => {
      document.querySelector('.updatedd').classList.remove('hidden');
    }, 0100)
    setTimeout(() => {
      document.querySelector('.updatedd').classList.add('hidden');
      document.location.href = './admin_profile.php';
    }, 1000)
    </script>
  
    ";
  }
?>
