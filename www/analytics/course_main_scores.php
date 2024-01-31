<?php
  ob_start();
  session_start();

  include './includes/database.php';
  include './includes/session_role.php';
  include './includes/admin_header.php';
  include './includes/admin_sidebar.php';
  
?>
<style>
    .table-art{
      box-shadow: 0 3px 20px #888;
      margin: 0 .5 1rem .5rem;
    }
    /* Track */
    ::-webkit-scrollbar-track {
    background: transparent; 
  }

  /* Handle */
  ::-webkit-scrollbar-thumb {
    background: transparent; 
    border-radius: 10px;

  }

  /* Handle on hover */
  ::-webkit-scrollbar-thumb:hover {
    background: transparent; 
  }
</style>

<body class="bg-light">
  <section class="home-section">
      <div class="d-flex align-items-center justify-content-between">
        <i class='bx bx-menu-alt-left' style="font-size: 38px; cursor: pointer;"></i>
        <i class="fa-regular fa-circle-xmark hidden" style="font-size: 30px; cursor: pointer;"></i>
        <div class="d-flex justify-content-end">
  
          <a href="./main_dashboard.php" class="text-decoration-none">
            <button
            class="btn mt-2 mt-2 d-flex align-items-center justify-content-center"
            style="height: 2.5rem"
            name="home"
            >
            <p
              style="margin-right: 0.4rem; font-size: 18px"
              class="font-med"
              >
              Home
            </p>
            <div>
              <img
              src="./assets/img/exit 2.png"
              style="width: 20px; height: 16px; margin-top: -20px"
              width="100%"
              alt=""
              />
            </div>
          </button>
        </a>
        <?php 
          if(isset($_GET['course_id'])){
            $course_id = $_GET['course_id'];
          }
        ?>
        <a href="./course_report.php?course_id=<?php echo $course_id; ?>" class="text-decoration-none">
          <button
            class="btn mt-2 mt-2 d-flex align-items-center justify-content-center"
            style="height: 2.5rem"
            name="home"
          >
            <p
            style="margin-right: 0.4rem; font-size: 18px"
            class="font-med"
            >
            Back to Performace Rate
          </p>
          <div>
            <img
            src="./assets/img/exit 2.png"
            style="width: 20px; height: 16px; margin-top: -20px"
            width="100%"
            alt=""
            />
          </div>
        </button>
      </a>
        </div>
      </div>
  <main class="container-fluid">
    <div id="courses">
      <section>
        <article class="rounded-3" style="margin-top: 2%;">
          <?php
            if(isset($_GET['course_id'])){
              $course_id = $_GET['course_id'];
            
              $course_details_db = $conn->prepare("SELECT id, course_title, course_lang_id FROM course_table");
              $course_details_db->execute();

              $fetch_course_det = $course_details_db->fetch(PDO::FETCH_ASSOC);

              $course_title = $fetch_course_det['course_title'];
              $course_lang_id = $fetch_course_det['course_lang_id'];

              // getting course_title
              $course_db =  $conn->prepare("SELECT course_title FROM course_table WHERE id = :course_id");
              $course_db->bindParam(":course_id", $course_id);
              $course_db->execute();
              $fetch_course_title = $course_db->fetch(PDO::FETCH_ASSOC);
              $course_title = $fetch_course_title['course_title'];

              // getting language thru its id
              $lang_id_db =  $conn->prepare("SELECT language FROM language_table WHERE id = :course_lang_id");
              $lang_id_db->bindParam(":course_lang_id", $course_lang_id);
              $lang_id_db->execute();
              $fetch_course_lang = $lang_id_db->fetch(PDO::FETCH_ASSOC);
              $course_lang = $fetch_course_lang['language'];

              // getting the number of enrolled student under this course
              $enrolled_db =  $conn->prepare("SELECT user_id FROM enrolled_courses_table WHERE course_id = :course_id");
              $enrolled_db->bindParam(":course_id", $course_id);
              $enrolled_db->execute();

              $enrolled_user_count = 0;
              while($enrolled_db->fetch(PDO::FETCH_ASSOC)){
                $enrolled_user_count += 1;
              }

              ?>

              <div style="padding-top:0%;">
                <h1 class="container text-center mb-1"><?php echo $course_title; ?> <span style="color: #777; font-size: 16px;">(<?php echo $course_lang;?>)</span></h1>
                <h5 class="text-center" style="color: #777; padding-bottom: 2%;">Users' Scores</h5>

              </div>
              <?php
            }            
          ?>

      <script>
          setTimeout(function() {
            document.getElementById('course-det').classList.remove('hidden');
            document.querySelector('.table-art').classList.remove('hidden');
          }, 1000); 
        </script>
      </script>

      <article class="rounded-3 table-art px-4 mx-4 py-4 my-2">
        <div id="course-det">
          <table id="example" class="table table-bordered">
            <thead class="px-4 rounded-3" style="background: #444; color: #fff;">
              <tr>
                <th class="text-center" style="width: 8%;">ID</th>
                <th>User Name</th>
                <th class="text-center">Course Progress</th>
                <th class="text-center">Record Average</th>
                <th class="text-center" >Quiz Scores</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if(isset($_GET['course_id'])){

                  
                  $course_id = $_GET['course_id'];
                
                  $course_details_db = $conn->prepare("SELECT * FROM enrolled_courses_table WHERE course_id = :course_id");
                  $course_details_db->bindParam(":course_id", $course_id);
                  $course_details_db->execute();

                while($fetch_course_det = $course_details_db->fetch(PDO::FETCH_ASSOC)){
                  $user_id = $fetch_course_det['user_id'];
                  $course_progress = $fetch_course_det['course_progress'];
                  $numhours = $fetch_course_det['numhours'];
                  $record_ave = $fetch_course_det['record_ave'];
                  $retake_num = $fetch_course_det['retake_num'];

                  $username_db = $conn->prepare("SELECT firstname, lastname FROM user_table WHERE id = :user_id");
                  $username_db->bindParam(":user_id", $user_id);
                  $username_db->execute();
                  $fetch_username = $username_db->fetch(PDO::FETCH_ASSOC);
                  $username = $fetch_username['firstname'] . " " . $fetch_username['lastname'];

                  ?>

                    <tr class="course-list-row">
                      <td class="text-center"><?php echo $user_id; ?></td>
                      <td>
                        <a class="text-dark text-decoration-none" href="./users_main.php?user_id=<?php echo $user_id;?>">
                          <?php echo $username; ?>
                        </a>    
                      </td>
                      <td class="text-center"><?php echo $course_progress; ?>%</td>

                      <td class="text-center">
                        <?php
                          $record_ave = $record_ave != 100 ? $record_ave : $record_ave;
                          echo $record_ave;
                        ?>
                      </td>
                      <td style="text-align: center;">
                        <a href="./course_main_scores.php?course_id=<?php echo $course_id;?>&user_id=<?php echo $user_id;?>">
                          <div class="btn bgc-gray-light rounded-pill" style="border: 1px solid #444; font-size: 16px; width: 80%;">View</div>
                        </a>
                      </td>
                     </tr>

                  <?php
                }
              }
              ?>
            </tbody>
          </table>
        </div>
        </article>

        <br>
        </article>
        
      </section>
    </div>

       

    <?php
      if(isset($_GET['user_id'])){
        $user_id = $_GET['user_id'];

        $username = $conn->prepare("SELECT firstname, lastname FROM user_table WHERE id = $user_id");
        $username->execute();
        $fetch_username = $username->fetch(PDO::FETCH_ASSOC);
        $username = $fetch_username['firstname'] . ' ' . $fetch_username['lastname'];

        ?>
          <div id="printableArea" class="px-4 py-3 bgc-gray-light rounded-3 position-absolute w-75" style="z-index: 350; top: 15%; left: 12%; min-height: 70vh;" >
          
          <a class="text-decoration-none text-dark" href="./course_main_scores.php?course_id=<?php echo $course_id; ?>">
          <div class="d-flex align-items-center justify-content-end w-100">
              <div class="lead font-med" style="font-size: 30px">&times;</div>
            </div>
          </a>

            <h4 class="text-center my-3"><?php echo $username; ?>'s Scores</h4>
            <table class="table">
              <thead style="background: #444; color: #fff">
                <tr>
                  <th></th>
                  <th>Lesson Title</th>
                  <th class="text-center">Quiz Items</th>
                  <th class="text-center">Passing Score</th>
                  <th class="text-center">Score</th>
                </tr>
              </thead>
              <tbody>
                
              
            <?php 
              $select_video_title = $conn->prepare("SELECT id, video_title FROM videos_table WHERE course_id = $course_id");
              $select_video_title->execute();

              $count_num = 0;
              $overall = 0;
              $overall_score = 0;
              while($fetch_video_title = $select_video_title->fetch(PDO::FETCH_ASSOC)){
                $video_id = $fetch_video_title['id'];
                $video_title = $fetch_video_title['video_title']; 
                
                $scoring_db = $conn->prepare("SELECT selected_act, passing_score FROM score_table WHERE course_id = $course_id AND video_id = $video_id");
                $scoring_db->execute();
                $fetch_scoring_db = $scoring_db->fetch(PDO::FETCH_ASSOC);
                $selected_act = $fetch_scoring_db['selected_act'];
                $passing_score = $fetch_scoring_db['passing_score']; 

                $user_score = $conn->prepare("SELECT user_score FROM user_act_score WHERE course_id = $course_id AND lesson_id = $video_id AND user_id = $user_id");
                $user_score->execute();
                $fetch_user_score = $user_score->fetch(PDO::FETCH_ASSOC);
                $user_score = $fetch_user_score['user_score'];
                                
                $overall += $selected_act;
                $overall_score += $user_score;
                
               
                $user_status = $conn->prepare("SELECT user_status FROM enrolled_courses_table WHERE course_id = $course_id AND user_id = $user_id");
                $user_status->execute();
                $fetch_user_status = $user_status->fetch(PDO::FETCH_ASSOC);
                $user_status = $fetch_user_status['user_status'];

                $_SESSION['user_status'] = $user_status;
                $count_num += 1;
                ?>
                  <tr>
                    <td><?php echo $count_num; ?></td>
                    <td><?php echo $video_title; ?></td>
                    <td class="text-center"><?php echo $selected_act; ?></td>
                    <td class="text-center"><?php echo $passing_score; ?></td>
                    <td class="text-center"><?php echo $user_score; ?></td>
                  </tr>

                <?php
                }
                
              ?>
              </tbody>
            </table>
            <?php
              if($user_status === 'FINISHED'){
                $record_ave = round(($overall_score / $overall) * 100);
                ?>
                  <div class="lead font-med">Record Average: <?php echo $record_ave; ?></div>
                <?php
              }
              ?>
            </div>

          <div class="overlay" style="z-index: 300;"></div>
        <?php
      }
    ?>
    
  </main>

</section>
<?php include './includes/admin_footer.php'; ?>
