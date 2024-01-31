<?php
    if(isset($_POST['confirmBtn'])){
        $username = trim($_POST['username']);


        $confirm = "SELECT * FROM user_table WHERE username = :username";
        $run_confirm = $conn->prepare($confirm);
        $run_confirm->bindParam(':username', $username);
        $run_confirm->execute();
        $row = $run_confirm->fetch(PDO::FETCH_ASSOC);

        $username_db = $row['username'];
        $user_role = $row['role'];

        if($username === $username_db){
            
            if($user_role === 'Super Admin' || $user_role === 'Admin'){
                echo "
                    <script>
                        document.location.href = './forgot_pass_verification.php?username=$username';
                    </script>
                ";
            } else {
                // if either professional or student
                echo "
                    <script>
                        document.location.href = './userredirect.php';
                    </script>
                ";
            }
            
            

        } else {
            echo "<h3 class='txt-red-light text-center mt-5 showWrong'>No username record found.</h3>
            ";
        }
    }
?>