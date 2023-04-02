<?php 
    ob_start();
    session_start();
    include './includes/database.php';
    include './includes/session_role.php';
    include './category_includes/course_folder/processingCourseFunctionality.php';
    include './includes/admin_header.php';
?>
    <style>
      .hover_course{
        background: #eaeae5;
        color: #222;
      }
      .hover_course:hover{
        color: #fff;
        background: #f20e0e;
        transition: all .2s ease-in-out;
      }
      .hover_course:focus{
        color: #fff;
        background: #f20e0e;
        transition: all .2s ease-in-out;
      }
      table {
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 20px;
        border: 1px solid #ddd;
      }

   
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

      .table button {
        border: none;
        padding: 8px 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 19px;
        margin-right: 5px;
        border-radius: 4px;
        outline: none;
      }



      .course, .video, .activity, .scoring{
        transition: all .2s linear;
      }
      .course:hover, .video:hover, .activity:hover, .scoring:hover{
        background: #f2f2f2;
      }


    </style>


  <!-- SIDEBAR NAVIGATION -->
  <?php include './includes/admin_sidebar.php'; ?>
  <?php include './includes/admin_sidebar_section_header.php'; ?>
      
      <?php 
        $courseCount = $conn->prepare("SELECT * FROM course_table");
        $courseCount->execute();

        $count = 0;
        while($courseCount->fetch(PDO::FETCH_ASSOC)){
          $count += 1;
        }
        
        if($count === 0){
          echo "
          <div class='text-center font-med display-4 py-5'>NO COURSE HAS BEEN CREATED</div>
          ";
        } else {

        
        if($count > 0){ ?>
            <div class="d-flex align-items-center justify-content-center mt-3">
              <form action="" id="filter_btn" method="POST">

                <!-- FILTER BUTTONS - FILIPINO AND ENGLISH -->
                
                <div>
                  <a href="./courses_display.php?language=all_languages" class="btn font-med rounded-pill mx-1 px-3" 
                  style="<?php
                    if(isset($_GET['language']) && $_GET['language'] === 'all_languages'){
                      echo "font-size: 16px; border: 2px #222 solid; color: #222";
                    } else {
                      echo "font-size: 16px; border: 2px #999 solid; color: #999";
                    }
                  ?>"
                  >
                    All Courses
                  </a>
                  <?php 
                  $fetch_languages = $conn->prepare("SELECT * FROM language_table");
                  $fetch_languages->execute();
                  
                  
                  while($language_row = $fetch_languages->fetch(PDO::FETCH_ASSOC)) {
                    $language = $language_row['language'];

                    ?>
    
                    <a href='./courses_display.php?language=<?php echo $language; ?>' class='btn font-med rounded-pill mx-1 px-3' style='<?php
                    if(isset($_GET['language']) && $_GET['language'] === $language){
                      echo "font-size: 16px; border: 2px #222 solid; color: #222";
                    } else {
                      echo "font-size: 16px; border: 2px #999 solid; color: #999";
                    }
                  ?>'>
                      <?php echo $language; ?> Courses
                    </a>
                      
                  
                    <?php }
                  ?>
                
              </div>
            </form>
            </div>

          <?php
        }

      ?>
        <hr>

      <?php 
        $check_existing_courses = $conn->prepare("SELECT * FROM course_table");
        $check_existing_courses->execute();

        $course_count = 0;
        while($check_existing_courses->fetch(PDO::FETCH_ASSOC)){
          $course_count += 1;
        }

        if($course_count === 0) {
          echo "
            <div class='text-center font-med display-4 py-5 anim-to-top-slow'>NO COURSE HAS BEEN CREATED</div>
          ";
        } else { ?>

          <!-- main -->
          <main style="min-height: 90%;" class="w-100 d-flex align-items-center  flex-column anim-to-top-slow">
            <div class="container">
              <div class="col-12 mx-auto text-center h5 my-4" style="color: #555;">
              Each element in the Video List column is interactive, allowing you to easily <span class="txt-primary">view the videos under a certain course</span> by simply <span class="txt-primary">clicking on the "See List of Videos" button.</span> Additionally, you can <span class="txt-primary"> edit and delete the course by clicking their buttons.</span>
              </div>


            <!-- FILTER -->
            <?php
              if(isset($_GET['language'])){
                $language = $_GET['language'];
                if($language === "all_languages"){
                  echo "<h4 class='font-bold my-3'>All Language Courses</h4>";
                }else {
                  echo "<h4 class='font-bold my-3'>$language Courses</h4>";
                }

                
              }
            ?>
            <table class="table">
              <thead>
                <tr>
                  <th class="text-center"></th>
                  <th class="text-center">Course Icon</th>
                  <th class="text-center">Course Title</th>
                  <th class="text-center">Course Language</th>
                  <th class="text-center">List of Lessons</th>
                  <th class="text-center">Modify</th>
                </tr>
              </thead>
              <tbody>
              <?php
              if(isset($_GET['language'])){
                $language = $_GET['language'];

                if($language == 'all_languages'){

                  $select_all_course = $conn->prepare("SELECT * FROM course_table");
                  $select_all_course->execute();

                  
                } else {
                  
                  $select_all_course = $conn->prepare("SELECT * FROM course_table WHERE course_lang = '$language'");
                  $select_all_course->execute();
                  $rowcount = $select_all_course->rowCount();
                  if($rowcount > 0){
                    echo "no";
                  } else {
                    echo "";
                  }
                }
                
                $num_count = 1;
                while($row = $select_all_course->fetch(PDO::FETCH_ASSOC)){ 
                  $course_id = $row['id'];
                  $course_title = $row['course_title'];
                  $course_icon = $row['course_icon'];
                  $course_lang = $row['course_lang'];
                  ?>

                    <tr>
                      <td class="text-center font-med course pt-3"><?php echo $num_count; ?></td>
                      <td class="text-center video">
                        <div class="d-flex align-items-center justify-content-center pt-1">
                          <div style="width: 40px; height: 40px; object-fit: cover;">
                            <img src="../backend_storage/uploaded_icons/<?php echo $course_icon; ?>" width="100%" height="100%" alt="">
                          </div>
                        </div>
                      </td>
                      <td class="text-center font-med course pt-4" style="font-style: 22px;"><?php echo $course_title; ?></td>
                      <td class="text-center font-med course pt-4" style="font-style: 22px;"><?php echo $course_lang; ?></td>
                      <td class="text-center font-med course pt-3">
                        <a href="./videos_display.php?course_id_display=<?php echo $course_id;?>" class="text-decoration-none d-flex align-items-center justify-content-center mt-1">
                          <button class="bgc-gray-light rounded-pill px-4" style="border: #222 1px solid;">List of Lessons</button>
                        </a>
                      </td>

                      <td class="">
                        <div class="d-flex align-items-center justify-content-center">
                          <a href="./read/course/updateCourseUI.php?update_course_id=<?php echo $course_id; ?>" class="text-decoration-none d-flex align-items-center justify-content-center mt-1">
                            <button class="bg-transparent rounded-pill px-4" style="border: #2e6341 1px solid; color: #2e6341;">Edit Course</button>
                          </a>
                          <a onClick="return confirm('Are you sure you want to delete?')" href="./courses_display.php?delete_course=<?php echo $course_id; ?>">      
                          <button class="rounded-pill bg-transparent" style="border: #cc2b0e 1px solid; color: #cc2b0e;">Delete Course</button>
                          </a>
                      </div>
                      </td>
                    </tr>
                    <?php 
                    $num_count += 1; 
                  }
                ?>

              </tbody>
            </table>
              <?php    
                  }


                
              ?>
            </div>
          </main>

          <?php
        }
      ?>





    <?php } ?>
    </section>

    <div class="overlay hidden"></div>
    
<?php include './includes/admin_footer.php'; ?>