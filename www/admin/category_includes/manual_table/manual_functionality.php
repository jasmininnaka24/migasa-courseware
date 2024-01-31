<?php

    // ADD MANUAL
    if(isset($_POST['addManual'])){
        $manual_pdf = $_FILES['manual_pdf']['name'];
        $pdf_tmp_loc = $_FILES['manual_pdf']['tmp_name'];
        $pdf_file_location = "../../../backend_storage/uploaded_pdf/$manual_pdf";
      
        if(move_uploaded_file($pdf_tmp_loc, $pdf_file_location)){
          $manual_query = "INSERT INTO manual_table(manual_pdf) VALUES ('$manual_pdf')";
          $query_run = $conn -> prepare($manual_query);
          $query_run -> execute();
        }
        //Storing file id and pdf file into sessions
        $query_select_from_manual = $conn->prepare("SELECT * FROM manual_table");
        $query_select_from_manual->execute();
        while($row = $query_select_from_manual->fetch(PDO :: FETCH_ASSOC)){
          $_SESSION['manual_id_db'] = $row['id'];
          $_SESSION['manual_pdf_db'] = $row['manual_pdf'];
        }
        // header('Location: admin_manual.php');
        echo "
        <script>
        setTimeout(() => {
          document.querySelector('.added').classList.remove('hidden');
        }, 0100)
        setTimeout(() => {
          document.querySelector('.added').classList.add('hidden');
          document.location.href = 'admin_manual.php';
        }, 1000)
        </script>
      
        ";
      }

      // UPDATE MANUAL
      if (isset($_POST['updateBtn'])) {
        $manual_pdf = $_FILES['manual_pdf']['name'];
        $pdf_tmp_loc = $_FILES['manual_pdf']['tmp_name'];
        $pdf_file_location = "../../../backend_storage/uploaded_pdf/$manual_pdf";
        $id = $_POST['id'];

        // Check if a new file has been uploaded
        if ($manual_pdf != "") {        
          $select_manual  = $conn->prepare("SELECT * FROM manual_table WHERE id = :id");
          $select_manual ->bindParam(":id", $id);
          $select_manual ->execute();
          $fetch_manual_pdf = $select_manual->fetch(PDO::FETCH_ASSOC); 
          $manual_pdf_db = $fetch_manual_pdf['manual_pdf'];
          $manual_file_path = "../../../backend_storage/uploaded_pdf/$manual_pdf_db";
          
          unlink($manual_file_path);

          // Move the new file to the file directory
          move_uploaded_file($pdf_tmp_loc, $pdf_file_location);
  
        } else {
          $delete_manual  = $conn->prepare("SELECT * FROM manual_table WHERE id = :id");
          $delete_manual ->bindParam(":id", $id);
          $delete_manual ->execute();
          $fetch_manual_pdf = $delete_manual->fetch(PDO::FETCH_ASSOC); 
          $manual_pdf = $fetch_manual_pdf['manual_pdf'];

        }

        // Update the data in the database
        $update_manual_query = "UPDATE manual_table SET manual_pdf = :manual_pdf WHERE id = :id";
        $stmt = $conn->prepare($update_manual_query);
        $stmt->bindParam(':manual_pdf', $manual_pdf, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        // header('Location: admin_manual.php');
        echo "
        <script>
        setTimeout(() => {
          document.querySelector('.updated').classList.remove('hidden');
        }, 0100)
        setTimeout(() => {
          document.querySelector('.updated').classList.add('hidden');
          document.location.href = 'admin_manual.php';
        }, 1000)
        </script>
      
        ";
    }       



    // DELETE MANUAL
    if (isset($_GET['delete_manual_id'])){
      $manual_id = $_GET['delete_manual_id'];

      $delete_manual  = $conn->prepare("SELECT * FROM manual_table WHERE id = :manual_id");
      $delete_manual ->bindParam(":manual_id", $manual_id);
      $delete_manual ->execute();
      $fetch_manual_pdf = $delete_manual ->fetch(PDO::FETCH_ASSOC); 
      $manual_pdf = $fetch_manual_pdf['manual_pdf'];

      $file_path = "../../../backend_storage/uploaded_pdf/$manual_pdf";

              
      // Delete the data in the database
      $update_manual_query = "DELETE FROM manual_table WHERE id = ?";
      $stmt = $conn->prepare($update_manual_query);
      $stmt->execute([$manual_id]);

      if (unlink($file_path)) {
        echo '';
      } else {
          echo 'Error deleting file.';
      }

      // header('Location: admin_manual.php');
      echo "
      <script>
      setTimeout(() => {
        document.querySelector('.deleted').classList.remove('hidden');
      }, 0100)
      setTimeout(() => {
        document.querySelector('.deleted').classList.add('hidden');
        document.location.href = 'admin_manual.php';
      }, 1000)
      </script>
    
      ";
  }    
    
?>
