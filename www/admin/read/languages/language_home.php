<?php
    ob_start();
    session_start();
    include '../database.php';
    include '../a_includes/session_role.php';
    include '../../category_includes/language_folder/language_functionality.php';
?>
<!DOCTYPE html>
<html lang="en">
    <a href="../../"></a>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link
      rel="stylesheet"
      href="../../assets/bootstrap-5.1.3-dist/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="../../assets/css/general_styles.css" />
    <link rel="stylesheet" href="../../assets/css/modal_language.css">
    <link rel="stylesheet" href="../../assets/icons/fontawesome/css/all.css" />
    <link rel="stylesheet" href="../../assets/icons/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="../../assets/css/add_course.css">
    <link rel="stylesheet" href="../../assets/css/general_styles.css" />
    <link rel="stylesheet" href="../../assets/css/add_video.css">
    <link rel="stylesheet" href="../../assets/css/admin_home.css">
    <link rel="stylesheet" href="../../assets/css/course_display.css">
    <link rel="stylesheet" href="../../assets/css/sidebar.css">    
    <link rel="stylesheet" href = "../../assets/css/manual_style.css">
    <link rel="stylesheet" href = "../../assets/css/verification.css">

    
    <script src="../../assets/js/jquery-3.5.1.min.js"></script>

    <style>
        table {
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 20px;
        border: 1px solid #ddd;
      }

     /* Track */

      .table td {
        text-align: left;
        padding: 10px;
        border: 1px solid #ddd;
      }

      .table th {
        background-color: #f2f2f2;
        /* border-top: 1px solid #ddd;
        border-left: 1px solid #ddd; */
      }
      .file-list {
        list-style: none;
        padding: 0;
        margin: 10px 0 0 0;
        width: 100%;
        max-width: 400px;
        }

        .file-list li {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 5px;
        background-color: #f8f8f8;
        border: 1px solid #ddd;
        margin-bottom: 5px;
        }

        .file-list li .file-name {
        font-size: 16px;
        margin-right: 10px;
        }

        .file-list li .remove-button {
        background-color: red;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 4px;
        cursor: pointer;
        }

        .modal{
        position: absolute;
        min-height: 70vh;

        }

html {
  --scrollbarBG: transparent;
  --thumbBG: transparent;
}
body::-webkit-scrollbar {
  width: 0px;
}
body {
  scrollbar-width: thin;
  scrollbar-color: var(--thumbBG) var(--scrollbarBG);
}
body::-webkit-scrollbar-track {
  background: var(--scrollbarBG);
}
body::-webkit-scrollbar-thumb {
  background-color: var(--thumbBG) ;
  border-radius: 6px;
  border: 3px solid var(--scrollbarBG);
}

</style>
</head>
<body>





<div class="added hidden position-fixed" style="top: 0; left: 0; z-index: 9999999999 !important;">
  <div class="invalid_modal_container">
    <div class="invalid_modal d-flex flex-column" style="background: #ddf5d9; color: #444">
      <div class="h2">
      ✅ ADDED SUCCESSFULLY!
      </div>
    </div>
  </div>
</div>

<div class="updatedd hidden position-fixed" style="top: 0; left: 0; z-index: 9999;">
  <div class="invalid_modal_container">
    <div class="invalid_modal d-flex flex-column" style="background: #ddf5d9; color: #444">
      <div class="h2">
      ✅ UPDATED SUCCESSFULLY!
      </div>
    </div>
  </div>
</div>


<div class="deleted hidden position-fixed" style="top: 0; left: 0; z-index: 9999999999 !important;">
    <div class="invalid_modal_container">
      <div class="invalid_modal d-flex flex-column" style="background: #ddf5d9; color: #444">
        <div class="h2">
        ✅ DELETED SUCCESSFULLY!
        </div>
      </div>
    </div>
  </div>

<div class="updated hidden position-fixed" style="top: 0; left: 0; z-index: 9999999999 !important;">
    <div class="invalid_modal_container">
      <div class="invalid_modal d-flex flex-column" style="background: #ddf5d9; color: #444">
        <div class="h2">
        ✅ UPDATED SUCCESSFULLY!
        </div>
      </div>
    </div>
  </div>

<div class="added hidden position-fixed" style="top: 0; left: 0; z-index: 9999999999 !important;">
    <div class="invalid_modal_container">
      <div class="invalid_modal d-flex flex-column" style="background: #ddf5d9; color: #444">
        <div class="h2">
        ✅ ADDED SUCCESSFULLY!
        </div>
      </div>
    </div>
  </div>



    <?php
        include '../a_includes/admin_sidebar.php';
        include '../a_includes/admin_sidebar_section_header.php';
    ?>

    <!-- body -->
    <main class="w-100 d-flex align-items-center  flex-column ">
    <div class = "container">
      <?php
        $languageCount = $conn->prepare("SELECT * FROM language_table");
        $languageCount->execute();
        
        $languageCnt = 0;
        while($languageCount->fetch(PDO::FETCH_ASSOC)){ $languageCnt += 1; }

        if($languageCnt === 0){
            echo "<div style='display: flex; justify-content: center;'>
                    <button type='submit' id='add-button' class='btn bgc-red-light font-reg rounded-pill px-3 my-3' style='border-radius: 10px;'>+ Add a language</button>
                </div>";
            echo "<div class='text-center font-med display-4 py-5'>NO LANGUAGE HAS BEEN UPLOADED</div>";
        }else{?>
      
    <div class = "container" style = "border: none;">
        <div class = "row mt-5">
            <div class = "col">
                <div style="display: flex; justify-content: center;">
                <button type='submit' id='add-button' class='btn bgc-red-light font-reg rounded-pill px-3 my-3' style='border-radius: 10px;'>+ Add a language</button>
                </div>

                <br>
                <div class="col-12 mx-auto text-center h5 my-4" style="color: #555;"> 
                    Each element in the Langguage List column is interactive <span class="txt-primary">view the list of different languages.</span>You can modify the language, by simply clicking the buttons <span class="txt-primary"> edit and delete.</span>
                </div>
                <table class = "table">
                    <thead>
                        <tr>
                            <th class="text-center">Icon</th>
                            <th class="text-center">Language</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $query = "SELECT * FROM language_table";
                        $query_run = $conn->prepare($query);
                        $query_run->execute();

                        while($row = $query_run->FETCH(PDO::FETCH_ASSOC)){
                            // $language_icons = explode(',', $row['language_icon']);
                            $language_id = $row['id'];
                            $language = $row['language'];
                            $language_desc = $row['language_description'];

                            $query_lang_icons = "SELECT * FROM language_image_table WHERE language_id = :language_id";
                            $query_lang_icons_run = $conn->prepare($query_lang_icons);
                            $query_lang_icons_run->bindParam(":language_id", $language_id);
                            $query_lang_icons_run->execute();

                            
                            ?>
                        <tr>
                            <td class="text-center">
                                <div class="d-flex align-items-center justify-content-center">
                                <?php 
                                    while($fetch_icons = $query_lang_icons_run->fetch(PDO::FETCH_ASSOC)){
                                        $language_icons = $fetch_icons['language_icon'];
                                        ?>

                                        <div style="width: 30px;" class="mx-1">
                                            <img width="100%" src="../../../backend_storage/uploaded_language_icons/<?php echo $language_icons; ?>" alt="">
                                        </div>

                                        <?php
                                        }
                                    ?>
                                </div>
                                
                            </td>
                            <td class="text-center"><?php echo $language; ?></td>
                            <td class="text-center"><?php echo $language_desc; ?></td>
                            <td class="text-center">
                                <a class="text-decoration-none" style="outline: none;" href="./language_home.php?edit_lang_details=<?php echo $language_id; ?>">
                                    <button class="bg-transparent mx-1 py-1 px-4 rounded-pill edit-button" style='font-size: 18px; border: #2e6341 1px solid; color: #2e6341; outline: none;'>Edit</button>
                                </a>
                                <a href="./language_home.php?delete_lang_details=<?php echo $language_id; ?>" style="outline: none;">
                                    <button class="bg-transparent mx-1 py-1 px-3 rounded-pill text-danger delete-button" style="font-size: 18px; border: 1px solid red; color: #2e6341;  outline: none;">Delete</button>
                                </a>
                            </td>
                           </tr>
                        <?php
                        }
                    ?>
                </tbody>
                </table>
                <?php
        }
        ?>

                    <!-- modal for Add -->
                    <div id="addModal" class="modal" >
                    <div class="modal-content position-absolute" style="z-index: 600; top: 10%; left: 30%; min-height: 50vh; margin-bottom: 5rem;">
                            <h2 class="text-center mt-2" style="color: #333">Add Language</h2>
                            <br>
                            <form method="POST" enctype="multipart/form-data">
                                <!-- File attachment -->
                                <label class="font-med my-3" style="color: #444; font-size: 18px;">Choose icons</label>
                                <div class="form-group" style="display: flex; align-items: center;">
                                    <label for="upload_file" class="rounded-pill bgc-gray-light px-3 py-1" style="border: #555 solid 0.1rem; cursor: pointer; margin-right: 10px;" onclick="document.getElementById('language_icon').click()">Upload File</label>
                                    <input type="file" name="language_icon[]" id="language_icon" value="" accept="image/*" style="display: none" required multiple onchange="displayFileNames()"/>
                                    <span id="file_name" style = "flex-grow: 1;">No file chosen</span>
                                    <span id="file_error" style="font-weight: bold; color: red;"></span>
                                </div>
                                <ul class="file-list"></ul>

                              <!-- Input language -->
                            <input hidden type="number" name="id" id="id">
                            <label for="language-name" class="font-med mt-3" style="color: #444; font-size: 18px;">Language</label>
                            <input type="text" class="rounded-3 mt-2 form-control" id="language" name="language" style="border: 2px solid #777; color: #444;" required>

                            <!-- Input description -->
                            <label for="description" class="font-med mt-3" style="color: #444; font-size: 18px;">Description</label>

                            <div class="input-group d-flex align-items-center justify-content-center position-relative">
                                <textarea name="language_description" id="message" cols="20" rows="3" class="rounded-3 mt-2 form-control" style="border: 2px solid #777; color: #444;" required maxlength="100" onkeyup="countCharacters()"></textarea>

                                <div class="counter" style="z-index: 999;">
                                    <span id="characterCount">0</span>/100
                                </div>
                            </div>
                            <span id="description_error" style="color:red; font-weight: bold; margin-top: 10px;"></span>
                            <br>

                                <!-- Function button -->
                                <div class="add-button-modal" style="text-align: right; margin-top: 10px;">
                                    <button type="submit" id="addBtn" name="addBtn" class="btn bgc-red-light rounded-pill font-med" style="width: 100px; font-size: 18px; margin-left: 20px;">Save</button>
                                    <a href="./language_home.php">
                                        <button type="button" id="cancelBtn" class="btn bgc-gray-light rounded-pill font-med mx-3" style="width: 100px; border: #222 solid 2px; font-size: 18px; margin-left: 20px;">
                                             Cancel
                                        </button>
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>


                    <!-- EDIT LANGUAGE -->
                    <?php 
                        if(isset($_GET['edit_lang_details'])){
                            $language_id = $_GET['edit_lang_details'];
                            $language_details_db = $conn->prepare("SELECT * FROM language_table WHERE id = $language_id");
                            $language_details_db->execute();

                            $fetch_language_detailss = $language_details_db->fetch();
                            $language = $fetch_language_detailss['language'];
                            $language_desc = $fetch_language_detailss['language_description'];

                            $course_desc_length = strlen($language_desc);
                            ?>

                            <div id="edit-modal" style="max-height: 100%; overflow-y: none;">
                                <div class="modal-content position-absolute" style="z-index: 600; top: 10%; left: 30%; min-height: 50vh; margin-bottom: 5rem;">
                                <h2 class="text-center mt-2" style="color: #333">Update Language</h2>
                                    <br>
                                    <form method="POST" enctype="multipart/form-data">
                                        <!-- File attachment -->
                                        <div>
                                            <label class="font-med my-3" style="color: #444; font-size: 18px;">Icons: </label>
                                            <div class="d-flex align-items-center">
                                            <?php
                                                $language_icons_db = $conn->prepare("SELECT * FROM language_image_table WHERE language_id = $language_id");
                                                $language_icons_db->execute();
                    
                                                while($fetch_language_icons = $language_icons_db->fetch()){
                                                    $language_iconss = $fetch_language_icons['language_icon'];
                                                    ?>

                                                        <div style="width: 30px;" class="mx-1">
                                                            <img width="100%" src="../../../backend_storage/uploaded_language_icons/<?php echo $language_iconss; ?>" alt="">
                                                        </div>
                                                        
                                                        <?php
                                                }
                                                
                                                ?>
                                            </div>

                                        </div>
                                        <label class="font-med my-2" style="color: #444; font-size: 18px;">Replace icons (optional)</label>
                                        
                                        <div class="form-group" style="display: flex; align-items: center;">
                                        <label for="upload_file" class="rounded-pill bgc-gray-light px-3 py-1 mt-3" style="border: #555 solid 0.1rem; cursor: pointer; margin-right: 10px;">Upload File</label>
                                        <input
                                            type="file"
                                            name="updated_lang_icons[]"
                                            id="upload_file"
                                            multiple
                                            onchange="displaySelectedFiles()"
                                            />
                                        </div>
                                        <div id="selected_files" class="rounded-3 px-4 py-2">
                                        </div>

                                        <!-- Input language -->
                                        <input hidden type="number" name="language_id" value="<?php echo $language_id; ?>" id="id">
                                        <label for="language-name" required class="font-med mt-3" style="color: #444; font-size: 18px;">Language</label>
                                        <input type="text" class="rounded-3 mt-2 form-control" id="language" name="language" value="<?php echo $language; ?>" style="border: 2px solid #777; color: #444;" required>

                                        <!-- Input description -->
                                        <label for="description" required class="font-med mt-3" style="color: #444; font-size: 18px;">Description</label>

                                        <div class="input-group d-flex align-items-center justify-content-center position-relative">
                                            <textarea name="language_description" id="message" cols="20" rows="3" class="rounded-3 mt-2 form-control" style="border: 2px solid #777; color: #444;" required maxlength="100" onkeyup="countCharacters()"><?php echo $language_desc; ?></textarea>

                                            <div class="counter" style="z-index: 9999;">
                                                <span id="characterCount" ><?php echo $course_desc_length; ?></span>/100
                                            </div>

                                        </div>
                                        <span id="description_error" style="color:red; font-weight: bold; margin-top: 10px;"></span>
                                        <br>

                                        <!-- Function button -->
                                        <div class="add-button-modal" style="text-align: right; margin-top: 10px;">
                                            <button type="submit" id="addBtn" name="updateBtn" class="btn bgc-red-light rounded-pill font-med" style="width: 100px; font-size: 18px; margin-left: 20px;">Save</button>
                                            <a href="./language_home.php">
                                                <button type="button" id="cancelBtn" class="btn bgc-gray-light rounded-pill font-med mx-3" style="width: 100px; border: #222 solid 2px; font-size: 18px; margin-left: 20px;">
                                                    Cancel
                                                </button>
                                            </a>
                                        </div>
                                    </form>
                                </div>
                                <div class="overlay"></div>
                            </div>

                            <?php
                        }
                    ?>






                <!-- DELETE LANGUAGE -->

                <?php 
                 if(isset($_GET['delete_lang_details'])){
                    $language_id = $_GET['delete_lang_details'];
                    ?>


                    <!-- modal for delete -->
                    <div id="delete-modal" class="" style="max-height: 100%; overflow-y: none; ">
                        <div class="modal-content position-absolute" style="top: 30%; left: 30%; min-height: 25vh; z-index: 9999;">
                            <h2 class="text-center mt-2" style="color: #333">Delete Language</h2>
                            <br>
                            <p class="text-center lead">Input a password to confirm deletion:</p>
                            <?php 
                                if(isset($_POST['delete_confirmation'])){

                                    $superadmin_password = $_SESSION['password'];
                                    $password = trim($_POST['password']);

                                    
                                    if($password == ''){
                                        echo "<p class='lead font-med text-center txt-red-light'>Password input cannot be empty</p>";
                                    } else {

                                        $salt = "@specialpassworddummyy";
                                        $encrypted_password = sha1($password.$salt);
                                        $password = $encrypted_password;

                                        if($password != $superadmin_password){
                                            echo "<p class='lead font-med text-center txt-red-light'>Password did not match</p>";
                                        } else {

                                            // DELETING LANGUAGE
                                            $delete_language = $conn->prepare("DELETE FROM language_table WHERE id = :language_id");
                                            $delete_language->bindParam(":language_id", $language_id);
                                            $delete_language->execute();

                                            // SELECTING ICONS THEN UNLINK THEM
                                            $unlink_lang_icon = $conn->prepare("SELECT language_icon FROM language_image_table WHERE language_id = :language_id");
                                            $unlink_lang_icon->bindParam(":language_id", $language_id);
                                            $unlink_lang_icon->execute();
                                            while($fetch_icons = $unlink_lang_icon->fetch(PDO::FETCH_ASSOC)){
                                                $language_icons = $fetch_icons['language_icon'];
                                                // ICONS FILE PATH
                                                $language_icons = "../../../backend_storage/uploaded_language_icons/$language_icons";
                                                unlink($language_icons);
                                            }

                                            // DELETING ICONS
                                            $delete_lang_icon = $conn->prepare("DELETE FROM language_image_table WHERE language_id = :language_id");
                                            $delete_lang_icon->bindParam(":language_id", $language_id);
                                            $delete_lang_icon->execute();


                                            // SELECTING ICONS THEN UNLINK THEM
                                            $unlink_course_images = $conn->prepare("SELECT course_icon FROM course_table WHERE course_lang_id = :language_id");
                                            $unlink_course_images->bindParam(":language_id", $language_id);
                                            $unlink_course_images->execute();
    
                                            while($fetch_img = $unlink_course_images->fetch(PDO::FETCH_ASSOC)){
                                                $course_img = $fetch_img['course_icon'];
                                                $icon_del_file_path = "../backend_storage/uploaded_icons/$course_img";

                                                // ICONS FILE PATH
                                                if($course_img != 'BIT TYP LOGO.png'){
                                                    unlink($icon_del_file_path);
                                                }
                                            }
    
    
                                            // SELECTING COURSES UNDER THIS LANGUAGE
                                            $select_course_id = $conn->prepare("SELECT id FROM course_table WHERE course_lang_id = :language_id");
                                            $select_course_id->bindParam(":language_id", $language_id);
                                            $select_course_id->execute();
    
                                            while($fetch_course_id = $select_course_id->fetch(PDO::FETCH_ASSOC)){
                                                $course_id = $fetch_course_id['id'];
                                                
                                                // DELETING ROWS THAT HAVE THE SAME COURSE_ID
                                                
                                                // SELECTING VIDEOS THEN UNLINK THEM
                                                $unlink_course_lesson_videos = $conn->prepare("SELECT video_file_name FROM videos_table WHERE course_id = :course_id");
                                                $unlink_course_lesson_videos->bindParam(":course_id", $course_id);
                                                $unlink_course_lesson_videos->execute();
        
                                                while($fetch_vid = $unlink_course_lesson_videos->fetch(PDO::FETCH_ASSOC)){
                                                    $course_lesson_vid = $fetch_vid['video_file_name'];
                                                    // ICONS FILE PATH
                                                    unlink($course_lesson_vid);
                                                }                                         
                                                

                                                // DELETING VIDEO LESSONS UNDER THIS LANGUAGE AND COURSE
                                                $delete_lesson_vid = $conn->prepare("DELETE FROM videos_table WHERE course_id = :course_id");
                                                $delete_lesson_vid->bindParam(":course_id", $course_id);
                                                $delete_lesson_vid->execute();
                                                

                                                // DELETING ACTIVITY/QUIZES UNDER THIS LANGUAGE AND COURSE
                                                $delete_quizes = $conn->prepare("DELETE FROM activity_table WHERE course_id = :course_id");
                                                $delete_quizes->bindParam(":course_id", $course_id);
                                                $delete_quizes->execute();

                                                // DELETING CHOICES UNDER THIS LANGUAGE AND COURSE
                                                $delete_choices = $conn->prepare("DELETE FROM choices_table WHERE course_id = :course_id");
                                                $delete_choices->bindParam(":course_id", $course_id);
                                                $delete_choices->execute();
    
                                                // DELETING SCORES UNDER THIS LANGUAGE AND COURSE
                                                $delete_scoring = $conn->prepare("DELETE FROM score_table WHERE course_id = :course_id");
                                                $delete_scoring->bindParam(":course_id", $course_id);
                                                $delete_scoring->execute();
    
    
                                                // SELECTING CAPTIONS THEN UNLINK THEM
                                                $unlink_lesson_caption = $conn->prepare("SELECT caption_file_name FROM caption_table WHERE course_id = :course_id");
                                                $unlink_lesson_caption->bindParam(":course_id", $course_id);
                                                $unlink_lesson_caption->execute();
        
                                                while($fetch_caption = $unlink_lesson_caption->fetch(PDO::FETCH_ASSOC)){
                                                    $lesson_caption = $fetch_caption['caption_file_name'];
                                                    // ICONS FILE PATH
                                                    $lesson_caption = "../../../backend_storage/uploaded_captions/$lesson_caption";
                                                    unlink($lesson_caption);
                                                }  
    
                                                // DELETING CAPTIONS UNDER THIS LANGUAGE AND COURSE
                                                $delete_captions = $conn->prepare("DELETE FROM caption_table WHERE course_id = :course_id");
                                                $delete_captions->bindParam(":course_id", $course_id);
                                                $delete_captions->execute();
    
                                                // DELETING ENROLLED RECORDS UNDER THIS LANGUAGE AND COURSE
                                                $delete_enrolled_rec = $conn->prepare("DELETE FROM enrolled_courses_table WHERE course_id = :course_id");
                                                $delete_enrolled_rec->bindParam(":course_id", $course_id);
                                                $delete_enrolled_rec->execute();
    
                                                // DELETING FINISHED COURSES RECORD UNDER THIS LANGUAGE AND COURSE
                                                $delete_finished_rec = $conn->prepare("DELETE FROM finished_courses_table WHERE course_id = :course_id");
                                                $delete_finished_rec->bindParam(":course_id", $course_id);
                                                $delete_finished_rec->execute();
    
    
                                                // DELETING USER ACT SCORE UNDER THIS LANGUAGE AND COURSE
                                                $delete_act_score = $conn->prepare("DELETE FROM user_act_score WHERE course_id = :course_id");
                                                $delete_act_score->bindParam(":course_id", $course_id);
                                                $delete_act_score->execute();
    
                                                // DELETING LAST ACTIVITY TRACKER
                                                $delete_last_act_tracker = $conn->prepare("DELETE FROM last_activity_user_table_tracker WHERE course_id = :course_id");
                                                $delete_last_act_tracker->bindParam(":course_id", $course_id);
                                                $delete_last_act_tracker->execute();
    
                                            }
    
    
                                            // DELETING COURSES UNDER THIS LANGUAGE
                                            $delete_courses = $conn->prepare("DELETE FROM course_table WHERE course_lang_id = :language_id");
                                            $delete_courses->bindParam(":language_id", $language_id);
                                            $delete_courses->execute();


                                            // header("Location: ./language_home.php");
                                            echo "
                                            <script>
                                            setTimeout(() => {
                                              document.querySelector('.deleted').classList.remove('hidden');
                                            }, 0100)
                                            setTimeout(() => {
                                              document.querySelector('.deleted').classList.add('hidden');
                                              document.location.href = './language_home.php';
                                            }, 1000)
                                            </script>
                                          
                                            ";
                                        }
                                        



                                    }
                                }
                                
                            ?>
                            <form id='deleteModal' method='POST' enctype='multipart/form-data'>

                            
                                <input type='password' id='password' name='password' style="border: 2px solid #777; color: #444;" class="rounded-3 mt-2 form-control"><br>

                                <div style='text-align: right; margin-top: 10px;'>
                                    <button type='submit' name="delete_confirmation" id='deleteBtn' class='btn bgc-red-light rounded-pill font-med deleteBtn' style='width: 100px; font-size: 18px; margin-left: 20px;'>Confirm</button>

                                    <a href = "./language_home.php">
                                        <button type='button'  class='btn bgc-gray-light rounded-pill font-med mx-3 cancelBtn' style='width: 100px; border: #444 solid 1px; font-size: 18px; margin-left: 20px;'>Cancel</button>
                                    </a>
                                </div>

                            </form>
                        </div>
                        <div class="overlay"></div>

                    </div>

                    <?php
                }
                    ?>









            </div>
        </div>
    </div>
    </div>
    <main>
                </section>
    <script>
        var modal = document.geElementById('delete-modal');
        var btns = document.querySelectorAll('.delete-button');
        var span = document.getElementsByClassName('closeBtn')[0];
        var deleteBtn = document.getElementById('deleteBtn');

        btns.forEach(function(btn){
            btn.addEventListener('click', function(event){
                var lang_id = document.getElementId('id');
                var id = this.getAttribute('data-id')
                lang_id.value = id;
                modal.style.display = 'block';
            });
        });
        
        function confirmDelete(password_match) {
        console.log('confirmDelete called with password_match: ' + password_match);
        if (password_match) {
          if (confirm("Are you sure you want to delete?")) {
            window.location.href = './language_home.php?delete_language=<?php echo $id; ?>';
          }
        } else {
          alert('Invalid password');
        }
      }
    </script>

    <script>
        function displaySelectedFiles() {
        const input = document.getElementById('upload_file');
        const output = document.getElementById('selected_files');
        const files = input.files;
        let fileNames = '';

        for (let i = 0; i < files.length; i++) {
        const fileName = files[i].name;
        const fileId = `file_${i}`;
        fileNames += `
            <div id="${fileId}">
            ${fileName}
            <button type="button" style='font-size: 15px; background:transparent; border:none; color: red' class='my-1 font-med' onclick="deleteFile('${fileId}')">X</button>
            </div>
        `;
        }

            output.innerHTML = fileNames;
        }

        function deleteFile(fileId) {
            const fileElement = document.getElementById(fileId);
            fileElement.parentNode.removeChild(fileElement);
        }
    </script>
    <!-- <script src = "../../../assets/js/validation_language.js"></script> -->
    <script src="../../assets/bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
    <script src="../../assets/js/jquery-3.6.0.min.js"></script>
    <!-- <script src="../../assets/js/modals.js"></script> -->
    <script src="../../assets/js/admin_sidebar.js"></script>
    <script src="../../assets/js/guide.js"></script>
    <script src = "../../assets/js/modal_language.js"></script>
    <script src = "../../assets/js/general_func.js"></script>
    <script src = "../../assets/js/language_icon_progressBar.js"></script> 
    <script src = "../../assets/js/edit_modal_language.js"></script>
    <script src = "../../assets/js/delete_modal_language.js"></script>

</body>
</html>