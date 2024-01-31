<?php

    // ADDING COURSE FUNCTIONALITY
    if(isset($_POST['create_course'])){
      $course_title = ucwords(trim($_POST['course_title']));
      $course_description = trim($_POST['course_description']);
      $course_lang = trim($_POST['course_lang_id']);
      $course_icon = $_FILES['course_icon']['name'];
      $course_icon_temp = $_FILES['course_icon']['tmp_name'];

      if($course_icon == ""){
        $course_icon = 'BIT TYP LOGO.png';
      } else {
        $course_icon = uniqid() . "_" . $course_icon;
      }      
      
      
      if($course_title != "" && $course_description != ""){ 
        
        $validate_course_title = $conn->prepare("SELECT course_title, course_lang_id FROM course_table WHERE course_title = :course_title AND course_lang_id = :course_lang_id");
        $validate_course_title->bindParam(':course_title', $course_title);
        $validate_course_title->bindParam(':course_lang_id', $course_lang);
        $validate_course_title->execute();
        $fetch_course_title = $validate_course_title->fetch(PDO::FETCH_ASSOC);
        $course_title_db = $fetch_course_title['course_title'];
        
        if (strlen($course_title_db) > 1) {
          echo "<h3 class='mt-5 container txt-red-light font-med text-center  container d-flex align-items-center justify-content-center'>Course title already exists</h3>";
        }
        
        else {

        
          
        // MOVING FILE TO A FOLDER
        move_uploaded_file($course_icon_temp, "../../../backend_storage/uploaded_icons/$course_icon");

        // creating command
        $query_insert_course_credentials = $conn->prepare("INSERT INTO course_table (course_title, course_desc, course_lang_id, course_icon) VALUES (:course_title, :course_desc, :course_lang, :course_icon)");

        $query_insert_course_credentials->bindParam(":course_title", $course_title);
        $query_insert_course_credentials->bindParam(":course_desc", $course_description);
        $query_insert_course_credentials->bindParam(":course_lang", $course_lang);
        $query_insert_course_credentials->bindParam(":course_icon", $course_icon);

        $query_insert_course_credentials->execute();

        
        echo
        "
        <script>
        setTimeout(() => {
          document.querySelector('.added').classList.remove('hidden');
        }, 0100)
        setTimeout(() => {
          
          document.location.href = '../../courses_display.php?language=all_languages';
          document.querySelector('.added').classList.add('hidden');
        }, 1000)
        </script>
  
        ";
        }
      } else {
        echo "
        <script>
          setTimeout((e) => {
            document.querySelector('.unhide').classList.remove('hidden');
            e.preventDefault();
          }, 0100)
        </script>
        ";
        }

        $_SESSION['add_course_icon'] = null;
        $_SESSION['add_course_title'] = null;
        $_SESSION['add_course_description'] = null;
        $_SESSION['add_language'] = null;
      }

      
      
      
      // UPDATING COURSE DETAILS
      if(isset($_POST['update_course'])){
      $course_id = trim($_POST['course_id']);
      $course_title = ucwords(trim($_POST['course_title']));
      $course_description = trim($_POST['course_description']);
      $course_lang = trim($_POST['course_lang_id']);
      $course_icon = $_FILES['course_icon']['name'];
      $course_icon_temp = $_FILES['course_icon']['tmp_name'];

      
      if($course_title != "" && $course_description != ""){  
        
        // CHECKING IF COURSE ICON IS EMPTY

        if(empty($course_icon)){
          
          $select_course_icon = $conn->prepare("SELECT course_icon FROM course_table WHERE id = :course_id");
          $select_course_icon->bindParam(":course_id", $course_id);
          $select_course_icon->execute();
  
          $row = $select_course_icon->fetch(PDO::FETCH_ASSOC);
          $course_icon = $row['course_icon'];


        } else {

          $delete_icon  = $conn->prepare("SELECT * FROM course_table WHERE id = :course_id");
          $delete_icon ->bindParam(":course_id", $course_id);
          $delete_icon ->execute();
          $fetch_icon = $delete_icon ->fetch(PDO::FETCH_ASSOC); 
          $course_icon_to_del = $fetch_icon['course_icon'];
    
          $file_path = "../../../backend_storage/uploaded_icons/$course_icon_to_del";
    
          if($course_icon_to_del != 'BIT TYP LOGO.png'){
            unlink($file_path);
          }
        
          $course_icon = uniqid() . "_" . $course_icon;
          
          // MOVING FILE TO A FOLDER
          move_uploaded_file($course_icon_temp, "../../../backend_storage/uploaded_icons/$course_icon");
        }
        
        // creating command
        $query_update_course_credentials = $conn->prepare("UPDATE course_table SET course_title = :course_title, course_desc = :course_desc, course_icon = :course_icon, course_lang_id = :course_lang WHERE id = :course_id");

        $query_update_course_credentials->bindParam(":course_title", $course_title);
        $query_update_course_credentials->bindParam(":course_desc", $course_description);
        $query_update_course_credentials->bindParam(":course_icon", $course_icon);
        $query_update_course_credentials->bindParam(":course_lang", $course_lang);
        $query_update_course_credentials->bindParam(":course_id", $course_id);

        $query_update_course_credentials->execute();

        echo
        "
        <script>
        setTimeout(() => {
          document.querySelector('.updatedd').classList.remove('hidden');
        }, 0100)
        setTimeout(() => {
          
          document.querySelector('.updatedd').classList.add('hidden');
          document.location.href = '../../courses_display.php?language=all_languages';
        }, 0700)
        </script>
  
        ";
      } else {
        echo "
        <script>
          setTimeout((e) => {
            document.querySelector('.unhide').classList.remove('hidden');
            e.preventDefault();
          }, 0100)
        </script>
        ";
        }
      }
      


    // DELETING A COURSE

    // if(isset($_GET['delete_course'])){
    //   $course_id_del = $_GET['delete_course'];
    
    //   $delete_icon  = $conn->prepare("SELECT * FROM course_table WHERE id = :course_id");
    //   $delete_icon ->bindParam(":course_id", $course_id_del);
    //   $delete_icon ->execute();
    //   $fetch_icon = $delete_icon ->fetch(PDO::FETCH_ASSOC); 
    //   $course_icon_to_del = $fetch_icon['course_icon'];
    
    //   $icon_del_file_path = "../backend_storage/uploaded_icons/$course_icon_to_del";
    
    //   $delete_videos = $conn->prepare("SELECT video_file_name FROM videos_table WHERE course_id = :course_id");
    //   $delete_videos->bindParam(":course_id", $course_id_del);
    //   $delete_videos->execute();
    //   $videos = $delete_videos->fetchAll(PDO::FETCH_ASSOC);
      
    //   foreach ($videos as $video) {
    //     $vid_file_name_to_del = $video['video_file_name'];
    //     $vid_sub_to_del = "../backend_storage/uploaded_subtitle/$vid_sub_to_del";
    //     $vid_file_name_to_del = str_replace("../../../backend_storage/uploaded_vids/", "../backend_storage/uploaded_vids/", $vid_file_name_to_del);
    
    //     unlink($vid_file_name_to_del);
    //     unlink($vid_sub_to_del);
    //   }
    
    //   if($course_icon_to_del != 'BIT TYP LOGO.png'){
    //     unlink($icon_del_file_path);
    //   }
    
    //   $delete_Course = $conn->prepare("DELETE FROM course_table WHERE id = $course_id_del");
    //   $delete_Course->execute();
    
    //   $delete_video_row = $conn->prepare("DELETE FROM videos_table WHERE course_id = :course_id");
    //   $delete_video_row->bindParam(":course_id", $course_id_del);
    //   $delete_video_row->execute();
    
    //   $delete_activity_row = $conn->prepare("DELETE FROM activity_table WHERE course_id = :course_id");
    //   $delete_activity_row->bindParam(":course_id", $course_id_del);
    //   $delete_activity_row->execute();
    
    //   $delete_choices_row = $conn->prepare("DELETE FROM choices_table WHERE course_id = :course_id");
    //   $delete_choices_row->bindParam(":course_id", $course_id_del);
    //   $delete_choices_row->execute();
    
    //   $delete_scoring_row = $conn->prepare("DELETE FROM score_table WHERE course_id = :course_id");
    //   $delete_scoring_row->bindParam(":course_id", $course_id_del);
    //   $delete_scoring_row->execute();
    
    //   header("Location: ./courses_display.php?language=all_languages");
    // }
    

?>