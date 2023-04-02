<?php

    ob_start();
    date_default_timezone_set('Asia/Manila');
  
    try {
        $conn = new PDO("sqlite:../database.db");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    }
    catch(PDOException $e) {
        echo 'Exception -> ';
        var_dump($e->getMessage());
    }

   session_start();
   
   if(isset($_POST['admin_login_btn'])){

    $admin_username = trim($_POST['admin_username']);
    $admin_password = trim($_POST['admin_password']);

    $salt = "iloveyousomuch143boukxmapagmahalbeybeh";
    $encrypted_password = sha1($admin_password.$salt);
    $admin_password = $encrypted_password;

    $query = "SELECT * FROM admin_table WHERE admin_username = :admin_username AND admin_password = :admin_password";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':admin_username', $admin_username);
    $stmt->bindParam(':admin_password', $admin_password);
    $stmt->execute();

    $checkrow = 0;

    while($smt->fetch(PDO::FETCH_ASSOC)){
      $checkrow += 1;
    }

    if($checkrow == 1){
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      $admin_password = $row['admin_password'];
      $admin_username = $row['admin_username'];
      $role = $row['role'];

      // extracting data through sessions
      $_SESSION['admin_password'] = $admin_password;
      $_SESSION['admin_username'] = $admin_username;
      $_SESSION['role'] = $role;

      if($_SESSION['role'] != 'Admin'){
        echo "
          <script>
              document.location.href = './pick_language.php';
          </script>
        ";
      } else {
        echo "
          <script>
              document.location.href = './admin/admin_home.php';
          </script>
        "; 
      } 
    }
  
  }

?>
