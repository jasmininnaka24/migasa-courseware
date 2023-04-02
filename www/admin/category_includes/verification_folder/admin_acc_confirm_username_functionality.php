<?php

    if(isset($_POST['confirmBtn'])){
        $username = $_POST['username'];

        $confirm = "SELECT * FROM user_table WHERE username = :username";
        $run_confirm = $conn->prepare($confirm);
        $run_confirm->bindParam(':username', $username);
        $run_confirm->execute();
        $row = $run_confirm->FETCH(PDO::FETCH_ASSOC);

        if($row['username'] == $username){
            echo "
                <script>
                    document.location.href = './forgot_pass_verification.php';
                </script>
            ";
        }else{
            echo "<h3 class='txt-red-light text-center mt-5 showWrong'>Invalid Username Input</h3>
            ";
        
        
        }
    }
?>