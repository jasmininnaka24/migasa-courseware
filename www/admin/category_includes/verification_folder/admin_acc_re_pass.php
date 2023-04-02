<?php 

    if(isset($_POST['updatePassVer'])){
        $entered_pass = $_POST['password'];
        $re_entered_pass = $_POST['confirm_password'];

        if($entered_pass === $re_entered_pass){
            // Define password requirements
            $minimum_length = 8;
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
                $id = 1;
                
                $update_cred = "UPDATE user_table SET password = :password WHERE id = :id";
                $run_update_cred = $conn->prepare($update_cred);
                $run_update_cred->bindParam(":password", $password);
                $run_update_cred->bindParam(":id", $id);
                $run_update_cred->execute();

                $_SESSION['password'] = $password;
    
                if(isset($_SESSION['role'])) {
                    echo "
                        <script>
                            document.location.href = '../profile/profile.php';
                        </script>
                    ";
                } else {
                    echo "
                    <script>
                        document.location.href = '../../../hero_section.php';
                    </script>
                    ";
                    $_SESSION['role'] == null;
                    $_SESSION['username'] == null;
                    $_SESSION['password'] == null;
                }
            }

        } else {
            echo "<h3 class='text-danger'>Password do not match</h3>";
        }
    }

    if(isset($_POST['cancelBtn'])){
        if(isset($_SESSION['role'])) {
            echo "
                <script>
                    document.location.href = '../profile/profile.php';
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