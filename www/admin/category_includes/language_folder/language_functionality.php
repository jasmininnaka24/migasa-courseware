<?php
    //ADD
    if(isset($_POST['addBtn'])){
        $language = $_POST['language'];
        $language_description = $_POST['language_description'];
        $id = $_POST['id'];
        
            $select_language_query = $conn->prepare("SELECT * FROM language_table WHERE language = :language");
            $select_language_query->bindParam(':language', $language);
            $select_language_query->execute();
            $row = $select_language_query->fetch(PDO::FETCH_ASSOC);

            $language_id = $row['id'];
        
                $add_language_query = $conn->prepare("INSERT INTO language_table(language, language_description) VALUES (:language, :language_description)");
                $add_language_query->bindParam(':language', $language);
                $add_language_query->bindParam(':language_description', $language_description);
                $add_language_query->execute();
                $language_id = $conn->lastInsertId();
           
        if($language != "" && $language_description != "" && ($_FILES['language_icon']['name'][0]) != ""){   
            foreach($_FILES['language_icon']['tmp_name'] as $icons => $icon_tmp_name){
                $language_icon = uniqid() . "_" . $_FILES['language_icon']['name'][$icons];
                $file_path = "../../../backend_storage/uploaded_language_icons/".basename($language_icon);
                move_uploaded_file($icon_tmp_name, $file_path);
    
                    $add_language_image_query = $conn->prepare("INSERT INTO language_image_table(language_id, language_icon) VALUES(:language_id, :language_icon)");
                    $add_language_image_query->bindParam(':language_id', $language_id);
                    $add_language_image_query->bindParam(':language_icon', $language_icon);
                    $add_language_image_query->execute();
            }
        }
        echo "
        <script>
        setTimeout(() => {
          document.querySelector('.added').classList.remove('hidden');
        }, 0100)
        setTimeout(() => {
          document.querySelector('.added').classList.add('hidden');
          document.location.href = './language_home.php';
        }, 1000)
        </script>
      
        ";
    }
        
    //UPDATE
    if(isset($_POST['updateBtn'])) {
        $lang_id = $_POST['language_id'];
        $language = ucwords(trim($_POST['language']));
        $language_description = trim($_POST['language_description']);


        if($_FILES['updated_lang_icons']['error'][0] != UPLOAD_ERR_NO_FILE){
            $select_language_query = $conn->prepare("SELECT language_icon FROM language_image_table WHERE language_id = :id");
            $select_language_query->bindParam(':id', $lang_id);
            $select_language_query->execute();


            while($fetch_icon = $select_language_query->fetch(PDO::FETCH_ASSOC)){
                $language_icon = $fetch_icon['language_icon'];
                
                $language_icon = "../../../backend_storage/uploaded_language_icons/$language_icon";
                unlink($language_icon);
              }
              
            $icons_db_del = $conn->prepare("DELETE FROM language_image_table WHERE language_id = :lang_id");
            $icons_db_del->bindParam(":lang_id", $lang_id);
            $icons_db_del->execute();

            $uniqueId = str_pad(mt_rand(10, 99), 4, '0', STR_PAD_LEFT);

    
            foreach($_FILES['updated_lang_icons']['tmp_name'] as $key => $icon_temp) {
            $new_icon = $uniqueId . $_FILES['updated_lang_icons']['name'][$key];
            move_uploaded_file($icon_temp, "../../../backend_storage/uploaded_language_icons/$new_icon");
            $insert_icon = $conn->prepare("INSERT INTO language_image_table (language_id, language_icon) VALUES (:language_id, :language_icon)");
            $insert_icon->bindParam(":language_id", $lang_id);
            $insert_icon->bindParam(":language_icon", $new_icon);
            $insert_icon->execute();
            }

        } 

        $update_lang_details = $conn->prepare("UPDATE language_table SET language = :language, language_description = :lang_desc WHERE id = :language_id");
        
        $update_lang_details->bindParam(":language", $language);
        $update_lang_details->bindParam(":lang_desc", $language_description);
        $update_lang_details->bindParam(":language_id", $lang_id);
        $update_lang_details->execute();


        // header("Location: ./language_home.php");
        echo "
        <script>
        setTimeout(() => {
          document.querySelector('.updatedd').classList.remove('hidden');
        }, 0100)
        setTimeout(() => {
          document.querySelector('.updatedd').classList.add('hidden');
          document.location.href = './language_home.php';
        }, 1000)
        </script>
      
        ";
    }
    
    
 
?>