<?php 

    if(isset($_POST['updatePassVer'])){
        $entered_pass = trim($_POST['password']);
        $re_entered_pass = trim($_POST['confirm_password']);

        if($entered_pass != '' && $re_entered_pass != ''){

        
        if($entered_pass === $re_entered_pass){
            // Define password requirements
            $minimum_length = 7;
            $minimum_symbol_count = 1;
            $minimum_uppercase_count = 1;

            $moreThanEightChar = strlen($entered_pass) <= $minimum_length;
            $containSymbol = preg_match_all("/[!@#$%^&*()\-_=+{};:,<.>]/", $entered_pass) < $minimum_symbol_count;
            $containsUpperCase = preg_match_all("/[A-Z]/", $entered_pass) < $minimum_uppercase_count;


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
                $password = sha1($entered_pass.$salt);
                if(isset($_GET['username'])){
                    $username = $_GET['username'];
                } else if(isset($_SESSION['username'])){
                    $username = $_SESSION['username'];
                }
                
                $update_cred = "UPDATE user_table SET password = :password WHERE username = :username";
                $run_update_cred = $conn->prepare($update_cred);
                $run_update_cred->bindParam(":password", $password);
                $run_update_cred->bindParam(":username", $username);
                $run_update_cred->execute();

                $_SESSION['password'] = $password;
    
                if(isset($_SESSION['role'])) {
                    echo "
                    <script>
                    setTimeout(() => {
                      document.querySelector('.updatedd').classList.remove('hidden');
                    }, 0100)
                    setTimeout(() => {
                      document.querySelector('.updatedd').classList.add('hidden');
                      document.location.href = '../profile/admin_profile.php';
                    }, 1000)
                    </script>
                  
                    ";
                } else {
                    echo "
                    <script>
                        document.location.href = '../../../hero_section.php';
                    </script>
                    ";
                    // $_SESSION['role'] == null;
                    // $_SESSION['admin_username'] == null;
                    // $_SESSION['admin_password'] == null;
                }
            }

        } else {
            echo "<h3 class='text-danger'>Password do not match</h3>";
        }
    } else {
        echo "<h3 class='text-danger'>Field cannot be empty</h3>";
    }
    }


    if(isset($_POST['cancelBtn'])){
        $session_role = $_SESSION['role'];

        if($session_role === 'Super Admin' || $session_role === 'Admin') {
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

        } 

    }
?>

